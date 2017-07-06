<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use Notification;
use DB;

use App\Corporate;
use App\Car;
use App\Carsale;
use App\Carsaleoffer;
use App\Carsalereserve;
use App\Carrent;
use App\Carrentoffer;
use App\Carrentreserve;
use App\Cartender;
use App\Cartendertender;
use App\Cartenderreserve;
use App\Carauction;
use App\Carauctionbid;
use App\Carauctionreserve;

// Notifications
use App\Notifications\CarSaleAddedNotification;

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
     * Add Sales
     *
     * @param  Request $request
     * @return Response 
     */
    public function addsale(Request $request, Corporate $corporate, Car $car)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'price' => 'required|numeric',
        ]);

        $carsale = new Carsale;
        $carsale->corporate_id = $corporate->id;
        $carsale->car_id = $car->id;
        if ($request->cargroup_id) {
            $carsale->cargroup_id = $request->cargroup_id;
        }
        $carsale->price = $request->price;
        if ($request->startdate) {
            $carsale->start_date = $request->start_date;
        }
        if ($request->salereserveholddays) {
            $carsale->salereserveholddays = $request->salereserveholddays;
        } else {
            $carsale->salereserveholddays = 3;
        }
        $carsale->negotiable = $request->negotiable;
        $carsale->status = $request->status;
        $carsale->note = $request->note;

        $carsale->save();

        // Notification (if carsale status == open)
        // Notify all users following corp

        if ($carsale->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $corporate->id)
                ->where('notificables.model_name', 'corporate')
                ->get();

            Notification::send($users, new CarSaleOpenedNotification($carsale));
        }

        // Fire Car Sale added event
        event(new CarSaleAdded($carsale));

        return response()->json(['success'=>true]);
    }

    /**
     * Update Sales
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatesale(Request $request, Corporate $corporate, Car $car, Carsale $carsale)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'price' => 'required|numeric',
        ]);

        $carsale->corporate_id = $corporate->id;
        $carsale->car_id = $car->id;
        if ($request->cargroup_id) {
            $carsale->cargroup_id = $request->cargroup_id;
        }
        $carsale->price = $request->price;
        if ($request->startdate) {
            $carsale->start_date = $request->start_date;
        }
        if ($request->salereserveholddays) {
            $carsale->salereserveholddays = $request->salereserveholddays;
        } else {
            $carsale->salereserveholddays = 3;
        }
        $carsale->negotiable = $request->negotiable;
        $carsale->status = $request->status;
        $carsale->note = $request->note;
        $carsale->save();

        // Notification (if carsale status == open)
        // Notify all users commented, offered, tailed.

        if ($carsale->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarSaleUpdatedNotification($carsale));
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletesale(Request $request, Corporate $corporate, Car $car, Carsale $carsale)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $carsale->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Close Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function closesale(Request $request, Corporate $corporate, Car $car, Carsale $carsale)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $carsale->status = 'closed';

        // Notification
        // Notify all users commented, offered, tailed.

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarSaleClosedNotification($carsale));

        // Fire Car Sale closed event
        event(new CarSaleClosed($carsale));

        return response()->json(['success'=>true]);
    }

    /**
     * Sales Offer Reserve
     *
     * @param  Request $request
     * @return Response 
     */
    public function saleofferreserve(Request $request, Corporate $corporate, Car $car, Carsale $carsale, Carsaleoffer $carsaleoffer)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carsale status. Move this out to Traits later.
        if ($carsale->status != 'reserved' || $carsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // check how many reserved carsale offers and stop if minimum 3 of them already exist.
        $count = Carsalereserve::where('carsale_id', $carsale_id)->count();

        if ($count < 3) {
            $carsalereserve = new Carsalereserve;
            $carsalereserve->carsale_id = $carsale->id;
            $carsalereserve->carsaleoffer_id = $carsaleoffer->id;
            $carsalereserve->note = $request->note;
            $carsalereserve->save();
        } 
        // That means we now have a total of 3 reserves, so set as reserved.
        if ($count == 2) {
            $carsale->status = 'reserved';
            $carsale->save();
            
            // Notification
            // Notify all users commented, offered, tailed that carsale is now reserved

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarSaleReservedNotification($carsaleoffer));
        }

        // Notification
        // Notify user being reserved

        $carsaleoffer->$user->notify(new CarSaleOfferReservedNotification($carsaleoffer));

        // Fire Car Sale Offer reserved event
        event(new CarSaleOfferReserved($carsaleoffer));

        return response()->json(['success'=>true]);
    }

    /**
     * Sales Offer Reserve Cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function saleofferreservecancel(Request $request, Corporate $corporate, Car $car, Carsale $carsale, Carsaleoffer $carsaleoffer)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carsale status. Move this out to Traits later.
        if ($carsale->status != 'reserved' || $carsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $carsalereserve->delete();

        $count = Carsalereserve::where('carsale_id', $carsale_id)->count();

        if ($count == 0) {
            $carsale->status = 'opened';
            $carsale->save();
            
            // Notification
            // Notify all users commented, offered, tailed that carsale is now opened

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarSaleOpenedNotification($carsaleoffer));
        }

        // Notification
        // Notify user whos reserved is cancelled

        $carsaleoffer->$user->notify(new CarSaleOfferReserveCancelledNotification($carsaleoffer));

        // Fire Car Sale Offer reserve cancelled event
        event(new CarSaleOfferReserveCancelled($carsaleoffer));

        return response()->json(['success'=>true]);
    }

    /**
     * Purchase Sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function purchasesale(Request $request, Corporate $corporate, Car $car, Carsale $carsale, Carsaleoffer $carsaleoffer, Carsalereserve $carsalereserve)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carsale status. Move this out to Traits later.
        if ($carsale->status != 'reserved') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'amount' => 'required|numeric',
            'tax' => 'numeric',
            'additionalfees' => 'numeric',
        ]);

        $carsalepurchase = new Carsalepurchase;
        $carsalepurchase->carsale_id = $carsale->id;
        $carsalepurchase->carsalereserve_id = $carsalereserve->id;
        $carsalepurchase->amount = $request->amount;
        $carsalepurchase->tax = $request->tax;
        $carsalepurchase->additionalfees = $request->additionalfees;
        $carsalepurchase->additionalfeesdescript  = $request->additionalfeesdescript ;
        $carsalepurchase->uniquepaymentid = $request->uniquepaymentid;
        $carsalepurchase->method = $request->method;
        $carsalepurchase->note = $request->note;
        $carsalepurchase->save();

        $carsale->status = 'purchased';
        $carsale->save();

        // Notification
        // Notify user who purchased the car
        // Notify all users commented, offered, tailed that car has been purchased

        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarSalePurchasedNotification($carsaleoffer));

        $carsaleoffer->$user->notify(new CarSaleOfferReservePurchasedNotification($carsaleoffer));

        // Fire Car purchased event
        event(new CarSaleOfferReservePurchased($carsale));

        return response()->json(['success'=>true]);
    }

    // ===================================================================================
    // 
    // 
    //     Rents
    // 
    // 
    // ===================================================================================

    /**
     * Add Rents
     *
     * @param  Request $request
     * @return Response 
     */
    public function addrent(Request $request, Corporate $corporate, Car $car)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'rateperday' => 'numeric',
            'rateperhour' => 'numeric',
            'bondfee' => 'numeric',
        ]);

        $carrent = new Carrent;
        $carrent->corporate_id = $corporate->id;
        $carrent->car_id = $car->id;
        if ($request->cargroup_id) {
            $carrent->cargroup_id = $request->cargroup_id;
        }
        $carrent->rateperday = $request->rateperday;
        $carrent->rateperhour = $request->rateperhour;
        $carrent->bondfee = $request->bondfee;
        if ($request->rentreserveholddays) {
            $carrent->rentreserveholddays = $request->rentreserveholddays;
        } else {
            $carrent->rentreserveholddays = 3;
        }
        $carrent->status = $request->status;
        $carrent->note = $request->note;

        $carrent->save();

        // Notification if status == open
        // Notify all users following corp

        if ($carrent->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $corporate->id)
                ->where('notificables.model_name', 'corporate')
                ->get();

            Notification::send($users, new CarRentOpenedNotification($carrent));
        }

        // Fire Car Rent added event
        event(new CarRentAdded($carrent));

        return response()->json(['success'=>true]);
    }

    /**
     * Update Rents
     *
     * @param  Request $request
     * @return Response 
     */
    public function updaterent(Request $request, Corporate $corporate, Car $car, Carrent $carrent)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'rateperday' => 'numeric',
            'rateperhour' => 'numeric',
            'bondfee' => 'numeric',
        ]);

        $carrent->corporate_id = $corporate->id;
        $carrent->car_id = $car->id;
        if ($request->cargroup_id) {
            $carrent->cargroup_id = $request->cargroup_id;
        }
        $carrent->rateperday = $request->rateperday;
        $carrent->rateperhour = $request->rateperhour;
        $carrent->bondfee = $request->bondfee;
        if ($request->rentreserveholddays) {
            $carrent->rentreserveholddays = $request->rentreserveholddays;
        } else {
            $carrent->rentreserveholddays = 3;
        }
        $carrent->status = $request->status;
        $carrent->note = $request->note;

        $carrent->save();

        if ($carrent->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarRentUpdatedNotification($carrent));
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Rent
     *
     * @param  Request $request
     * @return Response 
     */
    public function deleterent(Request $request, Corporate $corporate, Car $car, Carrent $carrent)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $carrent->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Close Rent
     *
     * @param  Request $request
     * @return Response 
     */
    public function closerent(Request $request, Corporate $corporate, Car $car, Carrent $carrent)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $carrent->status = 'closed';

        // Notification 
        // Notify all users commented, offered, tailed.

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarRentClosedNotification($carrent));

        // Fire Car Rent closed event
        event(new CarRentClosed($carrent));

        return response()->json(['success'=>true]);
    }

    /**
     * Rent Offer Reserve
     *
     * @param  Request $request
     * @return Response 
     */
    public function rentofferreserve(Request $request, Corporate $corporate, Car $car, Carrent $carrent, Carrentoffer $carrentoffer)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carrent status. Move this out to Traits later.
        if ($carrent->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $carrentreserve = new Carrentreserve;
        $carrentreserve->carrent_id = $carrent->id;
        $carrentreserve->carrentoffer_id = $carrentoffer->id;
        $carrentreserve->note = $request->note;
        $carrentreserve->save();

        $carrent->status = 'reserved';
        $carrent->save();
        
        // Notification
        // Notify all users commented, offered, tailed that carsale is now reserved
        // Notify user that car is reserved for him now

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarRentReservedNotification($carrentoffer));

        $carrentoffer->$user->notify(new CarRentOfferReservedNotification($carrentoffer));

        // Fire Car Rent Offer reserved event
        event(new CarRentOfferReserved($carrentoffer));

        return response()->json(['success'=>true]);
    }

    /**
     * Rent Offer Reserve Cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function rentofferreservecancel(Request $request, Corporate $corporate, Car $car, Carrent $carrent, Carrentoffer $carrentoffer)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carrent status. Move this out to Traits later.
        if ($carrent->status != 'reserved') {
            return response()->json(['success'=>false]);
        }

        $carrentreserve->delete();

        $carrent->status = 'opened';
        $carrent->save();
        
        // Notification
        // Notify user whos reserved is cancelled
        // Notify all users commented, offered, tailed that carrent is now opened

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarRentOpenedNotification($carrentoffer));

        $carrentoffer->$user->notify(new CarRentOfferReserveCancelledNotification($carrentoffer));

        // Fire Car Rent Offer reserve cancelled event
        event(new CarRentOfferReserveCancelled($carrentoffer));

        return response()->json(['success'=>true]);
    }

    /**
     * Purchase Rent
     *
     * @param  Request $request
     * @return Response 
     */
    public function purchaserent(Request $request, Corporate $corporate, Car $car, Carrent $carrent, Carrentoffer $carrentoffer, Carrentreserve $carrentreserve)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carrent status. Move this out to Traits later.
        if ($carrent->status != 'reserved') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'amount' => 'required|numeric',
            'tax' => 'numeric',
            'additionalfees' => 'numeric',
        ]);

        $carrentpurchase = new Carrentpurchase;
        $carrentpurchase->carrent_id = $carrent->id;
        $carrentpurchase->carrentreserve_id = $carrentreserve->id;
        $carrentpurchase->amount = $request->amount;
        $carrentpurchase->tax = $request->tax;
        $carrentpurchase->additionalfees = $request->additionalfees;
        $carrentpurchase->additionalfeesdescript = $request->additionalfeesdescript;
        $carrentpurchase->uniquepaymentid = $request->uniquepaymentid;
        $carrentpurchase->method = $request->method;
        $carrentpurchase->note = $request->note;
        $carrentpurchase->save();

        $carrent->status = 'hired';
        $carrent->save();

        // Notification
        // Notify user who purchased the hire of the car
        // Notify all users commented, offered, tailed that car has been purchased

        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarRentPurchasedNotification($carrentoffer));

        $carrentoffer->$user->notify(new CarRentOfferReservePurchasedNotification($carrentoffer));

        // Fire Car purchased event
        event(new CarRentOfferReservePurchased($carrent));

        return response()->json(['success'=>true]);
    }

    /**
     * Rent Returned
     *
     * @param  Request $request
     * @return Response 
     */
    public function rentreturned(Request $request, Corporate $corporate, Car $car, Carrent $carrent, Carrentoffer $carrentoffer, Carrentpurchase $carrentpurchase)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carrent status. Move this out to Traits later.
        if ($carrent->status != 'hired') {
            return response()->json(['success'=>false]);
        }

        $carrent->status = 'opened';
        $carrent->save();
        
        // Notification
        // Notify all users commented, offered, tailed that car is now open

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarRentOpenedNotification($carrentoffer));

        return response()->json(['success'=>true]);
    }

    // ===================================================================================
    // 
    // 
    //     Tenders
    // 
    // 
    // ===================================================================================

    /**
     * Add Tender
     *
     * @param  Request $request
     * @return Response 
     */
    public function addtender(Request $request, Corporate $corporate, Car $car)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        $cartender = new Cartender;
        $cartender->corporate_id = $corporate->id;
        $cartender->car_id = $car->id;
        if ($request->cargroup_id) {
            $cartender->cargroup_id = $request->cargroup_id;
        }
        $cartender->start_date = $request->start_date;
        $cartender->end_date = $request->end_date;
        $cartender->signuprequired = $request->signuprequired;
        $cartender->signupfee = $request->signupfee;
        if ($request->tenderreserveholddays) {
            $cartender->tenderreserveholddays = $request->tenderreserveholddays;
        } else {
            $cartender->tenderreserveholddays = 3;
        }
        $cartender->status = $request->status;
        $cartender->note = $request->note;

        $cartender->save();

        // Notification if status == open
        // Notify all users following corp

        if ($cartender->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $corporate->id)
                ->where('notificables.model_name', 'corporate')
                ->get();

            Notification::send($users, new CarTenderOpenedNotification($cartender));
        }

        // Fire Car Tender added event
        event(new CarTenderAdded($cartender));

        return response()->json(['success'=>true]);
    }

    /**
     * Update Tender
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatetender(Request $request, Corporate $corporate, Car $car)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        $cartender->corporate_id = $corporate->id;
        $cartender->car_id = $car->id;
        if ($request->cargroup_id) {
            $cartender->cargroup_id = $request->cargroup_id;
        }
        $cartender->start_date = $request->start_date;
        $cartender->end_date = $request->end_date;
        $cartender->signuprequired = $request->signuprequired;
        $cartender->signupfee = $request->signupfee;
        if ($request->tenderreserveholddays) {
            $cartender->tenderreserveholddays = $request->tenderreserveholddays;
        } else {
            $cartender->tenderreserveholddays = 3;
        }
        $cartender->status = $request->status;
        $cartender->note = $request->note;

        $cartender->save();

        if ($cartender->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarTenderUpdatedNotification($cartender));
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Tender
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletetender(Request $request, Corporate $corporate, Car $car, Cartender $cartender)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $cartender->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Close Tender
     *
     * @param  Request $request
     * @return Response 
     */
    public function closetender(Request $request, Corporate $corporate, Car $car, Cartender $cartender)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $cartender->status = 'closed';

        // Notification 
        // Notify all users commented, offered, tailed.

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarTenderClosedNotification($cartender));

        // Fire Car Tender closed event
        event(new CarTenderClosed($cartender--));

        return response()->json(['success'=>true]);
    }

    /**
     * Tender Tender Reserve
     *
     * @param  Request $request
     * @return Response 
     */
    public function tendertenderreserve(Request $request, Corporate $corporate, Car $car, Cartender $cartender, Cartendertender $cartendertender)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Cartender status. Move this out to Traits later.
        if ($cartender->status != 'reserved' || $cartender->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // check how many reserved cartender tenders and stop if minimum 3 of them already exist.
        $count = Cartenderreserve::where('cartender_id', $cartender_id)->count();

        if ($count < 3) {
            $cartenderreserve = new Cartenderreserve;
            $cartenderreserve->cartender_id = $cartender->id;
            $cartenderreserve->cartendertender_id = $cartendertender->id;
            $cartenderreserve->note = $request->note;
            $cartenderreserve->save();
        } 
        // That means we now have a total of 3 reserves, so set as reserved.
        if ($count == 2) {
            $cartender->status = 'reserved';
            $cartender->save();
            
            // Notification
            // Notify all users commented, tendered, tailed that cartender is now reserved

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarTenderReservedNotification($cartendertender));
        }

        // Notification
        // Notify user being reserved

        $cartendertender->$user->notify(new CarTenderTenderReservedNotification($cartendertender));

        return response()->json(['success'=>true]);
    }

    /**
     * Tender Tender Reserve Cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function tendertenderreservecancel(Request $request, Corporate $corporate, Car $car, Cartender $cartender, Cartendertender $cartendertender)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Cartender status. Move this out to Traits later.
        if ($cartender->status != 'reserved' || $cartender->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $cartenderreserve->delete();

        $count = Cartenderreserve::where('cartender_id', $cartender_id)->count();

        if ($count == 0) {
            $cartender->status = 'opened';
            $cartender->save();
            
            // Notification
            // Notify all users commented, offered, tailed that cartender is now opened

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarTenderOpenedNotification($cartendertender));
        }

        // Notification
        // Notify user whos reserved is cancelled

        $cartendertender->$user->notify(new CarTenderTenderReserveCancelledNotification($cartendertender));

        return response()->json(['success'=>true]);
    }

    /**
     * Purchase Tender
     *
     * @param  Request $request
     * @return Response 
     */
    public function purchasetender(Request $request, Corporate $corporate, Car $car, Cartender $cartender, Cartendertender $cartendertender, Cartenderreserve $cartenderreserve)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Car status. Move this out to Traits later.
        if ($cartender->status != 'reserved') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'amount' => 'required|numeric',
            'tax' => 'numeric',
            'additionalfees' => 'numeric',
        ]);

        $cartenderpurchase = new Cartenderpurchase;
        $cartenderpurchase->cartender_id = $cartender->id;
        $cartenderpurchase->cartenderreserve_id = $cartenderreserve->id;
        $cartenderpurchase->amount = $request->amount;
        $cartenderpurchase->tax = $request->tax;
        $cartenderpurchase->additionalfees = $request->additionalfees;
        $cartenderpurchase->additionalfeesdescript = $request->additionalfeesdescript;
        $cartenderpurchase->uniquepaymentid = $request->uniquepaymentid;
        $cartenderpurchase->method = $request->method;
        $cartenderpurchase->note = $request->note;
        $cartenderpurchase->save();

        $cartender->status = 'purchased';
        $cartender->save();

        // Notification
        // Notify user who purchased the car
        // Notify all users commented, offered, tailed that car has been purchased

        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarTenderPurchasedNotification($cartendertender));

        $cartendertender->$user->notify(new CarTenderTenderReservePurchasedNotification($cartendertender));

        // Fire Car purchased event
        event(new CarTenderTenderReservePurchased($cartender));

        return response()->json(['success'=>true]);
    }

    // ===================================================================================
    // 
    // 
    //     Auctions
    // 
    // 
    // ===================================================================================

    /**
     * Add Auction
     *
     * @param  Request $request
     * @return Response 
     */
    public function addauction(Request $request, Corporate $corporate, Car $car)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'startdate' => 'required',
            'enddate' => 'required',
            'startbidprice' => 'numeric',
            'signupfee' => 'numeric',
        ]);

        $carauction = new Carauction;
        $carauction->corporate_id = $corporate->id;
        $carauction->car_id = $car->id;
        if ($request->cargroup_id) {
            $carauction->cargroup_id = $request->cargroup_id;
        }
        $carauction->start_date = $request->start_date;
        $carauction->end_date = $request->end_date;
        $carauction->startbidprice = $request->startbidprice;
        $carauction->signuprequired = $request->signuprequired;
        if ($request->auctionreserveholddays) {
            $carauction->auctionreserveholddays = $request->auctionreserveholddays;
        } else {
            $carauction->auctionreserveholddays = 3;
        }
        $carauction->status = $request->status;
        $carauction->note = $request->note;

        $carauction->save();

        // Notification if status == open
        // Notify all users following corp

        if ($carauction->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $corporate->id)
                ->where('notificables.model_name', 'corporate')
                ->get();

            Notification::send($users, new CarAuctionOpenedNotification($carauction));
        }

        // Fire Car Auction added event
        event(new CarAuctionAdded($carauction));

        return response()->json(['success'=>true]);
    }

    /**
     * Update Auction
     *
     * @param  Request $request
     * @return Response 
     */
    public function updateauction(Request $request, Corporate $corporate, Car $car)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'startdate' => 'required',
            'enddate' => 'required',
            'startbidprice' => 'numeric',
            'signupfee' => 'numeric',
        ]);

        $carauction->corporate_id = $corporate->id;
        $carauction->car_id = $car->id;
        if ($request->cargroup_id) {
            $carauction->cargroup_id = $request->cargroup_id;
        }
        $carauction->start_date = $request->start_date;
        $carauction->end_date = $request->end_date;
        $carauction->startbidprice = $request->startbidprice;
        $carauction->signuprequired = $request->signuprequired;
        if ($request->auctionreserveholddays) {
            $carauction->auctionreserveholddays = $request->auctionreserveholddays;
        } else {
            $carauction->auctionreserveholddays = 3;
        }
        $carauction->status = $request->status;
        $carauction->note = $request->note;

        $carauction->save();

        if ($carauction->status == 'open') {
            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarAuctionUpdatedNotification($carauction));
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Delete auction
     *
     * @param  Request $request
     * @return Response 
     */
    public function deleteauction(Request $request, Corporate $corporate, Car $car, Carauction $carauction)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $carauction->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Close auction
     *
     * @param  Request $request
     * @return Response 
     */
    public function closeauction(Request $request, Corporate $corporate, Car $car, Carauction $carauction)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        $carauction->status = 'closed';

        // Notification 
        // Notify all users commented, offered, tailed.

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarAuctionClosedNotification($carauction));

        // Fire Car Auction closed event
        event(new CarAuctionClosed($carauction));

        return response()->json(['success'=>true]);
    }

    /**
     * Auction Bid Reserve
     *
     * @param  Request $request
     * @return Response 
     */
    public function auctionbidreserve(Request $request, Corporate $corporate, Car $car, Carauction $carauction, Carauctionbid $carauctionbid)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Carauction status. Move this out to Traits later.
        if ($carauction->status != 'reserved' || $carauction->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // check how many reserved carauction bids and stop if minimum 3 of them already exist.
        $count = Carauctionreserve::where('carauction_id', $carauction_id)->count();

        if ($count < 3) {
            $carauctionreserve = new Carauctionreserve;
            $carauctionreserve->carauction_id = $carauction->id;
            $carauctionreserve->carauctionbid_id = $carauctionbid->id;
            $carauctionreserve->note = $request->note;
            $carauctionreserve->save();
        } 
        // That means we now have a total of 3 reserves, so set as reserved.
        if ($count == 2) {
            $carauction->status = 'reserved';
            $carauction->save();
            
            // Notification
            // Notify all users commented, bided, tailed that carauction is now reserved

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarAuctionReservedNotification($carauctionbid));
        }

        // Notification
        // Notify user being reserved

        $carauctionbid->$user->notify(new CarAuctionBidReservedNotification($carauctionbid));

        // Fire Car Auction Bid reserved event
        event(new CarAuctionBidReserved($carauctionbid));

        return response()->json(['success'=>true]);
    }

    /**
     * Auction Bid Reserve Cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function auctionbidreservecancel(Request $request, Corporate $corporate, Car $car, Carauction $carauction, Carauctionbid $carauctionbid)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Car status. Move this out to Traits later.
        if ($carauction->status != 'reserved' || $carauction->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $carauctionreserve->delete();

        $count = Carauctionreserve::where('carauction_id', $carauction_id)->count();

        if ($count == 0) {
            $carauction->status = 'opened';
            $carauction->save();
            
            // Notification
            // Notify all users commented, offered, tailed that carauction is now opened

            // get all users
            $users = DB::table('users')
                ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
                ->where('notificables.model_id', $car->id)
                ->where('notificables.model_name', 'car')
                ->get();

            Notification::send($users, new CarAuctionOpenedNotification($carauctionbid));
        }

        // Notification
        // Notify user whos reserved is cancelled

        $carauctionbid->$user->notify(new CarAuctionBidReserveCancelledNotification($carauctionbid));

        // Fire Car Auction Bid reserve cancelled event
        event(new CarAuctionBidReserveCancelled($carauctionbid));

        return response()->json(['success'=>true]);
    }

    /**
     * Purchase auction
     *
     * @param  Request $request
     * @return Response 
     */
    public function purchaseauction(Request $request, Corporate $corporate, Car $car, Carauction $carauction, Carauctionbid $carauctionbid, Carauctionreserve $carauctionreserve)
    {
        // This is the check for Corp Car. Move this out to Traits later.
        if ($car->corporate->id != $corporate->id) {
            return response()->json(['success'=>false]);
        }

        // This is the check for Car status. Move this out to Traits later.
        if ($carauction->status != 'reserved') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'amount' => 'required|numeric',
            'tax' => 'numeric',
            'additionalfees' => 'numeric',
        ]);

        $carauctionpurchase = new Carauctionpurchase;
        $carauctionpurchase->carauction_id = $carauction->id;
        $carauctionpurchase->carauctionreserve_id = $carauctionreserve->id;
        $carauctionpurchase->amount = $request->amount;
        $carauctionpurchase->tax = $request->tax;
        $carauctionpurchase->additionalfees = $request->additionalfees;
        $carauctionpurchase->additionalfeesdescript = $request->additionalfeesdescript;
        $carauctionpurchase->uniquepaymentid = $request->uniquepaymentid;
        $carauctionpurchase->method = $request->method;
        $carauctionpurchase->note = $request->note;
        $carauctionpurchase->save();

        $carauction->status = 'purchased';
        $carauction->save();

        // Notification
        // Notify user who purchased the car
        // Notify all users commented, offered, tailed that car has been purchased

        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $car->id)
            ->where('notificables.model_name', 'car')
            ->get();

        Notification::send($users, new CarAuctionPurchasedNotification($carauctionbid));

        $carauctionbid->$user->notify(new CarAuctionBidReservePurchasedNotification($carauctionbid));

        // Fire Car purchased event
        event(new CarAuctionBidReservePurchased($carauction));

        return response()->json(['success'=>true]);
    }
}



