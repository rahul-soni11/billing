@extends('layouts.app')

@section('content')
<style>
.exp{
    background-image: url("{{ asset('images/expenses.jpg') }}");
    background-size: cover;
}
</style>

<div class="jumbotron exp">
    <div class="container">
        <h1 class="display-3 text-light">Expenses</h1>
        <h4 class="display-4 text-light">records</h4>
        <p><a class="btn btn-primary btn-lg" href="/expense/new
        " role="button">Add New Record &raquo;</a></p>
    </div>
</div>
@if(Session::has('message'))
<div class="alert alert-{{Session::get('alert-type')}} alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
     {{Session::get('message')}}
</div>
@endif


<div class="card mb-3">
  <div class="card-header"><i class="fa fa-area-chart"></i> Choose Dates</div>
    <div class="card-body">
      <form class="form" action="{{Request::url()}}" method="post" onsubmit="return validation();" role="form" autocomplete="off">
        {{ csrf_field() }}
        <div class="row">
          <div class="form-group col-md-3">
            <input name="from" class="form-control datepicker" type="text" placeholder="From">
          </div>
          <div class="form-group col-md-3">
            <input name="to" class="form-control datepicker" type="text" placeholder="To">
          </div>
          <div class="form-group col-md-2">
            <input class="btn btn-success" type="submit" value="Get Stats">
        </div>
        <div class="form-group col-md-1">
            <a href="{{Request::url()}}" class="btn btn-primary">Reset</a>
        </div>
      </form>        
  </div><!-- ./card body -->
</div><!-- ./card mb-3 -->


@if(!empty($sum_texable))
<div class="card">
        <div class="card-header"><i class="fa fa-table"></i> Statistics | {{ (!empty($from) ? 'From :' . $from . ' To :' . $to : '') }} | {{ (!empty($sec_party)? $sec_party : 'Party Not Selected')}} </div>
        <div class="card-body">
            <table class="table table-responsive-md table-bordered">
            <thead>
                <tr>
                <th>Qty</th>
                <th>Texable <i class="fa fa-inr" aria-hidden="true"></i></th>
                <th>SGST <i class="fa fa-inr" aria-hidden="true"></i></th>
                <th>CGST <i class="fa fa-inr" aria-hidden="true"></i></th>
                <th>IGST <i class="fa fa-inr" aria-hidden="true"></i></th>
                <th>Total <i class="fa fa-inr" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr class="green">
                    <td>{{$sum_qty}}</td>
                    <td>{{$sum_texable}}</td>
                    <td>{{$sum_s_amount}}</td>
                    <td>{{$sum_c_amount}}</td>
                    <td>{{$sum_i_amount}}</td>
                    <td>{{$sum_total}}</td>
                </tr>
            </tbody>
            </table>
        </div><!-- ./card body -->
        </div><!-- ./card -->
@endif


<div class="card">
  <div class="card-header"><i class="fa fa-table"></i> Total Records : {{$count}} </div>
  <div class="card-body">

      <div class="table-responsive">
          <table class="table table-striped table-responsive-md table-bordered" id="dataTable" >
            <thead>
              <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Bill No.</th>
                <th>Qty</th>
                <th>Texable <i class="fa fa-inr" aria-hidden="true"></i> </th>
                <th>SGST <i class="fa fa-inr" aria-hidden="true"></i> </th>
                <th>CGST <i class="fa fa-inr" aria-hidden="true"></i> </th>
                <th>IGST <i class="fa fa-inr" aria-hidden="true"></i> </th>
                <th>Total <i class="fa fa-inr" aria-hidden="true"></i></th>
                <th>HSN SAC Code</th>
                <th>GST No.</th>                
                <th>Party</th>                
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($expenses as $exp)
                <tr>
                    <td>{{ $exp->id }}</td>
                    <td>{{ $exp->date }}</td>
                    <td>{{ $exp->bill_no }}</td>
                    <td>{{ $exp->qty }}</td>
                    <td>{{ $exp->texable }} </td>
                    <td>{{ $exp->s_amount }} </td>
                    <td>{{ $exp->c_amount }} </td>
                    <td>{{ $exp->i_amount }} </td>
                    <td>{{ $exp->total }} </td>
                    <td>{{ $exp->hsn_sac }} </td>                    
                    <td>{{ $exp->gst_no }} </td>
                    <td>{{ $exp->party }} </td>
                    <td> <a href="/expense/show/{{$exp->id}}"><button>Edit</button></a> </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div> <!-- \.Table responsive -->

  </div> <!--\. Card body-->
   <div class="card-footer small text-muted">Designed & Developed by Rahul Soni</div>
</div> <!--\. Card-->

@endsection
