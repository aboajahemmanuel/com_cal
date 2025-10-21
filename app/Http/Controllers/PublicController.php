<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Market;
use App\Models\Category;
use App\Models\Contract;
use App\Models\ImResult;
use App\Models\Denomination;
use App\Models\SecurityType;
use Illuminate\Http\Request;
use App\Models\CashIMCollatera;
use App\Models\NonCashIMCollatera;
use App\Models\Security;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Redirect;

class PublicController extends Controller
{
    public function im_calculate()
    {
        $data['countries'] = Market::get(["name", "id"]);
        return view('im_calculate', $data);

        //return view('im_calculate');
    }

    public function im_results($ip)
    {
        //return $ip;
        $data['countries'] = Market::get(["name", "id"]);

        $todayrecord = Carbon::today();
        $im_results = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->get();
        $totalNetPosition = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('net_position');
        $totalNetIM = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('initial_margin');
        $totalNV = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('nominal_value');

        // if (count($im_results) === 0 || !session()->has('ip')) {
        //     return Redirect::to('/');
        // }


        // if (!session()->has('ip')) {

        //     return Redirect::to('/');
        // }

        if (count($im_results) === 0 && !session()->has('ip')) {
            return Redirect::to('/');
        }

        //  $salesCountToday = PaypalPayment::whereDate('created_at', $todayrecord)->count();

        return view('im_results', $data, compact('im_results', 'totalNetPosition', 'totalNetIM', 'ip', 'totalNV'));
        //return view('im_results');
    }


    public function im_report($ip)
    {
        // $data['countries'] = Market::get(["name", "id"]);
        $todayrecord = Carbon::today();
        $im_results = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->get();
        $totalNetPosition = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('net_position');
        $totalim_obligation = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('initial_margin');
        $totalNV = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('nominal_value');
        $category = Category::all();



        if (count($im_results) === 0 && !session()->has('ip')) {
            return Redirect::to('/');
        }


        return view('im_report', compact('im_results', 'totalNetPosition', 'totalim_obligation', 'ip', 'totalNV', 'category'));
        // return view('im_report');
    }


    public function collateral_report($ip)
    {

        $ip;
        $data['countries'] = Market::get(["name", "id"]);

        // CASH 

        $todayrecord = Carbon::today();
        $im_results = CashIMCollatera::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->get();
        $totalNetPosition = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('net_position');
        $totalim_obligation = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('initial_margin');
        $totalNetIM = CashIMCollatera::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('marketvalue');
        $totalfacevalue = CashIMCollatera::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('facevalue');
        $denominatios = Denomination::all();




        //NON-CASH


        $n_im_results = NonCashIMCollatera::where('user_ip', $ip)->get();
        $security_type = SecurityType::all();
        $totalMV = NonCashIMCollatera::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('marketvalue');
        $totalNCFACE = NonCashIMCollatera::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('facevalue');




        $im_prt_builder = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->get();
        $totalNetPosition_port_builder = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('net_position');
        $totalNetIM_port_builder = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('initial_margin');
        $totalNV = ImResult::where('user_ip', $ip)->whereDate('created_at', $todayrecord)->sum('nominal_value');


        if (count($im_prt_builder) === 0 || !session()->has('ip')) {
            return Redirect::to('/');
        }


        return view('collateral_report', $data, compact('im_results', 'totalNetPosition', 'totalNetIM', 'ip', 'totalim_obligation', 'denominatios', 'totalfacevalue', 'n_im_results', 'security_type', 'totalMV', 'totalNCFACE', 'totalNV', 'totalNetIM_port_builder', 'totalNetPosition_port_builder', 'im_prt_builder'));
    }

    public function fetchRate(Request $request)
    {
        $data['rates'] = Contract::where("id", $request->state_id)
            ->get(["im_Rate", "id"]);

        return response()->json($data);
    }


    public function fetchNominalValue(Request $request)
    {
        $data['nominal_value'] = Contract::where("id", $request->state_id)
            ->get(["nominal_value", "id"]);

        return response()->json($data);
    }




    public function fetchExRate(Request $request)
    {
        $data['rate'] = Denomination::where("id", $request->country_id)
            ->get(["rate", "id"]);

        return response()->json($data);
    }















