<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Market;
use App\Models\Category;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\CashIMCollatera;
use App\Models\NonCashIMCollatera;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {

        //return Redirect::to('reports');


        $category = Category::count();
        $category_active = Category::where('status', 1)->count();
        $category_inactive = Category::where('status', 0)->count();

        $events = Event::count();
        $events_active = Event::where('status', 1)->count();
        $events_inactive = Event::where('status', 0)->count();


        $statusCounts = DB::table('events')
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');




        return view('admin.dashboard', compact('category', 'events', 'category_active', 'category_inactive', 'events_active', 'events_inactive'));
    }
}
