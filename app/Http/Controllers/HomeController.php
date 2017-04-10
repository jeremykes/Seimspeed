<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\NewMessageNotification;

use App\User;
use App\Userreport;
use App\Events\UserReported;

use App\Message;

use Auth;


class HomeController extends Controller
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
     * Show the application dashboard.
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


    
}
