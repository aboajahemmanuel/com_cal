<?php

namespace App\Http\Controllers;


use Log;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Helpers\LogActivity;
use App\Models\EventPending;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{


    public function events(Request $request)
    {
        Log::info('Request Category: ' . $request->category);  // Log the input for debugging
        $query = Event::where('status', 1)->newQuery();

        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }

        $events = $query->get();
        Log::info('Returned Events: ' . json_encode($events));  // Log the output for debugging
        return response()->json($events);
    }







    public function allevents()
    {

        $data = Event::orderBy('created_at', 'desc')->get();
        $categories = Category::where('status', 1)->get();
        return view('events.index', compact('data', 'categories'));
    }




    public function addevent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_title_code' => 'required',
            'event_description' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'venue' => 'required',
            'issuer' => 'required',
            'issuer_description' => 'required',
            'category_id' => 'required',
            'category_name' => 'required', // Ensure this is required if you need it
            'category_color' => 'required', // Ensure this is required if you need it
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create and save event
        $event = new Event();
        $event->event_title_code = $request->input('event_title_code');
        $event->event_description = $request->input('event_description');
        $event->start_date = $request->input('start_date');
        $event->start_time = $request->input('start_time');
        $event->end_date = $request->input('end_date');
        $event->end_time = $request->input('end_time');
        $event->category_id = $request->input('category_id');
        $event->category_name = $request->input('category_name');
        $event->category_color = $request->input('category_color');
        $event->issuer = $request->input('issuer');
        $event->issuer_description = $request->input('issuer_description');
        $event->venue = $request->input('venue');

        if ($request->hasFile('event_image')) {
            $file = $request->file('event_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/event_image/', $filename);
            $event->event_image = 'event_image/' . $filename;
        }

        $event->save();

        // Create and save event pending
        $eventPending = new EventPending();
        $eventPending->event_id = $event->id;
        $eventPending->event_title_code = $event->event_title_code;
        $eventPending->event_description = $event->event_description;
        $eventPending->start_date = $event->start_date;
        $eventPending->start_time = $event->start_time;
        $eventPending->end_date = $event->end_date;
        $eventPending->end_time = $event->end_time;
        $eventPending->category_id = $event->category_id;
        $eventPending->category_name = $event->category_name;
        $eventPending->category_color = $event->category_color;
        $eventPending->issuer = $event->issuer;
        $eventPending->issuer_description = $event->issuer_description;
        $eventPending->venue = $event->venue;
        $eventPending->event_image = $event->event_image;
        $eventPending->inputer_id = Auth::user()->id;
        $eventPending->status = 0;
        $eventPending->action_type = 'Insert';

        $eventPending->save();

        LogActivity::addToLog('Event (' . $event->event_title_code . ') Created by ' . Auth::user()->name);



        $authoriserUsers = User::role('admin')->get();

        $title = 'Event';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $event->event_title_code,
                'title' => $title,
            ];

            Mail::send('emails.Actioncreate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });
        }

        return redirect()->back()->with('success', 'Event created successfully.');
    }







    public function editevent(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'event_title_code' => 'required',
            'event_description' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'venue' => 'required',
            'issuer' => 'required',
            'issuer_description' => 'required',
            'category_id' => 'required',
            'category_name' => 'required', // Ensure this is required if you need it
            'category_color' => 'required', // Ensure this is required if you need it
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find existing event
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        // Update event fields
        // $event->event_title_code = $request->input('event_title_code');
        // $event->event_description = $request->input('event_description');
        // $event->start_date = $request->input('start_date');
        // $event->start_time = $request->input('start_time');
        // $event->end_date = $request->input('end_date');
        // $event->end_time = $request->input('end_time');
        // $event->category_id = $request->input('category_id');
        // $event->category_name = $request->input('category_name');
        // $event->category_color = $request->input('category_color');
        // $event->issuer = $request->input('issuer');
        // $event->issuer_description = $request->input('issuer_description');
        // $event->venue = $request->input('venue');
        $event->status = 0;

        if ($request->hasFile('event_image')) {
            // Delete old image if exists
            if ($event->event_image && file_exists(public_path($event->event_image))) {
                unlink(public_path($event->event_image));
            }
            $file = $request->file('event_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/event_image/', $filename);
            $event->event_image = 'event_image/' . $filename;
        }

        $event->save();

        // Create and save event pending
        $eventPending = new EventPending();
        $eventPending->event_id = $event->id;
        $eventPending->event_title_code = $request->event_title_code;
        $eventPending->event_description = $request->event_description;
        $eventPending->start_date = $request->start_date;
        $eventPending->start_time = $request->start_time;
        $eventPending->end_date = $request->end_date;
        $eventPending->end_time = $request->end_time;
        $eventPending->category_id = $request->category_id;
        $eventPending->category_name = $request->category_name;
        $eventPending->category_color = $request->category_color;
        $eventPending->issuer = $request->issuer;
        $eventPending->issuer_description = $request->issuer_description;
        $eventPending->venue = $request->venue;
        $eventPending->event_image = $event->event_image;
        $eventPending->inputer_id = Auth::user()->id;
        $eventPending->status = 2;
        $eventPending->action_type = 'Update';

        $eventPending->save();

        LogActivity::addToLog('Event (' . $event->event_title_code . ') Updated by ' . Auth::user()->name);


        $authoriserUsers = User::role('admin')->get();

        $title = 'Group';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $eventPending->event_title_code,
                'title' => $title,
            ];

            Mail::send('emails.Actionupdate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Financial Markets Regulations & Rules Repository Portal');
            });
        }

        return redirect()->back()->with('success', 'Event updated successfully.');
    }



    // public function editevent(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'event_title_code' => 'required',
    //         'event_description' => 'required',
    //         'start_date' => 'required',
    //         'start_time' => 'required',
    //         'end_date' => 'required',
    //         'end_time' => 'required',
    //         'venue' => 'required',
    //         'issuer' => 'required',
    //         'issuer_description' => 'required',
    //     ]);


    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $event_update = Event::find($id);

    //     // Check if the event was found
    //     if (!$event_update) {
    //         return redirect()->back()->withErrors(['error' => 'Event not found']);
    //     }

    //     // Proceed with updating the event
    //     $slug = Str::slug($request->event_title_code);

    //     $event_update->event_title_code = $request['event_title_code'];
    //     $event_update->event_description = $request['event_description'];
    //     $event_update->start_date = $request['start_date'];
    //     $event_update->start_time = $request['start_time'];
    //     $event_update->end_date = $request['end_date'];
    //     $event_update->end_time = $request['end_time'];
    //     $event_update->slug = $slug;



    //     $event_update->issuer = $request['issuer'];
    //     $event_update->issuer_description = $request['issuer_description'];
    //     $event_update->venue = $request['venue'];

    //     $event_update->category_id = $request['category_id'];
    //     $event_update->category_name = $request['category_name'];
    //     $event_update->category_color = $request['category_color'];

    //     $event_update->save();

    //     // Handle event image upload
    //     // if ($request->hasFile('event_image')) {
    //     //     $file = $request->file('event_image');
    //     //     $extension = $file->getClientOriginalExtension();
    //     //     $filename = time() . '.' . $extension;
    //     //     $file->move('public/event_image/', $filename);
    //     //     $image = 'event_image/' . $filename;

    //     //     $event_update->event_image = $image;
    //     //     $event_update->save();
    //     // }


    //     if ($request->hasFile('event_image')) {
    //         $new_event_image = Event::find($event_update->id);
    //         $file = $request->file('event_image');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extension;
    //         $file->move('public/event_image/', $filename);
    //         $image = 'event_image/' . $filename;

    //         $new_event_image->event_image = $image;
    //         $new_event_image->save();
    //     }

    //     LogActivity::addToLog('Event (' . $request['event_title_code'] . ') Updated by ' . Auth::user()->name);


    //     return redirect()->back()->with('success', 'Event updated successfully.');
    // }





    public function statusevent(Request $request, $id)
    {

        // return $request;
        $validator = Validator::make($request->all(), [
            'status' => 'required',

        ]);


        $event = Event::find($id);


        // Proceed with updating the Category
        $event->status = $request['status'];
        $event->save();


        $eventPending = new EventPending();
        $eventPending->event_id = $event->id;
        $eventPending->event_title_code = $event->event_title_code;
        $eventPending->event_description = $event->event_description;
        $eventPending->start_date = $event->start_date;
        $eventPending->start_time = $event->start_time;
        $eventPending->end_date = $event->end_date;
        $eventPending->end_time = $event->end_time;
        $eventPending->category_id = $event->category_id;
        $eventPending->category_name = $event->category_name;
        $eventPending->category_color = $event->category_color;
        $eventPending->issuer = $event->issuer;
        $eventPending->issuer_description = $event->issuer_description;
        $eventPending->venue = $event->venue;
        $eventPending->inputer_id = Auth::user()->id;
        $eventPending->status =  $request['status'];
        $eventPending->action_type = 'Change Status';

        $eventPending->save();

        LogActivity::addToLog('Event (' . $event->event_title_code . ') Event status updated by ' . Auth::user()->name);

        return redirect()->back()->with('success', 'Event status successfully updated.');

        // OK
    }



    public function deleteEvent($id)
    {
        // Find the existing event
        $event = Event::find($id);
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        // Create and save event pending
        $eventPending = new EventPending();
        $eventPending->event_id = $event->id;
        $eventPending->event_title_code = $event->event_title_code;
        $eventPending->event_description = $event->event_description;
        $eventPending->start_date = $event->start_date;
        $eventPending->start_time = $event->start_time;
        $eventPending->end_date = $event->end_date;
        $eventPending->end_time = $event->end_time;
        $eventPending->category_id = $event->category_id;
        $eventPending->category_name = $event->category_name;
        $eventPending->category_color = $event->category_color;
        $eventPending->issuer = $event->issuer;
        $eventPending->issuer_description = $event->issuer_description;
        $eventPending->venue = $event->venue;
        $eventPending->inputer_id = Auth::user()->id;
        $eventPending->status = 3;
        $eventPending->action_type = 'Delete';

        $event->status = 3;
        $event->save();
        $eventPending->save();

        LogActivity::addToLog('Event (' . $event->event_title_code . ') marked for deletion by ' . Auth::user()->name);

        return redirect()->back()->with('success', 'Event marked for deletion successfully.');
    }






    public function eventstatus(Request $request, $id)
    {
        // return  $request;

        $update_status = Event::find($id);
        $update_status_pending = EventPending::where('event_id', $id)->orderBy('created_at', 'desc')->first();


        if ($request->status == 1) {
            $update_status->status = $request->status;

            $update_status->event_title_code = $update_status_pending->event_title_code;
            $update_status->event_description = $update_status_pending->event_description;
            $update_status->start_date = $update_status_pending->start_date;
            $update_status->start_time = $update_status_pending->start_time;
            $update_status->end_date = $update_status_pending->end_date;
            $update_status->end_time = $update_status_pending->end_time;
            $update_status->category_id = $update_status_pending->category_id;
            $update_status->category_name = $update_status_pending->category_name;
            $update_status->category_color = $update_status_pending->category_color;
            $update_status->issuer = $update_status_pending->issuer;
            $update_status->issuer_description = $update_status_pending->issuer_description;
            $update_status->venue = $update_status_pending->venue;


            $update_status_pending->status = $request->status;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->event_title_code;

            $this->ApprovenotifyUsers($action);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }




        if ($request->status == 2) {
            $update_status->status = $request->status;
            $update_status_pending->status = $request->status;
            $update_status_pending->note = $request->note;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            $action = $update_status->event_title_code;
            $note = $request->note;

            $this->notifyUsersOfRejection($action, $note);

            return redirect()->back()->with('success', 'Request rejected.');
        }



        if ($request->status == 3) {

            $update_status_pending->authorizer_id = Auth::user()->id;
            $update_status_pending->save();

            Event::find($id)->delete();

            $action = $update_status_pending->event_title_code;

            $this->notifyUsersOfDeletion($action);

            return redirect()->back()->with('success', 'Request approved.');
        }



        if ($request->status == 4) {

            $update_status->status = 5;
            $update_status_pending->status = 5;


            $update_status_pending->authorizer_id = Auth::user()->id;
            $update_status_pending->save();
            $update_status->save();



            $action = $update_status_pending->event_title_code;

            $this->notifyUsersOfDeletion($action);

            return redirect()->back()->with('success', 'Request approved.');
        }



        if ($request->status == 6) {

            $update_status->status = 1;
            $update_status_pending->status = 1;


            $update_status_pending->authorizer_id = Auth::user()->id;
            $update_status_pending->save();
            $update_status->save();



            $action = $update_status_pending->event_title_code;

            $this->notifyUsersOfDeletion($action);

            return redirect()->back()->with('success', 'Request approved.');
        }
    }


    private function ApprovenotifyUsers($action)
    {
        $authoriserUsers = User::role('user')->get(); // Ensure this role exists and is correct

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $action,
            ];

            Mail::send('emails.Actionapproved', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Event Approved')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
        }
    }





    private function notifyUsersOfRejection($action, $note)
    {
        $authoriserUsers = User::role('user')->get(); // Ensure the role exists

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $action,
                'note' => $note,
            ];

            Mail::send('emails.Actionrejected', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Event Rejected')
                    ->from(env('MAIL_FROM_ADDRESS', 'no-reply@example.com'), env('MAIL_FROM_NAME', 'Your Application Name'));
            });
        }
    }




    private function notifyUsersOfDeletion($action)
    {
        $authoriserUsers = User::role('user')->get(); // Ensure this role exists

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email' => $user->email,
                'action' => $action,
            ];

            Mail::send('emails.Actiondelete', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Event Deleted')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
        }
    }
}
