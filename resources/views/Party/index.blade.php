@extends('layouts.app')

@section('content')
<!--This is for showing notification if send back with return back() method from controller-->
@if(Session::has('message'))
<div class="alert alert-{{Session::get('alert-type')}} alert-dismissible fade show">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
 {{Session::get('message')}}
</div>
@endif
<section class="jumbotron">
        <div>
            <h1 class="jumbotron-heading">Manage Party</h1>
            <p class="lead text-danger">Once Party Assigned to any Purchase Record can not be Deleted.</p>
        </div>

        <form class="form-inline" action="{{Request::url()}}" method="post" onsubmit="return party_validate()">
            {{ csrf_field() }}
            <input type="text" class="form-control mb-2 mr-sm-2" name="party" id="party" placeholder="Name">
            <input type="text" class="form-control mb-2 mr-sm-2" name="gst_no" id="gst_no" maxlength="15" placeholder="GST Number">
            <button type="submit" class="btn btn-primary mb-2">Add</button>
        </form>
</section>
<table class="table table-dark table-striped table-responsive-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>GST No.</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach($parties as $party)
        <tr>
            <td>{{$party->id}}</td>
            <td>{{$party->party}}</td>
            <td>{{$party->gst_no}}</td>
            <td>
                <form action="party/delete" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$party->id}}">
                    <button type="submit" class="btn btn-danger" >Delete</button>
                </form>
            </td>
      </tr>
      @endforeach
    </tbody>
  </table>


<script>
function party_validate(){

    var $party = $("#party").val();
    var $gst_no  = $("#gst_no").val(); 
    var $val=true;

    if ($party == '') {
        alert("Party name could not be empty!");
        var $val=false;
    }
    if($gst_no ==''){
        alert('GST Number could not be empty!.');
        var $val=false;
    }
    if($gst_no.length<15){
        alert('GST Number is not Valid!.');
        var $val=false;
    }
    
    
    return $val;
}
</script>
@endsection
