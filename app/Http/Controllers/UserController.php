<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $this->middleware('role:maintainer|administrator', ['only' => [
            
        ]]);
        

        $this->middleware('role:sales|administrator', ['only' => [
            
        ]]);
        

        $this->middleware('role:management|administrator', ['only' => [
             
        ]]);
        

        $this->middleware('role:administrator', ['only' => [
            
        ]]);
        
    }
}



