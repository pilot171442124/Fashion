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
















<section class="testimonial-area pt-10 pb-10" >

<div class="container">




             <div id="formpanel" class="panel panel-default " style="">
			

					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Create Product type of Generations') }}</a></div>
								<div class="card-body">
								
								
									<form  id="generation" method="POST">
									@csrf
									

										<div class="row">

										<div class="col-md-6">
											<div class="form-group">
											<label>Create Product Generation<span class="red">*</span></label>
													<input type="text" class="form-control marquee" name="gen" id="gen" required required data-parsley-trigger="keyup" placeholder="Product type">
											</div>											
										</div>

		
											</div>




										<div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
										
												
										 	   </div>
     							
											</div>
								

							
										
									</form>
                                     
									</div>
								</div>
						    </div>
						</div>
					</div>
              
					</div>
			
						
                                     
									
</section>
	




<section class="testimonial-area pt-10 pb-10">
	<div id="listpanel" >
			<div class="container">

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered " style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">Id</th>
										<th>Serial</th>
										<th>Products Type</th>
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



<br>	

<br>	
<br>	
<br>	

					

									

@endsection

@section('getjs')
<script>
var SITEURL = '{{URL::to('')}}';



function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	//url: "http://localhost/olms/deleteBookTypeRoute",
	url: SITEURL+"/deleteproducttype",
	
	datatype:"json",
	data: {
		"id":recordId,
		"_token":$('meta[name="csrf-token"]').attr('content')
	},
	success:function(response){
		if(response==1){
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Product type Deleted ");

				}, 1300);

		}
		
		//alert("success");
		//console.log(response);
		//$("#tableMain").dataTable().fnDraw();

		$("#tableMain").dataTable().fnDraw();
	},
	

});
}



$(document).ready(function(){



    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


    
    $('#generation').parsley();




    $('#generation').on('submit', function(event){
        event.preventDefault();
        if($('#generation').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/addproductgeneration",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
					cache: false,
			processData:false,
				beforeSend:function(){
				$('#submit').attr('disabled','disabled');
				$('#submit').val('Submitting...');
				},
				success:function(data)
				{
			

if(data==1){

	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Generation Added Successfully");

				}, 1300);

				$('#generation')[0].reset();
				$('#generation').parsley().reset();
}



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
		$("#tableMain").dataTable().fnDraw();
			
			
			   }
		});
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
		        "url": "<?php route('viewproductggenerations') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },

			
			
			


			"fnDrawCallback" : function(oSettings) {
				
				if (oSettings.aiDisplay.length == 0) {
		                return;
		            }

			
$('a.itmDrop', tablemain.fnGetNodes()).each(function() {

$(this).click(function() {

	var nTr = this.parentNode.parentNode;
	var aData = tablemain.fnGetData(nTr);

	$.confirm({
	title: 'Are you sure?!',
	content: 'Do you really want to delete this Product type?',
	icon: 'fa fa-question',
	theme: 'bootstrap',
	closeIcon: true,
	animation: 'scale',
	type: 'red',
	buttons: {
		confirm: function () {
			onConfirmWhenDelete(aData['id']);
		},
		cancel: function () {
			//$.alert('Canceled!');
		}
	}
});

});
});





			},
			


			"columns":[
		        {"data":"id","bVisible" : false},
		        {"data":"Serial","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        {"data":"producttype","sWidth": "60%"},		       
		        {"data":"action","sWidth": "30%", "sClass": "align-center", "bSortable": false},
		    
            ]


			});













 //$('.chosen-select').chosen({width: "100%"});



});

</script>

<style>



</style>

@endsection
