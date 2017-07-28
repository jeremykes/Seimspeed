<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use Carbon;
use DB;
use Illuminate\Notifications\DatabaseNotification;

use App\User;
use App\Message;
use App\Userreport;
use App\Corporatereport;
use App\Carreport;
use App\Partreport;
use App\Carsale;
use App\Carrent;
use App\Cartender;
use App\Carauction;
use App\Partsale;

use App\Corporate;
use App\Car;
use App\Carcomment;
use App\Cartail;
use App\Part;
use App\Partcomment;
use App\Parttail;

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
        // $user = User::find(2);

        // $userreport = Userreport::find(1);

        // event(new UserReported($user, $userreport));

        // $message = Message::find(20);

        // Auth::user()->notify(new NewMessageNotification($message));

        return view('home'); 
    }

    /**
     * Show to the Carauction.
     *
     * @return \Illuminate\Http\Response
     */
    public function carauction(Corporate $corporate, Car $car, Carauction $carauction)
    {
        return view('car.carauction', [
            'carauction' => $carauction,
        ]); 
    }

    /**
     * Show to the Carrent.
     *
     * @return \Illuminate\Http\Response
     */
    public function carrent(Corporate $corporate, Car $car, Carrent $carrent)
    {
        return view('car.carrent', [
            'carrent' => $carrent,
        ]); 
    }

    /**
     * Show to the Carsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function carsale(Corporate $corporate, Car $car, Carsale $carsale)
    {
        return view('car.carsale', [
            'carsale' => $carsale,
        ]); 
    }

    /**
     * Show to the Cartender.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartender(Corporate $corporate, Car $car, Cartender $cartender)
    {
        return view('car.cartender', [
            'cartender' => $cartender,
        ]); 
    }

    /**
     * Show to the Partsale.
     *
     * @return \Illuminate\Http\Response
     */
    public function partsale(Corporate $corporate, Part $part, Partsale $partsale)
    {
        return view('part.partsale', [
            'partsale' => $partsale,
        ]); 
    }

    /**
     * Show the Corporate Home.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatehome(Corporate $corporate)
    {
        return view('corp.home', [
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show the Corporate Dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatedashboard(Corporate $corporate)
    {
        return view('corp.dashboard', [
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show the Corporate members.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatemembers(Corporate $corporate)
    {
        return view('corp.members', [
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show the Corporate settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function corporatesettings(Corporate $corporate)
    {
        return view('corp.settings', [
            'corporate' => $corporate,
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
    public function sendmessage(Request $request)
    {
        $receiving_user = User::find($request->user_id_receiving);

        $message = new Message();
        $message->user_id_sending = Auth::user()->id;
        $message->user_id_receiving = $receiving_user->id;
        $message->message = $request->message;
        $message->save();

        $receiving_user->notify(new NewMessageNotification($message));

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

        return response()->json(['success'=>true]);
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

        if (Auth::user()->corporateuser) {
            if (Auth::user()->corporateuser->corporate->id == $request->corp_id) {
                $success = true;
            }
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
