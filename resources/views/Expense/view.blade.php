@extends('layouts.app')

@section('content')
<main role="main" class="container">



<div class="col-md-12">
@if(Session::has('message'))
<div class="alert alert-{{Session::get('alert-type')}} alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 {{Session::get('message')}}
</div>
@endif              
<hr>
              <!-- form user info -->
              <form class="form" action="{{Request::url()}}" method="post" onsubmit="return validation();" role="form" autocomplete="off" id="form1">
              {{ csrf_field() }}
             <div class="card card-outline-secondary">
                  <div class="card-header">
                    <h3 class="mb-0">View Expense Record</h3>
                  </div>
                  <div class="card-body" >
                              <!--Row 1-->
                              <div class="row ">
                                <div class="form-group col-md-4">
                                  <label for="date">Date</label>
                                  <input value = "{{$record->date}}" disabled name="date" class="form-control form-control-lg datepicker" id="date" type="text" placeholder="Required" >
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="bill_no">Bill No.</label>
                                  <input value = "{{$record->bill_no}}" disabled name="bill_no" class="form-control form-control-lg form-control-danger" id="bill_no" type="text" placeholder="Required">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="qty">Qty.</label>
                                  <input value = "{{$record->qty}}" disabled name="qty" class="form-control form-control-lg" id="qty" type="number" step=".01" placeholder="Required">
                                </div>
                              </div>
                              

                              <!--Row 2-->
                              <div class="row">
                                <div class="form-group col-md-3">
                                  <label for="texable">Texable</label>
                                  <div class="input-group">
                                    <input value = "{{$record->texable}}" disabled name="texable" class="form-control form-control-lg" id="texable" type="number" min="0" step=".01" placeholder="Required">
                                    <div class="input-group-append">
                                      <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="s_amount">SGST</label>
                                  <div class="input-group">
                                    <input value = "{{$record->s_amount}}" disabled name="s_amount" type="number" class="form-control form-control-lg" id="s_amount" min="0" step=".01">
                                    <div class="input-group-append">
                                       <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="c_amount">CGST</label>
                                  <div class="input-group">
                                  <input value = "{{$record->c_amount}}" disabled name="c_amount" type="number" class="form-control form-control-lg" id="c_amount" min="0" step=".01">
                                    <div class="input-group-append">
                                     <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="i_amount">IGST</label>
                                  <div class="input-group">
                                  <input value = "{{$record->i_amount}}" disabled name="i_amount" type="number" class="form-control form-control-lg" id="i_amount" min="0" value="0" step=".01">
                                    <div class="input-group-append">
                                     <div class="input-group-text"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group col-md-3">
                                  <label for="total">Total</label>
                                  <div class="input-group">
                                    <input value = "{{$record->total}}" disabled name="total" class="form-control form-control-lg" id="total" type="number"  min="0" style="background-color:#f5f5f5;" step=".01">
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
                                  <input value = "{{$record->hsn_sac}}" disabled name="hsn_sac" class="form-control form-control-lg" id="hsn" type="text" placeholder="Optional">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="gst_no">GST No.</label>
                                  <input value = "{{$record->gst_no}}" disabled name="gst_no" class="form-control form-control-lg" id="gst_no" type="text" placeholder="Optional" maxlength="15">
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="party">Party</label>
                                  <input value = "{{$record->party}}" disabled name="party" class="form-control form-control-lg" id="party" type="text" placeholder="Optional" maxlength="15">
                              </div>
                              </div>

                              <div class="row">
                                <div class="form-group col">
                                  <label for="description">Additional info</label>
                                  <input value = "{{$record->description}}" disabled name="description" class="form-control form-control-lg" id="description" type="text" placeholder="Optional (May used if bill contains multiple items)">
                                </div>
                              </div>

                              <!--Row 5-->
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
                                <form action="/expense/delete" method="post" onsubmit="return sure()">
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
    $("#gst_no").removeAttr("disabled");
    $("#party").removeAttr("disabled");    
    $("#description").removeAttr("disabled");
    $("#btn_sub").removeAttr("disabled");
  }
</script>

@endsection
