<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/this-template.css') }}" rel="stylesheet">

    <!-- Pic date css -->
    <link rel="stylesheet" href="{{asset('pickadate/lib/themes/default.css')}}">
    <link rel="stylesheet" href="{{asset('pickadate/lib/themes/default.date.css')}}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="{{ url('/home') }}">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#rahul_nav" aria-controls="rahul_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="rahul_nav">
        
        <!-- Authentication Links -->
        @if (Auth::guest())
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link {{ Request::is('login') ? "active" : "" }}" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a> </li>
                <li class="nav-item"> <a class="nav-link {{ Request::is('register') ? "active" : "" }}" href="{{ route('register') }}">Register</a> </li>
            </ul> 
        @else
            <ul class="navbar-nav mr-auto"> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href id="sale01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sale</a>
                    <div class="dropdown-menu" aria-labelledby="sale01">
                    <a class="dropdown-item" href="/sale/gold">Sale Gold</a>
                    <a class="dropdown-item" href="/sale/silver">Sale Silver</a>
                    <a class="dropdown-item" href="/sale/diamond">Sale Diamond jewellery</a>
                    <a class="dropdown-item" href="/sale/gemstone">Sale Gemstones</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href id="purchase01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Purchase</a>
                    <div class="dropdown-menu" aria-labelledby="purchase01">
                    <a class="dropdown-item" href="/purchase/gold">Purchase Gold</a>
                    <a class="dropdown-item" href="/purchase/silver">Purchase Silver</a>
                    <a class="dropdown-item" href="/purchase/diamond">Purchase Diamond jewellery</a>
                    <a class="dropdown-item" href="/purchase/gemstone">Purchase Gemstones</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('expense') ? "active" : "" }}" href="/expense">Expense</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('party') ? "active" : "" }}" href="/party">Manage Party</a>
                </li>

                @if(Request::is('sale/new/*'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href id="sale01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Branch</a>
                        <div class="dropdown-menu" aria-labelledby="sale01">
                            <a href="/select/branch/sn" class="dropdown-item" style="background-color:#00ff00;">Smriti Nagar @if (Session::has('branch')) @if(Session::get('branch')=='Smriti Nagar')<i class="fa fa-check" aria-hidden="true"></i> @endif @endif</a>
                            <a href="/select/branch/nn" class="dropdown-item" style="background-color:#ffff00;">Nehru Nagar @if (Session::has('branch')) @if(Session::get('branch')=='Nehru Nagar')<i class="fa fa-check" aria-hidden="true"></i> @endif @endif</a>
                        </div>
                    </li>
                @endif

                @if(Request::is('purchase/new/*'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning" href id="sale02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Party</a>
                        <div class="dropdown-menu" aria-labelledby="sale02">
                            @foreach($parties as $party)
                                <a href="/select/party/{{$party->id}}" class="dropdown-item">{{$party->party}}</a>
                            @endforeach
                            
                            
                        </div>
                    </li>
                @endif
            </ul><!--Left side menu Keep-->

            <ul class="navbar-nav mr-left">
                <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }}</a> </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>        
        @endif
      </div>
    </nav>


<div>
    @yield('content')
</div>
        
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Placed at the end of the document so the pages load faster -->
    

    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

   
    <script src="{{ asset('datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>

    <link href="{{ asset('datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">


    <script src="{{ asset('pickadate/lib/picker.js') }}"></script>
    <script src="{{ asset('pickadate/lib/picker.date.js') }}"></script>
        <script>
            $('.datepicker').pickadate(
              { 
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd' 
              }
              );
        </script>

<script>
function calc() {
 
            //get the values
            var texable =  parseFloat( $("#texable").val() );
            var s =  parseFloat( $("#sgst").val() );
            var c =  parseFloat( $("#cgst").val() );
            var i =  parseFloat( $("#igst").val() );

            //SGST %
            var sp = (texable*s)/100;

            //CGST %
            var cp = (texable*c)/100;

            //IGST %
            var ip = (texable*i)/100;

            var total = (texable+sp+cp+ip).toFixed(2);//calcuate total

            //set total value to total input
            $("#total").val(total);
}
</script>

<script>
function validation(){

    var branch = $("#branch").val();
    var date   = $("#date").val();
    var bill_no= $("#bill_no").val();
    var qty    = $("#qty").val();
    var texable= $("#texable").val();
    var s      = $("#s_amount").val();
    var c      = $("#c_amount").val(); 
    var i      = $("#i_amount").val();
    var total  = $("#total").val(); 
    var gst_no  = $("#gst_no").val(); 
    
    var val=true;
    if(branch==''){
        alert('Branch should not be empty.');
        val=false;
    }
    if(date==''){
        alert('Bill Date should not be empty.');
        val=false;
    }
    if(bill_no==''){
        alert('Bill Number should not be empty.');
        val=false;
    }
    if(qty==''){
        alert('Quantity should not be empty.');
        val=false;
    }
    if(texable==''){
        alert('Texable should not be empty.');
        val=false;
    }
    if(s==''){
        alert('SGST should not be empty.');
        val=false;
    }
    if(c==''){
        alert('CGST should not be empty.');
        val=false;
    }
    if(i==''){
        alert('IGST should not be empty.');
        val=false;
    }
    
    if(total==''){
        alert('Total should not be value.');
        val=false;
    }
    if(total=='NaN'){
        alert('Total should be a numaric value.');
        val=false;
    }
    if(gst_no!='' && gst_no.length<15){
        alert('GST Number should be in 15 characters.');
        val=false;
    }

    return val;
}

function sum()
{
    var texable =  parseFloat( $("#texable").val() );
    var s =  parseFloat( $("#s_amount").val() );
    var c =  parseFloat( $("#c_amount").val() );
    var i =  parseFloat( $("#i_amount").val() );
    
    var sum = (texable+s+c+i).toFixed(2);//calcuate total
    $("#total").val(sum);    
}
</script>
  </body>
</body>
</html>
