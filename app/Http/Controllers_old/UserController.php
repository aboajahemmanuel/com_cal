<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Hash;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Arr;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
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

        $data = User::orderBy('created_at', 'desc')->get();
        $groups = Group::all();
        $roles = Role::pluck('name', 'name')->all();

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        //  return $request;

        $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
            // 'usertype' => 'required'

        ]);

        $input = $request->all();
        $input['password'] = Hash::make($password);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $created_at = $user->created_at;

        // email data
        $email_data = array(
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'created_at' => $created_at,
        );



        Mail::send('emails.usercreation', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'])
                ->subject('Account Details')
                ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
        });

        LogActivity::addToLog('User (' . $request->name . ') Created by ' . Auth::user()->name);


        return Redirect::back()->with('success', 'User created successfully.');
    }




    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')
            ->where('model_id', $id)
            ->delete();

        $user->assignRole($request->input('roles'));

        LogActivity::addToLog('User (' . $request->name . ') Updated by ' . Auth::user()->name);


        return redirect()->back()->with('success', 'User updated successfully.');
    }

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


        User::find($id)->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }



    public function statususer(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',

        ]);


        $user_update = User::find($id);


        // Proceed with updating the Category
        $user_update->status = $request['status'];
        $user_update->save();

        LogActivity::addToLog('User (' . $user_update->name . ') Status Updated by ' . Auth::user()->name);

        return redirect()->back()->with('success', 'User status successfully updated.');

        // OK
    }
}
