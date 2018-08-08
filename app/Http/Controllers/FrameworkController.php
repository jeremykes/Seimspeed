<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use Notification;
use DB;
use Illuminate\Notifications\DatabaseNotification;
use Carbon;
use Session;

use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionApplication;

use App\Subscription;

use App\User;
use App\Message;
use App\Userreport;
use App\Corporatereport;
use App\Carreport;
use App\Partreport;
use App\Carsale;
use App\Carsalereserve;
use App\Carrent;
use App\Carrentreserve;
use App\Cartender;
use App\Cartenderreserve;
use App\Carauction;
use App\Carauctionreserve;
use App\Partsale;
use App\Partsalereserve;
use App\Carsalepurchase;
use App\Carrentpurchase;
use App\Cartenderpurchase;
use App\Carauctionpurchase;
use App\Partsalepurchase;

use App\Corporate;
use App\Corporateuser;
use App\Corporatetail;
use App\Car;
use App\Carcomment;
use App\Cartail;
use App\Carimage;
use App\Part;
use App\Partcomment;
use App\Parttail;
use App\Partimage;

use App\Carmakemodel;

use App\Carsaleoffer;
use App\Carrentoffer;
use App\Cartendertender;
use App\Carauctionbid;

use App\Partsaleoffer;

use App\Cartendertenderer;
use App\Carauctionbidder;

use App\Notifications\CarSaleOfferReservedNotification;
use App\Notifications\NewMessageNotification;

class FrameworkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('auth', ['only' => [
            'sendmessage',
            'reportuser',
            'reportcorporate',
            'reportcar',
            'reportpart',
            'addcorporate',
            'pusherauthenticate',
            'iscorpuser',
            'hascorpuserrole',
            'addcorporateform',
            'addcorporate',
        ]]);

        $this->middleware('corpuser', ['only' => [
            'corporatedashboard',
            'corporatemembers',
            'corporatesettings',
        ]]);
    }

    // ===================================================================================
    // 
    // 
    //     Main Views
    // 
    // 
    // ===================================================================================

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home'); 
    }

    /**
     * Show to the Carauction.
     *
     * @return \Illuminate\Http\Response
     */
    public function carauction(Corporate $corporate, Car $car, Carauction $carauction, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        $user_not_req = false;
        $user_can_bid = false;

        if (Auth::check()) {
            
            if ($carauction->signuprequired == 1) {
                $carauctionbidder = Carauctionbidder::where('user_id', Auth::user()->id)->where('carauction_id', $carauction->id)->first();
                if ($carauctionbidder !== null && $carauctionbidder->count()) {
                    if ($carauctionbidder->accepted == true) {
                        $user_can_bid = true;
                    }
                } else {
                    $user_not_req = true;
                }
            }
        }

        return view('car.carauction', [
            'carauction' => $carauction,
            'user_can_bid' => $user_can_bid,
            'user_not_req' => $user_not_req,
        ]);
    }

    /**
     * Show to the Carrent.
     *
     * @return \Illuminate\Http\Response
     */
    public function carrent(Corporate $corporate, Car $car, Carrent $carrent, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('car.carrent', [
            'carrent' => $carrent,
        ]); 
    }

    /**
     * Show to the Carsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function carsale(Corporate $corporate, Car $car, Carsale $carsale, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('car.carsale', [
            'carsale' => $carsale,
        ]); 
    }

    /**
     * Show to the Cartender.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartender(Corporate $corporate, Car $car, Cartender $cartender, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        $user_not_req = false;
        $user_can_tender = false;

        if (Auth::check()) {
            
            if ($cartender->signuprequired == 1) {
                $cartendertenderer = Cartendertenderer::where('user_id', Auth::user()->id)->where('cartender_id', $cartender->id)->first();
                if ($cartendertenderer !== null && $cartendertenderer->count()) {
                    if ($cartendertenderer->accepted == true) {
                        $user_can_tender = true;
                    }
                } else {
                    $user_not_req = true;
                }
            }
        }

        return view('car.cartender', [
            'cartender' => $cartender,
            'user_can_tender' => $user_can_tender,
            'user_not_req' => $user_not_req,
        ]); 
    }

    /**
     * Show to the Partsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function partsale(Corporate $corporate, Part $part, Partsale $partsale, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('part.partsale', [
            'partsale' => $partsale,
        ]); 
    }

    /**
     * Show the Corporate Home.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatehome(Corporate $corporate, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        $corporatetail = false;
        if (Auth::check()) {
            if (Corporatetail::where('user_id', Auth::user()->id)->where('corporate_id', $corporate->id)->count() > 0) {
                $corporatetail = true;
            }
        }

        return view('corphome', [
            'corporate' => $corporate,
            'corporatetail' => $corporatetail,
        ]); 
    }

    /**
     * Show the Corporate Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatedashboard(Corporate $corporate)
    {
        // Totals ----------------------------------
        # Total carsalepurchases
        // $total_carsalepurchases = Carsalepurchase::where('corporate_id', $corporate->id)->count();
        // $total_carrentpurchases = Carrentpurchase::where('corporate_id', $corporate->id)->count();
        // $total_cartenderpurchases = Cartenderpurchase::where('corporate_id', $corporate->id)->count();
        // $total_carauctionpurchases = Carauctionpurchase::where('corporate_id', $corporate->id)->count();
        // $total_partsalepurchases = Partsalepurchase::where('corporate_id', $corporate->id)->count();
        // $total_cars_sold = $total_carsalepurchases + $total_cartenderpurchases + $total_carauctionpurchases;
        // $total_cars_rented = $total_carrentpurchases;
        // $total_parts_sold = $total_partsalepurchases;

        // $total_cars = Car::where('corporate_id', $corporate->id);
        // $total_car_comments = 0;
        // $total_car_tails = 0;
        // foreach ($total_cars as $car) {
        //     $total_car_comments += $car->comments->count();
        // }
        // foreach ($total_cars as $car) {
        //     $total_car_tails += $car->tails->count();
        // }

        // $total_carsales = Carsale::where('corporate_id', $corporate->id)->get();
        // $total_carsales_count = 0;
        // foreach ($total_carsales as $carsale) {
        //     $total_carsales_count += $carsale->offers->count();
        // }
        // $total_carrents = Carrent::where('corporate_id', $corporate->id)->get();
        // $total_carrents_count  = 0;
        // foreach ($total_carrents as $carrent) {
        //     $total_carrents_count += $carrent->offers->count();
        // }
        // $total_cartenders = Cartender::where('corporate_id', $corporate->id)->get();
        // $total_cartenders_count  = 0;
        // foreach ($total_cartenders as $cartender) {
        //     $total_cartenders_count += $cartender->offers->count();
        // }
        // $total_carauctions = Carauction::where('corporate_id', $corporate->id)->get();
        // $total_carauctions_count = 0;
        // foreach ($total_carauctions as $carauction) {
        //     $total_carauctions_count += $carauction->offers->count();
        // }
        // $total_partsales = Partsale::where('corporate_id', $corporate->id)->get();
        // $total_partsales_count = 0;
        // foreach ($total_partsales as $partsale) {
        //     $total_partsales_count += $partsale->offers->count();
        // }
        // $total_offers_bids_tenders = $total_carsales_count + $total_carrents_count + $total_carauctions_count + $total_cartenders_count + $total_partsales_count;

        // // Months ----------------------------------
        // $month_carsalepurchases = Carsalepurchase::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
        // $month_carrentpurchases = Carrentpurchase::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
        // $month_cartenderpurchases = Cartenderpurchase::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
        // $month_carauctionpurchases = Carauctionpurchase::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
        // $month_partsalepurchases = Partsalepurchase::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
        // $month_cars_sold = $month_carsalepurchases + $month_cartenderpurchases + $month_carauctionpurchases;
        // $month_cars_rented = $month_carrentpurchases;
        // $month_parts_sold = $month_partsalepurchases;

        // $month_cars = Car::where('corporate_id', $corporate->id);
        // $month_car_comments = 0;
        // $month_car_tails = 0;
        // foreach ($month_cars as $car) {
        //     $month_car_comments = Carcomment::where('car_id', $car->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
        // }
        // foreach ($month_cars as $car) {
        //     $month_car_tails = Cartail::where('car_id', $car->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->count();
        // }

        // $month_carsales = Carsale::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->get();
        // $month_carsales_count = 0;
        // foreach ($month_carsales as $carsale) {
        //     $month_carsales_count += $carsale->offers->count();
        // }
        // $month_carrents = Carrent::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->get();
        // $month_carrents_count  = 0;
        // foreach ($month_carrents as $carrent) {
        //     $month_carrents_count += $carrent->offers->count();
        // }
        // $month_cartenders = Cartender::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->get();
        // $month_cartenders_count  = 0;
        // foreach ($month_cartenders as $cartender) {
        //     $month_cartenders_count += $cartender->offers->count();
        // }
        // $month_carauctions = Carauction::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->get();
        // $month_carauctions_count = 0;
        // foreach ($month_carauctions as $carauction) {
        //     $month_carauctions_count += $carauction->offers->count();
        // }
        // $month_partsales = Partsale::where('corporate_id', $corporate->id)->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE())')->get();
        // $month_partsales_count = 0;
        // foreach ($month_partsales as $partsale) {
        //     $month_partsales_count += $partsale->offers->count();
        // }
        // $month_offers_bids_tenders = $month_carsales_count + $month_carrents_count + $month_carauctions_count + $month_cartenders_count + $month_partsales_count;

        // // Activity

        return view('corp.dashboard', [
            'corporate' => $corporate,
            // 'total_cars_sold' => $total_cars_sold,
            // 'total_cars_rented' => $total_cars_rented,
            // 'total_parts_sold' => $total_parts_sold,
            // 'total_car_comments' => $total_car_comments,
            // 'total_car_tails' => $total_car_tails,
            // 'total_offers_bids_tenders' => $total_offers_bids_tenders,
            // 'month_cars_sold' => $month_cars_sold,
            // 'month_cars_rented' => $month_cars_rented,
            // 'month_parts_sold' => $month_parts_sold,
            // 'month_car_comments' => $month_car_comments,
            // 'month_car_tails' => $month_car_tails,
            // 'month_offers_bids_tenders' => $month_offers_bids_tenders,
        ]); 
    }

    /**
     * Show the Corporate members.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatemembers(Corporate $corporate)
    {
        $corporateusers = Corporateuser::where('corporate_id', $corporate->id)->get();

        return view('corp.members', [
            'corporate' => $corporate,
            'corporateusers' => $corporateusers,
        ]); 
    }

    /**
     * Show the Corporate settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatesettings(Corporate $corporate)
    {
        $subscription = Subscription::findOrFail($corporate->subscription_id);

        return view('corp.settings', [
            'subscription' => $subscription,
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show the Corporate settings edit page.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatesettingsedit(Corporate $corporate)
    {
        if (Session::has($corporate->id . 'corp_logo_image_url')) {
            // $car_image_upload_count = (int)Session::pull('car_image_upload_count');
            // for ($i = $car_image_upload_count; $i > 0; $i--) { 
                Session::forget($corporate->id . 'corp_logo_image_url');
            // }
            // Session::forget('car_image_upload_count');
        }
        if (Session::has($corporate->id . 'corp_banner_image_url')) {
            // $car_image_upload_count = (int)Session::pull('car_image_upload_count');
            // for ($i = $car_image_upload_count; $i > 0; $i--) { 
                Session::forget($corporate->id . 'corp_banner_image_url');
            // }
            // Session::forget('car_image_upload_count');
        }

        $subscription = Subscription::findOrFail($corporate->subscription_id);

        return view('corp.settingsedit', [
            'subscription' => $subscription,
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show the Corporate store.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatestore(Corporate $corporate)
    {
        $opencarsales = Carsale::where('corporate_id', $corporate->id)->where('status', 'opened')->get();
        $opencarrents = Carrent::where('corporate_id', $corporate->id)->where('status', 'opened')->get();
        $opencartenders = Cartender::where('corporate_id', $corporate->id)->where('status', 'opened')->get();
        $opencarauctions = Carauction::where('corporate_id', $corporate->id)->where('status', 'opened')->get();
        $openpartsales = Partsale::where('corporate_id', $corporate->id)->where('status', 'opened')->get();

        $reservedcarsales = Carsale::where('corporate_id', $corporate->id)->where('status', 'reserved')->get();
        $reservedcarrents = Carrent::where('corporate_id', $corporate->id)->where('status', 'reserved')->get();
        $reservedcartenders = Cartender::where('corporate_id', $corporate->id)->where('status', 'reserved')->get();
        $reservedcarauctions = Carauction::where('corporate_id', $corporate->id)->where('status', 'reserved')->get();
        $reservedpartsales = Partsale::where('corporate_id', $corporate->id)->where('status', 'reserved')->get();

        return view('corp.store', [
            'corporate' => $corporate,
            'opencarsales' => $opencarsales,
            'opencarrents' => $opencarrents,
            'opencartenders' => $opencartenders,
            'opencarauctions' => $opencarauctions,
            'openpartsales' => $openpartsales,
            'reservedcarsales' => $reservedcarsales,
            'reservedcarrents' => $reservedcarrents,
            'reservedcartenders' => $reservedcartenders,
            'reservedcarauctions' => $reservedcarauctions,
            'reservedpartsales' => $reservedpartsales,
        ]); 
    }

    /**
     * Show to the Carsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatecarsale(Corporate $corporate, Car $car, Carsale $carsale, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        $carsalereserves = Carsalereserve::where('carsale_id', $carsale->id)->get();

        return view('corp.car.carsale', [
            'carsale' => $carsale,
            'corporate' => $corporate,
            'carsalereserves' => $carsalereserves,
        ]); 
    }

    /**
     * Show to the Carrent.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatecarrent(Corporate $corporate, Car $car, Carrent $carrent, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        $carrentreserves = Carrentreserve::where('carrent_id', $carrent->id)->get();

        return view('corp.car.carrent', [
            'carrent' => $carrent,
            'corporate' => $corporate,
            'carrentreserves' => $carrentreserves,
        ]); 
    }

    /**
     * Show to the Cartender.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatecartender(Corporate $corporate, Car $car, Cartender $cartender, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        // $cartenderreserves = Cartenderreserve::where('cartender_id', $cartender->id)->get();
        $cartendertenderers = Cartendertenderer::where('cartender_id', $cartender->id)->get();
        $cartendertenderers_pending = Cartendertenderer::where('cartender_id', $cartender->id)->where('accepted', false)->get();
        $cartendertenderers_accepted = Cartendertenderer::where('cartender_id', $cartender->id)->where('accepted', true)->get();

        return view('corp.car.cartender', [
            'cartender' => $cartender,
            'corporate' => $corporate,
            // 'cartenderreserves' => $cartenderreserves,
            'cartendertenderers' => $cartendertenderers,
            'cartendertenderers_pending' => $cartendertenderers_pending,
            'cartendertenderers_accepted' => $cartendertenderers_accepted,
        ]); 
    }

    /**
     * Show to the Carauction.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatecarauction(Corporate $corporate, Car $car, Carauction $carauction, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        $carauctionbidders = Carauctionbidder::where('carauction_id', $carauction->id)->get();
        $carauctionbidders_pending = Carauctionbidder::where('carauction_id', $carauction->id)->where('accepted', false)->get();
        $carauctionbidders_accepted = Carauctionbidder::where('carauction_id', $carauction->id)->where('accepted', true)->get();

        return view('corp.car.carauction', [
            'carauction' => $carauction,
            'corporate' => $corporate,
            'carauctionbidders' => $carauctionbidders,
            'carauctionbidders_pending' => $carauctionbidders_pending,
            'carauctionbidders_accepted' => $carauctionbidders_accepted,
        ]); 
    }

    /**
     * Show to the Partsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatepartsale(Corporate $corporate, Part $part, Partsale $partsale, $id = null)
    {
        if ($id != null) {
            $notification = Auth::user()->notifications()->where('id',$id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }

        $partsalereserves = Partsalereserve::where('partsale_id', $partsale->id)->get();

        return view('corp.part.partsale', [
            'partsale' => $partsale,
            'corporate' => $corporate,
            'partsalereserves' => $partsalereserves,
        ]); 
    }

    /**
     * Show to the Members Add Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function addcorporateuserform(Corporate $corporate)
    {
        return view('corp.user.createcorporateuser', [
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show to the Members Update Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatecorporateuserform(Corporate $corporate, Corporateuser $corporateuser)
    {
        return view('corp.user.corporateuseredit', [
            'corporate' => $corporate,
            'corporateuser' => $corporateuser,
        ]); 
    }



    // ===================================================================================
    // 
    // 
    //     Getters
    // 
    // 
    // ===================================================================================


    /**
     * Newsfeed builder here
     *
     * @return \Illuminate\Http\Response
     */
    function getnewsfeed(Request $request) {

        // Carsales
        $carsales = DB::table('carsales')
                        ->join('cars', 'carsales.car_id', 'cars.id')
                        ->join('corporates', 'carsales.corporate_id', 'corporates.id')
                        ->select(
                            'carsales.*', 
                            'cars.*', 
                            'corporates.name as corporate_name', 
                            'carsales.id as carsale_id', 
                            'cars.id as car_id', 
                            'carsales.created_at as carsales_created_at', 
                            'cars.created_at as cars_created_at', 
                            'carsales.updated_at as carsales_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('carsales.status', 'opened')
                        ->where('corporates.active', true)
                        ->orderBy('carsales.updated_at', 'desc')
                        ->simplePaginate(3);

        // Carrents
        $carrents = DB::table('carrents')
                        ->join('cars', 'carrents.car_id', 'cars.id')
                        ->join('corporates', 'carrents.corporate_id', 'corporates.id')
                        ->select(
                            'carrents.*', 
                            'cars.*', 
                            'corporates.name as corporate_name', 
                            'carrents.id as carrent_id', 
                            'cars.id as car_id', 
                            'carrents.created_at as carrents_created_at', 
                            'cars.created_at as cars_created_at', 
                            'carrents.updated_at as carrents_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('carrents.status', 'opened')
                        ->where('corporates.active', true)
                        ->orderBy('carrents.updated_at', 'desc')
                        ->simplePaginate(3);
        // Cartenders
        $cartenders = DB::table('cartenders')
                        ->join('cars', 'cartenders.car_id', 'cars.id')
                        ->join('corporates', 'cartenders.corporate_id', 'corporates.id')
                        ->select(
                            'cartenders.*', 
                            'cars.*', 
                            'corporates.name as corporate_name', 
                            'cartenders.id as cartender_id', 
                            'cars.id as car_id', 
                            'cartenders.created_at as cartenders_created_at', 
                            'cars.created_at as cars_created_at', 
                            'cartenders.updated_at as cartenders_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('cartenders.status', 'opened')
                        ->where('corporates.active', true)
                        ->orderBy('cartenders.updated_at', 'desc')
                        ->simplePaginate(3);
        // Carauctions
        $carauctions = DB::table('carauctions')
                        ->join('cars', 'carauctions.car_id', 'cars.id')
                        ->join('corporates', 'carauctions.corporate_id', 'corporates.id')
                        ->select(
                            'carauctions.*', 
                            'cars.*', 
                            'corporates.name as corporate_name', 
                            'carauctions.id as carauction_id', 
                            'cars.id as car_id', 
                            'carauctions.created_at as carauctions_created_at', 
                            'cars.created_at as cars_created_at', 
                            'carauctions.updated_at as carauctions_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('carauctions.status', 'opened')
                        ->where('corporates.active', true)
                        ->orderBy('carauctions.updated_at', 'desc')
                        ->simplePaginate(3);
        // Partsales
        $partsales = DB::table('partsales')
                        ->join('parts', 'partsales.part_id', 'parts.id')
                        ->join('corporates', 'partsales.corporate_id', 'corporates.id')
                        ->select(
                            'partsales.*', 
                            'parts.*', 
                            'corporates.name as corporate_name', 
                            'partsales.id as partsale_id', 
                            'parts.id as part_id', 
                            'partsales.created_at as partsales_created_at', 
                            'parts.created_at as parts_created_at', 
                            'partsales.updated_at as partsales_updated_at', 
                            'parts.updated_at as parts_updated_at')
                        ->where('partsales.status', 'opened')
                        ->where('corporates.active', true)
                        ->orderBy('partsales.updated_at', 'desc')
                        ->simplePaginate(3);

        return response()->json(['success'=>true, 'carsales'=>$carsales, 'carrents'=>$carrents, 'cartenders'=>$cartenders, 'carauctions'=>$carauctions, 'partsales'=>$partsales]);
    }

    /**
     * Corporate Newsfeed builder here
     *
     * @return \Illuminate\Http\Response
     */
    function getcorpnewsfeed(Request $request) {
        $this->validate($request, [
            'corporate_id' => 'required|numeric',
        ]);

        // Carsales
        $carsales = DB::table('carsales')
                        ->join('cars', 'carsales.car_id', 'cars.id')
                        ->select(
                            'carsales.*', 
                            'cars.*', 
                            'carsales.id as carsale_id', 
                            'cars.id as car_id', 
                            'carsales.created_at as carsales_created_at', 
                            'cars.created_at as cars_created_at', 
                            'carsales.updated_at as carsales_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('carsales.status', 'opened')
                        ->where('carsales.corporate_id', $request->corporate_id)
                        ->orderBy('carsales.updated_at', 'desc')
                        ->simplePaginate(3);

        // Carrents
        $carrents = DB::table('carrents')
                        ->join('cars', 'carrents.car_id', 'cars.id')
                        ->select(
                            'carrents.*', 
                            'cars.*', 
                            'carrents.id as carrent_id', 
                            'cars.id as car_id', 
                            'carrents.created_at as carrents_created_at', 
                            'cars.created_at as cars_created_at', 
                            'carrents.updated_at as carrents_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('carrents.status', 'opened')
                        ->where('carrents.corporate_id', $request->corporate_id)
                        ->orderBy('carrents.updated_at', 'desc')
                        ->simplePaginate(3);
        // Cartenders
        $cartenders = DB::table('cartenders')
                        ->join('cars', 'cartenders.car_id', 'cars.id')
                        ->select(
                            'cartenders.*', 
                            'cars.*', 
                            'cartenders.id as cartender_id', 
                            'cars.id as car_id', 
                            'cartenders.created_at as cartenders_created_at', 
                            'cars.created_at as cars_created_at', 
                            'cartenders.updated_at as cartenders_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('cartenders.status', 'opened')
                        ->where('cartenders.corporate_id', $request->corporate_id)
                        ->orderBy('cartenders.updated_at', 'desc')
                        ->simplePaginate(3);
        // Carauctions
        $carauctions = DB::table('carauctions')
                        ->join('cars', 'carauctions.car_id', 'cars.id')
                        ->select(
                            'carauctions.*', 
                            'cars.*', 
                            'carauctions.id as carauction_id', 
                            'cars.id as car_id', 
                            'carauctions.created_at as carauctions_created_at', 
                            'cars.created_at as cars_created_at', 
                            'carauctions.updated_at as carauctions_updated_at', 
                            'cars.updated_at as cars_updated_at')
                        ->where('carauctions.status', 'opened')
                        ->where('carauctions.corporate_id', $request->corporate_id)
                        ->orderBy('carauctions.updated_at', 'desc')
                        ->simplePaginate(3);
        // Partsales
        $partsales = DB::table('partsales')
                        ->join('parts', 'partsales.part_id', 'parts.id')
                        ->select(
                            'partsales.*', 
                            'parts.*', 
                            'partsales.id as partsale_id', 
                            'parts.id as part_id', 
                            'partsales.created_at as partsales_created_at', 
                            'parts.created_at as parts_created_at', 
                            'partsales.updated_at as partsales_updated_at', 
                            'parts.updated_at as parts_updated_at')
                        ->where('partsales.status', 'opened')
                        ->where('partsales.corporate_id', $request->corporate_id)
                        ->orderBy('partsales.updated_at', 'desc')
                        ->simplePaginate(3);

        return response()->json(['success'=>true, 'carsales'=>$carsales, 'carrents'=>$carrents, 'cartenders'=>$cartenders, 'carauctions'=>$carauctions, 'partsales'=>$partsales]);
    }

    /**
     * Get the Car counts
     *
     * @return \Illuminate\Http\Response
     */
    function getcarcounts(Request $request) {
        $this->validate($request, [
            'car_array' => 'required',
        ]);

        $counts_array = [];

        foreach ($request->car_array as $car) {
            $trade_count = 0;
            if ($car['trade_type'] == 'carsale') {
                $trade_count = Carsaleoffer::where('carsale_id', $car['trade_id'])->count();
            } else if ($car['trade_type'] == 'carrent') {
                $trade_count = Carrentoffer::where('carrent_id', $car['trade_id'])->count();
            } else if ($car['trade_type'] == 'cartender') {
                $trade_count = Cartendertender::where('cartender_id', $car['trade_id'])->count();
            } else if ($car['trade_type'] == 'carauction') {
                $trade_count = Carauctionbid::where('carauction_id', $car['trade_id'])->count();
            }

            $comment_count = 0;
            $tail_count = 0;
            $comment_count = Carcomment::where('car_id', $car['car_id'])->count();
            $tail_count = Cartail::where('car_id', $car['car_id'])->count();

            $counts_array[] = array('comment_count'=>$comment_count, 'tail_count'=>$tail_count, 'trade_count'=>$trade_count);
        }

        return response()->json(['success'=>true, 'counts'=>$counts_array]);
    }

    /**
     * Get the Part counts
     *
     * @return \Illuminate\Http\Response
     */
    function getpartcounts(Request $request) {
        $this->validate($request, [
            'part_array' => 'required',
        ]);

        $counts_array = [];

        foreach ($request->part_array as $part) {
            $trade_count = 0;
            if ($part['trade_type'] == 'partsale') {
                $trade_count = Partsaleoffer::where('partsale_id', $part['trade_id'])->count();
            }

            $comment_count = 0;
            $tail_count = 0;
            $comment_count = Partcomment::where('part_id', $part['part_id'])->count();
            $tail_count = Parttail::where('part_id', $part['part_id'])->count();

            $counts_array[] = array('comment_count'=>$comment_count, 'tail_count'=>$tail_count, 'trade_count'=>$trade_count);
        }

        return response()->json(['success'=>true, 'counts'=>$counts_array]);
    }

    /**
     * Get the Car images
     *
     * @return \Illuminate\Http\Response
     */
    function getcarimages(Request $request) {
        $this->validate($request, [
            'car_array' => 'required',
        ]);

        $images_array = [];

        foreach ($request->car_array as $car) {
            if (Carimage::where('car_id', $car['car_id'])->count() > 0) {
                $carimage = Carimage::where('car_id', $car['car_id'])->first(); 
                $images_array[] = array('thumb_img_url'=>$carimage->thumb_img_url);
            } else {
                $images_array[] = array('thumb_img_url'=>asset('/imgs/no-images.png'));
            }
        }

        return response()->json(['success'=>true, 'carimages'=>$images_array]);
    }

    /**
     * Get the part images
     *
     * @return \Illuminate\Http\Response
     */
    function getpartimages(Request $request) {
        $this->validate($request, [
            'part_array' => 'required',
        ]);

        $images_array = [];

        foreach ($request->part_array as $part) {
            $partimage = Partimage::where('part_id', $part['part_id'])->first();

            $images_array[] = array('thumb_img_url'=>$partimage->thumb_img_url);
        }

        return response()->json(['success'=>true, 'partimages'=>$images_array]);
    }

    /**
     * Get the Carsale offers
     *
     * @return \Illuminate\Http\Response
     */
    function getcarsaleoffers(Request $request) {
        // get car offers
        $this->validate($request, [
            'carsale_id' => 'required|integer',
        ]);

        $carsaleoffers = DB::table('carsaleoffers')
                    ->leftJoin('users', 'users.id', '=', 'carsaleoffers.user_id')
                    ->select('carsaleoffers.*', 'users.propic', 'users.name')
                    ->where('carsaleoffers.carsale_id', $request->carsale_id)
                    ->get();

        return response()->json(['success'=>true, 'carsaleoffers'=>$carsaleoffers]);
    }

    /**
     * Get the Carrent offers
     *
     * @return \Illuminate\Http\Response
     */
    function getcarrentoffers(Request $request) {
        // get car offers
        $this->validate($request, [
            'carrent_id' => 'required|integer',
        ]);

        $carrentoffers = DB::table('carrentoffers')
                    ->leftJoin('users', 'users.id', '=', 'carrentoffers.user_id')
                    ->select('carrentoffers.*', 'users.propic', 'users.name')
                    ->where('carrentoffers.carrent_id', $request->carrent_id)
                    ->get();

        return response()->json(['success'=>true, 'carrentoffers'=>$carrentoffers]);
    }

    /**
     * Get the Cartender tenders
     *
     * @return \Illuminate\Http\Response
     */
    function getcartendertenders(Request $request) {
        // get car tenders
        $this->validate($request, [
            'cartender_id' => 'required|integer',
        ]);

        $cartendertenders = DB::table('cartendertenders')
                    ->leftJoin('users', 'users.id', '=', 'cartendertenders.user_id')
                    ->select('cartendertenders.*', 'users.propic', 'users.name')
                    ->where('cartendertenders.cartender_id', $request->cartender_id)
                    ->where('cartendertenders.user_id', Auth::user()->id)
                    ->get();

        return response()->json(['success'=>true, 'cartendertenders'=>$cartendertenders]);
    }

    /**
     * Get the Carauction bids
     *
     * @return \Illuminate\Http\Response
     */
    function getcarauctionbids(Request $request) {
        // get car bids
        $this->validate($request, [
            'carauction_id' => 'required|integer',
        ]);

        $carauctionbids = DB::table('carauctionbids')
                    ->leftJoin('users', 'users.id', '=', 'carauctionbids.user_id')
                    ->select('carauctionbids.*', 'users.propic', 'users.name')
                    ->where('carauctionbids.carauction_id', $request->carauction_id)
                    ->get();

        return response()->json(['success'=>true, 'carauctionbids'=>$carauctionbids]);
    }

    /**
     * Get the Partsale offers
     *
     * @return \Illuminate\Http\Response
     */
    function getpartsaleoffers(Request $request) {
        // get part comments
        $this->validate($request, [
            'partsale_id' => 'required|integer',
        ]);

        $partsaleoffers = DB::table('partsaleoffers')
                    ->leftJoin('users', 'users.id', '=', 'partsaleoffers.user_id')
                    ->select('partsaleoffers.*', 'users.propic', 'users.name')
                    ->where('partsaleoffers.partsale_id', $request->partsale_id)
                    ->get();

        return response()->json(['success'=>true, 'partsaleoffers'=>$partsaleoffers]);
    }

    /**
     * Get the car comments
     *
     * @return \Illuminate\Http\Response
     */
    function getcarcomments(Request $request) {
        // get car comments
        $this->validate($request, [
            'car_id' => 'required|integer',
        ]);

        $carcomments = DB::table('carcomments')
                    ->leftJoin('users', 'users.id', '=', 'carcomments.user_id')
                    ->select('carcomments.*', 'users.propic', 'users.name')
                    ->orderBy('carcomments.created_at', 'asc')
                    ->where('carcomments.car_id', $request->car_id)
                    ->get();

        return response()->json(['success'=>true, 'carcomments'=>$carcomments]);
    }

    /**
     * Get the part comments
     *
     * @return \Illuminate\Http\Response
     */
    function getpartcomments(Request $request) {
        // get part comments
        $this->validate($request, [
            'part_id' => 'required|integer',
        ]);

        $partcomments = DB::table('partcomments')
                    ->leftJoin('users', 'users.id', '=', 'partcomments.user_id')
                    ->select('partcomments.*', 'users.propic', 'users.name')
                    ->where('partcomments.part_id', $request->part_id)
                    ->get();

        return response()->json(['success'=>true, 'partcomments'=>$partcomments]);
    }

    /**
     * Get the Car tails
     *
     * @return \Illuminate\Http\Response
     */
    function getcartails(Request $request) {
        // get car tails
        $this->validate($request, [
            'car_id' => 'required|integer',
        ]);

        $cartails = DB::table('cartails')
                    ->leftJoin('users', 'users.id', '=', 'cartails.user_id')
                    ->select('cartails.*', 'users.propic', 'users.name')
                    ->where('cartails.car_id', $request->car_id)
                    ->get();

        return response()->json(['success'=>true, 'cartails'=>$cartails]);
    }

    /**
     * Get the Part tails
     *
     * @return \Illuminate\Http\Response
     */
    function getparttails(Request $request) {
        // get part tails
        $this->validate($request, [
            'part_id' => 'required|integer',
        ]);

        $cartails = DB::table('parttails')
                    ->leftJoin('users', 'users.id', '=', 'parttails.user_id')
                    ->select('parttails.*', 'users.propic', 'users.name')
                    ->where('parttails.part_id', $request->part_id)
                    ->get();

        return response()->json(['success'=>true, 'parttails'=>$parttails]);
    }



    // ===================================================================================
    // 
    // 
    //     Message
    // 
    // 
    // ===================================================================================

    /**
     * Send message to another user.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendmessage(Request $request) {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'message' => 'required',
        ]);

        $receiving_user = User::find($request->user_id);

        // Fill this so that user message shows up in Messages. Dirty Hack. Please fix later.
        if(Message::where('user_id_sending', Auth::user()->id)->where('user_id_receiving', $request->user_id)->count() == 0) {
            $message_blank = new Message();
            $message_blank->user_id_sending = $receiving_user->id;
            $message_blank->user_id_receiving = Auth::user()->id;
            $message_blank->message = '';
            $message_blank->save();
        }

        $message = new Message();
        $message->user_id_sending = Auth::user()->id;
        $message->user_id_receiving = $receiving_user->id;
        $message->message = $request->message;
        $message->save();

        $receiving_user->notify(new NewMessageNotification($message));

        return response()->json(['success'=>true, 'message'=>$message]);
    }

    /**
     * Get user messages
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function getusermessages(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
        ]);

        $user = Auth::user();

        $notifications = $user->notifications()->whereRaw('data LIKE \'%"user_sending_id":' . $request->user_id . '%\'')->get();
        if ($notifications->count() > 0) {
            $notifications->markAsRead();
        }

        $messages = Message::where([
                ['user_id_receiving', $user->id],
                ['user_id_sending', $request->user_id],
            ])->orWhere([
                ['user_id_receiving', $request->user_id],
                ['user_id_sending', $user->id],
            ])->orderBy('created_at')->get();

        return response()->json(['success'=>true,'messages'=>$messages]);
    }


    /**
     * Get user and all their messages
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function getusermessagesanduser(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer',
        ]);

        $user = Auth::user();

        $messages = Message::where([
                ['user_id_receiving', $user->id],
                ['user_id_sending', $request->user_id],
            ])->orWhere([
                ['user_id_receiving', $request->user_id],
                ['user_id_sending', $user->id],
            ])->orderBy('created_at')->get();

        return response()->json(['success'=>true,'messages'=>$messages, 'user'=>$user]);
    }

    /**
     * Get new users to message
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function getnewusers(Request $request)
    {
        $this->validate($request, [
            'partial' => 'required',
        ]);

        $users = User::where('name', 'like', '%' . $request->partial . '%')->orWhere('email', 'like', '%' . $request->partial . '%')->get();

        return response()->json(['success'=>true, 'users'=>$users]);
    }



    // ===================================================================================
    // 
    // 
    //     Notifications
    // 
    // 
    // ===================================================================================

    /**
     * Get notifications. THIS ALSO GRABS ALL MESSAGES REMEMBER!!!
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function getnotifications(Request $request)
    {
        $unreadnotifications = Auth::user()->unreadNotifications;

        return response()->json(['success'=>true,'notifications'=>$unreadnotifications]);
    }

    /**
     * Mark as read notification
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function marknotificationasread($id)
    {
        $success = false;

        $notification = Auth::user()->notifications()->where('id',$id)->first();
        if ($notification) {
            $notification->delete();
            $success = true;
        } 

        return response()->json(['success'=>$success]);
    }



    // ===================================================================================
    // 
    // 
    //     Reports
    // 
    // 
    // ===================================================================================

    /**
     * Report another user.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportuser(Request $request)
    {
        $userreport = new Userreport;
        $userreport->reporting_user_id = Auth::User()->id;
        $userreport->report_user_id = $request->report_user_id;
        $userreport->report = $request->report;
        $userreport->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Report a corporate.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportcorporate(Request $request)
    {
        $corporatereport = new Corporatereport;
        $corporatereport->corporate_id = $request->corporate_id;
        $corporatereport->user_id = $request->user_id;
        $corporatereport->report = $request->report;
        $corporatereport->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Report a car.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportcar(Request $request)
    {
        $carreport = new Carreport;
        $carreport->car_id = $request->car_id;
        $carreport->user_id = $request->user_id;
        $carreport->report = $request->report;
        $carreport->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Report a part.
     *
     * @return \Illuminate\Http\Response
     */
    public function reportpart(Request $request)
    {
        $partreport = new Partreport;
        $partreport->part_id = $request->part_id;
        $partreport->user_id = $request->user_id;
        $partreport->report = $request->report;
        $partreport->save();

        return response()->json(['success'=>true]);
    }



    // ===================================================================================
    // 
    // 
    //     Add Corporate
    // 
    // 
    // ===================================================================================

    /**
     * Add Corporate
     *
     * @param  Request $request
     * @return Response 
     */
    public function addcorporate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'descrip' => 'required',
            'subscription' => 'required',
            'logo_url' => 'required|image',
            'banner_url' => 'required|image',
        ]);

        $user = Auth::user();

        $corporate = new Corporate;
        $corporate->name = $request->name;
        $corporate->address = $request->address;
        $corporate->phone = $request->phone;
        $corporate->descrip = $request->descrip;

        $path = $request->file('logo_url')->store('corplogo');
        $imageName = $request->logo_url->hashName();
        $image_url = $path;
        $image_url_full = url('/') . '/storage/' . $path;
        $corporate->logo_url = $image_url_full;

        $path = $request->file('banner_url')->store('corpbanner');
        $imageName = $request->banner_url->hashName();
        $image_url = $path;
        $image_url_full = url('/') . '/storage/' . $path;
        $corporate->banner_url = $image_url_full;

        $subscription = Subscription::where('name', ($request->subscription))->first();
        $corporate->subscription_id = $subscription->id;
        $corporate->save();

        $corporateuser = new Corporateuser;
        $corporateuser->corporate_id = $corporate->id;
        $corporateuser->user_id = $user->id;
        $corporateuser->title = 'title';
        $corporateuser->save();

        $user->attachRole(1);

        if ($subscription->name == 'basic') {
            $corporate->active = true;
            $corporate->save();

            return redirect('/corporate/' . $corporate->id);
        } else {
            $corporate->active = false;
            $corporate->save();

            # Email Skoonters team advising them of this application. For now check everytime
            // Mail::to('jeremypalme@gmail.com')
            //     ->to('kitraimo@gmail.com')
            //     // ->to('wikaimembi@live.com')
            //     ->send(new SubscriptionApplication($corporate, $subscription, Auth::user()));

            # Redirect to page to inform user that we will contact them shortly to get their details and organize payment.
            return redirect('/user/corporate/add/pending');
        }
        
        // return response()->json(['success'=>true]);
    }



    // ===================================================================================
    // 
    // 
    //     Checks and Misc Ajax Calls
    // 
    // 
    // ===================================================================================

    /**
     * Authenticate User to Pusher Channel
     *
     * @return \Illuminate\Http\Response
     */
    public function pusherauthenticate($id) {
         if ( Auth::user()->id === (int) $id ) {
           $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'));
           echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
         } else {
           header('', true, 403);
           echo "Forbidden";
         }
    }

    /**
     * Check if user is a Corporate user
     *
     * @param  Request $request
     * @return Response 
     */
    public function iscorpuser(Request $request)
    {
        $this->validate($request, [
            'corp_id' => 'required|integer',
        ]);

        $success = false;

        if (!is_null(Auth::user()->corporateuser)) {
            if (Auth::user()->corporateuser->corporate->id == $request->corp_id) {
                $success = true;
            }
        }

        return response()->json(['success'=>$success]);
    }

    /**
     * Check if user is a tailing car
     *
     * @param  Request $request
     * @return Response 
     */
    public function istailingcar(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required|integer',
        ]);

        $success = false;

        if (Cartail::where('car_id', $request->car_id)->where('user_id', Auth::user()->id)->count() == 1) {
            $success = true;
        }

        return response()->json(['success'=>$success]);
    }

    /**
     * Check if user is a tailing part
     *
     * @param  Request $request
     * @return Response 
     */
    public function istailingpart(Request $request)
    {
        $this->validate($request, [
            'part_id' => 'required|integer',
        ]);

        $success = false;

        if (Parttail::where('part_id', $request->part_id)->where('user_id', Auth::user()->id)->count() == 1) {
            $success = true;
        }

        return response()->json(['success'=>$success]);
    }

    /**
     * Check if user is a Corporate user and has role
     *
     * @param  Request $request
     * @return Response 
     */
    public function hascorpuserrole(Request $request)
    {
        $this->validate($request, [
            'corp_id' => 'required|integer',
            'role' => 'required',
        ]);

        $success = false;

        if (Auth::user()->corporateuser) {
            if (Auth::user()->corporateuser->corporate->id == $request->corp_id && Auth::user()->hasRole($request->role)) {
                $success = true;
            }
        }

        return response()->json(['success'=>$success]);
    }

    /**
     * Return the Car models
     *
     * @return \Illuminate\Http\Response
     */
    public function loadcarmodels(Request $request)
    {
        $carmodels = Carmakemodel::where('make', $request->make)->groupBy('model')->pluck('model')->toArray();

        return response()->json($carmodels);
    }

}
