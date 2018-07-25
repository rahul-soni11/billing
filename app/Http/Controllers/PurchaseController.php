<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Party as Party;
use App\Purchase as Purchase;


class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Display form
    public function viewform()
    {
        $data = [];
        $data['parties'] = Party::select('id','party','gst_no')->get();

        return view('Purchase.form', $data);
    }

    //Index Method
    public function index(Request $request)
    {
        $url = $request->url();
        
        if($url == "http://jewellery/purchase/gold")
        {
            $category = "gold";
        }
        if($url == "http://jewellery/purchase/silver")
        {
            $category = "silver";
        }
        
        if($url == "http://jewellery/purchase/diamond")
        {
            $category = "diamond";
        }
        
        if($url == "http://jewellery/purchase/gemstone")
        {
            $category = "gems";
        }
             

        if($request->has('from') && $request->has('to'))
        {
            $data['from'] = $request->input('from');
            $data['to'] = $request->input('to');

            $data['purchases']= DB::table('purchases')
                                ->select('purchases.id','purchases.date','purchases.bill_no', 'purchases.qty', 'purchases.texable', 'purchases.s_amount', 'purchases.c_amount', 'purchases.i_amount', 'purchases.total', 'purchases.hsn_sac', 'parties.party', 'parties.gst_no')
                                ->join('parties', 'parties.id', '=', 'purchases.party_id')
                                ->where('category', $category)
                                ->whereBetween('date', [ $data['from'], $data['to'] ])
                                ->get();
            $data['count'] = count($data['purchases']);

            $data['sum_qty'] = DB::table('purchases')->where('category', $category)->whereBetween('date', [ $data['from'], $data['to'] ])->sum('qty');            
            $data['sum_texable'] = DB::table('purchases')->where('category', $category)->whereBetween('date', [ $data['from'], $data['to'] ])->sum('texable');            
            $data['sum_s_amount'] =  DB::table('purchases')->where('category', $category)->whereBetween('date', [ $data['from'], $data['to'] ])->sum('s_amount');
            $data['sum_c_amount'] =  DB::table('purchases')->where('category', $category)->whereBetween('date', [ $data['from'], $data['to'] ])->sum('c_amount');
            $data['sum_i_amount'] =  DB::table('purchases')->where('category', $category)->whereBetween('date', [ $data['from'], $data['to'] ])->sum('i_amount');
            $data['sum_total'] =  DB::table('purchases')->where('category', $category)->whereBetween('date', [ $data['from'], $data['to'] ])->sum('total');
        
        }else{
            
            $data['purchases']= DB::table('purchases')
            ->select('purchases.id','purchases.date','purchases.bill_no', 'purchases.qty', 'purchases.texable', 'purchases.s_amount', 'purchases.c_amount', 'purchases.i_amount', 'purchases.total', 'purchases.hsn_sac', 'parties.party', 'parties.gst_no')
            ->join('parties', 'parties.id', '=', 'purchases.party_id')
            ->where('category', $category)
            ->get();
            $data['count'] = count($data['purchases']);

        }
        
            return view('Purchase.purchase', $data);
    }

    //Create Methods
    public function create(Request $request)
    {

        $purchase = new Purchase;
            
            $purchase->party_id = $request->input('party_id');
            $purchase->date = $request->input('date');
            $purchase->bill_no = $request->input('bill_no');
            $purchase->qty = $request->input('qty');
            $purchase->texable = $request->input('texable');
            
            $purchase->s_amount = $request->input('s_amount');
            
            $purchase->c_amount = $request->input('c_amount');

            $purchase->i_amount = $request->input('i_amount');
            
            $purchase->total = $request->input('total');
            $purchase->hsn_sac = $request->input('hsn_sac');
            
            $purchase->category = $request->input('category');
            $purchase->description = $request->input('description');
            
            $purchase->save();

            $notification = array(
                'message' => 'Data Saved Succesfuly!',
                'alert-type'=>'success');
            return back()->with($notification);
    }//create close

    public function show($id)
    {
        $data['record']= DB::table('purchases')->find($id);
        $data['party']= DB::table('parties')->find($data['record']->party_id);
        
        return view('Purchase.view', $data);
    }

    public function update($id, Request $request)
    {
        $data = PUrchase::find($id);

        
        $data->date = $request->input('date');
        $data->bill_no = $request->input('bill_no');
        $data->qty = $request->input('qty');
        $data->texable = $request->input('texable');
        $data->s_amount = $request->input('s_amount');
        $data->c_amount = $request->input('c_amount');
        $data->i_amount = $request->input('i_amount');
        $data->total = $request->input('total');
        $data->hsn_sac = $request->input('hsn_sac');
        $data->description = $request->input('description');
        
        $data->update();

        $notification = array(
            'message' => 'Data Updated Succesfuly!',
            'alert-type'=>'success');

        return back()->with($notification);
    }

    public function delete(Request $request)
    {

        $url = $request->url();
        
        $id = $request->input('id');
        $data = Purchase::find($id);
        $data->delete();

            $notification = array(
            'message' => 'Record Deleted Succesfuly!  Bill No.: '.$data->bill_no,
            'alert-type'=>'danger');

           // return redirect('/home')->with($notification);

        $url = $request->url();
    
        if($url == "http://jewellery/purchase/gold/delete")
        {
            return redirect('/purchase/gold')->with($notification);
        }
        if($url == "http://jewellery/purchase/silver/delete")
        {
            return redirect('/purchase/silver')->with($notification);
        }
        
        if($url == "http://jewellery/purchase/diamond/delete")
        {
            return redirect('/purchase/diamond')->with($notification);
        }
        
        if($url == "http://jewellery/purchase/gemstone/delete")
        {
            return redirect('/purchase/gemstone')->with($notification);
        }
    }
    
}//class close

