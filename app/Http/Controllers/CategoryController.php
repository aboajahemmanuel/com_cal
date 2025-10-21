<?php
namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use App\Models\CategoriesPending;
use App\Models\Category;
use App\Models\User;
use App\Services\CustomLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */

    public function categories()
    {

        $categories = Category::where('deleted_at', null)->where('status', 1)->get();
        return response()->json($categories);
    }

    public function index(Request $request)
    {

        $data = Category::where('deleted_at', null)->orderBy('created_at', 'desc')->get();

        return view('categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories,name',
        ], [
            'name.required' => 'Category name is required.',
            'name.unique'   => 'The category name must be unique. This name has already been taken.',
        ]);

        $new_category        = new Category();
        $new_category->name  = $request['name'];
        $new_category->code  = $request['code'];
        $new_category->color = $request['color'];

        $new_category->save();

        $category_pending              = new CategoriesPending();
        $category_pending->category_id = $new_category->id;
        $category_pending->name        = $request['name'];
        //$category_pending->code        = $request['code'];
        $category_pending->color       = $request['color'];
        $category_pending->inputer_id  = Auth::user()->id;
        $category_pending->status      = 0;
        $category_pending->action_type = 'Insert';

        $category_pending->save();

        LogActivity::addToLog('New Corporate Action Category (' . $new_category->name . ') Created by ' . Auth::user()->name);

        $authoriserUsers = User::role('Admin')->get();
        $title           = 'Category';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $new_category->name,
                'title'  => $title,
            ];

            Mail::send('emails.Actioncreate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }

        return redirect()->back()->with('success', 'Category successfully created and pending approval.');
    }

    public function show($id)
    {
        $category = category::find($id);

        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = category::find($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        CustomLogger::logAction('Category Update', 'Initiated', ['user_id' => Auth::id(), 'category_id' => $id]);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::find($id);
        if (! $category) {
            CustomLogger::logAction('Category Update', 'Failed - Not Found', ['category_id' => $id, 'user_id' => Auth::id()]);
            return redirect()->back()->with('error', 'Category not found.');
        }

        $existingCategory = Category::where('name', $request->input('name'))
            ->where('id', '!=', $id)
            ->first();

        if ($existingCategory) {
            CustomLogger::logAction('Category Update', 'Failed - Duplicate Name', ['category_id' => $id, 'user_id' => Auth::id(), 'existing_category_id' => $existingCategory->id]);
            return redirect()->back()->with('error', 'A category with the given name already exists.');
        }

        $category->admin_status = 0;
        $category->save();
        CustomLogger::logAction('Category Update', 'Category Updated', ['category_id' => $id, 'user_id' => Auth::id()]);

        $categoryPending              = new CategoriesPending();
        $categoryPending->category_id = $id;
        $categoryPending->name        = $request->input('name');
        $categoryPending->code        = $request->input('code');
        $categoryPending->color       = $request->input('color');
        $categoryPending->inputer_id  = Auth::user()->id;
        $categoryPending->status      = 0;
        $categoryPending->action_type = 'Edit';
        $categoryPending->save();

        LogActivity::addToLog('Update Corporate Action Category (' . $category->name . ') Created by ' . Auth::user()->name);

        // CustomLogger::logAction('Category Update', 'Pending Approval Created', ['pending_id' => $categoryPending->id, 'user_id' => Auth::id()]);

        $authoriserUsers = User::role('Admin')->get();
        $title           = 'Category';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $categoryPending->name,
                'title'  => $title,
            ];

            Mail::send('emails.Actionupdate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }

        CustomLogger::logAction('Corporate Action Category Update', 'Approval Email Sent', ['category_name' => $categoryPending->name, 'user_id' => Auth::id()]);

        return redirect()->back()->with('success', 'Category updated successfully and pending approval.');
    }

    public function statuscategory(Request $request, $id)
    {
        //return $request;

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        $category_update = Category::find($id);
        if (! $category_update) {
            LogActivity::addToLog('Category Status Update Failed - Category Not Found by ' . Auth::user()->name, ['category_id' => $id]);
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Proceed with updating the Category
        $category_update->admin_status = $request['status'];
        $category_update->save();

        $categoryPending              = new CategoriesPending();
        $categoryPending->category_id = $id;
        $categoryPending->name        = $category_update->name;
        //$categoryPending->code        = $category_update->code;
        $categoryPending->color       = $category_update->color;
        $categoryPending->inputer_id  = Auth::user()->id;
        $categoryPending->status      = 0;
        $categoryPending->action_type = 'Change Status';
        $categoryPending->save();

        if ($request['status'] == 4) {
            LogActivity::addToLog('Corporate Action Category (' . $category_update->name . ') status changed to inactive updated by ' . Auth::user()->name);
        }

        if ($request['status'] == 6) {
            LogActivity::addToLog('Corporate Action Category (' . $category_update->name . ') status changed to active updated by ' . Auth::user()->name);
        }

        $authoriserUsers = User::role('Admin')->get();
        $title           = 'Category';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $categoryPending->name,
                'title'  => $title,
            ];

            Mail::send('emails.Actionupdate', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }

        return redirect()->back()->with('success', 'Category status successfully updated.');
    }

    public function destroy($id)
    {

        $category = Category::find($id);

        $category->admin_status = 3;

        $category->save();

        $category_pending              = new CategoriesPending();
        $category_pending->category_id = $id;
        $category_pending->inputer_id  = Auth::user()->id;
        $category_pending->status      = 0;
        $category_pending->action_type = 'Delete';

        $category_pending->save();

        $authoriserUsers = User::role('Admin')->get();

        $title = 'Category';

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $category->name,
                'title'  => $title,
            ];

            Mail::send('emails.ActiondeletePending', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Awaiting Approval')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }

        LogActivity::addToLog('Corporate Action Category (' . $category->name . ') Category deleted by ' . Auth::user()->name);

        return redirect()->back()->with('success', 'Category deleted  successfully  and pending approval.');
    }

    public function catstatus(Request $request, $id)
    {
        $request;

        $update_status         = Category::find($id);
        $update_status_pending = CategoriesPending::where('category_id', $id)->where('status', 0)->where(
            'authorizer_id',
            null
        )->orderBy('created_at', 'desc')->first();

        $update_status_delete = CategoriesPending::where('category_id', $id)
            ->where('status', 0)
            ->where('action_type', 'delete')
            ->where('authorizer_id', null)
            ->orderBy('created_at', 'desc')
            ->first();

        if (
            $request->status == 3 && $update_status_pending->action_type == 'Delete'
        ) {

            $update_status_pending->status        = 1;
            $update_status->deleted_at            = now();
            $update_status_pending->authorizer_id = Auth::user()->id;
            $update_status_pending->save();
            $update_status->save();

            LogActivity::addToLog('Category Delete Request (' . $update_status->name . ') Approved by ' . Auth::user()->name);

            $entityName = $update_status->name;

            $this->notifyUsersOfDeletion($entityName);

            return redirect()->back()->with('success', 'Request approved.');
        }

        if (
            $request->status == 2 && $update_status_pending->action_type == 'Delete'
        ) {

            $update_status->status                = 1;
            $update_status->admin_status          = 1;
            $update_status_pending->status        = 1;
            $update_status_pending->note          = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;

            $update_status->save();
            $update_status_pending->save();

            LogActivity::addToLog('Category Delete Request (' . $update_status->name . ') Rejected by ' . Auth::user()->name);

            $this->notifyUsersOfRejection($update_status->name, $request->note);

            return redirect()->back()->with('success', 'Request rejected.');
        }

        if ($request->status == 1 && $update_status_pending->action_type == 'Edit') {
            $update_status->name         = $update_status_pending->name;
            $update_status->color        = $update_status_pending->color;
            $update_status->code         = $update_status_pending->code;
            $update_status->status       = $request->status;
            $update_status->admin_status = $request->status;

            $update_status_pending->status        = $request->status;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            LogActivity::addToLog('Update Category Request (' . $update_status->name . ') Approved by ' . Auth::user()->name);

            $this->ApprovenotifyUsers($update_status->name);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }

        if (
            $request->status == 1 && $update_status_pending->action_type == 'Insert'
        ) {

            $update_status->status       = $request->status;
            $update_status->admin_status = $request->status;

            $update_status_pending->status        = $request->status;
            $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

            $update_status->save();
            $update_status_pending->save();

            LogActivity::addToLog('New Category Request (' . $update_status->name . ') Approved by ' . Auth::user()->name);

            $this->ApprovenotifyUsers($update_status->name);

            return redirect()->back()->with('success', 'Request approved successfully.');
        }

        if (
            $request->status == 2 && $update_status_pending->action_type == 'Insert'
        ) {

            $update_status->status                = $request->status;
            $update_status->admin_status          = $request->status;
            $update_status_pending->status        = $request->status;
            $update_status_pending->note          = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;

            $update_status->save();
            $update_status_pending->save();

            LogActivity::addToLog('New Category Request (' . $update_status->name . ') Rejected by ' . Auth::user()->name);

            $this->notifyUsersOfRejection($update_status->name, $request->note);

            return redirect()->back()->with('success', 'Request rejected.');
        }

        if (
            $request->status == 2 && $update_status_pending->action_type == 'Edit'
        ) {

            $update_status->status                = 1;
            $update_status->admin_status          = 1;
            $update_status_pending->status        = $request->status;
            $update_status_pending->note          = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;

            $update_status->save();
            $update_status_pending->save();

            LogActivity::addToLog('Update Category Request (' . $update_status->name . ') Rejected by ' . Auth::user()->name);

            $this->notifyUsersOfRejection($update_status->name, $request->note);

            return redirect()->back()->with('success', 'Request rejected.');
        }

        if (
            $request->status == 2 && $update_status_pending->action_type == 'Delete'
        ) {

            $update_status->status                = 1;
            $update_status->admin_status          = 1;
            $update_status_pending->status        = $request->status;
            $update_status_pending->note          = $request->note;
            $update_status_pending->authorizer_id = Auth::user()->id;

            $update_status->save();
            $update_status_pending->save();

            LogActivity::addToLog('Delete Category Request (' . $update_status->name . ') Rejected by ' . Auth::user()->name);

            $this->notifyUsersOfRejection($update_status->name, $request->note);

            return redirect()->back()->with('success', 'Request rejected.');
        }

        if (
            $request->status == 4 && $update_status_pending->action_type == 'Change Status'
        ) {

            $update_status->status         = 5;
            $update_status->admin_status   = 5;
            $update_status_pending->status = 5;

            $update_status_pending->authorizer_id = Auth::user()->id;
            $update_status_pending->save();
            $update_status->save();

            $action = $update_status_pending->event_title_code;

            $this->ApprovenotifyUsers($action);
            LogActivity::addToLog('Category (' . $update_status->name . ') status changed to inactive Approved  by ' . Auth::user()->name);

            return redirect()->back()->with('success', 'Request approved.');
        }

        if ($request->status == 2 && $update_status_pending->action_type == 'Change Status') {
            // return '3';
            if ($update_status->admin_status == 6) {
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

                LogActivity::addToLog('Category (' . $update_status->event_title_code . ') status changed to active rejected  by ' . Auth::user()->name);

                return redirect()->back()->with('success', 'Request rejected.');

            }

            if ($update_status->admin_status == 4) {
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

                LogActivity::addToLog('Category (' . $update_status->event_title_code . ') status changed to inactive rejected  by ' . Auth::user()->name);

                return redirect()->back()->with('success', 'Request rejected.');

            }
        }

        if (
            $request->status == 6 && $update_status_pending->action_type == 'Change Status'
        ) {

            $update_status->status         = 1;
            $update_status->admin_status   = 1;
            $update_status_pending->status = 1;

            $update_status_pending->authorizer_id = Auth::user()->id;
            $update_status_pending->save();
            $update_status->save();

            LogActivity::addToLog('Category (' . $update_status->event_title_code . ') status changed to active Approved  by ' . Auth::user()->name);

            $action = $update_status_pending->event_title_code;

            $this->ApprovenotifyUsers($action);

            return redirect()->back()->with('success', 'Request approved.');
        }

        if (
            $request->status == 2 && $update_status_pending->action_type == 'Change Status'
        ) {
            // return "jjdjdjd";

            if ($update_status->admin_status == 6) {
                $update_status->status                = 5;
                $update_status->admin_status          = 5;
                $update_status_pending->status        = $request->status;
                $update_status_pending->note          = $request->note;
                $update_status_pending->authorizer_id = Auth::id(); // Assuming the user is authenticated

                $update_status->save();
                $update_status_pending->save();

                LogActivity::addToLog('Category (' . $update_status->event_title_code . ') status changed to active Rejected  by ' . Auth::user()->name);

                $action = $update_status->event_title_code;
                $note   = $request->note;

                $this->notifyUsersOfRejection($action, $note);

                return redirect()->back()->with('success', 'Request rejected');
            }

            if ($update_status->admin_status == 4) {
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

                return redirect()->back()->with('success', 'Request rejected');
            }
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
                    ->subject('Category Approved')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }
    }

    private function notifyUsersOfRejection($actionName, $note)
    {
        $authoriserUsers = User::role('Admin')->get(); // Ensure the role exists

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $actionName,
                'note'   => $note,
            ];

            Mail::send('emails.Actionrejected', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Category Rejected')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }
    }

    private function notifyUsersOfDeletion($entityName)
    {
        $authoriserUsers = User::role('Admin')->get(); // Ensure this role exists

        foreach ($authoriserUsers as $user) {
            $email_data = [
                'email'  => $user->email,
                'action' => $entityName,
            ];

            Mail::send('emails.Actiondelete', $email_data, function ($message) use ($email_data) {
                $message->to($email_data['email'])
                    ->subject('Category Deleted')
                    ->from('no-reply@fmdqgroup.com', 'Corporate Action Calendar');
            });
        }
    }
}
