<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupPending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:group-list|group-create|group-edit|group-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:group-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:group-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:group-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Group::orderBy('created_at', 'desc')->get();
        return view('groups.index', compact('data'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required|unique:groups,name'
        ]);



        $new_group = new Group();
        $new_group->name = $request['name'];
        $new_group->status = 0;

        $new_group->save();



        $group_pending = new GroupPending();
        $group_pending->group_id =  $new_group->id;
        $group_pending->inputer_id = Auth::user()->id;
        $group_pending->status = 0;
        $group_pending->action_type = 'Insert';

        $group_pending->save();


        $authoriserUsers = User::role('Authoriser')->get();

        $title = 'Group';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $new_group->name,
                'title' => $title,
            ];

            Mail::send('emails.Actioncreate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });
        }


        return Redirect::back()->with('success', 'Group created successfully.');
    }



    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255', // Ensuring 'name' is a string and not too long
        ]);

        $group = Group::find($id);
        if (!$group) {
            return redirect()->back()->with('error', 'Group not found.');
        }

        // Check if another group with the same name already exists, excluding the current one
        $existingGroup = Group::where('name', $request->input('name'))
            ->where('id', '!=', $id) // Exclude the current group from the check
            ->first();

        if ($existingGroup) {
            // Group with the same name exists, return with error
            return redirect()->back()->with('error', 'A group with the given name already exists.');
        }

        // If the group doesn't exist, proceed with the update



        $group->status = $request->input('status');
        $group->save();


        $group_pending = new groupPending();
        $group_pending->group_id =  $id;
        $group_pending->name =   $request->input('name');
        $group_pending->inputer_id = Auth::user()->id;
        $group_pending->status = 0;
        $group_pending->action_type = 'Edit';

        $group_pending->save();



        $authoriserUsers = User::role('Authoriser')->get();

        $title = 'Group';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $group_pending->name,
                'title' => $title,
            ];

            Mail::send('emails.Actionupdate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });
        }

        return redirect()->back()->with('success', 'Group updated successfully.');
    }




    public function delete($id)
    {




        $group = Group::find($id);

        $group->status = 3;

        $group->save();





        $group_pending = new GroupPending();
        $group_pending->group_id =  $id;
        $group_pending->inputer_id = Auth::user()->id;
        $group_pending->status = 0;
        $group_pending->action_type = 'Delete';

        $group_pending->save();


        $authoriserUsers = User::role('Authoriser')->get();

        $title = 'group';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $group->name,
                'title' => $title,
            ];

            Mail::send('emails.ActiondeletePending', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });
        }

        return Redirect::back()->with('success', 'Group deleted successfully.');
    }



    public function groupstatus1(Request $request, $id)
    {

        $update_status = Group::find($id);
        $update_status_pending = GroupPending::where('group_id', $id)->where('status', 0)->where(
            'authorizer_id',
            null
        )->orderBy('created_at', 'desc')->first();


        $update_status_delete = GroupPending::where('group_id', $id)
            ->where('status', 0)
            ->where('action_type', 'delete')
            ->where('authorizer_id', null)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($update_status_delete !== null) {
            $update_status_delete->status = 1;
            $update_status_delete->authorizer_id = Auth::user()->id;
            $update_status_delete->save();


            Group::find($id)->delete();
        }


        if ($update_status_pending->name != null) {
            $update_status->name = $update_status_pending->name;

            $update_status->status = $update_status_pending->status;
            $update_status->save();
        }


        //$update_status->note = $request['note'];
        $update_status->status = $request['status'];



        $update_status_pending->status = $request['status'];
        $update_status_pending->authorizer_id = Auth::user()->id;





        $update_status->save();
        $update_status_pending->save();



        if ($request['status'] == 1) {


            // APPROVED Group status
            $email_data = array(
                'email' => 'aboajah.emmanuel@fmdqgroup.com',
                'action' => $update_status->name,
            );
            Mail::send('emails.Actionapproved', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'],)
                    ->subject('Group Approved')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });




            return redirect()->back()->with('success', 'Request approved successfully..');
        }


        if ($request['status'] == 2) {

            // REJECT Group status 
            $email_data = array(
                'email' => 'aboajah.emmanuel@fmdqgroup.com',
                'action' => $update_status->name,
                'note' => $request['note'],
            );
            Mail::send('emails.Actionrejected', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'],)
                    ->subject('Group Rejected')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });

            $update_status->save();

            return redirect()->back()->with('success', 'Request rejected.');
        }





        if ($request['status'] == 3) {

            // REJECT Group status 
            $email_data = array(
                'email' => 'aboajah.emmanuel@fmdqgroup.com',
                'action' => $update_status->name,

            );
            Mail::send('emails.Actiondelete', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'],)
                    ->subject('Group Delete')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });

            $update_status->save();

            return redirect()->back()->with('success', 'Request approved.');
        }
    }







    public function groupstatus(Request $request, $id)
    {
        //return $request;

        $update_status = Group::find($id);
        $update_status_pending = GroupPending::where('group_id', $id)->where('status', 0)->where(
            'authorizer_id',
            null
        )->orderBy('created_at', 'desc')->first();


        $update_status_delete = GroupPending::where('group_id', $id)
            ->where('status', 0)
            ->where('action_type', 'delete')
            ->where('authorizer_id', null)
            ->orderBy('created_at', 'desc')
            ->first();


        if ($update_status_delete !== null && $request->status == 2) {
            $update_status->status = $request->status;
            $update_status_delete->status = $request->status;
            $update_status_delete->note = $request->note;
            $update_status_delete->authorizer_id = Auth::user()->id;


            $update_status->save();
            $update_status_delete->save();

            $this->notifyUsersOfRejection($update_status->name, $request->note);

            return redirect()->back()->with('success', 'Request rejected.');
        }

        if ($update_status_delete !== null) {
            $update_status_delete->status = 1;
            $update_status_delete->authorizer_id = Auth::user()->id;
            $update_status_delete->save();


            Group::find($id)->delete();

            $GroupName = $update_status->name;

            $this->notifyUsersOfDeletion($GroupName);



            return redirect()->back()->with('success', 'Request approved.');
        }









        if ($update_status_pending->name !== null && $request->status == 2) {

            $update_status->status = $request->status;
            $update_status_pending->status = $request->status;
            $update_status_pending->note = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;


            $update_status->save();
            $update_status_pending->save();

            $this->notifyUsersOfRejection($update_status->name, $request->note);

            return redirect()->back()->with('success', 'Request rejected.');
        }



        if ($update_status_pending->name !== null && $request->status == 1) {
            $update_status->name = $update_status_pending->name;
            $update_status->status = $request->status;

            $update_status_pending->status = $request->status;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $this->ApprovenotifyUsers($update_status->name);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }



        if ($update_status_pending->name == null && $request->status == 1) {

            $update_status->status = $request->status;

            $update_status_pending->status = $request->status;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $this->ApprovenotifyUsers($update_status->name);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }





        if ($update_status_pending->name == null && $request->status == 2) {

            $update_status->status = $request->status;
            $update_status_pending->status = $request->status;
            $update_status_pending->note = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;


            $update_status->save();
            $update_status_pending->save();

            $this->notifyUsersOfRejection($update_status->name, $request->note);
            return redirect()->back()->with('success', 'Request rejected.');
        }
    }


    private function ApprovenotifyUsers($action)
    {
        $authoriserUsers = User::role('Inputer')->get(); // Ensure this role exists and is correct

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $action,
            ];

            Mail::send('emails.Actionapproved', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Group Approved')
                    ->from(env('MAIL_FROM_ADDRESS', 'no-reply@example.com'), env('MAIL_FROM_NAME', 'Your Application Name'));
            });
        }
    }





    private function notifyUsersOfRejection($actionName, $note)
    {
        $authoriserUsers = User::role('Inputer')->get(); // Ensure the role exists

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $actionName,
                'note' => $note,
            ];

            Mail::send('emails.Actionrejected', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Group Rejected')
                    ->from(env('MAIL_FROM_ADDRESS', 'no-reply@example.com'), env('MAIL_FROM_NAME', 'Your Application Name'));
            });
        }
    }




    private function notifyUsersOfDeletion($GroupName)
    {
        $authoriserUsers = User::role('Inputer')->get(); // Ensure this role exists

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $GroupName,
            ];

            Mail::send('emails.Actiondelete', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Group Deleted')
                    ->from(env('MAIL_FROM_ADDRESS', 'no-reply@example.com'), env('MAIL_FROM_NAME', 'Your Application Name'));
            });
        }
    }
}
