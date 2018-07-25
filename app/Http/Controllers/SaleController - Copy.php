<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale as Sale;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Display form
    public function saleform()
    {
        return view('Sale.form');
    }

    // Index Methods
    public function goldindex(Request $request)
    {
        
        $data = [];
        //$data['url'] = $request->url();
        if($request->has('from') && $request->has('to'))
        {
            $data = [];        
            $data['from'] = $request->input('from');
            $data['to'] = $request->input('to');
           
            $data['gold_sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total')->where('category', 'gold')->whereBetween('date', [ $data['from'], $data['to'] ])->get();
            $data['count'] = count($data['gold_sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');

        }else
        {
            $data['gold_sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total')->where('category', 'gold')->get();
            $data['count'] = count($data['gold_sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'gold'],['branch','sn']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'gold'],['branch','nn']])->sum('total');
        }
        
        return view('Sale.gold', $data);
    }
    public function silverindex(Request $request)
    {
        $data = [];
        
        if($request->has('from') && $request->has('to'))
        {
            $data = [];
            $data['from'] = $request->input('from');
            $data['to'] = $request->input('to');
           
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total')->where('category', 'silver')->whereBetween('date', [ $data['from'], $data['to'] ])->get();
            $data['count'] = count($data['sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');

        }else
        {
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total')->where('category', 'silver')->get();
            $data['count'] = count($data['sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'silver'],['branch','sn']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'silver'],['branch','nn']])->sum('total');
        }
        return view('Sale.silver', $data);
    }
    public function diamondindex(Request $request)
    {
        $data = [];
        
        if($request->has('from') && $request->has('to'))
        {
            $data = [];
            $data['from'] = $request->input('from');
            $data['to'] = $request->input('to');
           
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable', 'sgst','s_amount', 'cgst','c_amount', 'igst','i_amount', 'total')->where('category', 'diamond')->whereBetween('date', [ $data['from'], $data['to'] ])->get();
            $data['count'] = count($data['sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');

        }else
        {
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable', 'sgst','s_amount', 'cgst','c_amount', 'igst','i_amount', 'total')->where('category', 'diamond')->get();
            $data['count'] = count($data['sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'diamond'],['branch','sn']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'diamond'],['branch','nn']])->sum('total');
        }
        return view('Sale.diamond', $data);
    }

    public function gemsindex(Request $request)
    {
        $data = [];
        
        if($request->has('from') && $request->has('to'))
        {
            $data = [];
            $data['from'] = $request->input('from');
            $data['to'] = $request->input('to');
           
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable', 'sgst','s_amount', 'cgst','c_amount', 'igst','i_amount', 'total')->where('category', 'gems')->whereBetween('date', [ $data['from'], $data['to'] ])->get();
            $data['count'] = count($data['sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');

        }else
        {
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable', 'sgst','s_amount', 'cgst','c_amount', 'igst','i_amount', 'total')->where('category', 'gems')->get();
            $data['count'] = count($data['sales']);
            
            $data['texable_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', 'gems'],['branch','sn']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', 'gems'],['branch','nn']])->sum('total');
        }
        return view('Sale.gems', $data);
    }

    //Create Methods
    public function goldcreate(Request $request)
    {

        $sale = new Sale;
        
        $branch;
     
            if($request->input('branch')=='Smriti Nagar')
            {
                $branch = 'sn';
            }elseif($request->input('branch')=='Nehru Nagar')
            {
                $branch = 'nn';
            }
    
            $sale->branch = $branch;
            $sale->date = $request->input('date');
            $sale->bill_no = $request->input('bill_no');
            $sale->qty = $request->input('qty');
            $sale->texable = $request->input('texable');
            
            $sale->s_amount = $request->input('s_amount');
            
            $sale->c_amount = $request->input('c_amount');

            $sale->i_amount = $request->input('i_amount');
            
            $sale->total = $request->input('total');
            $sale->hsn_sac = $request->input('hsn_sac');
            $sale->gst_no = $request->input('gst_no');
            $sale->customer_name = $request->input('customer_name');
            $sale->category = "gold";
            $sale->description = $request->input('description');
            
            $sale->save();

            $notification = array(
                'message' => 'Data Saved Succesfuly!',
                'alert-type'=>'success');
            return back()->with($notification);
    }//gold create close

    public function silvercreate(Request $request)
    {
        $sale = new Sale;
        
        $branch;
     
            if($request->input('branch')=='Smriti Nagar')
            {
                $branch = 'sn';
            }elseif($request->input('branch')=='Nehru Nagar')
            {
                $branch = 'nn';
            }
    
            $sale->branch = $branch;
            $sale->date = $request->input('date');
            $sale->bill_no = $request->input('bill_no');
            $sale->qty = $request->input('qty');
            $sale->texable = $request->input('texable');
            
            $sale->s_amount = ($request->input('texable')*$request->input('sgst')/100);
            
            $sale->c_amount = ($request->input('texable')*$request->input('cgst')/100);

            $sale->i_amount = ($request->input('texable')*$request->input('igst')/100);
            
            $sale->total = $request->input('total');
            $sale->hsn_sac = $request->input('hsn_sac');
            $sale->gst_no = $request->input('gst_no');
            $sale->customer_name = $request->input('customer_name');
            $sale->category = "silver";
            $sale->description = $request->input('description');
            
            $sale->save();

            $notification = array(
                'message' => 'Data Saved Succesfuly!',
                'alert-type'=>'success');
            return back()->with($notification);
    }


    public function diamondcreate(Request $request)
    {
        $sale = new Sale;
        
        $branch;
     
            if($request->input('branch')=='Smriti Nagar')
            {
                $branch = 'sn';
            }elseif($request->input('branch')=='Nehru Nagar')
            {
                $branch = 'nn';
            }
    
            $sale->branch = $branch;
            $sale->date = $request->input('date');
            $sale->bill_no = $request->input('bill_no');
            $sale->qty = $request->input('qty');
            $sale->texable = $request->input('texable');
            
            $sale->s_amount = ($request->input('texable')*$request->input('sgst')/100);
            
            $sale->c_amount = ($request->input('texable')*$request->input('cgst')/100);

            $sale->i_amount = ($request->input('texable')*$request->input('igst')/100);
            
            $sale->total = $request->input('total');
            $sale->hsn_sac = $request->input('hsn_sac');
            $sale->gst_no = $request->input('gst_no');
            $sale->customer_name = $request->input('customer_name');
            $sale->category = "diamond";
            $sale->description = $request->input('description');
            
            $sale->save();

            $notification = array(
                'message' => 'Data Saved Succesfuly!',
                'alert-type'=>'success');
            return back()->with($notification);
    }
    public function gemscreate(Request $request)
    {
        $sale = new Sale;
        
        $branch;
     
            if($request->input('branch')=='Smriti Nagar')
            {
                $branch = 'sn';
            }elseif($request->input('branch')=='Nehru Nagar')
            {
                $branch = 'nn';
            }
    
            $sale->branch = $branch;
            $sale->date = $request->input('date');
            $sale->bill_no = $request->input('bill_no');
            $sale->qty = $request->input('qty');
            $sale->texable = $request->input('texable');
            
            $sale->s_amount = ($request->input('texable')*$request->input('sgst')/100);
            
            $sale->c_amount = ($request->input('texable')*$request->input('cgst')/100);

            $sale->i_amount = ($request->input('texable')*$request->input('igst')/100);
            
            $sale->total = $request->input('total');
            $sale->hsn_sac = $request->input('hsn_sac');
            $sale->gst_no = $request->input('gst_no');
            $sale->customer_name = $request->input('customer_name');
            $sale->category = "gems";
            $sale->description = $request->input('description');
            
            $sale->save();

            $notification = array(
                'message' => 'Data Saved Succesfuly!',
                'alert-type'=>'success');
            return back()->with($notification);
    }

    //View Methods
    public function show($id)
    {
        
        $data['record'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable', 'sgst', 'cgst', 'igst', 'total', 'hsn_sac', 'gst_no', 'customer_name', 'description', 'created_at', 'updated_at')->find($id);
/*
        $notification = array(
            'message' => 'Data Saved Succesfuly!',
            'alert-type'=>'success');
        return back()->with($notification);
*/
        return view('Sale.view', $data);
    }

    public function gold_update($id, Request $request)
    {
        $sale_data = Sale::find($id);

        $sale_data->branch = $request->input('branch');  
        $sale_data->date = $request->input('date');
        $sale_data->bill_no = $request->input('bill_no');
        $sale_data->qty = $request->input('qty');
        $sale_data->texable = $request->input('texable');
        
        $sale_data->sgst = $request->input('sgst');
        $sale_data->s_amount = ($request->input('texable')*$request->input('sgst')/100);
        
        $sale_data->cgst = $request->input('cgst');
        $sale_data->c_amount = ($request->input('texable')*$request->input('cgst')/100);

        $sale_data->igst = $request->input('igst');
        $sale_data->i_amount = ($request->input('texable')*$request->input('igst')/100);
        
        $sale_data->total = $request->input('total');
        $sale_data->hsn_sac = $request->input('hsn_sac');
        $sale_data->gst_no = $request->input('gst_no');
        $sale_data->customer_name = $request->input('customer_name');
        $sale_data->category = "gold";
        $sale_data->description = $request->input('description');
        $sale_data->update();

        $notification = array(
            'message' => 'Data Updated Succesfuly!',
            'alert-type'=>'success');

        return back()->with($notification);
        
    }
}
