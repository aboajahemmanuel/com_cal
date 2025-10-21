<?php
namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\Group;
use App\Models\User;
use App\Models\UsersPending;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data   = User::where('deleted_at', null)->orderBy('created_at', 'desc')->get();
        $groups = Group::all();
        $roles  = Role::pluck('name', 'name')->all();

        return view('users.index', compact('data', 'roles', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        //  return $request;

        $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
        $this->validate($request, [
            // 'name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
            // 'usertype' => 'required'

        ]);

        $name              = $request->fname . ' ' . $request->lname;
        $input             = $request->all();
        $input['name']     = $name;
        $input['password'] = Hash::make($password);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $user_pending              = new UsersPending();
        $user_pending->user_id     = $user->id;
        $user_pending->name        = $user->name;
        $user_pending->email       = $user->email;
        $user_pending->password    = $password;
        $user_pending->inputer_id  = Auth::user()->id;
        $user_pending->status      = 0;
        $user_pending->action_type = 'Insert';
        $user_pending->save();

        $authoriserUsers = User::role('Admin')->get();
        $title           = 'User';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $name,
                'title'  => $title,
            ];

            Mail::send('emails.Actioncreate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }

        // $created_at = $user->created_at;

        // $email_data = [
        //     'name'       => $user->name,
        //     'email'      => $user->email,
        //     'password'   => $password,
        //     'created_at' => $created_at,
        // ];

        // Mail::send('emails.usercreation', $email_data, function ($message) use ($email_data) {
        //     $message->to($email_data['email'])
        //         ->subject('Account Details')
        //         ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
        // });

        LogActivity::addToLog('User (' . $name . ') Created by ' . Auth::user()->name);

        return Redirect::back()->with('success', 'User created successfully.');
    }

    public function update(Request $request, $id)
    {
        //return $request;
        $this->validate($request, [
            //'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            //'password' => 'confirmed',
            'roles' => 'required',
        ]);

        $user = User::find($id);

        $user_pending              = new UsersPending();
        $user_pending->user_id     = $user->id;
        $user_pending->name        = $request->fname . ' ' . $request->lname;
        $user_pending->email       = $request->email;
        $user_pending->group_id    = $request->group_id;
        $user_pending->roles       = json_encode($request->input('roles'));
        $user_pending->inputer_id  = Auth::user()->id;
        $user_pending->status      = 0;
        $user_pending->action_type = 'Edit';

        $user_pending->save();

        $user->admin_status = 0;
        $user->save();

        // Prepare the notification details
        // $action = $request->input('name');
        //$title  = 'Please be advised that the User (' . $action . ') has been updated and is awaiting your review and approval.';
        LogActivity::addToLog(' User (' . $request['name'] . ')  updated  by ' . Auth::user()->name);

        $authoriserUsers = User::role('Admin')->get();
        $title           = 'User';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $request->fname . ' ' . $request->lname,
                'title'  => $title,
            ];

            Mail::send('emails.Actioncreate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }

        return redirect()->back()->with('success', 'User update submitted for approval successfully.');
    }

    public function edit($id)
    {
        $user     = User::find($id);
        $roles    = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'name'     => 'required',
    //         'email'    => 'required|email|unique:users,email,' . $id,
    //         'password' => 'confirmed',
    //         'roles'    => 'required',
    //     ]);

    //     $input = $request->all();

    //     if (! empty($input['password'])) {
    //         $input['password'] = Hash::make($input['password']);
    //     } else {
    //         $input = Arr::except($input, ['password']);
    //     }

    //     $user = User::find($id);
    //     $user->update($input);

    //     DB::table('model_has_roles')
    //         ->where('model_id', $id)
    //         ->delete();

    //     $user->assignRole($request->input('roles'));

    //     LogActivity::addToLog('User (' . $request->name . ') Updated by ' . Auth::user()->name);

    //     return redirect()->back()->with('success', 'User updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user_update = User::find($id);

        LogActivity::addToLog('User (' . $user_update->name . ') User deleted by ' . Auth::user()->name);

        $user_update->deleted_at = date('Y-m-d H:i:s');
        $user_update->save();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function statususer(Request $request, $id)
    {
        //return $request;
        $this->validate($request, [
            'status' => 'required',
        ]);

        $user = User::find($id);

        if ($request->status == 6) {

            $user_pending              = new Userspending();
            $user_pending->user_id     = $id;
            $user_pending->inputer_id  = Auth::user()->id;
            $user_pending->status      = 0;
            $user_pending->action_type = 'Enable';

            $user_pending->save();
            LogActivity::addToLog(' User (' . $user->name . ')  Enabled  by ' . Auth::user()->name);

            //$user->status       = 6;
            $user->admin_status = 6;
            $user->save();
        }
        if ($request->status == 4) {

            $user_pending              = new Userspending();
            $user_pending->user_id     = $id;
            $user_pending->inputer_id  = Auth::user()->id;
            $user_pending->status      = 0;
            $user_pending->action_type = 'Disabled';

            $user_pending->name     = $user->name;
            $user_pending->email    = $user->email;
            $user_pending->group_id = $user->group_id;
            $user_pending->roles    = json_encode($request->input('roles'));
            //$user_pending->roles = json_encode($user->roles);

            LogActivity::addToLog(' User (' . $user->name . ')  Disabled  by ' . Auth::user()->name);

            $user_pending->save();

            //$user->status       = 4;
            $user->admin_status = 4;
            $user->save();
        }

        $action = $user->name;
        //$title  = 'Please be advised that the User (' . $action . ') status has been updated and is awaiting your review and approval.';

        $authoriserUsers = User::role('Admin')->get();
        $title           = 'User';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $action,
                'title'  => $title,
            ];

            Mail::send('emails.Actionupdate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }

        return redirect()->back()->with('success', 'User status successfully updated.');
    }

    public function userStatus(Request $request, $id)
    {
        //return $request;

        $update_status         = User::find($id);
        $update_status_pending = Userspending::where('status', 0)->where(
            'authorizer_id',
            null
        )->where('user_id', $id)->orderBy('created_at', 'desc')->first();

        if ($update_status_pending->action_type == 'Delete' && $request->status == 1) {
            $update_status_pending->status        = 1;
            $update_status_pending->authorizer_id = Auth::user()->id;
            $update_status_pending->save();

            Role::find($id)->delete();

            $action = $update_status->name;

            $this->ApprovenotifyDeletion($action);

            $inputter_email = Auth::user()->email;
            $inputter_title = 'Please be advised that User (' . $action . ') Delete request approved.';
            $this->insertNotifyInputter($action, $inputter_title, $inputter_email);

            return Redirect::to('admin_users')->with('success', 'Request approved.');

            //  return redirect()->back()->with('success', 'Request approved.');
        }

        if ($update_status_pending->action_type == 'Edit' && $request->status == 1) {

            // Check if the role already exists
            $user = User::find($id);

            $user->name  = $update_status_pending->name;
            $user->email = $update_status_pending->email;
            // $user->group_id = $update_status_pending->group_id;

            $user->status       = 1;
            $user->admin_status = 1;
            $user->save();

            DB::table('model_has_roles')->where(
                'model_id',
                $user->id
            )->delete();
            $user->assignRole(json_decode($update_status_pending->roles, true));

            $update_status_pending->authorizer_id = Auth::id();
            $update_status_pending->status        = 1;
            $update_status_pending->save();

            $action = $update_status->name;

            LogActivity::addToLog('User Update Request (' . $update_status->name . ') Approved by ' . Auth::user()->name);

            $this->ApprovenotifyUsers($action);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }

        if ($update_status_pending->action_type == 'Insert' && $request->status == 1) {

            $update_status->status       = $request->status;
            $update_status->admin_status = $request->status;

            $update_status_pending->status        = $request->status;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->name;

            $email_data = [
                'name'       => $update_status_pending->name,
                'email'      => $update_status_pending->email,
                'password'   => $update_status_pending->password,
                'created_at' => $update_status_pending->created_at,
            ];

            Mail::send('emails.usercreation', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Account Details')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });

            LogActivity::addToLog(' User (' . $update_status->name . ')  insert request approved  by ' . Auth::user()->name);

            return redirect()->back()->with('success', 'Request approved successfully.');

            // return redirect()->back()->with('success', 'Request approved successfully.');
        }

        if ($update_status_pending->action_type == 'Disabled' && $request->status == 1) {

            $update_status->status       = 5;
            $update_status->admin_status = 5;

            $update_status_pending->status        = 5;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->name;

            LogActivity::addToLog('User (' . $update_status->name . ') status changed to active Approved  by ' . Auth::user()->name);

            $this->ApprovenotifyUsers($action);

            return redirect()->back()->with('success', 'Request approved.');

        }

        if ($update_status_pending->action_type == 'Enable' && $request->status == 1) {

            $update_status->status       = $request->status;
            $update_status->admin_status = $request->status;

            $update_status_pending->status        = $request->status;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->name;

            LogActivity::addToLog('User (' . $update_status->name . ') status changed to active Approved  by ' . Auth::user()->name);

            $this->ApprovenotifyUsers($action);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }

        if ($update_status_pending->action_type == 'Insert' && $request->status == 2) {

            $update_status->status                = $request->status;
            $update_status->admin_status          = $request->status;
            $update_status_pending->status        = $request->status;
            $update_status_pending->note          = $request->note;
            $update_status->note                  = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->name;
            $note   = $request->note;

            $this->notifyUsersOfRejection($action, $note);

            LogActivity::addToLog(' User (' . $update_status->name . ')  Request rejected by ' . Auth::user()->name);

            $inputter_email = Auth::user()->email;
            $inputter_title = 'Please be advised that User (' . $action . ') Request rejected.';

            return redirect()->back()->with('success', 'Request rejected.');
        }

        if ($update_status_pending->action_type == 'Disabled' && $request->status == 2) {

            $update_status->status                = 1;
            $update_status->admin_status          = 1;
            $update_status_pending->status        = $request->status;
            $update_status_pending->note          = $request->note;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->event_title_code;
            $note   = $request->note;

            $this->notifyUsersOfRejection($action, $note);

            LogActivity::addToLog(' User (' . $update_status->name . ')  Request rejected by ' . Auth::user()->name);

            return redirect()->back()->with('success', 'Request rejected');
        }

        if ($update_status_pending->action_type == 'Enable' && $request->status == 2) {

            $update_status->status                = 5;
            $update_status->admin_status          = 5;
            $update_status_pending->status        = $request->status;
            $update_status_pending->note          = $request->note;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->event_title_code;
            $note   = $request->note;

            $this->notifyUsersOfRejection($action, $note);

            LogActivity::addToLog(' User (' . $update_status->name . ')  Request rejected by ' . Auth::user()->name);

            return redirect()->back()->with('success', 'Request rejected');
        }

        if ($update_status_pending->action_type == 'Edit' && $request->status == 2) {

            $update_status->status                = 1;
            $update_status->admin_status          = 1;
            $update_status_pending->status        = $request->status;
            $update_status_pending->note          = $request->note;
            $update_status->note                  = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->name;
            $note   = $request->note;

            $this->notifyUsersOfRejection($action, $note);

            LogActivity::addToLog(' User (' . $update_status->name . ')  Request rejected by ' . Auth::user()->name);

            return redirect()->back()->with('success', 'Request rejected');

        }
    }

    private function notifyUsersOfRejection($action, $note)
    {
        $authoriserUsers = User::role('Admin')->get(); // Ensure the role exists

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $action,
                'note'   => $note,
            ];

            Mail::send('emails.Actionrejected', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('User Rejected')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }
    }

    private function ApprovenotifyUsers($action)
    {
        $authoriserUsers = User::role('Admin')->get(); // Ensure this role exists and is correct

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $action,
            ];

            Mail::send('emails.Actionapproved', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('User  Approved')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }
    }

    //  private function notifyUsersOfRejection($actionName, $note)
    // {
    //     $authoriserUsers = User::role('Admin')->get(); // Ensure the role exists

    //     foreach ($authoriserUsers as $user) {
    //         $email_data = [
    //             'email'  => $user->email,
    //             'action' => $actionName,
    //             'note'   => $note,
    //         ];

    //         Mail::send('emails.Actionrejected', $email_data, function ($message) use ($email_data) {
    //             $message->to($email_data['email'])
    //                 ->subject('User Rejected')
    //                 ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
    //         });
    //     }
    // }
}
