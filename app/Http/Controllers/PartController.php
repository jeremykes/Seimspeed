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

class UserController extends Controller
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
    public function addsale(Request $request, Corporate $corporate, Part $part)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($part->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'price' => 'required|numeric',
        ]);

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
        $partsale->status = $request->status;
        $partsale->note = $request->note;

        $partsale->save();

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
    public function updatesale(Request $request, Corporate $corporate, Part $part, Partsale $partsale)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($part->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'price' => 'required|numeric',
        ]);

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
        $partsale->status = $request->status;
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
    public function deletesale(Request $request, Corporate $corporate, Part $part, Partsale $partsale)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($part->corporate->id != $corporate->id) {
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
    public function closesale(Request $request, Corporate $corporate, Part $part, Partsale $partsale)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($part->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $partsale->status = 'closed';

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
    public function saleofferreserve(Request $request, Corporate $corporate, Part $part, Partsale $partsale, Partsaleoffer $partsaleoffer)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($part->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for partsale status. Move this out to Traits later.
        if ($partsale->status != 'reserved' || $partsale->status != 'opened') {
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

        $partsaleoffer->$user->notify(new PartSaleOfferReservedNotification($partsaleoffer));

        // Fire Part Sale Offer reserved event
        event(new PartSaleOfferReserved($partsaleoffer));

        return response()->json(['success'=>true]);
    }

    /**
     * Sales Offer Reserve Cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function saleofferreservecancel(Request $request, Corporate $corporate, Part $part, Partsale $partsale, Partsaleoffer $partsaleoffer)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($part->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for partsale status. Move this out to Traits later.
        if ($partsale->status != 'reserved' || $partsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

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

        $partsaleoffer->$user->notify(new PartSaleOfferReserveCancelledNotification($partsaleoffer));

        // Fire Part Sale Offer reserve cancelled event
        event(new PartSaleOfferReserveCancelled($partsaleoffer));

        return response()->json(['success'=>true]);
    }

    /**
     * Purchase Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function purchasesale(Request $request, Corporate $corporate, Part $part, Partsale $partsale, Partsaleoffer $partsaleoffer, Partsalereserve $partsalereserve)
    {
        // This is the check for Corp part. Move this out to Traits later.
        if ($part->corporate->id != $corporate->id) {
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

        $partsaleoffer->$user->notify(new PartSaleOfferReservePurchasedNotification($partsaleoffer));

        // Fire Part purchased event
        event(new PartSaleOfferReservePurchased($partsale));

        return response()->json(['success'=>true]);
    }
}



