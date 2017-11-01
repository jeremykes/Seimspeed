<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Corporate;
use App\Corporateuser;
use App\Car;
use App\Carimage;
use App\Cargroup;
use App\Part;
use App\Partimage;
use App\Partgroup;

use App\User;

use Auth;

use App\Notifications\CorporateUserAddedNotification;
use App\Notifications\CorporateUserUpdatedNotification;

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
            'addcorporateuser',
            'updatecorporateuser',
            'deletecorporateuser',
            'addcorporateuserrole',
            'updatecorporateuserrole',
            'addcar',
            'addcarimage',
            'deletecarimage',
            'addcargroup',
            'updatecargroup',
            'deletecargroup',
            'addpart',
            'addpartimage',
            'deletepartimage',
            'addpartgroup',
            'updatepartgroup',
            'deletepartgroup',
        ]]);

        $this->middleware('role:administrator', ['only' => [
            'updatecorporate',
            'deactivatecorporate',
        ]]);
        
    }

    /**
     * Update Corporate
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatecorporate(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'name' => 'required',
            'subscription' => 'required',
        ]);

        $corporate->name = $request->name;
        $corporate->address = $request->address;
        $corporate->phone = $request->phone;
        $corporate->descrip = $descrip;
        $corporate->logo_url = $request->logo_url;
        $corporate->banner_url = $request->banner_url;
        $corporate->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Deactivate Corporate
     *
     * @param  Request $request
     * @return Response 
     */
    public function deactivatecorporate(Request $request, Corporate $corporate)
    {
        $corporate->active = false;
        $corporate->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Add Corporate user
     *
     * @param  Request $request
     * @return Response 
     */
    public function addcorporateuser(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        if ($user = User::where('email', $request->email)->count() == 0) {
            // return response()->json(['success'=>false, 'message'=>'User does not exist in the system. Please check your spelling for the email.']);
            // return redirect('/corporate/' . $corporate->id . '/members');
            return redirect()->back()->withErrors(array('message' => 'User does not exist in the system. Please check your spelling for the email.'));
        } 

        $user = User::where('email', $request->email)->first();

        # This is to check if user is already a corporate user.
        if (Corporateuser::where('user_id', $user->id)->where('corporate_id', $corporate->id)->count() > 0) {
            return redirect()->back()->withErrors(array('message' => 'User is already belongs to another Corporate account.'));
            // return redirect('/corporate/' . $corporate->id . '/members');
        }

        $corporateuser_count = Corporateuser::where('user_id', $user->id)->where('corporate_id', $corporate->id)->count();
        if ($corporateuser_count == 1) {
            // return response()->json(['success'=>false, 'message'=>'User is already a member.']);
            return redirect('/corporate/' . $corporate->id . '/members');
        }

        $user->detachAllRoles();

        # administrator role ID     = 1
        # maintainer role ID        = 2
        # sales role ID             = 3
        # manager role ID           = 4

        if ($request->role_administrator == 'on') {
            $user->attachRole(1);
        }
        if ($request->role_maintainer == 'on') {
            $user->attachRole(2);
        }
        if ($request->role_sales == 'on') {
            $user->attachRole(3);
        }
        if ($request->role_manager == 'on') {
            $user->attachRole(4);
        }
        $user->save();

        $corporateuser = new Corporateuser;
        $corporateuser->corporate_id = $corporate->id;
        $corporateuser->user_id = $user->id;
        $corporateuser->title = $request->title;
        $corporateuser->save();

        // Notification
        // Notify user being added

        $user->notify(new CorporateUserAddedNotification($corporateuser));

        // return response()->json(['success'=>true]);
        return redirect('/corporate/' . $corporate->id . '/members');
    }

    /**
     * Update Corporate user
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatecorporateuser(Request $request, Corporate $corporate, Corporateuser $corporateuser)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $corporateuser->title = $request->title;
        $corporateuser->save();

        $user = $corporateuser->user;
        $user->detachAllRoles();

        # administrator role ID     = 1
        # maintainer role ID        = 2
        # sales role ID             = 3
        # manager role ID           = 4

        if ($request->role_administrator == 'on') {
            $user->attachRole(1);
        }
        if ($request->role_maintainer == 'on') {
            $user->attachRole(2);
        }
        if ($request->role_sales == 'on') {
            $user->attachRole(3);
        }
        if ($request->role_manager == 'on') {
            $user->attachRole(4);
        }
        $user->save();

        // Notification
        // Notify user being updated

        $corporateuser->user->notify(new CorporateUserUpdatedNotification($corporateuser));

        // return response()->json(['success'=>true]);
        return redirect('/corporate/' . $corporate->id . '/members');
    }

    /**
     * Delete Corporate user
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletecorporateuser(Request $request, Corporate $corporate)
    {
        $this->validate($request, [
            'corporateuser_id' => 'required|numeric',
        ]);

        $corporateuser = Corporateuser::findOrFail($request->corporateuser_id);
        $corporateuser->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Add Corporate user role
     *
     * @param  Request $request
     * @return Response 
     */
    public function addcorporateuserrole(Request $request, Corporate $corporate, Corporateuser $corporateuser, Role $role)
    {

        $corporateuser->user->attachRole($role);

        // Notification
        // Notify user role added

        $corporateuser->user->notify(new CorporateUserRoleAddedNotification($corporateuser));

        return response()->json(['success'=>true]);
    }

    /**
     * Update Corporate user role
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatecorporateuserrole(Request $request, Corporate $corporate, Corporateuser $corporateuser, Role $role)
    {
        $corporateuser->user->detachRole($corporateuser->user->roles);
        $corporateuser->user->attachRole($role);

        // Notification
        // Notify user role updated

        $corporateuser->user->notify(new CorporateUserRoleUpdatedNotification($corporateuser));

        return response()->json(['success'=>true]);
    }

    /**
     * Add Car
     *
     * @param  Request $request
     * @return Response 
     */
    public function addcar(Request $request, Corporate $corporate)
    {
        $car = new Car;
        $car->corporate_id = $corporate->id;
        $car->datebought = $request->datebought;
        $car->dateregistered = $request->dateregistered;
        $car->weight->d = $request->weight->d;
        $car->plates = $request->plates;
        $car->color = $request->color;
        $car->fueltype = $request->fueltype;
        $car->transmissiontype = $request->transmissiontype;
        // $car->2wd4wd = $request->2wd4wd;
        $car->steeringside = $request->steeringside;
        $car->make = $request->make;
        $car->model = $request->model;
        $car->bodytype = $request->bodytype;
        $car->status = $request->status;
        $car->note = $request->note;
        $car->physicallocation = $request->physicallocation;
        $car->ingroup = $request->ingroup;
        $car->published = $request->published;
        $car->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Update Car
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatecar(Request $request, Corporate $corporate, Car $car)
    {
        $car->datebought = $request->datebought;
        $car->dateregistered = $request->dateregistered;
        $car->weight->d = $request->weight->d;
        $car->plates = $request->plates;
        $car->color = $request->color;
        $car->fueltype = $request->fueltype;
        $car->transmissiontype = $request->transmissiontype;
        // $car->2wd4wd = $request->2wd4wd;
        $car->steeringside = $request->steeringside;
        $car->make = $request->make;
        $car->model = $request->model;
        $car->bodytype = $request->bodytype;
        $car->status = $request->status;
        $car->note = $request->note;
        $car->physicallocation = $request->physicallocation;
        $car->ingroup = $request->ingroup;
        $car->published = $request->published;
        $car->save();

        // Notification 
        // Notify all users following corp

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $corporate->id)
            ->where('notificables.model_name', 'corporate')
            ->get();

        Notification::send($users, new CarUpdatedNotification($car));

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Car
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletecar(Request $request, Corporate $corporate, Car $car)
    {
        $car->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Add Car Image
     *
     * @param  Request $request
     * @return Response 
     */
    public function addcarimage(Request $request, Corporate $corporate, Car $car)
    {
        $carimage = new Carimage;
        $carimage->car_id = $car->id;
        $carimage->img_url = $request->img_url;
        $carimage->thumb_img_url = $request->thumb_img_url;
        $carimage->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Car Image
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletecarimage(Request $request, Corporate $corporate, Car $car, Carimage $carimage)
    {
        $carimage->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Add Car Group
     *
     * @param  Request $request
     * @return Response 
     */
    public function addcargroup(Request $request, Corporate $corporate)
    {
        $cargroup = new Group;
        $cargroup->corporate_id = $corporate->id; 
        $cargroup->startdate = $request->startdate; 
        $cargroup->enddate = $request->enddate; 
        $cargroup->title = $request->title; 
        $cargroup->type = $request->type; 
        $cargroup->published = $request->published; 
        $cargroup->autopublish = $request->autopublish; 
        $cargroup->autounpublish = $request->autounpublish; 
        $cargroup->autopublishcars = $request->autopublishcars; 
        $cargroup->autounpublishcars = $request->autounpublishcars; 
        $cargroup->autoreservecars = $request->autoreservecars; 
        $cargroup->descript = $request->descript;
        $cargroup->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Update Car Group
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatecargroup(Request $request, Corporate $corporate, Cargroup $cargroup)
    {
        $cargroup->startdate = $request->startdate; 
        $cargroup->enddate = $request->enddate; 
        $cargroup->title = $request->title; 
        $cargroup->type = $request->type; 
        $cargroup->published = $request->published; 
        $cargroup->autopublish = $request->autopublish; 
        $cargroup->autounpublish = $request->autounpublish; 
        $cargroup->autopublishcars = $request->autopublishcars; 
        $cargroup->autounpublishcars = $request->autounpublishcars; 
        $cargroup->autoreservecars = $request->autoreservecars; 
        $cargroup->descript = $request->descript;
        $cargroup->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Car Group
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletecargroup(Request $request, Corporate $corporate, Cargroup $cargroup)
    {
        $cargroup->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Add Part
     *
     * @param  Request $request
     * @return Response 
     */
    public function addpart(Request $request, Corporate $corporate)
    {
        $part = new Part;
        $part->corporate_id = $corporate->id;
        $part->ingroup = $request->ingroup;
        $part->published = $request->published;
        $part->name = $request->name;
        $part->serialnumber = $request->serialnumber;
        $part->descript = $request->descript;
        $part->status = $request->status;
        $part->physicallocation = $request->physicallocation;
        $part->note = $request->note;
        $part->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Update Part
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatepart(Request $request, Corporate $corporate, Part $part)
    {
        $part->ingroup = $request->ingroup;
        $part->published = $request->published;
        $part->name = $request->name;
        $part->serialnumber = $request->serialnumber;
        $part->descript = $request->descript;
        $part->status = $request->status;
        $part->physicallocation = $request->physicallocation;
        $part->note = $request->note;
        $part->save();

        // Notification 
        // Notify all users following corp

        // get all users
        $users = DB::table('users')
            ->leftJoin('notificables', 'users.id', '=', 'notificables.user_id')
            ->where('notificables.model_id', $corporate->id)
            ->where('notificables.model_name', 'corporate')
            ->get();

        Notification::send($users, new PartUpdatedNotification($part));

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Part
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletepart(Request $request, Corporate $corporate, Part $part)
    {
        $part->delete(); 

        return response()->json(['success'=>true]);
    }

    /**
     * Add Part image
     *
     * @param  Request $request
     * @return Response 
     */
    public function addpartimage(Request $request, Corporate $corporate, Part $part)
    {
        $partimage = new Partimage;
        $partimage->part_id = $part;
        $partimage->img_url = $request->img_url;
        $partimage->thumb_img_url = $request->thumb_img_url;
        $partimage->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Part image
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletepartimage(Request $request, Corporate $corporate, Part $part, Partimage $partimage)
    {
        $partimage->delete();

        return response()->json(['success'=>true]);
    }

    /**
     * Add Part Group
     *
     * @param  Request $request
     * @return Response 
     */
    public function addpartgroup(Request $request, Corporate $corporate)
    {
        $partgroup = new Group;
        $partgroup->corporate_id = $corporate->id; 
        $partgroup->startdate = $request->startdate; 
        $partgroup->enddate = $request->enddate; 
        $partgroup->title = $request->title; 
        $partgroup->published = $request->published; 
        $partgroup->autopublish = $request->autopublish; 
        $partgroup->autounpublish = $request->autounpublish; 
        $partgroup->autopublishparts = $request->autopublishparts; 
        $partgroup->autounpublishparts = $request->autounpublishparts; 
        $partgroup->autoreserveparts = $request->autoreserveparts; 
        $partgroup->descript = $request->descript;
        $partgroup->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Update Part Group
     *
     * @param  Request $request
     * @return Response 
     */
    public function updatepartgroup(Request $request, Corporate $corporate, Partgroup $partgroup)
    {
        $partgroup->startdate = $request->startdate; 
        $partgroup->enddate = $request->enddate; 
        $partgroup->title = $request->title; 
        $partgroup->published = $request->published; 
        $partgroup->autopublish = $request->autopublish; 
        $partgroup->autounpublish = $request->autounpublish; 
        $partgroup->autopublishparts = $request->autopublishparts; 
        $partgroup->autounpublishparts = $request->autounpublishparts; 
        $partgroup->autoreserveparts = $request->autoreserveparts; 
        $partgroup->descript = $request->descript;
        $partgroup->save();

        return response()->json(['success'=>true]);
    }

    /**
     * Delete Part Group
     *
     * @param  Request $request
     * @return Response 
     */
    public function deletepartgroup(Request $request, Corporate $corporate, Partgroup $partgroup)
    {
        $partgroup->delete();

        return response()->json(['success'=>true]);
    }
}
