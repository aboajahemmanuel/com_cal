<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $categories = Category::where('status', 1)->get();
        return response()->json($categories);
    }





    public function index(Request $request)
    {




        $data = Category::orderBy('created_at', 'desc')->get();

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request;
        $this->validate($request, [
            // 'name' => 'required',
            'name' => 'required|unique:categories,name',


        ]);




        $new_category = new category();
        $new_category->name = $request['name'];
        $new_category->code = $request['code'];
        $new_category->color = $request['color'];



        $new_category->save();


        LogActivity::addToLog('Corporate Action Category (' . $request->name . ') Created by ' . Auth::user()->name);

        return redirect()->back()->with('success', 'Event category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = category::find($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category::find($id);

        return view('categories.edit', compact('category'));
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
        $category = category::find($id);
        $name =  $request->input('name');

        if ($name == $category->name) {

            $category->name = $request->input('name');
            $category->code = $request->input('code');
            $category->color = $request['color'];



            $category->save();
        } else {
            $this->validate($request, [
                'name' => 'required|unique:categories,name',
            ]);

            $category->name = $request->input('name');
            $category->code = $request->input('code');

            $category->color = $request['color'];




            $category->save();
        }




        LogActivity::addToLog('Corporate Action Category (' . $category->name . ') Updated by ' . Auth::user()->name);


        return redirect()->back()->with('success', 'Event category updated successfully.');
    }

    public function statuscategory(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',

        ]);


        $category_update = category::find($id);


        // Proceed with updating the Category
        $category_update->status = $request['status'];
        $category_update->save();

        LogActivity::addToLog('Corporate Action Category (' . $category_update->name . ') Category status updated by' . Auth::user()->name);

        return redirect()->back()->with('success', 'category status successfully updated.');

        // OK
    }


    public function destroy($id)
    {

        $category_update = category::find($id);
        LogActivity::addToLog('Corporate Action Category (' . $category_update->name . ') Category deleted by ' . Auth::user()->name);
        category::find($id)->delete();

        return redirect()->back()->with('success', 'category deleted  successfully.');
    }
}
