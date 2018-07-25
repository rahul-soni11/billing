@extends('layouts.app')

@section('content')

<style>
.goldimg{
    background-image: url("{{ asset('images/gold-jewellery-form-cover.png') }}");
    background-size: cover;
}
.silvimg{
    background-image: url("{{ asset('images/silver-jewellery-form-cover.png') }}");
    background-size: cover;
}
.diaimg{
    background-image: url("{{ asset('images/diamond-jewellery-form-cover.jpg') }}");
    background-size: cover;
}
.gemimg{
    background-image: url("{{ asset('images/gemstons-form-cover.png') }}");
    background-size: cover;
}
</style>
<main role="main" class="container">



<div class="col-md-12">
@if(Session::has('message'))
<div class="alert alert-{{Session::get('alert-type')}} alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 {{Session::get('message')}}
</div>
@endif              
<hr>
              <div class="card card-outline-secondary">
                  
                  <div class="card-header 
                    @if(Request::is('purchase/gold/show/*'))
                        {{'goldimg'}}
                    @elseif(Request::is('purchase/silver/show/*'))
                        {{'silvimg'}}
                    @elseif(Request::is('purchase/diamond/show/*'))
                        {{'diaimg'}}
                    @elseif(Request::is('purchase/gemstone/show/*'))
                        {{'gemimg'}}
                    @endif
                  ">
                    <h3 class="mb-0">
                      @if(Request::is('purchase/gold/show/*'))
                          {{'View Gold Jewellery Purchases Record'}}
                      @elseif(Request::is('purchase/silver/show/*'))
                          {{'View Silver Jewellery Purchases Record'}}    
                      @elseif(Request::is('purchase/diamond/show/*'))
                          {{'View Diamond Jewellery Purchases Record'}}
                      @elseif(Request::is('purchase/gemstone/show/*'))
                          {{'View Gemstones Purchases Record'}}
                      @endif
                    </h3>
                  </div>

                  <div class="card-body" >
                      <!-- form user info -->
                      <form class="form" action="{{Request::url()}}" method="post" onsubmit="return validation();" id="form1" autocomplete="off">
                      {{ csrf_field() }}
                              <!--Row 1-->
                              <div class="row ">
                                <div class="form-group col-md-3">
                                    <label for="party">Party</label>
                                    <input name="party" id="party" class="form-control form-control-lg" value="{{$party->party}}" disabled >
                                    <!--input  type="text" class="form-control form-control-lg" id="branch" readonly placeholder="Required"-->                                   
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="date">Date</label>
                                  <input name="date" class="form-control form-control-lg datepicker" id="date" type="text" placeholder="Required" value="{{$record->date}}" disabled>
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="bill_no">Bill No.</label>
                                  <input name="bill_no" class="form-control form-control-lg form-control-danger" id="bill_no" type="text" placeholder="Required" disabled value="{{$record->bill_no}}">
                                </div>
                                <div class="form-group col-md-3 ">
                                  <label for="qty">Qty.</label>
                                  <input name="qty" class="form-control form-control-lg" id="qty" type="number" step=".01" placeholder="Required" disabled value="{{$record->qty}}">
                                </div>
                              </div>
                              

                                <!--Row 2-->
                                <div class="row">
                                <div class="form-group col-md-3">
                                  <label for="texable">Texable</label>
                                  <div class="input-group">
                                    <input type="number" name="texable" class="form-control form-control-lg" id="texable" min="0" step=".01" placeholder="Required"  value="{{$record->texable}}" disabled>
                                    <div class="input-group-append">
                                      <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="s_amount">SGST</label>
                                  <div class="input-group">
                                    <input name="s_amount" type="number" class="form-control form-control-lg" id="s_amount" min="0" step=".01" disabled  value="{{$record->s_amount}}">
                                    <div class="input-group-append">
                                       <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="c_amount">CGST</label>
                                  <div class="input-group">
                                  <input name="c_amount" type="number" class="form-control form-control-lg" id="c_amount" min="0" step=".01" disabled  value="{{$record->c_amount}}">
                                    <div class="input-group-append">
                                     <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="i_amount">IGST</label>
                                  <div class="input-group">
                                  <input name="i_amount" type="number" class="form-control form-control-lg" id="i_amount" min="0" step=".01" disabled  value="{{$record->i_amount}}">
                                    <div class="input-group-append">
                                     <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group col-md-3">
                                  <label for="total">Total</label>
                                  <div class="input-group">
                                    <input name="total" class="form-control form-control-lg" id="total" type="number" style="background-color:#f5f5f5;" step=".01" disabled  value="{{$record->total}}">
                                    <div class="input-group-append">
                                     <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <!--Row 3-->
                              <div class="row">
                                <div class="form-group col-md-4">
                                  <label for="hsn">HSN/SAC code</label>
                                  <input name="hsn_sac" class="form-control form-control-lg" id="hsn" type="text" placeholder="Optional" disabled value="{{$record->hsn_sac}}">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="gst_no">GST No.</label>
                                  <input name="gst_no" class="form-control form-control-lg" id="gst_no" type="text" placeholder="Optional" maxlength="15" disabled value="{{$party->gst_no}}">
                                </div>
                              </div>

                              <!--Row 3-->
                              <div class="row">
                                <div class="form-group col">
                                  <label for="description">Additional info</label>
                                  <input name="description" class="form-control form-control-lg" id="description" type="text" placeholder="Optional (May used if bill contains multiple items)" disabled value="{{$record->description}}">
                                </div>
                              </div>

                              <!--Row 4-->
                              <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="description">Created At</label>
                                  <input name="description" class="form-control form-control-lg" id="description" type="text" disabled  value="{{$record->created_at}}">
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="description">Updated At</label>
                                  <input name="description" class="form-control form-control-lg" id="description" type="text" disabled  value="{{$record->updated_at}}">
                                </div>
                              </div>
                              
                        </form>
                  </div><!-- /card-body-->
                    <div class="card-footer">
                      <div class="row">
                            <div class="form-group col-md-4 text-center">
                                <form action="
                                @if(Request::is('purchase/gold/show/*'))
                                    {{'/purchase/gold/delete'}}
                                @elseif(Request::is('purchase/silver/show/*'))
                                    {{'/purchase/silver/delete'}}
                                @elseif(Request::is('purchase/diamond/show/*'))
                                    {{'/purchase/diamond/delete'}}
                                @elseif(Request::is('purchase/gemstone/show/*'))
                                    {{'/purchase/gemstone/delete'}}
                                @endif
                                " method="post" onsubmit="return sure()">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="id" value="{{$record->id}}">
                                  <input type="submit" value="Delete" class="btn btn-danger col-sm-4">
                                </form>
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="button" value="Edit" class="btn btn-warning col-sm-4" onclick="enable()">
                            </div>
                            <div class="form-group col-md-4 text-center">
                                <input type="submit" id="btn_sub" form="form1" value="Update" class="btn btn-success col-sm-4" disabled>
                            </div>
                        </div>
                    </div>
                  
              </div>
          </div>

<div class="alert alert-warning alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 Party Can not be updated here Delete the record and create new one.
</div>
</main><!-- /.container -->

<script>

  function sure()
  {
    return confirm("Warning ! This will Delete Record having Bill no {{$record->bill_no}}!");
  }

  function enable()
  {
    $("#date").removeAttr("disabled");    
    $("#bill_no").removeAttr("disabled");
    $("#qty").removeAttr("disabled");
    $("#texable").removeAttr("disabled");
    $("#s_amount").removeAttr("disabled");
    $("#c_amount").removeAttr("disabled");
    $("#i_amount").removeAttr("disabled");
    $("#total").removeAttr("disabled");
    $("#hsn").removeAttr("disabled");
    
    $("#description").removeAttr("disabled");
    $("#btn_sub").removeAttr("disabled");
  }
</script>

@endsection
