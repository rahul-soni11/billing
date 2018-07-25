<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale as Sale;
use Illuminate\Support\Facades\Redirect;

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
    public function index(Request $request)
    {
        
        $data = [];
        $url = $request->url();
        
        if($url == "http://jewellery/sale/gold")
        {
            $category = "gold";
        }
        if($url == "http://jewellery/sale/silver")
        {
            $category = "silver";
        }
        
        if($url == "http://jewellery/sale/diamond")
        {
            $category = "diamond";
        }
        
        if($url == "http://jewellery/sale/gemstone")
        {
            $category = "gems";
        }


        if($request->has('from') && $request->has('to'))
        {
               
            $data['from'] = $request->input('from');
            $data['to'] = $request->input('to');
           
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total')->where('category', $category)->whereBetween('date', [ $data['from'], $data['to'] ])->get();
            $data['count'] = count($data['sales']);
            
            
            $data['qty_sum_sn'] = Sale::where([['category', $category],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('qty');
            $data['qty_sum_nn'] = Sale::where([['category', $category],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('qty');

            $data['texable_sum_sn'] = Sale::where([['category', $category],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            $data['texable_sum_nn'] = Sale::where([['category', $category],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('texable');
            
            $data['sgst_sum_sn'] = Sale::where([['category', $category],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            $data['sgst_sum_nn'] = Sale::where([['category', $category],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
            
            $data['cgst_sum_sn'] = Sale::where([['category', $category],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            $data['cgst_sum_nn'] = Sale::where([['category', $category],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
            
            $data['igst_sum_sn'] = Sale::where([['category', $category],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            $data['igst_sum_nn'] = Sale::where([['category', $category],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
            
            $data['total_sum_sn'] = Sale::where([['category', $category],['branch','sn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');
            $data['total_sum_nn'] = Sale::where([['category', $category],['branch','nn']])->whereBetween('date', [$data['from'], $data['to']])->sum('total');

        }else
        {
            $data['sales'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total')->where('category', $category)->get();
            $data['count'] = count($data['sales']);
            
        }
        
            return view('Sale.sale', $data);
    }
    
    //Create Methods
    public function create(Request $request)
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
            $sale->category = $request->input('category');
            $sale->description = $request->input('description');
            
            $sale->save();

            $notification = array(
                'message' => 'Data Saved Succesfuly!',
                'alert-type'=>'success');
            return back()->with($notification);
    }//create close

    
    //View Methods
    public function show($id)
    {
        
        $data['record'] = Sale::select('id', 'branch', 'date', 'bill_no', 'qty', 'texable','s_amount', 'c_amount', 'i_amount', 'total', 'hsn_sac', 'gst_no', 'customer_name', 'description', 'created_at', 'updated_at')->findOrFail($id);
/*
        $notification = array(
            'message' => 'Data Saved Succesfuly!',
            'alert-type'=>'success');
        return back()->with($notification);
*/
        return view('Sale.view', $data);
    }

    public function update($id, Request $request)
    {
        $sale_data = Sale::find($id);

        $sale_data->branch = $request->input('branch');  
        $sale_data->date = $request->input('date');
        $sale_data->bill_no = $request->input('bill_no');
        $sale_data->qty = $request->input('qty');
        $sale_data->texable = $request->input('texable');
        $sale_data->s_amount = $request->input('s_amount');
        $sale_data->c_amount = $request->input('c_amount');
        $sale_data->i_amount = $request->input('i_amount');
        $sale_data->total = $request->input('total');
        $sale_data->hsn_sac = $request->input('hsn_sac');
        $sale_data->gst_no = $request->input('gst_no');
        $sale_data->customer_name = $request->input('customer_name');
        $sale_data->description = $request->input('description');
        $sale_data->update();

        $notification = array(
            'message' => 'Data Updated Succesfuly!',
            'alert-type'=>'success');

        return back()->with($notification);
        
    }

    public function delete(Request $request)
    {

        $url = $request->url();
        
        $id = $request->input('id');
        $sale_data = Sale::find($id);
        $sale_data->delete();

            $notification = array(
            'message' => 'Record Deleted Succesfuly!  Bill No.: '.$sale_data->bill_no,
            'alert-type'=>'danger');

           // return redirect('/home')->with($notification);

        $url = $request->url();
    
        if($url == "http://jewellery/sale/gold/delete")
        {
            return redirect('/sale/gold')->with($notification);
        }
        if($url == "http://jewellery/sale/silver/delete")
        {
            return redirect('/sale/silver')->with($notification);
        }
        
        if($url == "http://jewellery/sale/diamond/delete")
        {
            return redirect('/sale/diamond')->with($notification);
        }
        
        if($url == "http://jewellery/sale/gemstone/delete")
        {
            return redirect('/sale/gemstone')->with($notification);
        }

    }
}
