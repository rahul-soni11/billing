<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense as Expense;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewform()
    {
        return view('Expense.form');
    }

    public function index(Request $request)
    {
        $data = [];
        if($request->has('from') && $request->has('to')){
            $data['from'] = $request->input('from');
            $data['to'] = $request->input('to');

            $data['expenses'] = Expense::select('id', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total', 'party', 'hsn_sac', 'gst_no')
            ->whereBetween('date', [$data['from'], $data['to']])
            ->get();
            $data['count'] = count($data['expenses']);   
            
           $data['sum_texable'] = Expense::whereBetween('date', [$data['from'], $data['to']])->sum('texable');
           $data['sum_s_amount'] = Expense::whereBetween('date', [$data['from'], $data['to']])->sum('s_amount');
           $data['sum_c_amount'] = Expense::whereBetween('date', [$data['from'], $data['to']])->sum('c_amount');
           $data['sum_i_amount'] = Expense::whereBetween('date', [$data['from'], $data['to']])->sum('i_amount');
           $data['sum_total'] = Expense::whereBetween('date', [$data['from'], $data['to']])->sum('total');

        }else{
            $data['expenses'] = Expense::select('id', 'date', 'bill_no', 'qty', 'texable','s_amount','c_amount','i_amount', 'total', 'party', 'hsn_sac', 'gst_no')
            ->get();
            $data['count'] = count($data['expenses']);
        }

        
        
        
        return view('Expense.index', $data);
    }

    //Create Methods
    public function create(Request $request)
    {

        $expense = new Expense;
            
            $expense->date = $request->input('date');
            $expense->bill_no = $request->input('bill_no');
            $expense->qty = $request->input('qty');
            $expense->texable = $request->input('texable');
            $expense->s_amount = $request->input('s_amount');
            $expense->c_amount = $request->input('c_amount');
            $expense->i_amount = $request->input('i_amount');
            $expense->total = $request->input('total');
            $expense->hsn_sac = $request->input('hsn_sac');
            $expense->gst_no = $request->input('gst_no');
            $expense->party = $request->input('party');
            $expense->description = $request->input('description');
            
            $expense->save();

            $notification = array(
                'message' => 'Data Saved Succesfuly!',
                'alert-type'=>'success');
            return back()->with($notification);
    }//create close

    
    //View Methods
    public function show($id)
    {
        
        $data['record'] = Expense::findOrFail($id);

        return view('Expense.view', $data);
    }

    
    public function update($id, Request $request)
    {
        $data = Expense::find($id);

        $data->date = $request->input('date');
        $data->bill_no = $request->input('bill_no');
        $data->qty = $request->input('qty');
        $data->texable = $request->input('texable');
        $data->s_amount = $request->input('s_amount');
        $data->c_amount = $request->input('c_amount');
        $data->i_amount = $request->input('i_amount');
        $data->total = $request->input('total');
        $data->hsn_sac = $request->input('hsn_sac');
        $data->gst_no = $request->input('gst_no');
        $data->party = $request->input('party');
        $data->description = $request->input('description');
        $data->update();

        $notification = array(
            'message' => 'Data Updated Succesfuly!',
            'alert-type'=>'success');

        return back()->with($notification);
        
    }

    public function delete(Request $request)
    {

        $id = $request->input('id');
        $data = Expense::find($id);
        $data->delete();

            $notification = array(
            'message' => 'Record Deleted Succesfuly!  Bill No.: '.$data->bill_no,
            'alert-type'=>'danger');

        return redirect('http://jewellery/expense')->with($notification);
    }
}
