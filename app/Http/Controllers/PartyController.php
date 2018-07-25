<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party as Party;
use DB;

class PartyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [];
        $data['parties'] = Party::select('id','party','gst_no')->get();

        return view('Party.index', $data);
    }

    public function create(Request $request)
    {
        $party = new Party;
        $party->party = $request->input('party');
        $party->gst_no = $request->input('gst_no');
        
        $party->save();
        $notification = array(
            'message' => 'Data Saved Succesfuly!',
            'alert-type'=>'success');
        return back()->with($notification);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        $count = DB::table('purchases')->where('party_id', $id)->count('party_id');
        if($count==0){
            $party = Party::find($id);
            $party->delete();
            
            $notification = array(
                'message' => 'Record Deleted Succesfuly !',
                'alert-type'=>'success');
        }
        else{
            $notification = array(
                'message' => 'Party has '.$count.' purchases records so it can\'t be Deleted ! ',
                'alert-type'=>'danger');
        } 
        return back()->with($notification);
    }
}
