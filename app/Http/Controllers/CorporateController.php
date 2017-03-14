<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Corporate;
use App\Subscription;
use App\Car;
use App\Cargroup;
use App\Carauction;
use App\Carrent;
use App\Carsale;
use App\Carsaleoffer;
use App\Carsalereserve;
use App\Carsalepurchase;
use App\Cartender;
use App\Carmakemodel;
use App\Carimage;
use App\Part;
use App\Partimage;

use Carbon\Carbon;
use Session;
use File;

class CorporateController extends Controller
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
            'carcreate',
            'carstore',
            'caredit',
            'carupdate',
            'cardelete',
            'caruploadtempimage',
            'cardeletetempimage',
            'caruploadimage',
            'cardeleteimage',
            'partcreate',
            'partstore',
            'partedit',
            'partupdate',
            'partdelete',
            'partuploadtempimage',
            'partdeletetempimage',
            'partuploadimage',
            'partdeleteimage',
        ]]);
        

        $this->middleware('role:sales|administrator', ['only' => [
            'carsalecreate',
            'carsalestore',
            'carsalepurchase',
            'carsalereservedelete',
            'ajaxacceptcarsaleoffer',
        ]]);
        

        $this->middleware('role:management|administrator', ['only' => [
            'settings', 
        ]]);
        

        $this->middleware('role:administrator', ['only' => [
            'account',
        ]]);
        
    }


    // ===================================================================================
    // 
    // 
    //     PARTS
    // 
    // 
    // ===================================================================================


    /**
     * Show all cars.
     *
     * @return \Illuminate\Http\Response
     */
    public function allcars(Corporate $corporate)
    {
        $cars = Car::where('corporate_id', $corporate->id)->get();
        $total_count = count($cars);

        return view('corp.cars.all', [
            'corporate' => $corporate,
            'cars' => $cars,
            'total_count' => $total_count,
        ]); 
    }

    /**
     * Show one car.
     *
     * @return \Illuminate\Http\Response
     */
    public function car(Corporate $corporate, Car $car)
    {
        $carimages = Carimage::where('car_id', $car->id)->get();

        return view('corp.cars.car', [
            'corporate' => $corporate,
            'car' => $car,
            'carimages' => $carimages,
        ]); 
    }

    /**
     * Get create car form
     *
     * @return \Illuminate\Http\Response
     */
    public function carcreate(Corporate $corporate)
    {
        $carlimitreached = false;

        $carsaletotal = Carsale::where('corporate_id', $corporate->id)->where('status', 'sale')->count();
        $carrenttotal = Carrent::where('corporate_id', $corporate->id)->where('status', 'rent')->count();
        $carauctiontotal = Carauction::where('corporate_id', $corporate->id)->where('status', 'auction')->count();
        $cartendertotal = Cartender::where('corporate_id', $corporate->id)->where('status', 'tender')->count();

        $totalcars = $carsaletotal + $carrenttotal + $carauctiontotal + $cartendertotal;

        $subscription = Subscription::where('id', $corporate->subscription_id)->first();

        if ($totalcars >= $subscription->carsallowed)
        {
            $carlimitreached = true;
        }

        // delete all car image upload sessions
        if (Session::has('car_image_upload_count')) {
            $session_count = (int)Session::pull('car_image_upload_count');
            for ($i = 1; $i <= $session_count; $i++) { 
                Session::forget($i.'car_image_url');
            }
        }

        // For the car make autocomplete field
        $carmakes = Carmakemodel::select('make')->groupBy('make')->pluck('make')->toArray();

        return view('corp.forms.createcar', [
            'corporate' => $corporate,
            'carlimitreached' => $carlimitreached,
            'subscription' => $subscription,
            'carmakes' => $carmakes,
        ]);  
    }

    /**
     * Add new car
     *
     * @param  Request $request
     * @return Response 
     */
    public function carstore(Request $request, Corporate $corporate)
    {
        if (!$request->session()->has('car_image_upload_count')) {
            return redirect()->back();
        }

        $parseddatebought = Carbon::createFromFormat('d/m/Y', $request->dateboughtat);

        $this->validate($request, [
            'plates' => 'required',
            'weight' => 'numeric',
            'make' => 'required',
            'model' => 'required',
            'webmenu' => 'required',
        ]);

        $car = new Car;

        $car->plates = $request->plates;
        $car->color = $request->color;
        $car->weight = $request->weight;
        $car->datebought = $parseddatebought;
        $car->make = $request->make;
        $car->model = $request->model;
        $car->bodytype = $request->webmenu;
        $car->corporate_id = $corporate->id;
        $car->note = $request->note;
        if ($request->published == 1)
        {
            $car->published = true;
            $car->status = 'published';
        }
        elseif ($request->published == 0)
        {
            $car->published = false;
            $car->status = 'unpublished';
        }
        
        $car->save();

        // Now save car images
        $car_image_upload_count = (int)$request->session()->pull('car_image_upload_count');
        $session_key_tail = 'car_image_url';

        for ($i = 1; $i <= $car_image_upload_count; $i++) { 
            $carimage = new Carimage;
            $carimage->car_id = $car->id;
            $carimage->img_url = $request->session()->pull($i.$session_key_tail);
            $carimage->thumb_img_url = '';
            $carimage->save();
        }
            
        return redirect('/corporate/'.$corporate->id.'/cars/car/'.$car->id.'/edit');
    }

    /**
     * Edit car.
     *
     * @return \Illuminate\Http\Response
     */
    public function caredit(Request $request, Corporate $corporate, Car $car)
    {
        $carmakes = Carmakemodel::select('make')->groupBy('make')->pluck('make')->toArray();

        // delete all car image upload sessions
        if (Session::has('car_image_upload_count')) {
            $session_count = (int)Session::pull('car_image_upload_count');
            for ($i = 1; $i <= $session_count; $i++) { 
                Session::forget($i.'car_image_url');
            }
        }

        $carimages = Carimage::where('car_id', $car->id)->get();

        $carimage_array = [];
        $carimage_name = '';
        $carimage_count = 1;
        $session_key_tail = 'car_image_url';

        foreach ($carimages as $carimage) {
            $carimage_name = substr($carimage->img_url, strrpos($carimage->img_url, '/') + 1);
            $carimage_array[] = array(
                'img_url' => $carimage->img_url,
                'filename' => $carimage_name,
                'img_count' => $carimage_count
            );

            $session_key = $carimage_count.$session_key_tail;
            $request->session()->put($session_key, $carimage->img_url);
            $request->session()->put('car_image_upload_count', $carimage_count);

            $carimage_name = '';
            $carimage_count++;
        }

        return view('corp.cars.caredit', [
            'corporate' => $corporate,
            'car' => $car,
            'carmakes' => $carmakes,
            'carimagearray' => $carimage_array,
        ]); 
    }

    /**
     * Update car
     *
     * @param  Request $request
     * @return Response 
     */
    public function carupdate(Request $request, Corporate $corporate, Car $car)
    {

        $parseddatebought = Carbon::createFromFormat('d/m/Y', $request->dateboughtat);

        $this->validate($request, [
            'plates' => 'required',
            'weight' => 'numeric',
            'make' => 'required',
            'model' => 'required',
            'webmenu' => 'required',
        ]);

        $car->plates = $request->plates;
        $car->color = $request->color;
        $car->weight = $request->weight;
        $car->datebought = $parseddatebought;
        $car->make = $request->make;
        $car->model = $request->model;
        $car->bodytype = $request->webmenu;
        $car->physicallocation = $request->physicallocation;
        $car->note = $request->note;
        if ($request->published == true)
        {
            $car->published = true;
            $car->status = 'published';
        }
        elseif ($request->published == false)
        {
            $car->published = false;
            $car->status = 'unpublished';
        }
        
        $car->save();

        return redirect()->back();
    }

    /**
     * Delete car
     *
     * @param  Request $request
     * @return Response 
     */
    public function cardelete(Request $request, Corporate $corporate, Car $car)
    {
        // Integrity checks

        $ownership = false;
        $carsale = false;
        $carrent = false;
        $carauction = false;
        $cartender = false;
        $carreports = false;

        if ($car->corporate->id == $corporate->id)
        {
            $ownership = true;
        }

        if ($car->sale)
        {
            $carsale = true;
        }
        if ($car->rent)
        {
            $carrent = true;
        }
        if ($car->auction)
        {
            $carauction = true;
        }
        if ($car->tender)
        {
            $cartender = true;
        }
        if ($car->reports)
        {
            $carreports = true;
        }

        if ($ownership == true && $carsale == false && $carrent == false && $carauction == false && $cartender == false && $carreports == false) 
        {
            if ($car->comments)
            {
                $car->comments()->delete();
            }
            if ($car->likes)
            {
                $car->likes()->delete();
            }
            if ($car->tails)
            {
                $car->tails()->delete();
            }
            if ($car->images)
            {
                $car->images()->delete();
            }

            $car->delete();
        } 
        else
        {
            $message = '';

            if ($ownership == false) {
                Session::flash('ownermessage', 'You do not own this car! How did you get here? Stop being naughty.');
            }
            if ($carsale == true) {
                Session::flash('salemessage', 'This car has a sale record. You cannot delete a car that has a sale record.');
            } 
            if ($carrent == true) {
                Session::flash('rentmessage', 'This car has a rent record. You cannot delete a car that has a rent record.');
            }
            if ($carauction == true) {
                Session::flash('auctionmessage', 'This car has an auction record. You cannot delete a car that has an auction record.');
            }
            if ($cartender == true) {
                Session::flash('tendermessage', 'This car has a tender record. You cannot delete a car that has a tender record.');
            }
            if ($carreports == true) {
                Session::flash('reportsmessage', 'This car has report records. You cannot delete a car that has report records.');
            }

            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * Upload car temporary image (no database records inserted)
     *
     * @param  Request $request
     * @return Response 
     */
    public function caruploadtempimage(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $timestamp = Carbon::now()->format('YmdHis');

        $imageName = $corporate->id.$corporate->name.$timestamp.'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(base_path().'/public/imgs/corporate/'.$corporate->id.'/cars/', $imageName);

        $image_url = '/imgs/corporate/'.$corporate->id.'/cars/'.$imageName;
        $session_key_tail = 'car_image_url';

        if ($request->session()->has('car_image_upload_count')) {
            $car_image_upload_count = (int)$request->session()->get('car_image_upload_count');
        }
        else {
            $car_image_upload_count = 0;
        }

        $car_image_upload_count++;
        $session_key = $car_image_upload_count.$session_key_tail;

        $request->session()->put($session_key, $image_url);
        $request->session()->put('car_image_upload_count', $car_image_upload_count);

        return response()->json(
            ['img_url' => $image_url, 'filename' => $imageName, 'img_count' => $car_image_upload_count]
        );
    }

    /**
     * Delete car temp image (no database records inserted)
     *
     * @param  Request $request
     * @return Response 
     */
    public function cardeletetempimage(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'serverfilename' => 'required',
            'serverfileurl' => 'required',
            'serverfilecount' => 'required',
        ]);

        $success = true;
        $message = 'File successfully deleted.';

        $stringArray = preg_split("/[a-zA-Z]/",$request->serverfilename,1);
        $corporate_id = (int)$stringArray[0];

        if ($corporate->id == $corporate_id) {

            if ($request->session()->has('car_image_upload_count') && $request->session()->has($request->serverfilecount.'car_image_url')) {
                if (File::exists('../public'.$request->serverfileurl)) {
                    File::delete('../public'.$request->serverfileurl);

                    $request->session()->forget($request->serverfilecount.'car_image_url');
                    $car_image_count = (int)$request->session()->get('car_image_upload_count');
                    $car_image_count--;
                    $request->session()->put('car_image_upload_count', $car_image_count);
                } else {
                    $success = false;
                    $message = 'File doesn\'t exist buddy.';
                }
            } else {
                $success = false;
                $message = 'Oops, looks like there were some errors. Refresh the page and try again.';
            }
        } else {
            $success = false;
            $message = 'You do not own this image. Don\'t be naughty!';
        }


        return response()->json(
            ['success' => $success , 'message' => $message]
        );
    }

    /**
     * Upload car image (with database record inserted too)
     *
     * @param  Request $request
     * @return Response 
     */
    public function caruploadimage(Request $request, Corporate $corporate, Car $car)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $timestamp = Carbon::now()->format('YmdHis');

        $imageName = $corporate->id.$corporate->name.$timestamp.'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(base_path().'/public/imgs/corporate/'.$corporate->id.'/cars/', $imageName);

        $image_url = '/imgs/corporate/'.$corporate->id.'/cars/'.$imageName;
        $session_key_tail = 'car_image_url';

        if ($request->session()->has('car_image_upload_count')) {
            $car_image_upload_count = (int)$request->session()->get('car_image_upload_count');
        }
        else {
            $car_image_upload_count = 0;
        }

        $car_image_upload_count++;
        $session_key = $car_image_upload_count.$session_key_tail;

        $request->session()->put($session_key, $image_url);
        $request->session()->put('car_image_upload_count', $car_image_upload_count);

        // insert into database
        $carimage = new Carimage;
        $carimage->car_id = $car->id;
        $carimage->img_url = $image_url;
        $carimage->thumb_img_url = '';
        $carimage->save();

        return response()->json(
            ['img_url' => $image_url, 'filename' => $imageName, 'img_count' => $car_image_upload_count]
        );
    }

    /**
     * Delete car image (with database records delete too)
     *
     * @param  Request $request
     * @return Response 
     */
    public function cardeleteimage(Request $request, Corporate $corporate, Car $car)
    {
        $this->validate($request, [
            'serverfilename' => 'required',
            'serverfileurl' => 'required',
            'serverfilecount' => 'required',
        ]);

        $success = true;
        $message = 'File successfully deleted.';

        $stringArray = preg_split("/[a-zA-Z]/",$request->serverfilename,1);
        $corporate_id = (int)$stringArray[0];

        if ($corporate->id == $corporate_id) {

            if ($request->session()->has('car_image_upload_count') && $request->session()->has($request->serverfilecount.'car_image_url')) {
                if (File::exists('../public'.$request->serverfileurl)) {
                    File::delete('../public'.$request->serverfileurl);

                    $request->session()->forget($request->serverfilecount.'car_image_url');
                    $car_image_count = (int)$request->session()->get('car_image_upload_count');
                    $car_image_count--;
                    $request->session()->put('car_image_upload_count', $car_image_count);

                    $carimage = Carimage::where('car_id', $car->id)->where('img_url', $request->serverfileurl)->get()->first();
                    $carimage->delete();
                } else {
                    $success = false;
                    $message = 'File doesn\'t exist buddy.';
                }
            } else {
                $success = false;
                $message = 'Oops, looks like there were some errors. Refresh the page and try again.';
            }
        } else {
            $success = false;
            $message = 'You do not own this image. Don\'t be naughty!';
        }


        return response()->json(
            ['success' => $success , 'message' => $message]
        );
    }



    // ===================================================================================
    // 
    // 
    //     PARTS
    // 
    // 
    // ===================================================================================



    /**
     * Show all parts.
     *
     * @return \Illuminate\Http\Response
     */
    public function allparts(Corporate $corporate)
    {
        $parts = Part::where('corporate_id', $corporate->id)->get();
        $total_count = count($parts);

        return view('corp.parts.all', [
            'corporate' => $corporate,
            'parts' => $parts,
            'total_count' => $total_count,
        ]); 
    }

    /**
     * Show one part.
     *
     * @return \Illuminate\Http\Response
     */
    public function part(Corporate $corporate, Part $part)
    {
        $partimages = Partimage::where('part_id', $part->id)->get();

        return view('corp.parts.part', [
            'corporate' => $corporate,
            'part' => $part,
            'partimages' => $partimages,
        ]); 
    }

    /**
     * Get create part form
     *
     * @return \Illuminate\Http\Response
     */
    public function partcreate(Corporate $corporate)
    {
        // delete all part image upload sessions
        if (Session::has('part_image_upload_count')) {
            $session_count = (int)Session::pull('part_image_upload_count');
            for ($i = 1; $i <= $session_count; $i++) { 
                Session::forget($i.'part_image_url');
            }
        }

        return view('corp.forms.createpart', [
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Add new part
     *
     * @param  Request $request
     * @return Response 
     */
    public function partstore(Request $request, Corporate $corporate)
    {
        if (!$request->session()->has('part_image_upload_count')) {
            return redirect()->back();
        }

        $this->validate($request, [
            'name' => 'required',
        ]);

        $part = new Part;

        $part->name = $request->name;
        $part->serialnumber = $request->serialnumber;
        $part->descript = $request->descript;
        $part->corporate_id = $corporate->id;
        $part->note = $request->note;
        if ($request->published == 1)
        {
            $part->published = true;
            $part->status = 'published';
        }
        elseif ($request->published == 0)
        {
            $part->published = false;
            $part->status = 'unpublished';
        }
        
        $part->save();

        return redirect()->back();
    }

    /**
     * Edit part.
     *
     * @return \Illuminate\Http\Response
     */
    public function partedit(Request $request, Corporate $corporate, Part $part)
    {
        // delete all part image upload sessions
        if (Session::has('part_image_upload_count')) {
            $session_count = (int)Session::pull('part_image_upload_count');
            for ($i = 1; $i <= $session_count; $i++) { 
                Session::forget($i.'part_image_url');
            }
        }

        $partimages = Partimage::where('part_id', $part->id)->get();

        $partimage_array = [];
        $partimage_name = '';
        $partimage_count = 1;
        $session_key_tail = 'part_image_url';

        foreach ($partimages as $partimage) {
            $partimage_name = substr($partimage->img_url, strrpos($partimage->img_url, '/') + 1);
            $partimage_array[] = array(
                'img_url' => $partimage->img_url,
                'filename' => $partimage_name,
                'img_count' => $partimage_count
            );

            $session_key = $partimage_count.$session_key_tail;
            $request->session()->put($session_key, $partimage->img_url);
            $request->session()->put('part_image_upload_count', $partimage_count);

            $partimage_name = '';
            $partimage_count++;
        }

        return view('corp.parts.partedit', [
            'corporate' => $corporate,
            'part' => $part,
            'partimagearray' => $partimage_array,
        ]); 
    }

    /**
     * Update part
     *
     * @param  Request $request
     * @return Response 
     */
    public function partupdate(Request $request, Corporate $corporate, Part $part)
    {

        $this->validate($request, [
            'name' => 'required',
        ]);

        $part->name = $request->name;
        $part->serialnumber = $request->serialnumber;
        $part->descript = $request->descript;
        $part->physicallocation = $request->physicallocation;
        $part->note = $request->note;
        if ($request->published == true)
        {
            $part->published = true;
            $part->status = 'published';
        }
        elseif ($request->published == false)
        {
            $part->published = false;
            $part->status = 'unpublished';
        }
        
        $part->save();

        return redirect()->back();
    }

    /**
     * Delete part
     *
     * @param  Request $request
     * @return Response 
     */
    public function partdelete(Request $request, Corporate $corporate, Part $part)
    {
        // Integrity checks

        $ownership = false;
        $partsale = false;
        $partreports = false;

        if ($part->corporate->id == $corporate->id)
        {
            $ownership = true;
        }

        if ($part->sale)
        {
            $partsale = true;
        }
        if ($part->reports)
        {
            $partreports = true;
        }

        if ($ownership == true && $partsale == false && $partreports == false) 
        {
            if ($part->comments)
            {
                $part->comments()->delete();
            }
            if ($part->likes)
            {
                $part->likes()->delete();
            }
            if ($part->tails)
            {
                $part->tails()->delete();
            }
            if ($part->images)
            {
                $part->images()->delete();
            }

            $part->delete();
        } 
        else
        {
            $message = '';

            if ($ownership == false) {
                Session::flash('ownermessage', 'You do not own this part! How did you get here? Stop being naughty!');
            }
            if ($partsale == true) {
                Session::flash('salemessage', 'This part has a sale record. You cannot delete a part that has a sale record.');
            } 
            if ($partreports == true) {
                Session::flash('reportsmessage', 'This part has report records. You cannot delete a part that has report records.');
            }

            return redirect()->back();
        }

        return redirect()->back();
    }

    /**
     * Upload part temporary image (no database records inserted)
     *
     * @param  Request $request
     * @return Response 
     */
    public function partuploadtempimage(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $timestamp = Carbon::now()->format('YmdHis');

        $imageName = $corporate->id.$corporate->name.$timestamp.'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(base_path().'/public/imgs/corporate/'.$corporate->id.'/parts/', $imageName);

        $image_url = '/imgs/corporate/'.$corporate->id.'/parts/'.$imageName;
        $session_key_tail = 'part_image_url';

        if ($request->session()->has('part_image_upload_count')) {
            $part_image_upload_count = (int)$request->session()->get('part_image_upload_count');
        }
        else {
            $part_image_upload_count = 0;
        }

        $part_image_upload_count++;
        $session_key = $part_image_upload_count.$session_key_tail;

        $request->session()->put($session_key, $image_url);
        $request->session()->put('part_image_upload_count', $part_image_upload_count);

        return response()->json(
            ['img_url' => $image_url, 'filename' => $imageName, 'img_count' => $part_image_upload_count]
        );
    }

    /**
     * Delete part temp image (no database records inserted)
     *
     * @param  Request $request
     * @return Response 
     */
    public function partdeletetempimage(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'serverfilename' => 'required',
            'serverfileurl' => 'required',
            'serverfilecount' => 'required',
        ]);

        $success = true;
        $message = 'File successfully deleted.';

        $stringArray = preg_split("/[a-zA-Z]/",$request->serverfilename,1);
        $corporate_id = (int)$stringArray[0];

        if ($corporate->id == $corporate_id) {

            if ($request->session()->has('part_image_upload_count') && $request->session()->has($request->serverfilecount.'part_image_url')) {
                if (File::exists('../public'.$request->serverfileurl)) {
                    File::delete('../public'.$request->serverfileurl);

                    $request->session()->forget($request->serverfilecount.'part_image_url');
                    $part_image_count = (int)$request->session()->get('part_image_upload_count');
                    $part_image_count--;
                    $request->session()->put('part_image_upload_count', $part_image_count);
                } else {
                    $success = false;
                    $message = 'File doesn\'t exist buddy.';
                }
            } else {
                $success = false;
                $message = 'Oops, looks like there were some errors. Refresh the page and try again.';
            }
        } else {
            $success = false;
            $message = 'You do not own this image. Don\'t be naughty!';
        }


        return response()->json(
            ['success' => $success , 'message' => $message]
        );
    }

    /**
     * Upload part image (with database record inserted too)
     *
     * @param  Request $request
     * @return Response 
     */
    public function partuploadimage(Request $request, Corporate $corporate, Part $part)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $timestamp = Carbon::now()->format('YmdHis');

        $imageName = $corporate->id.$corporate->name.$timestamp.'.'.$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(base_path().'/public/imgs/corporate/'.$corporate->id.'/parts/', $imageName);

        $image_url = '/imgs/corporate/'.$corporate->id.'/parts/'.$imageName;
        $session_key_tail = 'part_image_url';

        if ($request->session()->has('part_image_upload_count')) {
            $part_image_upload_count = (int)$request->session()->get('part_image_upload_count');
        }
        else {
            $part_image_upload_count = 0;
        }

        $part_image_upload_count++;
        $session_key = $part_image_upload_count.$session_key_tail;

        $request->session()->put($session_key, $image_url);
        $request->session()->put('part_image_upload_count', $part_image_upload_count);

        // insert into database
        $partimage = new Partimage;
        $partimage->part_id = $part->id;
        $partimage->img_url = $image_url;
        $partimage->thumb_img_url = '';
        $partimage->save();

        return response()->json(
            ['img_url' => $image_url, 'filename' => $imageName, 'img_count' => $part_image_upload_count]
        );
    }

    /**
     * Delete part image (with database records delete too)
     *
     * @param  Request $request
     * @return Response 
     */
    public function partdeleteimage(Request $request, Corporate $corporate, Part $part)
    {
        $this->validate($request, [
            'serverfilename' => 'required',
            'serverfileurl' => 'required',
            'serverfilecount' => 'required',
        ]);

        $success = true;
        $message = 'File successfully deleted.';

        $stringArray = preg_split("/[a-zA-Z]/",$request->serverfilename,1);
        $corporate_id = (int)$stringArray[0];

        if ($corporate->id == $corporate_id) {

            if ($request->session()->has('part_image_upload_count') && $request->session()->has($request->serverfilecount.'part_image_url')) {
                if (File::exists('../public'.$request->serverfileurl)) {
                    File::delete('../public'.$request->serverfileurl);

                    $request->session()->forget($request->serverfilecount.'part_image_url');
                    $part_image_count = (int)$request->session()->get('part_image_upload_count');
                    $part_image_count--;
                    $request->session()->put('part_image_upload_count', $part_image_count);

                    $partimage = Partimage::where('part_id', $part->id)->where('img_url', $request->serverfileurl)->get()->first();
                    $partimage->delete();
                } else {
                    $success = false;
                    $message = 'File doesn\'t exist buddy.';
                }
            } else {
                $success = false;
                $message = 'Oops, looks like there were some errors. Refresh the page and try again.';
            }
        } else {
            $success = false;
            $message = 'You do not own this image. Don\'t be naughty!';
        }


        return response()->json(
            ['success' => $success , 'message' => $message]
        );
    }


    // ===================================================================================
    // 
    // 
    //     CAR SALES
    // 
    // 
    // ===================================================================================



    /**
     * Delete part image (with database records delete too)
     *
     * @param  Request $request
     * @return Response 
     */
    public function carsalecreate(Corporate $corporate)
    {
        $cars = Car::where('corporate_id', $corporate->id)->where('published', true)->where('status', 'free')->get();

        $cargroups = Cargroup::where('corporate_id', $corporate->id)->where('published', true)->where('type', 'sale')->get();

        return view('corp.forms.createsalecar', [
            'corporate' => $corporate,
            'cars' => $cars,
            'cargroups' => $cargroups,
        ]); 
    }

    /**
     * Add new car sale
     *
     * @param  Request $request
     * @return Response 
     */
    public function carsalestore(Request $request, Corporate $corporate)
    {

        $this->validate($request, [
            'car_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Car owner validation
        $car = Car::find($request->car_id);
        if ($car->corporate->id != $corporate->id) {
            Session::flash('errormessage', 'You do not own this car! What are you doing?');
            return redirect()->back();
        }     

        // Car is free validation
        if ($car->status != 'free') {
            Session::flash('errormessage', 'This car is not free at the moment.');
            return redirect()->back();
        } 

        $carsale = new Carsale;

        $carsale->car_id = $request->car_id;
        $carsale->price = $request->price;
        if ($request->negotiable == true)
        {
            $carsale->negotiable = true;
        }
        else
        {
            $carsale->negotiable = false;
        }
        $carsale->corporate_id = $corporate->id;
        $carsale->status = 'sale';
        $carsale->note = $request->note;
        if ($request->cargroup_id) {
            $carsale->cargroup_id = $request->cargroup_id;

            // update car model
            $car->ingroup = true;
        }
        $carsale->save();

        // update status of all relevant models
        $car->status = 'sale';
        $car->save();
            
        return redirect('/corporate/'.$corporate->id.'/cars/sales/sale/'.$carsale->id);
    }

    /**
     * Sell car to user
     *
     * @param  Request $request
     * @return Response 
     */
    public function carsalepurchase(Request $request, Corporate $corporate, Carsale $carsale)
    {
        $this->validate($request, [
            'reserve_id' => 'required|numeric',
            'tax' => 'required|numeric',
            'method' => 'required',
        ]);

        $carsalereserve = Carsalereserve::find($request->reserve_id);

        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            Session::flash('errormessage', 'You do not own this car sale! How did you get here? Stop being naughty.');
            return redirect()->back();
        }

        // check if carsalereserve record has a carsaleoffer record
        if (!($carsalereserve->carsaleoffer->offer)) {
            Session::flash('errormessage', 'Oops! No offer was found for this reserve. Please report this.');
            return redirect()->back();
        }

        $carsalepurchase = new Carsalepurchase;
        $carsalepurchase->carsale_id = $carsale->id;
        $carsalepurchase->amount = $carsalereserve->carsaleoffer->offer;
        $carsalepurchase->tax = $request->tax;
        $carsalepurchase->method = $request->method;
        $carsalepurchase->carsalereserve_id = $carsalereserve->id;
        $carsalepurchase->save();

        // set carsale status to purchased
        $carsale->status = 'purchased';
        $carsale->save();

        // set car status to salepurchased
        $car = $carsale->car;
        $car->status = 'salepurchased';
        $car->save();

        return redirect()->back();
    }

    /**
     * Delete reserve and offer manually
     *
     * @param  Request $request
     * @return Response 
     */
    public function carsalereservedelete(Request $request, Corporate $corporate, Carsale $carsale)
    {
        $this->validate($request, [
            'delete_reserve_id' => 'required|numeric',
        ]);

        $carsalereserve = Carsalereserve::find($request->delete_reserve_id);

        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            Session::flash('errormessage', 'You do not own this car sale! How did you get here? Stop being naughty.');
            return redirect()->back();
        }

        // check if carsalereserve record has a carsaleoffer record
        if (!($carsalereserve->carsaleoffer->offer)) {
            Session::flash('errormessage', 'Oops! No offer was found for this reserve. Please report this.');
            return redirect()->back();
        }

        $carsaleoffer = $carsalereserve->carsaleoffer;

        // delete carsale reserve
        $carsalereserve->delete();
        
        // delete carsale offer
        // $carsaleoffer = $carsalereserve->carsaleoffer;
        $carsaleoffer->delete();

        

        // check reserves statu and update appropriately
        if ($carsale->status == 'reserved') {
            $carsale->status = 'sale';
            $carsale->save();

            $car = $carsale->car;
            $car->status = 'sale';
            $car->save();
        }

        return redirect()->back();
    }

    /**
     * Delete reserve and offer manually
     *
     * @param  Request $request
     * @return Response 
     */
    public function ajaxacceptcarsaleoffer(Request $request, Corporate $corporate, Carsale $carsale)
    {
        $this->validate($request, [
            'offer_id' => 'required|numeric',
        ]);

        $response_array = [];

        $carsaleoffer = Carsaleoffer::find($request->offer_id);

        // check to see if corporate owns carsale
        if ($carsale->corporate->id != $corporate->id) {
            $response_array = array(
                'success' => false,
                'errormessage' => 'You do not own this car sale! How did you get here? Stop being naughty.');
            return response()->json($response_array);
        }

        // check if carsale status is already reserved or purchased
        if ($carsale->status == 'reserved' || $carsale->status == 'purchased') {
            $response_array = array(
                'success' => false,
                'errormessage' => 'The car is not on sale anymore.');
            return response()->json($response_array);
        }

        // check if carsalereserve record has a carsaleoffer record
        if ($carsaleoffer->reserve) {
            $response_array = array(
                'success' => false,
                'errormessage' => 'This offer is already accepted and is reserved.');
            return response()->json($response_array);
        }

        // check if carsale reserve count is less than 3
        if ($carsale->reserves()->count() < 3) {

            $carsalereserve = new Carsalereserve;
            $carsalereserve->carsale_id = $carsale->id;   
            $carsalereserve->carsaleoffer_id = $request->offer_id;
            $carsalereserve->save();

        }

        // set the carsale status and car status to reserved
        if ($carsale->reserves()->count() == 3) {
            // set carsale status to reserved because count = 3
            $carsale->status = 'reserved';
            $carsale->save();

            // set car status to sale reserved
            $car = $carsale->car;
            $carsale->status = 'salereserved';
            $car->save();
        }

        $response_array = array('success' => true);
        return response()->json($response_array);

    }
    

    
    // ===================================================================================
    // 
    // 
    //     CAR TENDERS
    // 
    // 
    // ===================================================================================



    /**
     * Delete part image (with database records delete too)
     *
     * @param  Request $request
     * @return Response 
     */
    public function cartendercreate(Corporate $corporate)
    {
        $cars = Car::where('corporate_id', $corporate->id)->where('published', true)->where('status', 'free')->get();

        $cargroups = Cargroup::where('corporate_id', $corporate->id)->where('published', true)->where('type', 'tender')->get();

        return view('corp.forms.createtendercar', [
            'corporate' => $corporate,
            'cars' => $cars,
            'cargroups' => $cargroups,
        ]); 
    }

    /**
     * Add new car tender
     *
     * @param  Request $request
     * @return Response 
     */
    public function cartenderstore(Request $request, Corporate $corporate)
    {

        $this->validate($request, [
            'car_id' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Car owner validation
        $car = Car::find($request->car_id);
        if ($car->corporate->id != $corporate->id) {
            Session::flash('errormessage', 'You do not own this car! What are you doing?');
            return redirect()->back();
        }     

        // Car is free validation
        if ($car->status != 'free') {
            Session::flash('errormessage', 'This car is not free at the moment.');
            return redirect()->back();
        } 

        $cartender = new Cartender;

        $cartender->car_id = $request->car_id;
        $cartender->price = $request->price;
        if ($request->negotiable == true)
        {
            $cartender->negotiable = true;
        }
        else
        {
            $cartender->negotiable = false;
        }
        $cartender->corporate_id = $corporate->id;
        $cartender->status = 'tender';
        $cartender->note = $request->note;
        if ($request->cargroup_id) {
            $cartender->cargroup_id = $request->cargroup_id;

            // update car model
            $car->ingroup = true;
        }
        $cartender->save();

        // update status of all relevant models
        $car->status = 'tender';
        $car->save();
            
        return redirect('/corporate/'.$corporate->id.'/cars/tenders/tender/'.$cartender->id);
    }

    /**
     * Sell car to user
     *
     * @param  Request $request
     * @return Response 
     */
    public function cartenderpurchase(Request $request, Corporate $corporate, Cartender $cartender)
    {
        $this->validate($request, [
            'reserve_id' => 'required|numeric',
            'tax' => 'required|numeric',
            'method' => 'required',
        ]);

        $cartenderreserve = Cartenderreserve::find($request->reserve_id);

        // check to see if corporate owns cartender
        if ($cartender->corporate->id != $corporate->id) {
            Session::flash('errormessage', 'You do not own this car tender! How did you get here? Stop being naughty.');
            return redirect()->back();
        }

        // check if cartenderreserve record has a cartenderoffer record
        if (!($cartenderreserve->cartenderoffer->offer)) {
            Session::flash('errormessage', 'Oops! No offer was found for this reserve. Please report this.');
            return redirect()->back();
        }

        $cartenderpurchase = new Cartenderpurchase;
        $cartenderpurchase->cartender_id = $cartender->id;
        $cartenderpurchase->amount = $cartenderreserve->cartenderoffer->offer;
        $cartenderpurchase->tax = $request->tax;
        $cartenderpurchase->method = $request->method;
        $cartenderpurchase->cartenderreserve_id = $cartenderreserve->id;
        $cartenderpurchase->save();

        // set cartender status to purchased
        $cartender->status = 'purchased';
        $cartender->save();

        // set car status to tenderpurchased
        $car = $cartender->car;
        $car->status = 'tenderpurchased';
        $car->save();

        return redirect()->back();
    }

    /**
     * Delete reserve and offer manually
     *
     * @param  Request $request
     * @return Response 
     */
    public function cartenderreservedelete(Request $request, Corporate $corporate, Cartender $cartender)
    {
        $this->validate($request, [
            'delete_reserve_id' => 'required|numeric',
        ]);

        $cartenderreserve = Cartenderreserve::find($request->delete_reserve_id);

        // check to see if corporate owns cartender
        if ($cartender->corporate->id != $corporate->id) {
            Session::flash('errormessage', 'You do not own this car tender! How did you get here? Stop being naughty.');
            return redirect()->back();
        }

        // check if cartenderreserve record has a cartenderoffer record
        if (!($cartenderreserve->cartenderoffer->offer)) {
            Session::flash('errormessage', 'Oops! No offer was found for this reserve. Please report this.');
            return redirect()->back();
        }

        $cartenderoffer = $cartenderreserve->cartenderoffer;

        // delete cartender reserve
        $cartenderreserve->delete();
        
        // delete cartender offer
        // $cartenderoffer = $cartenderreserve->cartenderoffer;
        $cartenderoffer->delete();

        

        // check reserves statu and update appropriately
        if ($cartender->status == 'reserved') {
            $cartender->status = 'tender';
            $cartender->save();

            $car = $cartender->car;
            $car->status = 'tender';
            $car->save();
        }

        return redirect()->back();
    }

    /**
     * Delete reserve and offer manually
     *
     * @param  Request $request
     * @return Response 
     */
    public function ajaxacceptcartenderoffer(Request $request, Corporate $corporate, Cartender $cartender)
    {
        $this->validate($request, [
            'offer_id' => 'required|numeric',
        ]);

        $response_array = [];

        $cartenderoffer = Cartenderoffer::find($request->offer_id);

        // check to see if corporate owns cartender
        if ($cartender->corporate->id != $corporate->id) {
            $response_array = array(
                'success' => false,
                'errormessage' => 'You do not own this car tender! How did you get here? Stop being naughty.');
            return response()->json($response_array);
        }

        // check if cartender status is already reserved or purchased
        if ($cartender->status == 'reserved' || $cartender->status == 'purchased') {
            $response_array = array(
                'success' => false,
                'errormessage' => 'The car is not on tender anymore.');
            return response()->json($response_array);
        }

        // check if cartenderreserve record has a cartenderoffer record
        if ($cartenderoffer->reserve) {
            $response_array = array(
                'success' => false,
                'errormessage' => 'This offer is already accepted and is reserved.');
            return response()->json($response_array);
        }

        // check if cartender reserve count is less than 3
        if ($cartender->reserves()->count() < 3) {

            $cartenderreserve = new Cartenderreserve;
            $cartenderreserve->cartender_id = $cartender->id;   
            $cartenderreserve->cartenderoffer_id = $request->offer_id;
            $cartenderreserve->save();

        }

        // set the cartender status and car status to reserved
        if ($cartender->reserves()->count() == 3) {
            // set cartender status to reserved because count = 3
            $cartender->status = 'reserved';
            $cartender->save();

            // set car status to tender reserved
            $car = $cartender->car;
            $cartender->status = 'tenderreserved';
            $car->save();
        }

        $response_array = array('success' => true);
        return response()->json($response_array);

    }



















    /**
     * Show the account page.
     *
     * @return \Illuminate\Http\Response
     */
    public function account(Corporate $corporate)
    {
        return view('corp.account', [
            'corporate' => $corporate,
        ]); 
    }

    /**
     * Show the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings(Corporate $corporate)
    {
        return view('corp.settings', [
            'corporate' => $corporate,
        ]);
    }
}
