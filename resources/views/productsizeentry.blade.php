
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











<section class="testimonial-area pt-10 pb-10" >


	
<div class="container">





             <div id="editpanel" class="panel panel-default " style="">
			
			 
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Product  Size Entry ') }}</a></div>
								<div class="card-body">
								
								
									<form  id="sizeentry" method="POST">
									@csrf


                                    <div class="row">
                                            <div class="col-md-6">
										        <div class="form-group">
												


												<label>Select Product Category Names<span class="red">*</span></label>													
												
                                                
                                                <select data-placeholder="Choose Category..." class="chosen-select" id="pname" name="pname" required>
												
                                                
                                                
                                                <option value="">Select Categoty</option>
                                                @foreach($productcategory as $productcategory)
													
                                                <option value="{{$productcategory->id}}">{{$productcategory->productname}}</option>
												@endforeach
			
													
													
													<!--<option value="Other">Other</option>-->
												</select>

												</div>
											</div>

											</div>




										<div class="row">
                                            <div class="col-md-6">
										        <div class="form-group">
													
												<label>Select Product Size<span class="red">*</span></label>													
												<select data-placeholder="Choose Size..." class="chosen-select" id="productsize" name="productsize" required>
													<option value="">Select Size</option>
													<option value="S">S</option>
													<option value="L">L</option>
													<option value="M">M</option>
													<option value="XL">XL</option>
													<option value="XS">XS</option>

													<option value="XXXL">XXXL</option>
													
													
													<!--<option value="Other">Other</option>-->
												</select>
												

												</div>
											</div>

											</div>

										
										<div class="row">	

											<div class="col-md-6">
												<div class="form-group">
												<label>Type Quantity<span class="red">*</span></label>													
												
													<input type="number" class="form-control " name="qt" id="qt" required data-parsley-type="number" required  data-parsley-trigger="keyup" placeholder="Enter Quantity">
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
										<th>Products Name</th>
										<th>Size</th>
										<th>Quantity</th>
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



								

							
	
<!--Edit panel-->


<section class="testimonial-area pt-10 pb-10" >

<div class="container">





             <div id="editpanel" class="panel panel-default " style="display:none;">
			

        <button id="backuserbtn" class="pull-right bg-primary"> <i class="fa fa-arrow-left"></i> Back </button>
		<br>
		<br>
			 
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Update Products') }}</a></div>
								<div class="card-body">
								
								
									<form  id="updateproduct" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Products Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="pname" id="pname" required  data-parsley-trigger="keyup" placeholder="Products Name">
												</div>
											</div>
											</div>

										
										<div class="row">	

											<div class="col-md-6">
												<div class="form-group">
												
													<input type="hidden" class="form-control " name="recordid" id="recordid" required data-parsley-type="number" required data-parsley-length="[11, 11]" data-parsley-trigger="keyup" placeholder="Enter User Phone No">
												</div>
											</div>
											

										</div>










										<div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
													<a id="cancel" class=" btn btn-sm btn-warning"> <i class="fas fa-backspace  "></i> Cancel </a>
												
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
						
                                     

	





<br>	

<br>	
<br>	
<br>	

					

									

@endsection

@section('getjs')
<script>
var SITEURL = '{{URL::to('')}}';



function editpanel(){

$("#listpanel").hide();
$("#editpanel").show();



}


function listpanel(){

$("#listpanel").show();
$("#editpanel").hide();



}





$(document).ready(function(){



    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});






//edit panel




$('#updateproduct').parsley();



    $('#updateproduct').on('submit', function(event){
        event.preventDefault();
        if($('#updateproduct').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/updateproduct",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
					cache: false,
			processData:false,
				beforeSend:function(){
				$('#submit').attr('disabled','disabled');
			
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
					toastr.success("Product Updated Successfully");

				}, 1300);

				$('#updateproduct')[0].reset();
				$('#updateproduct').parsley().reset();
				$("#tableMain").dataTable().fnDraw();

                listpanel();

}



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});


//end edit panel



// delete products



function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	//url: "http://localhost/olms/deleteBookTypeRoute",
	url: SITEURL+"/deleteproductsize",
	
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
					toastr.error("Product Deleted Successfully");

				}, 1300);

		}
		
		//alert("success");
		//console.log(response);
		//$("#tableMain").dataTable().fnDraw();

		$("#tableMain").dataTable().fnDraw();
	},
	

});
}




      
      





	  $('#sizeentry').on('submit', function(event){
        event.preventDefault();
	$.ajax({
				url: SITEURL +"/productsizeentrys",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
					cache: false,
			processData:false,
			
				success:function(data)
				{

				if(data=1)
				{

					setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Product Added Successfully");

				}, 1300);

				$('#sizeentry')[0].reset();
					

			    $("#tableMain").dataTable().fnDraw();



				}

			else{


				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Operation Faild");

				}, 1300);
				
			}



			
			   }
		});
		

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
		        "url": "<?php route('viewproductsize') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },




            "fnDrawCallback" : function(oSettings) {
				
				if (oSettings.aiDisplay.length == 0) {
		                return;
		            }



			$('a.itmEdit', tablemain.fnGetNodes()).each(function() {
		               
					   $(this).click(function() {

						    var nTr = this.parentNode.parentNode;
		                    var aData = tablemain.fnGetData(nTr);

							$.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to edit this data?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
								buttons: {

									confirm: function () {

		                                
										$('#recordid').val(aData['id']);
		                                $('#pname').val(aData['productname']);
		                               // $('#usercode').val(aData['usercode']);
		                      
									   									
										editpanel();
										
										
		                                //$.alert('Confirmed!');
		                            },
									cancel: function () {
		                                //$.alert('Canceled!');
		                            }


								}

							});


					   });
					});



// products delete

$('a.itmDrop', tablemain.fnGetNodes()).each(function() {

$(this).click(function() {

	var nTr = this.parentNode.parentNode;
	var aData = tablemain.fnGetData(nTr);

	$.confirm({
	title: 'Are you sure?!',
	content: 'Do you really want to delete this data?',
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
		        {"data":"productname","sWidth": "30%"},	
		        {"data":"productsize","sWidth": "20%"},		       
		        {"data":"productqt","sWidth": "10%"},		       

		        {"data":"action","sWidth": "30%", "sClass": "align-center", "bSortable": false},
		    
            ]

            });





 $('.chosen-select').chosen({width: "100%"});



});

</script>



@endsection
