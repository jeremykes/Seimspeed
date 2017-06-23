<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;

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
            // Fire a reserved notification here!
        }

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
            // Fire a opened notification here!
        }

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
        // Fire a reserved notification here!

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
        // Fire a opened notification here!

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
        // Fire a opened notification here!

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

        return response()->json(['success'=>true]);
    }

    // SHOULD YOU ADD TENDERTENDERRESERVE HERE????????????????????????

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
            // Fire a opened notification here!
        }

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

        // check how many reserved carauction offers and stop if minimum 3 of them already exist.
        $count = Carauctionreserve::where('carauction_id', $carauction_id)->count();

        if ($count < 3) {
            $carauctionreserve = new Carauctionreserve;
            $carauctionreserve->carauction_id = $carauction->id;
            $carauctionreserve->carauctionoffer_id = $carauctionoffer->id;
            $carauctionreserve->note = $request->note;
            $carauctionreserve->save();
        } 
        // That means we now have a total of 3 reserves, so set as reserved.
        if ($count == 2) {
            $carauction->status = 'reserved';
            $carauction->save();
            // Fire a reserved notification here!
        }

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
            // Fire a opened notification here!
        }

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

        return response()->json(['success'=>true]);
    }
}