    public function fetchCategory(Request $request)
    {
        $categories = Category::where("id", $request->category_id)
            ->get(["name", "id"]);
        return response()->json($categories);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchColor(Request $request)
    {
        $color = Category::where("id", $request->category_id)
            ->get(["color", "id"]);

        return response()->json($color);
    }



    public function fetchSecurity(Request $request)
    {
        $data['securities'] = Security::where("security_type_id", $request->security_id)
            ->get(["name", "id"]);

        return response()->json($data);
    }


    public function fetchSecurityPrice(Request $request)
    {
        $data['security_price'] = Security::where("id", $request->sec_id)
            ->get(["securityprice", "id"]);

        return response()->json($data);
    }


    public function fetchCurrency(Request $request)
    {

        $sec_type =  SecurityType::where("id", $request->currency_id)->first();

        $data['currency'] = Denomination::where("id", $sec_type->denominations_id)
            ->get();

        return response()->json($data);
    }









    public function im_submit(Request $request)
    {

        $request;

        $net_position = str_replace(',', '', $request['net_position']);
        $price = str_replace(',', '', $request['price']);

        if (session()->has('ip')) {

            $ip = session('ip');

            $market = $request['market'];
            $category = $request['category'];
            $contract = $request['contract'];
            $nominal_value = $request['nominal_value'];
            $net_position = $net_position;
            $price = $price;


            $marketDetails = Market::where('id', $market)->first();
            $marketName = $marketDetails->name;

            $catDetails = Category::where('id', $category)->first();
            $catName = $catDetails->name;

            $contractdetails = Contract::where('id', $contract)->first();
            $contractName = $contractdetails->name;
            $nominal_value = $contractdetails->nominal_value;
            $im_Rate = $contractdetails->im_Rate;

            $im_Rate_cal = $im_Rate / 100;

            $nominal_value_cal = $net_position * $nominal_value;
            $created_at = date('Y-m-d');


            if ($contractdetails->contract_type == 1) {

                $percentage_price = $price / 100;

                $initial_margin =  $nominal_value_cal  * $percentage_price * $im_Rate_cal;
            }



            if ($contractdetails->contract_type == 2) {


                $initial_margin =  $nominal_value_cal  * $price * $im_Rate_cal;
            }






            $new_result = new ImResult();
            $new_result->marketName = $marketName;
            $new_result->catName = $catName;
            $new_result->contractName = $contractName;
            $new_result->nominal_value = $nominal_value_cal;
            $new_result->initial_margin = $initial_margin;
            $new_result->user_ip = $ip;
            $new_result->net_position = $net_position;
            $new_result->price = $price;
            $new_result->im_Rate = $im_Rate;
            $new_result->created_at = $created_at;


            $new_result->save();

            return Redirect::to('/im_results/' . $ip)->with('success', 'Portfolio Created');

            // return Redirect::to('/im_results/' . $ip)->with('create', '');
        } else {
            $market = $request['market'];
            $category = $request['category'];
            $contract = $request['contract'];
            $nominal_value = $request['nominal_value'];
            $net_position = $net_position;
            $price = $price;


            $marketDetails = Market::where('id', $market)->first();
            $marketName = $marketDetails->name;

            $catDetails = Category::where('id', $category)->first();
            $catName = $catDetails->name;

            $contractdetails = Contract::where('id', $contract)->first();
            $contractName = $contractdetails->name;
            $nominal_value = $contractdetails->nominal_value;
            $im_Rate = $contractdetails->im_Rate;


            $nominal_value_cal = $net_position * $nominal_value;
            $im_Rate_cal = $im_Rate / 100;



            $ip = Str::random(12);

            session(['ip' => $ip]);

            $created_at = date('Y-m-d');
            if ($contractdetails->contract_type == 1) {

                $percentage_price = $price / 100;

                $initial_margin =  $nominal_value_cal  * $percentage_price * $im_Rate_cal;
            }



            if ($contractdetails->contract_type == 2) {


                $initial_margin =  $nominal_value_cal  * $price * $im_Rate_cal;
            }





            // $initial_margin =  $nominal_value * $net_position * $price * $im_Rate;




            $new_result = new ImResult();
            $new_result->marketName = $marketName;
            $new_result->catName = $catName;
            $new_result->contractName = $contractName;
            $new_result->nominal_value = $nominal_value_cal;
            $new_result->initial_margin = $initial_margin;
            $new_result->user_ip = $ip;
            $new_result->net_position = $net_position;
            $new_result->price = $price;
            $new_result->im_Rate = $im_Rate;
            $new_result->created_at = $created_at;



            $new_result->save();

            return Redirect::to('/im_results/' . $ip)->with('success', 'Portfolio Created');

            //return Redirect::to('/im_results/' . $ip)->with('success', 'Portfolio Created');
        }
    }



    public function im_update(Request $request, $id)
    {

        // return  $request;

        $net_position = str_replace(',', '', $request['net_position']);
        $price = str_replace(',', '', $request['price']);



        $market = $request['market'];
        $category = $request['category'];
        $contract = $request['contract'];
        $nominal_value = $request['nominal_value'];
        $net_position = $net_position;
        $price = $price;


        $marketDetails = Market::where('id', $market)->first();
        $marketName = $marketDetails->name;

        $catDetails = Category::where('id', $category)->first();
        $catName = $catDetails->name;

        $contractdetails = Contract::where('id', $contract)->first();
        $contractName = $contractdetails->name;
        $nominal_value = $contractdetails->nominal_value;
        $im_Rate = $contractdetails->im_Rate;

        $im_Rate_cal = $im_Rate / 100;

        $nominal_value_cal = $net_position * $nominal_value;
        $created_at = date('Y-m-d');


        if ($contractdetails->contract_type == 1) {

            $percentage_price = $price / 100;

            $initial_margin =  $nominal_value_cal  * $percentage_price * $im_Rate_cal;
        }



        if ($contractdetails->contract_type == 2) {


            $initial_margin =  $nominal_value_cal  * $price * $im_Rate_cal;
        }




        $new_result = ImResult::find($id);

        $new_result->marketName = $marketName;
        $new_result->catName = $catName;
        $new_result->contractName = $contractName;
        $new_result->nominal_value = $nominal_value_cal;
        $new_result->initial_margin = $initial_margin;
        $new_result->net_position = $net_position;
        $new_result->price = $price;
        $new_result->im_Rate = $im_Rate;
        $new_result->created_at = $created_at;


        $new_result->save();

        return Redirect::to('/im_results/' . $new_result->user_ip)->with('success', 'Portfolio Created');
    }



    public function deleteim($id)
    {
        ImResult::find($id)->delete();

        return redirect()->back()->with('success', 'Portfolio Deleted');
    }
}
