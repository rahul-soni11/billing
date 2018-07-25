@extends('layouts.app')

@section('content')
<style>
.gold{
    background-image: url("{{ asset('images/light-gold-jewellery.jpg') }}");
    background-size: cover;
}

.silver{
    background-image: url("{{ asset('images/light-silver-jewellery.jpg') }}");
    background-size: cover;
}

.diamond{
    background-image: url("{{ asset('images/light-diamond-jewellery.jpg') }}");
    background-size: cover;
}

.gems{
    background-image: url("{{ asset('images/light-gemstons.jpg') }}");
    background-size: cover;
}

/* Color */
.yellow {
    background-color: #ffff00;
}


.green {
  background-color: #00ff00;
}

.dot {
    height: 15px;
    width: 15px;
    border-radius: 50%;
    display: inline-block;
}
</style>

<div class="jumbotron @if(Request::is('sale/gold'))
                        {{'gold'}}
                    @elseif(Request::is('sale/silver'))
                        {{'silver'}}
                    @elseif(Request::is('sale/diamond'))
                        {{'diamond'}}
                    @elseif(Request::is('sale/gemstone'))
                        {{'gems'}}
                    @endif">
    <div class="container">
        <h1 class="display-3">@if(Request::is('sale/gold'))
                        {{'Gold Jewellery'}}
                    @elseif(Request::is('sale/silver'))
                        {{'Silver Jewellery'}}
                    @elseif(Request::is('sale/diamond'))
                        {{'Diamond Jewellery'}}
                    @elseif(Request::is('sale/gemstone'))
                        {{'Gemstons'}}
                    @endif
        </h1>
        <h4 class="display-4">Sales</h4>
        <p><a class="btn btn-primary btn-lg" href="@if(Request::is('sale/gold'))
                                                        {{'/sale/new/gold'}}
                                                    @elseif(Request::is('sale/silver'))
                                                        {{'/sale/new/silver'}}
                                                    @elseif(Request::is('sale/diamond'))
                                                        {{'/sale/new/diamond'}}
                                                    @elseif(Request::is('sale/gemstone'))
                                                        {{'/sale/new/gemstone'}}
                                                    @endif" role="button">Add New Record &raquo;</a></p>
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
          <div class="form-group col-md-4">
            <input name="from" class="form-control datepicker" type="text" placeholder="From">
          </div>
          <div class="form-group col-md-4">
            <input name="to" class="form-control datepicker" type="text" placeholder="To">
          </div>
          <div class="form-group col-md-2">
            <input class="btn btn-success" type="submit" value="Get Stats">
        </div>
        <div class="form-group col-md-2">
            <a href="{{Request::url()}}" class="btn btn-primary">Refresh</a>
        </div>
      </form>        
  </div><!-- ./card body -->
</div><!-- ./card mb-3 -->

@if(!empty($texable_sum_sn))
<div class="card">
        <div class="card-header"><i class="fa fa-table"></i> Statistics | {{ ( ! empty($from) ? 'From :' . $from . ' To :' . $to : '') }}</div>
        <div class="card-body">
<table class="table table-responsive-md table-bordered">
  <thead>
    <tr>
      <th>Branch</th>
      <th>Qty.</th>
      <th>Texable <i class="fa fa-inr" aria-hidden="true"></i></th>
      <th>SGST <i class="fa fa-inr" aria-hidden="true"></i></th>
      <th>CGST <i class="fa fa-inr" aria-hidden="true"></i></th>
      <th>IGST <i class="fa fa-inr" aria-hidden="true"></i></th>
      <th>Total <i class="fa fa-inr" aria-hidden="true"></i></th>
    </tr>
  </thead>
  <tbody>
      <tr class="green">
        <td>Smriti Nagar</td>
        <td>{{$qty_sum_sn}}</td>
        <td>{{$texable_sum_sn}}</td>
        <td>{{$sgst_sum_sn}}</td>
        <td>{{$cgst_sum_sn}}</td>
        <td>{{$igst_sum_sn}}</td>
        <td>{{$total_sum_sn}}</td>
      </tr>
      <tr class="yellow">
        <td>Nehru Nagar</td>
        <td>{{$qty_sum_nn}}</td>
        <td>{{$texable_sum_nn}}</td>
        <td>{{$sgst_sum_nn}}</td>
        <td>{{$cgst_sum_nn}}</td>
        <td>{{$igst_sum_nn}}</td>
        <td>{{$total_sum_nn}}</td>
      </tr>
      <tr>
        <td>Grand Total</td>
        <td>{{$qty_sum_sn + $qty_sum_nn}}</td>
        <td>{{$texable_sum_sn + $texable_sum_nn}}</td>
        <td>{{$sgst_sum_sn + $sgst_sum_nn}}</td>
        <td>{{$cgst_sum_sn + $cgst_sum_nn}}</td>
        <td>{{$igst_sum_sn + $igst_sum_nn}}</td>
        <td>{{$total_sum_sn + $total_sum_nn}}</td>

      </tr>
  </tbody>
</table>
@endif

<div class="card">
  <div class="card-header"><i class="fa fa-table"></i> Total Records : {{$count}} | Smriti Nagar <span class="dot green"></span> | Nehru Nagar <span class="dot yellow"></span></div>
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
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sales as $sale)
                <tr>
                    <td class="{{ $sale->branch == 'sn' ? 'green' : 'yellow' }}" >{{ $sale->id .' ' }}</td>
                    <td>{{ $sale->date }}</td>
                    <td>{{ $sale->bill_no }}</td>
                    <td>{{ $sale->qty }}</td>
                    <td>{{ $sale->texable }} </td>
                    <td>{{ $sale->s_amount }} </td>
                    <td>{{ $sale->c_amount }} </td>
                    <td>{{ $sale->i_amount }} </td>
                    <td>{{ $sale->total }} </td>
                    <td> <a href="@if(Request::is('sale/gold'))/sale/gold/show/{{$sale->id}}@elseif(Request::is('sale/silver'))/sale/silver/show/{{$sale->id}}@elseif(Request::is('sale/diamond'))/sale/diamond/show/{{$sale->id}}@elseif(Request::is('sale/gemstone'))/sale/gemstone/show/{{$sale->id}}@endif"><button>Edit</button></a> </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div> <!-- \.Table responsive -->

  </div> <!--\. Card body-->
   <div class="card-footer small text-muted">Designed & Developed by Rahul Soni</div>
</div> <!--\. Card-->

@endsection
