<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\CarUserCommented;

use App\Events\SomeEvent;

use App\User;

use App\Carcomment;

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
        // $data = [
        //         'name' => 'John',
        //         'age' => 40,
        //     ];

        // $text = "Hello";

        // event(new SomeEvent($text, $data));

        $carcomment = Carcomment::find(1);

        // $user = ;

        Auth::user()->notify(new CarUserCommented($carcomment));

        return view('home'); 
    }


    
}
