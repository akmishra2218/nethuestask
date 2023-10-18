<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CompanyListController extends Controller
{
    public function index()
    {
        return view('company.show');
    }


    public function create()
    {

        $response = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');

        if ($response->ok()) {
            $data = $response->json();
            $symbols = collect($data)->pluck('Symbol')->toArray();
        } else {
            $symbols = [];
        }

        return view('company.companyForm', compact('symbols'));
    }
    public function saveLists(Request $request)
    {

        $request->validate([
            'company_symbol' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'email' => 'required|email|max:255',

        ]);

        try {

            $symbol = $request->input('company_symbol');
            $sdate = $request->input('start_date');
            $edate = $request->input('end_date');

            $response = Http::withHeaders([
                'X-RapidAPI-Key' => config('app.rapidapi_key'),
                'X-RapidAPI-Host' => config('app.rapidapi_host'),
            ])->get('https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data', [
                'symbol' => $symbol,
                'sdate' => $sdate,
                'edate' => $edate,
            ]);

            $data = $response->json();
            $historicalData = $data['prices'];

            return view('company.show', compact('historicalData'));

        } catch (\Exception $e) {

            return redirect()->back()->withError('Something went wrong. Please try again');
        }
    }
}
