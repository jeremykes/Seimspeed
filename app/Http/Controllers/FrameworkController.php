<?php

namespace App\Http\Controllers;

use Carbon;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\User;
use App\Message;
use App\Userreport;
use App\Corporatereport;
use App\Carreport;
use App\Partreport;

use App\Events\NewMessage;
use App\Events\UserReported;
use App\Events\CorporateReported;
use App\Events\CarReported;
use App\Events\PartReported;
use App\Events\CorporateCreated;

use App\Notifications\NewMessageNotification;
use App\Notifications\UserReportedNotification;
use App\Notifications\CorporateReportedNotification;
use App\Notifications\CarReportedNotification;
use App\Notifications\PartReportedNotification;

use Illuminate\Notifications\DatabaseNotification;

use App\Carsale;
use App\Carrent;
use App\Cartender;
use App\Carauction;
use App\Partsale;

use Auth;


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
            'reportuser',
            'reportcorporate',
            'reportcar',
            'reportpart',
            'corporatesettings',
            'corporatedashboard',
            'addcorporate',
        ]]);

        $this->middleware('corpuser', ['only' => [
            'corporatesettings',
            'corporatedashboard',
        ]]);
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
    public function sendmessage(Request $request)
    {
    	$receiving_user = User::find($request->user_id_receiving);

    	$message = new Message();
    	$message->user_id_sending = Auth::user()->id;
    	$message->user_id_receiving = $receiving_user->id;
    	$message->message = $request->message;
    	$message->save();

        event(new NewMessage($receiving_user, $message));

        $receiving_user->notify(new NewMessageNotification($message));
    	Auth::user()->notify(new NewMessageNotification($message));

        return response()->json(['success'=>true]);
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

        $reported_user = User::find($request->report_user_id);

        event(new UserReported($userreport));

        $reported_user->notify(new UserReportedNotification($userreport));

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

        $corporate = Corporate::find($request->corporate_id);

        event(new CorporateReported($corporatereport));

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

        $car = Car::find($request->car_id);

        event(new CarReported($carreport));

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

        $part = Part::find($request->part_id);

        event(new PartReported($partreport));

        return response()->json(['success'=>true]);
    }



    // ===================================================================================
    // 
    // 
    //     Single Blade Views (used for Notifications too)
    // 
    // 
    // ===================================================================================

    /**
     * Show to the Carsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function carsale(Carsale $carsale, DatabaseNotification $notification = null)
    {
        if ($notification != null) {
            $notification->markAsRead();    
        }

        return view('carsale', [
            'carsale' => $carsale,
        ]); 
    }

    /**
     * Show to the Carrent.
     *
     * @return \Illuminate\Http\Response
     */
    public function carrent(Carrent $carrent, DatabaseNotification $notification = null)
    {
        if ($notification != null) {
            $notification->markAsRead();    
        }

        return view('carrent', [
            'carrent' => $carrent,
        ]); 
    }

    /**
     * Show to the Cartender.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartender(Cartender $cartender, DatabaseNotification $notification = null)
    {
        if ($notification != null) {
            $notification->markAsRead();    
        }

        return view('cartender', [
            'cartender' => $cartender,
        ]); 
    }

    /**
     * Show to the Carauction.
     *
     * @return \Illuminate\Http\Response
     */
    public function carauction(Carauction $carauction, DatabaseNotification $notification = null)
    {
        if ($notification != null) {
            $notification->markAsRead();    
        }

        return view('carauction', [
            'carauction' => $carauction,
        ]); 
    }

    /**
     * Show to the Partsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function partsale(Partsale $partsale, DatabaseNotification $notification = null)
    {
        if ($notification != null) {
            $notification->markAsRead();    
        }

        return view('partsale', [
            'partsale' => $partsale,
        ]); 
    }


    // ===================================================================================
    // 
    // 
    //     Main Views
    // 
    // 
    // ===================================================================================

    /**
     * Show the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::find(2);

        // $userreport = Userreport::find(1);

        // event(new UserReported($user, $userreport));

        // $message = Message::find(20);

        // Auth::user()->notify(new NewMessageNotification($message));

        return view('home'); 
    }

    /**
     * Show the Corporate Home.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatehome(Corporate $corporate, $page = 'newsfeed')
    {
        return view('corporatehome', [
            'corporate' => $corporate,
            'page' => $page,
        ]); 
    }

    /**
     * Show the Corporate settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatesettings(Corporate $corporate, $page = 'settings')
    {
        return view('corporatesettings', [
            'corporate' => $corporate,
            'page' => $page,
        ]); 
    }

    /**
     * Show the Corporate dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatedashboard(Corporate $corporate, $page = 'dashboard')
    {
        return view('corporatedashboard', [
            'corporate' => $corporate,
            'page' => $page,
        ]); 
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
            'subscription_id' => 'required',
        ]);

        $corporate = new Corporate;
        $corporate->name = $request->name;
        $corporate->address = $request->address;
        $corporate->phone = $request->phone;
        $corporate->descrip = $descrip;
        $corporate->logo_url = $request->logo_url;
        $corporate->banner_url = $request->banner_url;
        $corporate->subscription_id = $request->subscription_id;
        $corporate->subscriptionexpires = $request->subscriptionexpires;
        $corporate->save();

        event(new CorporateCreated($corporate));

        return response()->json(['success'=>true]);
    }
}
