<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GuestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the sales page.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales()
    {
        return view('sales');
    }

    /**
     * Show the rentals page.
     *
     * @return \Illuminate\Http\Response
     */
    public function rents()
    {
        return view('rents');
    }

    /**
     * Show the auctions page.
     *
     * @return \Illuminate\Http\Response
     */
    public function auctions()
    {
        return view('auctions');
    }

    /**
     * Show the tenders page.
     *
     * @return \Illuminate\Http\Response
     */
    public function tenders()
    {
        return view('tenders');
    }

    /**
     * Show the parts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function parts()
    {
        return view('parts');
    }
}
