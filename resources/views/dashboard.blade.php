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
			<div class="container">

            


            <div class="row">
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content bg-primary">
								<h1 class="no-margins" id="totalcustomer"></h1>
								<span class="no-margins"><i class="fas fa-user" style="font-size:25px;"></i> Total Customer</span>
							</div>
						</div>
					</div>
				


        
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content bg-success">
								<h1 class="no-margins" id="totalsalesman"></h1>
								<span class="no-margins"><i class="fas fa-user" style="font-size:25px;"></i> Total Selesman</span>
							</div>
						</div>
					</div>


  
					
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content " style="background-color:rgb(80, 50, 100); ">
								<h1 class="no-margins" id="totalusers"></h1>
								<span class="no-margins"><i class="fas fa-user" style="font-size:25px;"></i> Total Users</span>
							</div>
						</div>
					</div>
				
                </div>






            <div class="row">
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content " style="background-color:rgb(50, 50, 50)">
								<h1 class="no-margins" id="today"></h1>
								<span class="no-margins"><i class="fa fa-money" style="font-size:25px;"></i> Today</span>
							</div>
						</div>
					</div>
				


        
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content " style="background-color:rgb(200, 80, 100)">
								<h1 class="no-margins" id="month"></h1>
								<span class="no-margins"><i class="fa fa-hotel" style="font-size:25px;"></i> This Month</span>
							</div>
						</div>
					</div>


					
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content " style="background-color:rgb(200, 100, 50)">
								<h1 class="no-margins" id="year"></h1>
								<span class="no-margins" ><i class="fa fa-hotel" style="font-size:25px; "></i> This Years</span>
							</div>
						</div>
					</div>
				
                </div>



		
		</section>




<section class="testimonial-area pt-10 pb-10">

<div class="container">

                   <div class="row">
					<div class="col-lg-12">
						<div class="ibox-content">
							<div id="issuedtrendbymonth"></div>
						</div>
					</div>
				</div>	


</div>



</section>













					

									

@endsection


@section('extralibincludefooter')
   <!-- Highchart -->
	<script src="{{ asset('public/js/highcharts.js') }}" crossorigin="anonymous"></script>
	<script src="{{ asset('public/js/exporting.js') }}" crossorigin="anonymous"></script>
@endsection


@section('getjs')
<script>
var SITEURL = '{{URL::to('')}}';

var tablemain;











function getIssuedTrendData(){


$.ajax({
	type: "post",
	url: SITEURL+"/highchart",
	data: {
		"id":1,
		"_token":$('meta[name="csrf-token"]').attr('content')
	},
	success:function(response){


		$("#issuedtrendbymonth").highcharts({
		chart: {
				type: "bar",
				animation: Highcharts.svg,
				height:350
			},
		title: {
			text: "List of how much customers has Paymented on every years and months"
		},
		// subtitle: {
			// text: $("#StartDate").val()+" to "+$("#EndDate").val()+" and Accounts Head: "+$('#CarId').find(":selected").text()
		// },
		yAxis: {
			//gridLineWidth: 0,
			title: {
				text: 'Number of Customers'
			}
		},
		xAxis: {
			// categories: ["1 Aug 18", "2 Aug 18", "3 Aug 18", "4 Aug 18", "5 Aug 18", "6 Aug 18", "7 Aug 18", "8 Aug 18"]
			categories: response.category
			,labels: {
						 //enabled:false,//default is true
						 y : 20, rotation: -45, align: 'right' 
					}
		},
		legend: {
			layout: 'horizontal'
		},
		credits: {
				enabled: false
			},
		exporting: {
				filename: "Payment_by_Year_Month"
			},
		tooltip: {
			shared: true,
			crosshairs: true
		},
		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				marker: {
					//fillColor: '#FFFFFF',
					lineWidth: 1//,
					//lineColor: null // inherit from series
				}
			}
		},
		series: response.series
		




	});


	},
	error:function(error){
		setTimeout(function() {
			toastr.options = {
				closeButton: true,
				progressBar: true,
				showMethod: 'slideDown',
				timeOut: 4000
			};
		toastr.error("no more data");

		}, 1300);

	}

});


}




















$(document).ready(function(){



	$.ajax({
            type: "post",
            url: SITEURL+"/dashboardgetiboxdata",
            data: {
                "id":1,
        
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){    
           
              
			  
			  
			   $("#totalcustomer").html(response.coustomercount);
			   $("#totalsalesman").html(response.salesmancount);
			   $("#totalusers").html(response.totalusers);
			   $("#today").html(response.today);
			   $("#month").html(response.month);
			   $("#year").html(response.year);




			

            }

            });
              
		getIssuedTrendData();













	
});





</script>


<style>
.ibox {
	clear: both;
	margin-bottom: 25px;
	margin-top: 0;
	padding: 0;
	background-color: red;

}

.ibox-content {
	clear: both;
}
.ibox-content {
	
	color: white;
	padding: 15px 20px 20px 20px;
	border-color: #e7eaec;
	border-image: none;
	border-style: solid solid none;
	border-width: 1px 0;
	text-align: center;
}

.ibox-content h1{
	color: white;
}
		
.font-white {
    color: white !important;
}


</style>




@endsection