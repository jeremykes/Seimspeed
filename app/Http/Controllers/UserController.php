<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;

use App\Corporaterating;
use App\Corporatetail;
use App\Carcomment;
use App\Carlike;
use App\Carsale;
use App\Carsaleoffer;
use App\Carrent;
use App\Carrentoffer;
use App\Cartender;
use App\Cartendertender;
use App\Carauction;
use App\Carauctionbid;

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
    }

    /**
     * Rate Corporate
     *
     * @param  Request $request
     * @return Response 
     */
    public function rate(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'rating' => 'required',
        ]);

        $corporaterating_exist = Corporaterating::where('corporate_id', $corporate->id)->where('user_id', Auth::user->id)->first();

        if ($corporaterating_exist === null) {
            $corporaterating = new Corporaterating;
            $corporaterating->corporate_id = $corporate->id;
            $corporaterating->user_id = Auth::user->id;
            $corporaterating->rating = $request->rating;
            $corporaterating->comment = '';
            $corporaterating->save();
        } else {
            if (Auth::user->id == $corporaterating_exist->user_id) {
                $corporaterating_exist->rating = $request->rating;
                $corporaterating_exist->save();
            }
        }

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->get();

        Notification::send($users, new CorporateRatedNotification($corporaterating));

        return response()->json(['success'=>true]);
    }

    /**
     * Tail Add/Remove Corporate
     *
     * @param  Request $request
     * @return Response 
     */
    public function tailcorporate(Request $request, Corporate $corporate)
    {
        $corporatetail_exist = Corporatetail::where('corporate_id', $corporate->id)->where('user_id', Auth::user->id)->first();

        if ($corporatetail_exist === null) {
            $corporatetail = new Corporatetail;
            $corporatetail->corporate_id = $corporate->id;
            $corporatetail->user_id = Auth::user->id;
            $corporatetail->save();
        } else {
            if (Auth::user->id == $corporatetail_exist->user_id) {
                $corporatetail_exist->delete();
            }
        }

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->get();

        Notification::send($users, new CorporateTailedNotification($corporatetail));

        return response()->json(['success'=>true]);
    }

    /**
     * Car comment added
     *
     * @param  Request $request
     * @return Response 
     */
    public function addcarcomment(Request $request, Car $car)
    {
        $carcomment = New Carcomment;
        if ($request->parent_comment_id) {
            $carcomment->parent_comment_id = $request->parent_comment_id;
        }
        $carcomment->user_id = Auth::user->id;
        $carcomment->car_id = $car->id;
        $carcomment->comment = $request->comment;

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->get();

        Notification::send($users, new CarCommentAddedNotification($carcomment));

        // Fire Car Comment added event
        event(new CarCommentAdded($carcomment));

        return response()->json(['success'=>true]);
    }

    /**
     * Car comment update
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatecarcomment(Request $request, Car $car, Carcomment $carcomment)
    {
        if (Auth::user->id == $carcomment->user_id) {
            $carcomment->comment = $request->comment;
        }

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->get();

        Notification::send($users, new CarCommentUpdatedNotification($carcomment));

        // Fire Car Comment Updated event
        event(new CarCommentUpdated($carcomment));
        
        return response()->json(['success'=>true]);
    }

    /**
     * Car comment delete
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletecarcomment(Request $request, Car $car, Carcomment $carcomment)
    {
        if (Auth::user->id == $carcomment->user_id) {
            $carcomment->delete();
        }
        
        return response()->json(['success'=>true]);
    }

    /**
     * Car like/unlike 
     *
     * @param  Request $request
     * @return Response 
     */
    public function likecar(Request $request, Car $car)
    {
        $carlike_exist = Carlike::where('car_id', $corporate->id)->where('user_id', Auth::user->id)->first();

        if ($carlike_exist === null) {
            $carlike = new Carlike;
            $carlike->car_id = $car->id;
            $carlike->user_id = Auth::user->id;
            $carlike->save();

            // Notification
            // Notify all corpusers

            $users = DB::table('users')
                ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
                ->where('corpnotificables.corporate_id', $corporate->id)
                ->get();

            Notification::send($users, new CarLikedNotification($carlike));

        } else {
            if (Auth::user->id == $carlike_exist->user_id) {
                $carlike_exist->delete();
            }
        }
        
        return response()->json(['success'=>true]);
    }

    /**
     * Tail Add/Remove Car
     *
     * @param  Request $request
     * @return Response 
     */
    public function tailcar(Request $request, Car $car)
    {
        $cartail_exist = Cartail::where('car_id', $car->id)->where('user_id', Auth::user->id)->first();

        if ($cartail_exist === null) {
            $cartail = new Cartail;
            $cartail->car_id = $car->id;
            $cartail->user_id = Auth::user->id;
            $cartail->save();

            // Notification
            // Notify all corpusers

            $users = DB::table('users')
                ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
                ->where('corpnotificables.corporate_id', $corporate->id)
                ->get();

            Notification::send($users, new CarTailedNotification($carlike));

        } else {
            if (Auth::user->id == $cartail_exist->user_id) {
                $cartail_exist->delete();
            }
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Add Car sale offer
     *
     * @param  Request $request
     * @return Response 
     */
    public function carsaleoffer(Request $request, Carsale $carsale)
    {
        // This is the check for Carsale status. Move this out to Traits later.
        if ($carsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'offer' => 'required|numeric',
        ]);

        $carsaleoffer = new Carsaleoffer;
        $carsaleoffer->carsale_id = $carsale->id;
        $carsaleoffer->user_id = Auth::user->id;
        $carsaleoffer->offer = $request->offer;
        $carsale->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarSaleOfferAddedNotification($carsaleoffer));

        // Fire Car Sale Offer added event
        event(new CarSaleOfferAdded($carsaleoffer));
        
        return response()->json(['success'=>true]);
    }

    /**
     * Add Car sale offer cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function carsaleoffercancel(Request $request, Carsale $carsale, Carsaleoffer $carsaleoffer)
    {
        // This is the check for Carsale status. Move this out to Traits later.
        if ($carsale->status != 'reserved' || $carsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // Fire Car Sale Offer cancelled event
        event(new CarSaleOfferCancelled($carsaleoffer));

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarSaleOfferCancelledNotification($carsaleoffer));

        if (Auth::user->id == $carsaleoffer->user_id) {
            $carsaleoffer->delete();
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Add Car rent offer
     *
     * @param  Request $request
     * @return Response 
     */
    public function carrentoffer(Request $request, Carrent $carrent)
    {
        // This is the check for Carrent status. Move this out to Traits later.
        if ($carrent->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'offer' => 'required|numeric',
            'daysofrent' => 'required|numeric',
        ]);

        $carrentoffer = new Carrentoffer;
        $carrentoffer->carrent_id = $carrent->id;
        $carrentoffer->user_id = Auth::user->id;
        $carrentoffer->daysofrent = $request->daysofrent;
        $carrentoffer->offer = $request->offer;
        $carrent->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarRentOfferAddedNotification($carrentoffer));

        // Fire Car Rent Offer added event
        event(new CarRentOfferAdded($carrentoffer));
        
        return response()->json(['success'=>true]);
    }

    /**
     * Add Car rent offer cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function carrentoffercancel(Request $request, Carrent $carrent, Carrentoffer $carrentoffer)
    {
        // This is the check for Carrent status. Move this out to Traits later.
        if ($carrent->status != 'reserved' || $carrent->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // Fire Car Rent Offer cancelled event
        event(new CarRentOfferCancelled($carrentoffer));

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarRentOfferCancelledNotification($carrentoffer));

        if (Auth::user->id == $carrentoffer->user_id) {
            $carrentoffer->delete();
        }
        
        return response()->json(['success'=>true]);
    }

    /**
     * Add Car tender tender
     *
     * @param  Request $request
     * @return Response 
     */
    public function cartendertender(Request $request, Cartender $cartender)
    {
        // This is the check for Cartender status. Move this out to Traits later.
        if ($cartender->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'tender' => 'required|numeric',
        ]);

        $cartendertender = new Cartendertender;
        $cartendertender->cartender_id = $cartender->id;
        $cartendertender->user_id = Auth::user->id;
        $cartendertender->tender = $request->tender;
        $cartender->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarTenderTenderAddedNotification($cartendertender));

        // Fire Car Tender Tender added event
        event(new CarTenderTenderAdded($cartendertender));
        
        return response()->json(['success'=>true]);
    }

    /**
     * Add Car tender tender cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function cartendertendercancel(Request $request, Cartender $cartender, Cartendertender $cartendertender)
    {
        // This is the check for Cartender status. Move this out to Traits later.
        if ($cartender->status != 'reserved' || $cartender->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // Fire Car Tender Tender cancelled event
        event(new CarTenderTenderCancelled($cartendertender));

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarTenderTenderCancelledNotification($cartendertender));

        if (Auth::user->id == $cartendertender->user_id) {
            $cartendertender->delete();
        }
        
        return response()->json(['success'=>true]);
    }

    /**
     * Add Car auction bid
     *
     * @param  Request $request
     * @return Response 
     */
    public function carauctionbid(Request $request, Carauction $carauction)
    {
        // This is the check for Carauction status. Move this out to Traits later.
        if ($carauction->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'bid' => 'required|numeric',
        ]);

        $carauctionbid = new Carauctionbid;
        $carauctionbid->carauction_id = $carauction->id;
        $carauctionbid->user_id = Auth::user->id;
        $carauctionbid->bid = $request->bid;
        $carauction->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarAuctionBidAddedNotification($carauctionbid));

        // Fire Car Auction Bid added event
        event(new CarAuctionBidAdded($carauctionbid));
        
        return response()->json(['success'=>true]);
    }

    /**
     * Add Car auction bid cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function carauctionbidcancel(Request $request, Carauction $carauction, Carauctionbid $carauctionbid)
    {
        // This is the check for Carauction status. Move this out to Traits later.
        if ($carauction->status != 'reserved' || $carauction->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // Fire Car Auction Bid cancelled event
        event(new CarAuctionBidCancelled($carauctionbid));

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new CarAuctionBidCancelledNotification($carauctionbid));

        if (Auth::user->id == $carauctionbid->user_id) {
            $carauctionbid->delete();
        }
        
        return response()->json(['success'=>true]);
    }

    /**
     * Part comment added
     *
     * @param  Request $request
     * @return Response 
     */
    public function addpartcomment(Request $request, Part $part)
    {
        $partcomment = New Partcomment;
        if ($request->parent_comment_id) {
            $partcomment->parent_comment_id = $request->parent_comment_id;
        }
        $partcomment->user_id = Auth::user->id;
        $partcomment->part_id = $part->id;
        $partcomment->comment = $request->comment;

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->get();

        Notification::send($users, new PartCommentAddedNotification($partcomment));

        // Fire Part Comment added event
        event(new PartCommentAdded($partcomment));

        return response()->json(['success'=>true]);
    }

    /**
     * part comment update
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatepartcomment(Request $request, Part $part, Partcomment $partcomment)
    {
        if (Auth::user->id == $partcomment->user_id) {
            $partcomment->comment = $request->comment;
        }

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->get();

        Notification::send($users, new PartCommentUpdatedNotification($partcomment));

        // Fire Part Comment Updated event
        event(new PartCommentUpdated($partcomment));
        
        return response()->json(['success'=>true]);
    }

    /**
     * part comment delete
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletepartcomment(Request $request, Part $part, Partcomment $partcomment)
    {
        if (Auth::user->id == $partcomment->user_id) {
            $partcomment->delete();
        }
        
        return response()->json(['success'=>true]);
    }

    /**
     * part like/unlike 
     *
     * @param  Request $request
     * @return Response 
     */
    public function likepart(Request $request, Part $part)
    {
        $partlike_exist = Partlike::where('part_id', $corporate->id)->where('user_id', Auth::user->id)->first();

        if ($partlike_exist === null) {
            $partlike = new Partlike;
            $partlike->part_id = $part->id;
            $partlike->user_id = Auth::user->id;
            $partlike->save();

            // Notification
            // Notify all corpusers

            $users = DB::table('users')
                ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
                ->where('corpnotificables.corporate_id', $corporate->id)
                ->get();

            Notification::send($users, new PartLikedNotification($partlike));
            
        } else {
            if (Auth::user->id == $partlike_exist->user_id) {
                $partlike_exist->delete();
            }
        }
        
        return response()->json(['success'=>true]);
    }

    /**
     * Tail Add/Remove part
     *
     * @param  Request $request
     * @return Response 
     */
    public function tailpart(Request $request, Part $part)
    {
        $parttail_exist = Parttail::where('part_id', $part->id)->where('user_id', Auth::user->id)->first();

        if ($parttail_exist === null) {
            $parttail = new Parttail;
            $parttail->part_id = $part->id;
            $parttail->user_id = Auth::user->id;
            $parttail->save();

            // Notification
            // Notify all corpusers

            $users = DB::table('users')
                ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
                ->where('corpnotificables.corporate_id', $corporate->id)
                ->get();

            Notification::send($users, new PartTailedNotification($partlike));

        } else {
            if (Auth::user->id == $parttail_exist->user_id) {
                $parttail_exist->delete();
            }
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Add part sale offer
     *
     * @param  Request $request
     * @return Response 
     */
    public function partsaleoffer(Request $request, Partsale $partsale)
    {
        // This is the check for Partsale status. Move this out to Traits later.
        if ($partsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $this->validate($request, [
            'offer' => 'required|numeric',
        ]);

        $partsaleoffer = new Partsaleoffer;
        $partsaleoffer->partsale_id = $partsale->id;
        $partsaleoffer->user_id = Auth::user->id;
        $partsaleoffer->offer = $request->offer;
        $partsale->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new PartSaleOfferAddedNotification($partsaleoffer));

        // Fire Part Sale Offer added event
        event(new PartSaleOfferAdded($partsaleoffer));
        
        return response()->json(['success'=>true]);
    }

    /**
     * Add part sale offer cancel
     *
     * @param  Request $request
     * @return Response 
     */
    public function partsaleoffercancel(Request $request, Partsale $partsale, Partsaleoffer $partsaleoffer)
    {
        // This is the check for Partsale status. Move this out to Traits later.
        if ($partsale->status != 'reserved' || $partsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        // Fire Part Sale Offer cancelled event
        event(new PartSaleOfferCancelled($partsaleoffer));

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $corporate->id)
            ->where('corpnotificables.role', 'sales')
            ->where('corpnotificables.role', 'admin')
            ->get();

        Notification::send($users, new PartSaleOfferCancelledNotification($partsaleoffer));

        if (Auth::user->id == $partsaleoffer->user_id) {
            $partsaleoffer->delete();
        }
        
        return response()->json(['success'=>true]);
    }
}



