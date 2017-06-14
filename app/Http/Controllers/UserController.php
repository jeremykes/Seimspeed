<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Corporaterating;
use App\Corporatetail;

use Auth;

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

    /**
     * Rate Corporate
     *
     * @param  Request $request
     * @return Response 
     */
    public function rate(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'rating' => 'required',
        ]);

        $corporaterating_exist = Corporaterating::where('corporate_id', $corporate->id)->where('user_id', Auth::user->id)->first();

        if ($corporaterating_exist === null) {
            $corporaterating = new Corporaterating;
            $corporaterating->corporate_id = $corporate->id;
            $corporaterating->user_id = Auth::user->id;
            $corporaterating->rating = $request->rating;
            $corporaterating->comment = '';
            $corporaterating->save();
        } else {
            $corporaterating_exist->rating = $request->rating;
            $corporaterating_exist->save();
        }

        return response()->json(['success'=>true]);
    }

    /**
     * Tail Add/Remove Corporate
     *
     * @param  Request $request
     * @return Response 
     */
    public function tailcorporate(Request $request, Corporate $corporate)
    {
        $corporatetail_exist = Corporatetail::where('corporate_id', $corporate->id)->where('user_id', Auth::user->id)->first();

        if ($corporatetail_exist === null) {
            $corporatetail = new Corporatetail;
            $corporatetail->corporate_id = $corporate->id;
            $corporatetail->user_id = Auth::user->id;
            $corporatetail->save();
        } else {
            $corporatetail_exist->delete();
        }

        return response()->json(['success'=>true]);
    }

    // /**
    //  * Car comment added
    //  *
    //  * @param  Request $request
    //  * @return Response 
    //  */
    // public function addcarcomment(Request $request, Car $car)
    // {
    //     $corporatetail_exist = Corporatetail::where('corporate_id', $corporate->id)->where('user_id', $user->id)->first();

    //     if ($corporatetail_exist === null) {
    //         $corporatetail = new Corporatetail;
    //         $corporatetail->corporate_id = $corporate->id;
    //         $corporatetail->user_id = $user->id;
    //         $corporatetail->save();
    //     } else {
    //         $corporatetail_exist->delete();
    //     }

    //     return response()->json(['success'=>true]);
    // }
}



