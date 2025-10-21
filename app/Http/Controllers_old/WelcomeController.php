<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\Issuer;
use App\Models\Market;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {

        $category_color = Category::all();

        $data = Issuer::orderBy('id', 'DESC')->first();

        return view('welcome', compact('data', 'category_color'));
    }
}
