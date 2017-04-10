<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Corporate;
use App\Car;
use App\Cargroup;
use App\Carsale;
use App\Carcomment;
use App\Cartail;
use App\Carsaleoffer;
use App\Carsalereserve;
use App\Carrent;
use App\Carrentoffer;
use App\Carrentreserve;
use App\Carauction;
use App\Carauctionbid;
use App\Carauctionreserve;
use App\Cartender;
use App\Cartendertender;
use App\Cartenderreserve;
use App\Part;
use App\Partgroup;
use App\Partsale;
use App\Partcomment;
use App\Parttail;
use App\Partsaleoffer;
use App\Partsalereserve;
use App\Subscription;
use Auth;
use App\Carmakemodel;
use App\Corporateuser;

use Session;

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
     * Get all cars
     *
     * @return \Illuminate\Http\Response
     */
    public function carindex(Corporate $corporate)
    {

        // Sales panel
        $countcarsonsale = Car::where('corporate_id', $corporate->id)->where('status', 'sale')->where('published', 1)->count();
        $countcarsonsalereserve = Car::where('corporate_id', $corporate->id)->where('status', 'salereserve')->count();
        $carsalegroups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'sale')->where('published', 1)->get();

        // Rent panel
        $countcarsonrent = Car::where('corporate_id', $corporate->id)->where('status', 'rent')->count();
        $countcarsonrentreserve = Car::where('corporate_id', $corporate->id)->where('status', 'rentreserve')->count();
        $carrentgroups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'rent')->where('published', 1)->get();

        // Auction panel
        $countcarsonauction = Car::where('corporate_id', $corporate->id)->where('status', 'auction')->count();
        $carauctiongroups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'auction')->where('published', 1)->get();

        // Tender panel
        $countcarsontender = Car::where('corporate_id', $corporate->id)->where('status', 'tender')->count();
        $cartendergroups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'tender')->where('published', 1)->get();

        // Messages and Notifications goes here

        return view('corp.cars', [
            'corporate' => $corporate,
            'countcarsonsale' => $countcarsonsale,
            'countcarsonsalereserve' => $countcarsonsalereserve,
            'carsalegroups' => $carsalegroups,
            'countcarsonrent' => $countcarsonrent,
            'countcarsonrentreserve' => $countcarsonrentreserve,
            'carrentgroups' => $carrentgroups,
            'countcarsonauction' => $countcarsonauction,
            'carauctiongroups' => $carauctiongroups,
            'countcarsontender' => $countcarsontender,
            'cartendergroups' => $cartendergroups,
        ]);  
    }

    /**
     * Get all car sales
     *
     * @return \Illuminate\Http\Response
     */
    public function sales(Corporate $corporate)
    {
        $carsales = Carsale::where('corporate_id', $corporate->id)->where('status', 'sale')->get();

        return view('corp.cars.sales.all', [
            'corporate' => $corporate,
            'carsales' => $carsales,
        ]);  
    }

    /**
     * Get single car sale
     *
     * @return \Illuminate\Http\Response
     */
    public function sale(Corporate $corporate, Carsale $carsale)
    {
        $carsalereserves = [];

        // Get the last offer. To be used by ajax to check for new offers that come in
        if ($carsale->reserves()) {
            Session::put('carsalereservescount', $carsale->reserves()->count());

            $reserves = Carsalereserve::where('carsale_id', $carsale->id)->get();
        }

        // Set initial carsale status
        Session::put('carsalestatus', $carsale->status);

        // Also set offers,comments and tails count for ajax checking
        Session::put('carsaleoffercount', $carsale->offers()->count());
        Session::put('carsalecommentcount', $carsale->car->comments()->count());
        Session::put('carsaletailcount', $carsale->car->tails()->count());

        Session::put('carsaleofferviewed', true);
        Session::put('carsalecommentviewed', false);
        Session::put('carsaletailviewed', false);

        $offers = Carsaleoffer::where('carsale_id', $carsale->id)->orderBy('offer', 'desc')->get();

        return view('corp.cars.sales.salecar', [
            'corporate' => $corporate,
            'carsale' => $carsale,
            'reserves' => $reserves,
            'offers' => $offers
        ]);  
    }

    // /**
    //  * Get single car sale comments
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function salecomments(Corporate $corporate, Carsale $carsale)
    // {
    //     $comments = Carcomment::where('car_id', $carsale->car->id)->get();

    //     return view('corp.cars.sales.salecarcomment', [
    //         'corporate' => $corporate,
    //         'carsale' => $carsale,
    //         'comments' => $comments,
    //     ]);  
    // }

    // /**
    //  * Get single car sale comments
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function saletails(Corporate $corporate, Carsale $carsale)
    // {
    //     $tails = Cartail::where('car_id', $carsale->car->id)->get();

    //     return view('corp.cars.sales.salecartail', [
    //         'corporate' => $corporate,
    //         'carsale' => $carsale,
    //         'tails' => $tails,
    //     ]);  
    // }

    // /**
    //  * Get single car sale offers
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function saleoffers(Corporate $corporate, Carsale $carsale)
    // {
    //     $offers = Carsaleoffer::where('carsale_id', $carsale->id)->get();

    //     return view('corp.cars.sales.salecaroffer', [
    //         'corporate' => $corporate,
    //         'carsale' => $carsale,
    //         'offers' => $offers,
    //     ]);  
    // }

    // /**
    //  * Get single car sale reserves
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function salereserves(Corporate $corporate, Carsale $carsale)
    // {
    //     $reserves = Carsalereserve::where('carsale_id', $carsale->id)->get();

    //     return view('corp.cars.sales.reserves', [
    //         'corporate' => $corporate,
    //         'carsale' => $carsale,
    //         'reserves' => $reserves,
    //     ]);  
    // }

    /**
     * Get single car sale reserved
     *
     * @return \Illuminate\Http\Response
     */
    public function salereservedcar(Corporate $corporate, Carsale $carsale)
    {
        return view('corp.cars.sales.salecar', [
            'corporate' => $corporate,
            'carsale' => $carsale,
        ]);  
    }


    /**
     * Get car sales group
     *
     * @return \Illuminate\Http\Response
     */
    public function salegroups(Corporate $corporate)
    {
        $groups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'sale')->where('published', 1)->get();
        
        return view('corp.cars.sales.groups', [
            'corporate' => $corporate,
            'groups' => $groups,
        ]);  
    }

    /**
     * Get single car sales group
     *
     * @return \Illuminate\Http\Response
     */
    public function salegroup(Corporate $corporate, Cargroup $cargroup)
    {
        $carsales = Carsale::where('corporate_id', $corporate->id)->where('status', 'sale')->where('cargroup_id', $cargroup->id)->get();

        return view('corp.cars.sales.groupsgroup', [
            'corporate' => $corporate,
            'cargroup' => $cargroup,
            'carsales' => $carsales,
        ]);  
    }

    /**
     * Get single car sales group car
     *
     * @return \Illuminate\Http\Response
     */
    public function salegroupcar(Corporate $corporate, Cargroup $cargroup, Carsale $carsale)
    {
        return view('corp.cars.sales.salecar', [
            'corporate' => $corporate,
            'carsale' => $carsale,
        ]);  
    }














    /**
     * Get all car rents
     *
     * @return \Illuminate\Http\Response
     */
    public function rents(Corporate $corporate)
    {
        $carrents = Carrent::where('corporate_id', $corporate->id)->where('status', 'rent')->get();

        return view('corp.cars.rents.all', [
            'corporate' => $corporate,
            'carrents' => $carrents,
        ]);  
    }

    /**
     * Get single car rent
     *
     * @return \Illuminate\Http\Response
     */
    public function rent(Corporate $corporate, Carrent $carrent)
    {
        return view('corp.cars.rents.rentcar', [
            'corporate' => $corporate,
            'carrent' => $carrent,
        ]);  
    }

    /**
     * Get single car rent comments
     *
     * @return \Illuminate\Http\Response
     */
    public function rentcomments(Corporate $corporate, Carrent $carrent)
    {
        $comments = Carcomment::where('car_id', $carrent->car->id)->get();

        return view('corp.cars.rents.rentcarcomment', [
            'corporate' => $corporate,
            'carrent' => $carrent,
            'comments' => $comments,
        ]);  
    }

    /**
     * Get single car rent comments
     *
     * @return \Illuminate\Http\Response
     */
    public function renttails(Corporate $corporate, Carrent $carrent)
    {
        $tails = Cartail::where('car_id', $carrent->car->id)->get();

        return view('corp.cars.rents.rentcartail', [
            'corporate' => $corporate,
            'carrent' => $carrent,
            'tails' => $tails,
        ]);  
    }

    /**
     * Get single car rent offers
     *
     * @return \Illuminate\Http\Response
     */
    public function rentoffers(Corporate $corporate, Carrent $carrent)
    {
        $offers = Carrentoffer::where('carrent_id', $carrent->id)->get();

        return view('corp.cars.rents.rentcaroffer', [
            'corporate' => $corporate,
            'carrent' => $carrent,
            'offers' => $offers,
        ]);  
    }

    /**
     * Get single car rent reserves
     *
     * @return \Illuminate\Http\Response
     */
    public function rentreserves(Corporate $corporate, Carrent $carrent)
    {
        $reserves = Carrentreserve::where('carrent_id', $carrent->id)->get();

        return view('corp.cars.rents.reserves', [
            'corporate' => $corporate,
            'carrent' => $carrent,
            'reserves' => $reserves,
        ]);  
    }

    /**
     * Get single car rent reserved
     *
     * @return \Illuminate\Http\Response
     */
    public function rentreservedcar(Corporate $corporate, Carrent $carrent)
    {
        return view('corp.cars.rents.rentcar', [
            'corporate' => $corporate,
            'carrent' => $carrent,
        ]);  
    }

    /**
     * Get car rents group
     *
     * @return \Illuminate\Http\Response
     */
    public function rentgroups(Corporate $corporate)
    {
        $groups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'rent')->where('published', 1)->get();
        
        return view('corp.cars.rents.groups', [
            'corporate' => $corporate,
            'groups' => $groups,
        ]);  
    }

    /**
     * Get single car rents group
     *
     * @return \Illuminate\Http\Response
     */
    public function rentgroup(Corporate $corporate, Cargroup $cargroup)
    {
        $carrents = Carrent::where('corporate_id', $corporate->id)->where('status', 'rent')->where('cargroup_id', $cargroup->id)->get();

        return view('corp.cars.rents.groupsgroup', [
            'corporate' => $corporate,
            'cargroup' => $cargroup,
            'carrents' => $carrents,
        ]);  
    }

    /**
     * Get single car rents group car
     *
     * @return \Illuminate\Http\Response
     */
    public function rentgroupcar(Corporate $corporate, Cargroup $cargroup, Carrent $carrent)
    {
        return view('corp.cars.rents.rentcar', [
            'corporate' => $corporate,
            'carrent' => $carrent,
            'cargroup' => $cargroup,
        ]);  
    }











    /**
     * Get all car auctions
     *
     * @return \Illuminate\Http\Response
     */
    public function auctions(Corporate $corporate)
    {
        $carauctions = Carauction::where('corporate_id', $corporate->id)->where('status', 'auction')->get();

        return view('corp.cars.auctions.all', [
            'corporate' => $corporate,
            'carauctions' => $carauctions,
        ]);  
    }

    /**
     * Get single car auction
     *
     * @return \Illuminate\Http\Response
     */
    public function auction(Corporate $corporate, Carauction $carauction)
    {
        return view('corp.cars.auctions.auctioncar', [
            'corporate' => $corporate,
            'carauction' => $carauction,
        ]);  
    }

    /**
     * Get single car auction comments
     *
     * @return \Illuminate\Http\Response
     */
    public function auctioncomments(Corporate $corporate, Carauction $carauction)
    {
        $comments = Carcomment::where('car_id', $carauction->car->id)->get();

        return view('corp.cars.auctions.auctioncarcomment', [
            'corporate' => $corporate,
            'carauction' => $carauction,
            'comments' => $comments,
        ]);  
    }

    /**
     * Get single car auction comments
     *
     * @return \Illuminate\Http\Response
     */
    public function auctiontails(Corporate $corporate, Carauction $carauction)
    {
        $tails = Cartail::where('car_id', $carauction->car->id)->get();

        return view('corp.cars.auctions.auctioncartail', [
            'corporate' => $corporate,
            'carauction' => $carauction,
            'tails' => $tails,
        ]);  
    }

    /**
     * Get single car auction bids
     *
     * @return \Illuminate\Http\Response
     */
    public function auctionbids(Corporate $corporate, Carauction $carauction)
    {
        $bids = Carauctionbid::where('carauction_id', $carauction->id)->get();

        return view('corp.cars.auctions.auctioncarbid', [
            'corporate' => $corporate,
            'carauction' => $carauction,
            'bids' => $bids,
        ]);  
    }

    /**
     * Get single car auction reserves
     *
     * @return \Illuminate\Http\Response
     */
    public function auctionreserves(Corporate $corporate, Carauction $carauction)
    {
        $reserves = Carauctionreserve::where('carauction_id', $carauction->id)->get();

        return view('corp.cars.auctions.reserves', [
            'corporate' => $corporate,
            'carauction' => $carauction,
            'reserves' => $reserves,
        ]);  
    }

    /**
     * Get single car auction reserved
     *
     * @return \Illuminate\Http\Response
     */
    public function auctionreservedcar(Corporate $corporate, Carauction $carauction)
    {
        return view('corp.cars.auctions.auctioncar', [
            'corporate' => $corporate,
            'carauction' => $carauction,
        ]);  
    }

    /**
     * Get car auctions group
     *
     * @return \Illuminate\Http\Response
     */
    public function auctiongroups(Corporate $corporate)
    {
        $groups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'auction')->where('published', 1)->get();
        
        return view('corp.cars.auctions.groups', [
            'corporate' => $corporate,
            'groups' => $groups,
        ]);  
    }

    /**
     * Get single car auctions group
     *
     * @return \Illuminate\Http\Response
     */
    public function auctiongroup(Corporate $corporate, Cargroup $cargroup)
    {
        $carauctions = Carauction::where('corporate_id', $corporate->id)->where('status', 'auction')->where('cargroup_id', $cargroup->id)->get();

        return view('corp.cars.auctions.groupsgroup', [
            'corporate' => $corporate,
            'cargroup' => $cargroup,
            'carauctions' => $carauctions,
        ]);  
    }

    /**
     * Get single car auctions group car
     *
     * @return \Illuminate\Http\Response
     */
    public function auctiongroupcar(Corporate $corporate, Cargroup $cargroup, Carauction $carauction)
    {
        return view('corp.cars.auctions.auctioncar', [
            'corporate' => $corporate,
            'carauction' => $carauction,
        ]);  
    }








    /**
     * Get all car tenders
     *
     * @return \Illuminate\Http\Response
     */
    public function tenders(Corporate $corporate)
    {
        $cartenders = Cartender::where('corporate_id', $corporate->id)->where('status', 'tender')->get();

        return view('corp.cars.tenders.all', [
            'corporate' => $corporate,
            'cartenders' => $cartenders,
        ]);  
    }

    /**
     * Get single car tender
     *
     * @return \Illuminate\Http\Response
     */
    public function tender(Corporate $corporate, Cartender $cartender)
    {
        return view('corp.cars.tenders.tendercar', [
            'corporate' => $corporate,
            'cartender' => $cartender,
        ]);  
    }

    /**
     * Get single car tender comments
     *
     * @return \Illuminate\Http\Response
     */
    public function tendercomments(Corporate $corporate, Cartender $cartender)
    {
        $comments = Carcomment::where('car_id', $cartender->car->id)->get();

        return view('corp.cars.tenders.tendercarcomment', [
            'corporate' => $corporate,
            'cartender' => $cartender,
            'comments' => $comments,
        ]);  
    }

    /**
     * Get single car tender comments
     *
     * @return \Illuminate\Http\Response
     */
    public function tendertails(Corporate $corporate, Cartender $cartender)
    {
        $tails = Cartail::where('car_id', $cartender->car->id)->get();

        return view('corp.cars.tenders.tendercartail', [
            'corporate' => $corporate,
            'cartender' => $cartender,
            'tails' => $tails,
        ]);  
    }

    // /**
    //  * Get single car tender tenders. ONLY SALES AND ADMIN WILL SEE ALL SUBMITTED TENDERS
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function tendertenders(Corporate $corporate, Cartender $cartender)
    // {
    //     $tenders = Cartendertender::where('cartender_id', $cartender->id)->get();

    //     return view('corp.cars.tenders.tendercartender', [
    //         'corporate' => $corporate,
    //         'cartender' => $cartender,
    //         'tenders' => $tenders,
    //     ]);  
    // }

    /**
     * Get single car tender reserves
     *
     * @return \Illuminate\Http\Response
     */
    public function tenderreserves(Corporate $corporate, Cartender $cartender)
    {
        $reserves = Cartenderreserve::where('cartender_id', $cartender->id)->get();

        return view('corp.cars.tenders.reserves', [
            'corporate' => $corporate,
            'cartender' => $cartender,
            'reserves' => $reserves,
        ]);  
    }

    /**
     * Get single car tender reserved
     *
     * @return \Illuminate\Http\Response
     */
    public function tenderreservedcar(Corporate $corporate, Cartender $cartender)
    {
        return view('corp.cars.tenders.tendercar', [
            'corporate' => $corporate,
            'cartender' => $cartender,
        ]);  
    }

    /**
     * Get car tenders group
     *
     * @return \Illuminate\Http\Response
     */
    public function tendergroups(Corporate $corporate)
    {
        $groups = Cargroup::where('corporate_id', $corporate->id)->where('type', 'tender')->where('published', 1)->get();
        
        return view('corp.cars.tenders.groups', [
            'corporate' => $corporate,
            'groups' => $groups,
        ]);  
    }

    /**
     * Get single car tenders group
     *
     * @return \Illuminate\Http\Response
     */
    public function tendergroup(Corporate $corporate, Cargroup $cargroup)
    {
        $cartenders = Cartender::where('corporate_id', $corporate->id)->where('status', 'tender')->where('cargroup_id', $cargroup->id)->get();

        return view('corp.cars.tenders.groupsgroup', [
            'corporate' => $corporate,
            'cargroup' => $cargroup,
            'cartenders' => $cartenders,
        ]);  
    }

    /**
     * Get single car tenders group car
     *
     * @return \Illuminate\Http\Response
     */
    public function tendergroupcar(Corporate $corporate, Cargroup $cargroup, Cartender $cartender)
    {
        return view('corp.cars.tenders.tendercar', [
            'corporate' => $corporate,
            'cartender' => $cartender,
        ]);  
    }









    /**
     * Get all parts
     *
     * @return \Illuminate\Http\Response
     */
    public function partindex(Corporate $corporate)
    {

        // Sales panel
        $countpartsonsale = Part::where('corporate_id', $corporate->id)->where('status', 'sale')->where('published', 1)->count();
        $countpartsonsalereserve = Part::where('corporate_id', $corporate->id)->where('status', 'salereserve')->count();
        $partsalegroups = Partgroup::where('corporate_id', $corporate->id)->where('published', 1)->get();

        // Messages and Notifications goes here

        return view('corp.parts', [
            'corporate' => $corporate,
            'countpartsonsale' => $countpartsonsale,
            'countpartsonsalereserve' => $countpartsonsalereserve,
            'partsalegroups' => $partsalegroups,
        ]);  
    }

    /**
     * Get all part sales
     *
     * @return \Illuminate\Http\Response
     */
    public function partsales(Corporate $corporate)
    {
        $partsales = Partsale::where('corporate_id', $corporate->id)->where('status', 'sale')->get();

        return view('corp.parts.sales.all', [
            'corporate' => $corporate,
            'partsales' => $partsales,
        ]);  
    }

    /**
     * Get single part sale
     *
     * @return \Illuminate\Http\Response
     */
    public function partsale(Corporate $corporate, Partsale $partsale)
    {
        return view('corp.parts.sales.salepart', [
            'corporate' => $corporate,
            'partsale' => $partsale,
        ]);  
    }

    /**
     * Get single part sale comments
     *
     * @return \Illuminate\Http\Response
     */
    public function partsalecomments(Corporate $corporate, Partsale $partsale)
    {
        $comments = Partcomment::where('part_id', $partsale->part->id)->get();

        return view('corp.parts.sales.salepartcomment', [
            'corporate' => $corporate,
            'partsale' => $partsale,
            'comments' => $comments,
        ]);  
    }

    /**
     * Get single part sale comments
     *
     * @return \Illuminate\Http\Response
     */
    public function partsaletails(Corporate $corporate, Partsale $partsale)
    {
        $tails = Parttail::where('part_id', $partsale->part->id)->get();

        return view('corp.parts.sales.saleparttail', [
            'corporate' => $corporate,
            'partsale' => $partsale,
            'tails' => $tails,
        ]);  
    }

    /**
     * Get single part sale offers
     *
     * @return \Illuminate\Http\Response
     */
    public function partsaleoffers(Corporate $corporate, Partsale $partsale)
    {
        $offers = Partsaleoffer::where('partsale_id', $partsale->id)->get();

        return view('corp.parts.sales.salepartoffer', [
            'corporate' => $corporate,
            'partsale' => $partsale,
            'offers' => $offers,
        ]);  
    }

    /**
     * Get single part sale reserves
     *
     * @return \Illuminate\Http\Response
     */
    public function partsalereserves(Corporate $corporate, Partsale $partsale)
    {
        $reserves = Partsalereserve::where('partsale_id', $partsale->id)->get();

        return view('corp.parts.sales.reserves', [
            'corporate' => $corporate,
            'partsale' => $partsale,
            'reserves' => $reserves,
        ]);  
    }

    /**
     * Get single part sale reserved
     *
     * @return \Illuminate\Http\Response
     */
    public function partsalereservedpart(Corporate $corporate, Partsale $partsale)
    {
        return view('corp.parts.sales.salepart', [
            'corporate' => $corporate,
            'partsale' => $partsale,
        ]);  
    }


    /**
     * Get part sales group
     *
     * @return \Illuminate\Http\Response
     */
    public function partsalegroups(Corporate $corporate)
    {
        $groups = Partgroup::where('corporate_id', $corporate->id)->where('published', 1)->get();
        
        return view('corp.parts.sales.groups', [
            'corporate' => $corporate,
            'groups' => $groups,
        ]);  
    }

    /**
     * Get single part sales group
     *
     * @return \Illuminate\Http\Response
     */
    public function partsalegroup(Corporate $corporate, Partgroup $partgroup)
    {
        $partsales = Partsale::where('corporate_id', $corporate->id)->where('status', 'sale')->where('partgroup_id', $partgroup->id)->get();
        
        return view('corp.parts.sales.groupsgroup', [
            'corporate' => $corporate,
            'partgroup' => $partgroup,
            'partsales' => $partsales,
        ]);  
    }

    /**
     * Get single part sales group part
     *
     * @return \Illuminate\Http\Response
     */
    public function partsalegrouppart(Corporate $corporate, Partgroup $partgroup, Partsale $partsale)
    {
        return view('corp.parts.sales.salepart', [
            'corporate' => $corporate,
            'partsale' => $partsale,
        ]);  
    }


    /**
     * Show the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadcarmodels(Request $request)
    {
        $carmodels = Carmakemodel::where('make', $request->make)->groupBy('model')->pluck('model')->toArray();

        return response()->json($carmodels);
    }

    /**
     * Ajax update carsale page.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxupdatecarsale(Corporate $corporate, Carsale $carsale)
    {
        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            return redirect()->back();
        }

        // check to see if carsale status is purchased
        if ($carsale->status == 'purchased') {
            return redirect()->back();
        }

        $nothing_to_update = true;
        $corporate_user = true;
        $has_role_sales_or_admin = false;
        $response_array = [];
        $temparray = [];
        $temparray2 = [];
        $carsalereservescount = $carsale->reserves()->count();

        // check to see if anything to update
        if ($carsalereservescount > 0) {
            if (Session::has('carsalereservescount')) {
                $carsalereservescount_session = Session::get('carsalereservescount');
                if ($carsalereservescount_session != $carsalereservescount) {
                    Session::put('carsalereservescount', $carsalereservescount);
                    $nothing_to_update = false;
                }
            } else {
                Session::put('carsalereservescount', $carsalereservescount);
                $nothing_to_update = false;
            }
        }

        // check carsale status change
        if (Session::has('carsalestatus')) {
            $carsalestatus_session = Session::get('carsalestatus');
            if ($carsalestatus_session != $carsale->status) {
                Session::put('carsalestatus', $carsale->status);
                $nothing_to_update = false;
            }
        }

        // check offers
        if (Session::has('carsaleoffercount')) {
            $carsaleoffercount_session = Session::get('carsaleoffercount');
            if ($carsaleoffercount_session != $carsale->offers()->count()) {
                Session::put('carsaleoffercount', $carsale->offers()->count());
                $nothing_to_update = false;
            }
        }

        // check comments
        if (Session::has('carsalecommentcount')) {
            $carsalecommentcount_session = Session::get('carsalecommentcount');
            if ($carsalecommentcount_session != $carsale->car->comments()->count()) {
                Session::put('carsalecommentcount', $carsale->car->comments()->count());
                $nothing_to_update = false;
            }
        }

        // check tails
        if (Session::has('carsaletailcount')) {
            $carsaletailcount_session = Session::get('carsaletailcount');
            if ($carsaletailcount_session != $carsale->car->tails()->count()) {
                Session::put('carsaletailcount', $carsale->car->tails()->count());
                $nothing_to_update = false;
            }
        }

        if ($nothing_to_update == false) {
            // Check if Corp User
            $corp_user_count = 0;
            $corp_user_count = Corporateuser::where('corporate_id', $corporate->id)->where('user_id', Auth::user()->id)->count();
            if ($corp_user_count == 0) {
                $corporate_user = false;
            }

            // Check if has role sales or administrator
            if (Auth::user()->is('sales') || Auth::user()->is('administrator')) {
                $has_role_sales_or_admin = true;
            }

            // Get car reserves if only corpuser and sales or admin role
            if ($carsale->status == 'reserved' && $corporate_user == true && $has_role_sales_or_admin == true) {
                
                $carsalereserves = $carsale->reserves();

                $reserves = Carsalereserve::where('carsale_id', $carsale->id)->get();

                foreach ($reserves as $reserve) {
                    $temparray[] = array(
                        'reserve_id' => $reserve->id,
                        'reserve_carsale_offer_user_url' => url('/user/'.$reserve->carsaleoffer->user->id),
                        'reserve_carsale_offer_user_name' => $reserve->carsaleoffer->user->name,
                        'reserve_carsale_offer_user_propic' => $reserve->carsaleoffer->user->propic,
                        'reserve_carsale_offer_user_id' => $reserve->carsaleoffer->user->id,
                        'reserve_carsale_offer' => number_format($reserve->carsaleoffer->offer, 2, '.', ','),
                        'reserve_created_at' => $reserve->created_at->format('d/m/Y')
                    );
                }

                $temparray2 = array('carsale_reserves'=>$temparray);
                
                $response_array = array_merge($response_array, $temparray2);
            }

            $temparray = array('carsale_status'=>$carsale->status);
            $response_array = array_merge($response_array, $temparray);

            $temparray = array('carsale_reserves_count'=>$carsalereservescount);
            $response_array = array_merge($response_array, $temparray);

            $temparray = array('corporate_user' => $corporate_user);
            $response_array = array_merge($response_array, $temparray);

            $temparray = array('has_role_sales_or_admin' => $has_role_sales_or_admin);
            $response_array = array_merge($response_array, $temparray);

            $temparray = array('carsale_comment_count' => $carsale->car->comments()->count());
            $response_array = array_merge($response_array, $temparray);

            $temparray = array('carsale_offer_count' => $carsale->offers()->count());
            $response_array = array_merge($response_array, $temparray);

            $temparray = array('carsale_tail_count' => $carsale->car->tails()->count());
            $response_array = array_merge($response_array, $temparray);

        }

        return response()->json($response_array);
    }

    /**
     * Ajax get carsale offers.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxgetcarsaleoffers(Request $request, Corporate $corporate, Carsale $carsale)
    {
        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            return redirect()->back();
        }

        // check to see if carsale status is purchased
        if ($carsale->status == 'purchased') {
            return redirect()->back();
        }

        $nothing_to_update = true;
        $corporate_user = true;
        $has_role_sales_or_admin = false;
        $response_array = [];
        $temparray = [];
        $temparray2 = [];

        // check offers
        if (Session::has('carsaleoffercount')) {
            $carsaleoffercount_session = Session::get('carsaleoffercount');
            if ($carsaleoffercount_session != $carsale->offers()->count()) {
                Session::put('carsaleoffercount', $carsale->offers()->count());
                $nothing_to_update = false;
            }
        }

        if ($carsale->status == 'purchased') {
            $nothing_to_update = true;
        }

        if ($nothing_to_update == false || $request->forceit == 'true') {
            $sort_column = "offer";
            $sort_order = "desc";

            if ($request->sort == 'hof') {
                $sort_column = "offer";
                $sort_order = "desc";
            } else if ($request->sort == 'lof') {
                $sort_column = "offer";
                $sort_order = "asc";
            } else if ($request->sort == 'nof') {
                $sort_column = "created_at";
                $sort_order = "desc";
            } else if ($request->sort == 'oof') {
                $sort_column = "created_at";
                $sort_order = "asc";
            }

            $offers = Carsaleoffer::where('carsale_id', $carsale->id)->orderBy($sort_column, $sort_order)->get();

            // Check if Corp User
            $corp_user_count = 0;
            $corp_user_count = Corporateuser::where('corporate_id', $corporate->id)->where('user_id', Auth::user()->id)->count();
            if ($corp_user_count == 0) {
                $corporate_user = false;
            }

            // Check if has role sales or administrator
            if (Auth::user()->is('sales') || Auth::user()->is('administrator')) {
                $has_role_sales_or_admin = true;
            }

            $offer_user_propic = '';

            foreach ($offers as $offer) {

                if ($offer->user_propic) {
                    $offer_user_propic = $offer->user_propic;
                }

                $temparray[] = array(
                    'offer_id' => $offer->id,
                    'offer_offer' => number_format($offer->offer, 2, '.', ','),
                    'offer_created_at' => $offer->created_at->diffForHumans(),
                    'offer_user_id' => $offer->user->id,
                    'offer_user_url' => url('/user/'.$offer->user->id),
                    'offer_user_name' => $offer->user->name,
                    'offer_user_propic' => $offer->user->propic,
                    
                );
            }

            $response_array = array('offers' => $temparray);

            $temparray = array(
                'offer_reserves_count' => $carsale->reserves()->count(),
                'corporate_user' => $corporate_user,
                'has_role_sales_or_admin' => $has_role_sales_or_admin,
            );

            $response_array = array_merge($response_array, $temparray);
        } else {
            // to stop the javascript error
            $response_array = array('offers'=>$response_array);
        }

        return response()->json($response_array);
    }

    /**
     * Ajax get carsale comments.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxgetcarsalecomments(Corporate $corporate, Carsale $carsale)
    {
        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            return redirect()->back();
        }

        // check to see if carsale status is purchased
        if ($carsale->status == 'purchased') {
            return redirect()->back();
        }

        $nothing_to_update = true;
        $response_array = [];
        $temparray = [];
        $temparray2 = [];

        // check comments
        if (Session::has('carsalecommentcount')) {
            $carsalecommentcount_session = Session::get('carsalecommentcount');
            if (($carsalecommentcount_session != $carsale->car->comments()->count()) || (Session::get('carsalecommentviewed') == false)) {
                Session::put('carsalecommentcount', $carsale->car->comments()->count());
                $nothing_to_update = false;

                if (Session::get('carsalecommentviewed') == false) {
                    Session::put('carsalecommentviewed', true);
                }
            }
        }

        if ($nothing_to_update == false) {

            $comments = Carcomment::where('car_id', $carsale->car->id)->orderBy('created_at', 'desc')->get();

            $comment_user_propic = '';

            foreach ($comments as $comment) {

                if ($comment->user_propic) {
                    $comment_user_propic = $comment->user_propic;
                }

                $response_array[] = array(
                    'comment_comment' => $comment->comment,
                    'comment_created_at' => $comment->created_at->diffForHumans(),
                    'comment_user_id' => $comment->user->id,
                    'comment_user_url' => url('/user/'.$comment->user->id),
                    'comment_user_name' => $comment->user->name,
                    'comment_user_propic' => $comment->user->propic,
                );
            }
        }

        return response()->json($response_array);
    }

    /**
     * Ajax get carsale tails.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxgetcarsaletails(Corporate $corporate, Carsale $carsale)
    {
        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            return redirect()->back();
        }

        // check to see if carsale status is purchased
        if ($carsale->status == 'purchased') {
            return redirect()->back();
        }

        $nothing_to_update = true;
        $response_array = [];
        $temparray = [];
        $temparray2 = [];

        // check tails
        if (Session::has('carsaletailcount')) {
            $carsaletailcount_session = Session::get('carsaletailcount');
            if (($carsaletailcount_session != $carsale->car->tails()->count()) || (Session::get('carsaletailviewed') == false)) {
                Session::put('carsaletailcount', $carsale->car->tails()->count());
                $nothing_to_update = false;

                if (Session::get('carsaletailviewed') == false) {
                    Session::put('carsaletailviewed', true);
                }
            }
        }

        if ($nothing_to_update == false) {

            $tails = Cartail::where('car_id', $carsale->car->id)->orderBy('created_at', 'desc')->get();

            $tail_user_propic = '';

            foreach ($tails as $tail) {

                if ($tail->user_propic) {
                    $tail_user_propic = $tail->user_propic;
                }

                $response_array[] = array(
                    'tail_created_at' => $tail->created_at->diffForHumans(),
                    'tail_user_id' => $tail->user->id,
                    'tail_user_url' => url('/user/'.$tail->user->id),
                    'tail_user_name' => $tail->user->name,
                    'tail_user_propic' => $tail->user->propic,
                );
            }
        }

        return response()->json($response_array);
    }

    /**
     * Submit offer from user
     *
     * @param  Request $request
     * @return Response 
     */
    public function ajaxcreatecarsaleoffer(Request $request, Corporate $corporate, Carsale $carsale)
    {
        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            return redirect()->back();
        }

        // check to see if carsale status is purchased
        if ($carsale->status == 'purchased') {
            return redirect()->back();
        }

        $this->validate($request, [
            'offer' => 'required|numeric',
        ]);

        $response_array = [];
        $temparray = [];

        // check to see if carsale status is sale
        if ($carsale->status != 'sale') {
            $temparray = array('success' => false, 'errormessage' => 'Car is not on sale.');
            return response()->json($temparray);
        }

        // check to see if carsale is non negotiable
        if ($carsale->negotiable == false) {
            if ($request->offer != $carsale->offer) {
                $temparray = array('success' => false, 'errormessage' => 'Car selling price is not negotiable. Please offer the asking amount.');
                return response()->json($temparray);
            }
        }

        // create new carsale offer
        $carsaleoffer = new Carsaleoffer;
        $carsaleoffer->carsale_id = $carsale->id;
        $carsaleoffer->user_id = Auth::user()->id;
        $carsaleoffer->offer = $request->offer;
        $carsaleoffer->save();

        $temparray = array('success' => true);
        return response()->json($temparray);

    }

}

















