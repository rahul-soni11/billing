<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party as Party;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
   
    public function sel_smritinagar()
    {
        session()->put('branch', 'Smriti Nagar');
        return back();
    }
    public function sel_nehrunagar()
    {
        session()->put('branch', 'Nehru Nagar');
        return back();
    }    

    public function sel_party($id)
    {
        $party =  Party::select('id','party','gst_no')->find($id);
        session()->put('party_id', $party->id);
        session()->put('party_name', $party->party);
        session()->put('party_gst_no', $party->gst_no);
        return back();        
    }
}
