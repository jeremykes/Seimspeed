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
        // 
    }

    /**
     * Go to User page
     *
     * @param  Request $request
     * @return Response 
     */
    public function user(Request $request, User $user)
    {
        return view('user.home', [
            'user' => $user,
        ]); 
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
            'corporate_id' => 'required|numeric',
            'rating' => 'required|numeric',
        ]);

        $corporate = Corporate::findOfFail($request->corporate_id);

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
    public function tailcorporate(Request $request)
    {
        $this->validate($request, [
            'corporate_id' => 'required|numeric',
        ]);

        $corporate = Corporate::findOfFail($request->corporate_id);

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
    public function addcarcomment(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required|numeric',
            'parent_comment_id' => 'numeric',
            'comment' => 'required',
        ]);

        $carcomment = New Carcomment;
        if ($request->parent_comment_id) {
            $carcomment->parent_comment_id = $request->parent_comment_id;
        }
        $carcomment->user_id = Auth::user->id;
        $carcomment->car_id = $request->car_id;
        $carcomment->comment = $request->comment;
        $carcomment->save();

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $carcomment->car->corporate->id)
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
        $carcomment->save();

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $car->corporate->id)
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
    public function deletecarcomment(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required|numeric',
            'comment_id' => 'required|numeric',
        ]);

        $carcomment = Carcomment::findOfFail($request->comment_id);

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
    public function tailcar(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required|numeric',
        ]);

        $car = Car::findOfFail($request->car_id);

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
                ->where('corpnotificables.corporate_id', $car->corporate->id)
                ->get();

            Notification::send($users, new CarTailedNotification($cartail));

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
    public function carsaleoffer(Request $request)
    {
        $this->validate($request, [
            'carsale_id' => 'required|numeric',
            'offer' => 'required|numeric',
        ]);

        $carsale = Carsale::find($request->carsale_id);

        // This is the check for Carsale status. Move this out to Traits later.
        if ($carsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $carsaleoffer = new Carsaleoffer;
        $carsaleoffer->carsale_id = $request->carsale_id;
        $carsaleoffer->user_id = Auth::user->id;
        $carsaleoffer->offer = $request->offer;
        $carsaleoffer->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $carsale->corporate->id)
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
    public function carsaleoffercancel(Request $request)
    {
        $this->validate($request, [
            'carsale_id' => 'required|numeric',
            'carsaleoffer_id' => 'required|numeric',
        ]);

        $carsale = Carsale::findOfFail($request->carsale_id);
        $carsaleoffer = Carsaleoffer::findOfFail($request->carsaleoffer_id);

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
            ->where('corpnotificables.corporate_id', $carsale->corporate->id)
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
    public function carrentoffer(Request $request)
    {
        $this->validate($request, [
            'carrent_id' => 'required|numeric',
            'offer' => 'required|numeric',
            'daysofrent' => 'required|numeric',
        ]);

        $carrent = Carrent::findOfFail($request->carrent_id);

        // This is the check for Carrent status. Move this out to Traits later.
        if ($carrent->status != 'opened') {
            return response()->json(['success'=>false]);
        }

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
            ->where('corpnotificables.corporate_id', $carrent->corporate->id)
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
    public function carrentoffercancel(Request $request)
    {
        $this->validate($request, [
            'carrent_id' => 'required|numeric',
            'carrentoffer_id' => 'required|numeric',
        ]);

        $carrent = Carrent::findOfFail($request->carrent_id);
        $carrentoffer = Carrentoffer::findOfFail($request->carrentoffer_id);

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
            ->where('corpnotificables.corporate_id', $carrent->corporate->id)
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
    public function cartendertender(Request $request)
    {
        $this->validate($request, [
            'cartender_id' => 'required|numeric',
            'tender' => 'required|numeric',
        ]);

        $cartender = Cartender::findOfFail($request->cartender_id);

        // This is the check for Cartender status. Move this out to Traits later.
        if ($cartender->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $cartendertender = new Cartendertender;
        $cartendertender->cartender_id = $cartender->id;
        $cartendertender->user_id = Auth::user->id;
        $cartendertender->tender = $request->tender;
        $cartender->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $cartender->corporate->id)
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
    public function cartendertendercancel(Request $request)
    {
        $this->validate($request, [
            'cartender_id' => 'required|numeric',
            'cartendertender_id' => 'required|numeric',
        ]);

        $cartender = Cartender::findOfFail($request->cartender_id);
        $cartendertender = Cartendertender::findOfFail($request->cartendertender_id);

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
            ->where('corpnotificables.corporate_id', $cartender->corporate->id)
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
    public function carauctionbid(Request $request)
    {
        $this->validate($request, [
            'carauction_id' => 'required|numeric',
            'bid' => 'required|numeric',
        ]);

        $carauction = Carauction::findOfFail($request->carauction_id);

        // This is the check for Carauction status. Move this out to Traits later.
        if ($carauction->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $carauctionbid = new Carauctionbid;
        $carauctionbid->carauction_id = $carauction->id;
        $carauctionbid->user_id = Auth::user->id;
        $carauctionbid->bid = $request->bid;
        $carauction->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $carauction->corporate->id)
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
    public function carauctionbidcancel(Request $request)
    {
        $this->validate($request, [
            'carauction_id' => 'required|numeric',
            'carauctionbid_id' => 'required|numeric',
        ]);

        $carauction = Carauction::findOfFail($request->carauction_id);
        $carauctionbid = Carauctionbid::findOfFail($request->carauctionbid_id);

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
            ->where('corpnotificables.corporate_id', $carauction->corporate->id)
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
    public function addpartcomment(Request $request)
    {
        $this->validate($request, [
            'part_id' => 'required|numeric',
            'parent_comment_id' => 'numeric',
            'comment' => 'required',
        ]);

        $partcomment = New Partcomment;
        if ($request->parent_comment_id) {
            $partcomment->parent_comment_id = $request->parent_comment_id;
        }
        $partcomment->user_id = Auth::user->id;
        $partcomment->part_id = $partcomment->part_id;
        $partcomment->comment = $request->comment;
        $partcomment->save();

        // Notification
        // Notify all corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $partcomment->part->corporate->id)
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
        $partcomment->save();

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
    public function tailpart(Request $request)
    {
        $this->validate($request, [
            'part_id' => 'required|numeric',
        ]);

        $part = Part::findOfFail($request->part_id);

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
                ->where('corpnotificables.corporate_id', $part->corporate->id)
                ->get();

            Notification::send($users, new PartTailedNotification($parttail));

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
    public function partsaleoffer(Request $request)
    {
        $this->validate($request, [
            'partsale_id' => 'required|numeric',
            'offer' => 'required|numeric',
        ]);

        $partsale = Partsale::findOfFail($request->partsale_id);

        // This is the check for Partsale status. Move this out to Traits later.
        if ($partsale->status != 'opened') {
            return response()->json(['success'=>false]);
        }

        $partsaleoffer = new Partsaleoffer;
        $partsaleoffer->partsale_id = $partsale->id;
        $partsaleoffer->user_id = Auth::user->id;
        $partsaleoffer->offer = $request->offer;
        $partsale->save();

        // Notification
        // Notify sales,admin corpusers

        $users = DB::table('users')
            ->leftJoin('corpnotificables', 'users.id', '=', 'corpnotificables.user_id')
            ->where('corpnotificables.corporate_id', $partsale->corporate->id)
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
    public function partsaleoffercancel(Request $request)
    {
        $this->validate($request, [
            'partsale_id' => 'required|numeric',
            'partsaleoffer_id' => 'required|numeric',
        ]);

        $partsale = Partsale::findOfFail($request->partsale_id);
        $partsaleoffer = Partsaleoffer::findOfFail($request->partsaleoffer_id);

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
            ->where('corpnotificables.corporate_id', $partsale->corporate->id)
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



