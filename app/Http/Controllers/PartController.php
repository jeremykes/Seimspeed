<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;

use App\Corporate;
use App\Part;
use App\Partsale;
use App\Partsaleoffer;
use App\Partsalereserve;

use App\Partimage;

// Notifications
use App\Notifications\PartSaleOpenedNotification;
use App\Notifications\PartSaleUpdatedNotification;
use App\Notifications\PartSaleClosedNotification;
use App\Notifications\PartSaleOfferReservedNotification;
use App\Notifications\PartSaleOfferReserveCancelledNotification;
use App\Notifications\PartSaleOfferReservePurchasedNotification;
use App\Notifications\PartSalePurchasedNotification;

// Events
use App\Events\PartSaleAdded;
use App\Events\PartSaleClosed;
use App\Events\PartSaleOfferReserved;
use App\Events\PartSaleOfferReservedCancelled;
use App\Events\PartSaleOfferReservePurchased;

class PartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('corpuser');
        
        $this->middleware('role:sales|administrator'); 
        
    }


    // ===================================================================================
    // 
    // 
    //     Part Images
    // 
    // 
    // =================================================================================== 

    /**
     * Upload part temporary image (no database records inserted)
     *
     * @param  Request $request
     * @return Response 
     */
    public function partuploadtempimage(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $path = $request->file('file')->store('partimages');

        $imageName = $request->file->hashName();
        $image_url = $path;

        $session_key_tail = 'part_image_url';

        if ($request->session()->has('part_image_upload_count')) {
            $part_image_upload_count = (int)$request->session()->get('part_image_upload_count');
        } else {
            $part_image_upload_count = 0;
        }

        $part_image_upload_count++;
        $session_key = $part_image_upload_count.$session_key_tail;

        $request->session()->put($session_key, $image_url);
        $request->session()->put('part_image_upload_count', $part_image_upload_count);

        return response()->json(
            ['img_url' => $image_url, 'filename' => $imageName, 'img_count' => $part_image_upload_count]
        );
    }

    /**
     * Delete part temp image (no database records inserted)
     *
     * @param  Request $request
     * @return Response 
     */
    public function partdeletetempimage(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'serverfilename' => 'required',
            'serverfileurl' => 'required',
            'serverfilecount' => 'required',
        ]);

        $success = true;
        $message = 'File successfully deleted.';

        if ($request->session()->has('part_image_upload_count') && $request->session()->has($request->serverfilecount.'part_image_url')) {
            if (Storage::exists($request->serverfileurl)) {
                Storage::delete($request->serverfileurl);

                $request->session()->forget($request->serverfilecount.'part_image_url');
                $part_image_count = (int)$request->session()->get('part_image_upload_count');
                $part_image_count--;
                $request->session()->put('part_image_upload_count', $part_image_count);
            } else {
                $success = false;
                $message = 'File doesn\'t exist buddy.';
            }
        } else {
            $success = false;
            $message = 'Oops, looks like there were some errors. Refresh the page and try again.';
        }


        return response()->json(
            ['success' => $success , 'message' => $message]
        );
    }


    // ===================================================================================
    // 
    // 
    //     Views
    // 
    // 
    // =================================================================================== 

    /**
     * Show to the create partsale form.
     *
     * @return \Illuminate\Http\Response
     */
    public function addsaleform(Corporate $corporate)
    {
        return view('corp.part.createpartsale', [
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show to the update Partsale form.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatesaleform(Request $request, Corporate $corporate, Partsale $partsale)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($partsale->corporate->id != $corporate->id) {
            return redirect()->back();
        }

        return view('corp.part.partsaleedit', [
            'corporate' => $corporate,
            'partsale' => $partsale,
        ]); 
    }


    // ===================================================================================
    // 
    // 
    //     Sales
    // 
    // 
    // =================================================================================== 

    /**
     * Add Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function addsale(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'part_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        if ($request->car_id != "0" || $request->car_id != 0) {
            $part = Part::findOrFail($request->part_id);

            // This is the check for Corp part. Move this out to Traits later.
            if ($part->corporate->id != $corporate->id) {
                return response()->json(['success'=>false]);
            }

            $partsale = new Partsale;
            $partsale->corporate_id = $corporate->id;
            $partsale->part_id = $part->id;
            if ($request->partgroup_id) {
                $partsale->partgroup_id = $request->partgroup_id;
            }
            $partsale->price = $request->price;
            if ($request->startdate) {
                $partsale->start_date = $request->start_date;
            }
            if ($request->salereserveholddays) {
                $partsale->salereserveholddays = $request->salereserveholddays;
            } else {
                $partsale->salereserveholddays = 3;
            }
            $partsale->negotiable = $request->negotiable;
            $partsale->status = 'opened';
            $partsale->note = $request->note;

            $partsale->save();
        } else {
            $part = new Part;
            $part->corporate_id = $corporate->id;
            $part->published = 1;
            $part->name = $request->name;
            $part->serialnumber = $request->serialnumber;
            $part->descript = $request->descript;
            $part->status = "opened";
            $part->physicallocation = $request->physicallocation;
            $part->note = $request->note;
            $part->save();

            $partsale = new Partsale;
            $partsale->corporate_id = $corporate->id;
            $partsale->part_id = $part->id;
            if ($request->partgroup_id) {
                $partsale->partgroup_id = $request->partgroup_id;
            }
            $partsale->price = $request->price;
            if ($request->startdate) {
                $partsale->start_date = $request->start_date;
            }
            if ($request->salereserveholddays) {
                $partsale->salereserveholddays = $request->salereserveholddays;
            } else {
                $partsale->salereserveholddays = 3;
            }
            $partsale->negotiable = $request->negotiable;
            $partsale->status = 'opened';
            $partsale->note = $request->note;
            $partsale->save();
        }

        // Notification (if partsale status == open)
        // Notify all users following corp

        if ($partsale->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $corporate->id)
                ->where('notificables.model_name', 'corporate')
                ->get();

            Notification::send($users, new PartSaleOpenedNotification($partsale));
        }

        // Fire Part Sale added event
        event(new PartSaleAdded($partsale));

        return response()->json(['success'=>true]);
    }

    /**
     * Update Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatesale(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'partsale_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $partsale = Partsale::findOrFail($request->partsale_id);
        $part = $partsale->part;

        // This is the check for Corp part. Move this out to Traits later.
        if ($partsale->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $part->corporate_id = $corporate->id;
        $part->published = 1;
        $part->name = $request->name;
        $part->serialnumber = $request->serialnumber;
        $part->descript = $request->descript;
        $part->status = "opened";
        $part->physicallocation = $request->physicallocation;
        $part->note = $request->note;
        $part->save();

        $partsale->part_id = $part->id;
        // if ($request->partgroup_id) {
        //     $partsale->partgroup_id = $request->partgroup_id;
        // }
        $partsale->price = $request->price;
        if ($request->startdate) {
            $partsale->start_date = $request->start_date;
        }
        if ($request->salereserveholddays) {
            $partsale->salereserveholddays = $request->salereserveholddays;
        } else {
            $partsale->salereserveholddays = 3;
        }
        $partsale->negotiable = $request->negotiable;
        // $partsale->status = $request->status;
        $partsale->note = $request->note;
        $partsale->save();

        // Notification (if partsale status == open)
        // Notify all users commented, offered, tailed.

        if ($partsale->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $part->id)
                ->where('notificables.model_name', 'part')
                ->get();

            Notification::send($users, new PartSaleUpdatedNotification($partsale));
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletesale(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'partsale_id' => 'required|numeric',
        ]);

        $partsale = Partsale::findOrFail($request->partsale_id);

        // This is the check for Corp part. Move this out to Traits later.
        if ($partsale->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $partsale->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Close Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function closesale(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'partsale_id' => 'required|numeric',
        ]);

        $partsale = Partsale::findOrFail($request->partsale_id);
        $part = $partsale->part;

        // This is the check for Corp part. Move this out to Traits later.
        if ($partsale->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $partsale->status = 'closed';
        $partsale->save();

        // Notification
        // Notify all users commented, offered, tailed.

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $part->id)
            ->where('notificables.model_name', 'part')
            ->get();

        Notification::send($users, new PartSaleClosedNotification($partsale));

        // Fire Part Sale closed event
        event(new PartSaleClosed($partsale));

        return response()->json(['success'=>true]);
    }

    /**
     * Sales Offer Reserve
     *
     * @param  Request $request
     * @return Response 
     */
    public function saleofferreserve(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'partsaleoffer_id' => 'required|numeric',
        ]);

        $partsaleoffer = Partsaleoffer::findOrFail($request->partsaleoffer_id);
        $partsale = $partsaleoffer->partsale;
        $part = $partsaleoffer->partsale->part;

        // This is the check for Corp part. Move this out to Traits later.
        if ($partsale->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for partsale status. Move this out to Traits later.
        if ($partsale->status != 'reserved' && $partsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // check how many reserved partsale offers and stop if minimum 3 of them already exist.
        $count = Partsalereserve::where('partsale_id', $partsale_id)->count();

        if ($count < 3) {
            $partsalereserve = new Partsalereserve;
            $partsalereserve->partsale_id = $partsale->id;
            $partsalereserve->partsaleoffer_id = $partsaleoffer->id;
            $partsalereserve->note = $request->note;
            $partsalereserve->save();
        } else {
            return response()->json(['success'=>false]);
        } 
        // That means we now have a total of 3 reserves, so set as reserved.
        if ($count == 2) {
            $partsale->status = 'reserved';
            $partsale->save();
            
            // Notification
            // Notify all users commented, offered, tailed that partsale is now reserved

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $part->id)
                ->where('notificables.model_name', 'part')
                ->get();

            Notification::send($users, new PartSaleReservedNotification($partsaleoffer));
        }

        // Notification
        // Notify user being reserved

        $partsaleoffer->user->notify(new PartSaleOfferReservedNotification($partsaleoffer));

        // Fire Part Sale Offer reserved event
        event(new PartSaleOfferReserved($partsalereserve));

        return response()->json(['success'=>true]);
    }

    /**
     * Sales Offer Reserve Cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function saleofferreservecancel(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'partsaleoffer_id' => 'required|numeric',
        ]);

        $partsaleoffer = Partsaleoffer::findOrFail($request->partsaleoffer_id);
        $partsale = $partsaleoffer->partsale;
        $part = $partsaleoffer->partsale->part;

        // This is the check for Corp part. Move this out to Traits later.
        if ($partsale->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for partsale status. Move this out to Traits later.
        if ($partsale->status != 'reserved' && $partsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $partsalereserve = Partsalereserve::where('partsale_id', $partsale->id)->firstOrFail();
        $partsalereserve_id = $partsalereserve->id;
        $partsalereserve->delete();

        $count = Partsalereserve::where('partsale_id', $partsale_id)->count();

        if ($count == 0) {
            $partsale->status = 'opened';
            $partsale->save();
            
            // Notification
            // Notify all users commented, offered, tailed that partsale is now opened

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $part->id)
                ->where('notificables.model_name', 'part')
                ->get();

            Notification::send($users, new PartSaleOpenedNotification($partsaleoffer));
        }

        // Notification
        // Notify user whos reserved is cancelled

        $partsaleoffer->user->notify(new PartSaleOfferReserveCancelledNotification($partsaleoffer));

        // Fire Part Sale Offer reserve cancelled event
        event(new PartSaleOfferReserveCancelled($partsalereserve_id, $part->id));

        return response()->json(['success'=>true]);
    }

    /**
     * Purchase Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function purchasesale(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'partsalereserve_id' => 'required|numeric',
        ]);

        $partsalereserve = Partsalereserve::findOrFail($request->partsalereserve_id);
        $partsaleoffer = $partsalereserve->partsaleoffer;
        $partsale = $partsalereserve->partsale;
        $part = $partsalereserve->partsale->part;

        // This is the check for Corp part. Move this out to Traits later.
        if ($partsale->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for partsale status. Move this out to Traits later.
        if ($partsale->status != 'reserved') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'amount' => 'required|numeric',
            'tax' => 'numeric',
            'additionalfees' => 'numeric',
        ]);

        $partsalepurchase = new Partsalepurchase;
        $partsalepurchase->partsale_id = $partsale->id;
        $partsalepurchase->partsalereserve_id = $partsalereserve->id;
        $partsalepurchase->amount = $request->amount;
        $partsalepurchase->tax = $request->tax;
        $partsalepurchase->additionalfees = $request->additionalfees;
        $partsalepurchase->additionalfeesdescript = $request->additionalfeesdescript;
        $partsalepurchase->uniquepaymentid = $request->uniquepaymentid;
        $partsalepurchase->method = $request->method;
        $partsalepurchase->note = $request->note;
        $partsalepurchase->save();

        $partsale->status = 'purchased';
        $partsale->save();

        // Notification
        // Notify user who purchased the part
        // Notify all users commented, offered, tailed that part has been purchased

        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $part->id)
            ->where('notificables.model_name', 'part')
            ->get();

        Notification::send($users, new PartSalePurchasedNotification($partsaleoffer));

        $partsaleoffer->user->notify(new PartSaleOfferReservePurchasedNotification($partsaleoffer));

        // Fire Part purchased event
        event(new PartSaleOfferReservePurchased($partsale));

        return response()->json(['success'=>true]);
    }
}



