
@extends('fashionlayout')


@section('maincontent')





<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8">
<div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 align-right">
                     @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a class="notification-ico" href="{{ url('postview') }}"><i class="fa fa-bell"></i> <sup><span id="notificationcount"></span></sup></a>
                                <span>Hi,</span> <a href="{{ url('profile') }}" <span class="font-white"><u>{{ Auth::user()->name }}</u></span> </a>
                                <a class="btn btn-success mb-0" href="{{ url('logout') }}"><i class="fa fa-lock"></i> {{ __('Logout') }}</a>
                            @else
                                <a class="btn btn-info mb-0" href="{{ route('login') }}"><i class=" fa fa-sign-in "></i> {{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a class="btn btn-info mb-0" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
<br>





<br>

<section class="testimonial-area pt-10 pb-10">
	<div id="listpanel" >
			<div class="container">

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:100%">
								<thead>
									<tr>
										<th style="display:none">Id</th>
						
										<th>Serial</th>
                                        <th>Name</th>
										<th>Invoice</th>
										<th>Transaction ID</th>
										<th>Total Quantity</th>
										<th>Total Amount</th>
										<th>Action</th>								
										
									</tr>
								</thead>
								<tbody>
								</tbody>				
							</table>
						</div>
					</div>
				</div>
		</div>

</section>


@endsection

@section('getjs')
<script>

var SITEURL = '{{URL::to('')}}';




$(document).ready(function(){


   
    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


tablemain=$("#tableMain").dataTable({
		"bFilter" : true,
		//"scrollY": true,
		    "bDestroy": true,
			"bAutoWidth": false,
		    "bJQueryUI": true,      
		    "bSort" : true,
		    "bInfo" : true,
		    "bPaginate" : true,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
			"order": [[ 3, "asc" ]],
		    
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('getinvoicedata') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },


		
			"fnDrawCallback" : function(oSettings) {
				
				if (oSettings.aiDisplay.length == 0) {
		                return;
		            }




				



			},

            "columns":[
		        {"data":"id","bVisible" : false},		       		   
			    {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"customername","sWidth": "12%"},
		       
			    {"data":"invoice","sWidth": "12%"},
		        {"data":"payment_txr","sWidth": "12%"},
		        {"data":"quantity","sWidth": "12%"},
		        {"data":"amount","sWidth": "12%"},


				
		        {"data":"action","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		    
		    ]










});

$('.chosen-select').chosen({width: "100%"});









});

</script>




@endsection
