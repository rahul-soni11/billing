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
@if (!Session::has('branch'))
<div class="alert alert-danger">
  <strong>Branch is not selected !</strong> Please select the branch.
</div>
@endif
@if(Session::has('message'))
<div class="alert alert-{{Session::get('alert-type')}} alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 {{Session::get('message')}}
</div>
@endif
<div class="col-md-12">
              
<hr>
              <!-- form user info -->
              <form class="form" action="{{Request::url()}}" method="post" onsubmit="return validation();" role="form" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" name="category" value="@if(Request::is('sale/new/gold')){{'gold'}}@elseif(Request::is('sale/new/silver')){{'silver'}}@elseif(Request::is('sale/new/diamond')){{'diamond'}}@elseif(Request::is('sale/new/gemstone')){{'gems'}}@endif"> 
              <div class="card card-outline-secondary">
                  
                  <div class="card-header 
                    @if(Request::is('sale/new/gold'))
                        {{'goldimg'}}
                    @elseif(Request::is('sale/new/silver'))
                        {{'silvimg'}}
                    @elseif(Request::is('sale/new/diamond'))
                        {{'diaimg'}}
                    @elseif(Request::is('sale/new/gemstone'))
                        {{'gemimg'}}
                    @endif
                  ">
                    <h3 class="mb-0">
                      @if(Request::is('sale/new/gold'))
                          {{'Gold Jewellery Sales Record'}}
                      @elseif(Request::is('sale/new/silver'))
                          {{'Silver Jewellery Sales Record'}}    
                      @elseif(Request::is('sale/new/diamond'))
                          {{'Diamond Jewellery Sales Record'}}
                      @elseif(Request::is('sale/new/gemstone'))
                          {{'Gemstones Sales Record'}}
                      @endif
                    </h3>
                  </div>
                  <div class="card-body" >
                      
                              <!--Row 1-->
                              <div class="row ">
                                <div class="form-group col-md-3">
                                  <label for="branch">Branch</label>
                                  <input name="branch" type="text" class="form-control form-control-lg" id="branch" readonly placeholder="Required"
                                  @if (Session::has('branch'))
                                        value="{{Session::get('branch')}}"

                                        @if(Session::get('branch')=='Smriti Nagar')  
                                            style="background-color:#00FF00;" 
                                        @else
                                            style="background-color:#FFFF00;"
                                        @endif
                                  @endif
                                  >
                                   
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="date">Date</label>
                                  <input name="date" class="form-control form-control-lg datepicker" id="date" type="text" placeholder="Required" >
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="bill_no">Bill No.</label>
                                  <input name="bill_no" class="form-control form-control-lg form-control-danger" id="bill_no" type="text" placeholder="Required">
                                </div>
                                <div class="form-group col-md-3 ">
                                  <label for="qty">Qty.</label>
                                  <input name="qty" class="form-control form-control-lg" id="qty" type="number" step=".01" placeholder="Required">
                                </div>
                                <!--div class="col-md-2 ">
                                  <label for="unit">Unit.</label>
                                  <select name="unit" class="form-control form-control-lg" id="unit" type="number">
                                      <option value="gm">G.</option>
                                      <option value="gm">Ct</option>
                                  </select>
                                </div-->
                              </div>
                              

                              <!--Row 2-->
                              <div class="row">
                                <div class="form-group col-md-3">
                                  <label for="texable">Texable</label>
                                  <div class="input-group">
                                    <input name="texable" class="form-control form-control-lg" id="texable" type="number" min="0" step=".01" placeholder="Required">
                                    <div class="input-group-append">
                                      <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="s_amount">SGST</label>
                                  <div class="input-group">
                                    <input name="s_amount" type="number" class="form-control form-control-lg" id="s_amount" min="0" step=".01">
                                    <div class="input-group-append">
                                       <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="c_amount">CGST</label>
                                  <div class="input-group">
                                  <input name="c_amount" type="number" class="form-control form-control-lg" id="c_amount" min="0" step=".01">
                                    <div class="input-group-append">
                                     <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="i_amount">IGST</label>
                                  <div class="input-group">
                                  <input name="i_amount" type="number" class="form-control form-control-lg" id="i_amount" min="0" value="0" step=".01">
                                    <div class="input-group-append">
                                     <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group col-md-3">
                                  <label for="total">Total</label>
                                  <div class="input-group">
                                    <input name="total" class="form-control form-control-lg" id="total" type="number" style="background-color:#f5f5f5;" step=".01">
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
                                  <input name="hsn_sac" class="form-control form-control-lg" id="hsn" type="text" placeholder="Optional">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="gst_no">GST No.</label>
                                  <input name="gst_no" class="form-control form-control-lg" id="gst_no" type="text" placeholder="Optional" maxlength="15">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="customer_name">Customer Name</label>
                                  <input name="customer_name" class="form-control form-control-lg" id="customer_name" type="text" placeholder="Optional">
                                </div>
                              </div>

                              <div class="row">
                                <div class="form-group col">
                                  <label for="description">Additional info</label>
                                  <input name="description" class="form-control form-control-lg" id="description" type="text" placeholder="Optional (May used if bill contains multiple items)">
                                </div>
                              </div>
                              
                  </div><!-- /card-body-->
                    <div class="card-footer">
                        <input type="submit" value="Save" class="btn btn-primary col-sm-3 float-right ">
                        <input type="button" value="Sum" class="btn btn-warning col-sm-2" onclick="sum()">
                    </div>
                  
              </div>
              <!-- /form user info -->
            </form>
          </div>

</main><!-- /.container -->
@endsection
