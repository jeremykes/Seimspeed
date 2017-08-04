<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use Carbon;
use DB;
use Notification;
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
use App\Carimage;
use App\Part;
use App\Partcomment;
use App\Parttail;
use App\Partimage;

use App\Carsaleoffer;
use App\Carrentoffer;
use App\Cartendertender;
use App\Carauctionbid;

use App\Notifications\CarSaleOfferReservedNotification;

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

    public function test()
    {
        // return view('home'); 
        $user = User::find(1);
        $carsaleoffer = Carsaleoffer::where('user_id', $user->id)->first();

        Notification::send($user, new CarSaleOfferReservedNotification($carsaleoffer));
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

        return view('car.carauction', [
            'carauction' => $carauction,
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

        return view('car.cartender', [
            'cartender' => $cartender,
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


    // Newsfeed builder here
    /**
     * Get the initial newsfeeds
     *
     * @return \Illuminate\Http\Response
     */
    function getnewsfeed(Request $request) {

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
            $carimage = Carimage::where('car_id', $car['car_id'])->first();

            $images_array[] = array('thumb_img_url'=>$carimage->thumb_img_url);
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
                    ->orderBy('carcomments.created_at', 'asc')
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

    // /**
    //  * Get messages
    //  *
    //  * @param  Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function getmessages(Request $request)
    // {
    //     $unreadnotifications = Auth::user()->unreadNotifications;

    //     return response()->json(['success'=>true,'notifications'=>$unreadnotifications]);
    // }


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
