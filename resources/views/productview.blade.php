
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
										<th style="display:none">product_cart_id</th>							
										<th>Serial</th>
                                        <th>Product Name</th>
										<th>Price</th>
										<th>Discount</th>
										<th>Tags</th>
																		
										<th>Image</th>

										<th>Remarks</th>
										<th>Stock</th>
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









<section class="testimonial-area pt-10 pb-10" >

<div class="container">




             <div id="formpanel" class="panel panel-default " style="display:none">
			

					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Product Data Update') }}</a></div>
								<div class="card-body">
								
								
									<form  id="editform" method="POST">
									@csrf
										<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Select Product Category<span class="red">*</span></label>													
												<select data-placeholder="Choose Category..." class="chosen-select" id="productname" name="productname" >
													<option value="">Select Category</option>
										
													
													<!--<option value="Other">Other</option>-->
												</select>
											</div>											
										</div>

										

										</div>


										<div class="row">

										<div class="col-md-6">
											<div class="form-group">
											<label>Price<span class="red">*</span></label>
													<input type="text" class="form-control " name="price" id="price"  data-parsley-type="number" data-parsley-trigger="keyup" placeholder="Enter Price">
											   </div>											
										  </div>

									</div>


											
												




											
											<div class="row">
											<div class="col-md-6">
											<div class="form-group">
											   
											<label for="w3review">Product Tags<span class="red">*</span></label>
											<textarea id="tags" class="form-control" name="tags" rows="4" cols="50">
											
											</textarea>
     										 </div>
     										</div>

											 <div class="col-lg-6">
                                                <div class="form-group p-4 m-2">
                                                    <label > Insert Product Image</label>
                                                     <input type="file" name="file" >
                                                </div>
                                            </div>



										</div>





										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
											
												<label>Select Product Available<span class="red">*</span></label>													
												<select data-placeholder="Choose Stock..." class="chosen-select" id="stock" name="stock" >
													<option value="">Select Stock</option>
													<option value="Instock">In stock</option>
													<option value="Outstock">Out stock</option>
			
													
													<!--<option value="Other">Other</option>-->
												</select>
												</div>											
											</div>
											

										</div>

										   <div class="row">
											  <div class="col-md-6">
											    <div class="form-group">
											   
													<label for="remarks">Product Remarks<span class="red">*</span></label>
													<textarea id="remarks" class="form-control" name="remarks" rows="4" cols="50">
												
													</textarea>
     										 </div>
     										</div>
										</div>


       									 <input type="hidden" id="recordid" name="recordid">




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






<!--Discount panel-->



<section class="testimonial-area pt-10 pb-10" >

<div class="container">




             <div id="discountpanel" class="panel panel-default " style="display:none">
			

					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Create New Discount') }}</a></div>
								<div class="card-body">
								
								
									<form  id="discountform" method="POST">
									@csrf
										
										
										

										<div class="row">

										<div class="col-md-6">
											<div class="form-group">
											<label>Discount<span class="red">*</span></label>
													<input type="text" class="form-control " name="discount" id="discount" required data-parsley-type="number" data-parsley-trigger="keyup" placeholder="Enter Discount">
											</div>											
										</div>
										</div>



								

                                            <input type="hidden" id="disrecordid" name="disrecordid">




										<div class="form-group row">
											<div class="col align-self-center">
								 			<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
										  <a id="discancel" class=" btn btn-sm btn-warning"> <i class="fas fa-backspace  "></i> Cancel </a>
												
										 	   </div>
     							
											</div>
								

							
										
									</form>
                                     
									</div>
								</div>
						    </div>
						</div>
					</div>
              
					</div>
			
				<br>		
                                     
									
</section>








@endsection

@section('getjs')
<script>

var SITEURL = '{{URL::to('')}}';

function editpanel()
{
$('#listpanel').hide();
$('#formpanel').show();


}

function formpanel()
{
$('#formpanel').hide();
$('#listpanel').show();


}


function discountpanel()
{
$('#listpanel').hide();
$('#discountpanel').show();


}
function discountcancel()
{
$('#listpanel').show();
$('#discountpanel').hide();


}


function geteditproductlist() {

$.ajax({
    type: "post",
    url: SITEURL+"/geteditproductlist",
    data: {
        "id":1,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){				
        $.each(response, function(i, obj) {
            $("#productname").append($('<option></option>').val(obj.id).html(obj.productname));
           
        });
        $("#productname").trigger("chosen:updated");
         
    },
    error:function(error){
        //alert("fail");
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
        toastr.error("Dropdown can not fillup");

        }, 1300);

    }

});
}












function editproduct(){




$('#editform').parsley();



$('#editform').on('submit', function(event){
	event.preventDefault();
	if($('#editform').parsley().isValid())
{
	$.ajax({
			url: SITEURL +"/editproduct",
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
				toastr.success("This Product has been Updated Successfully");

			}, 1300);

			//$('#editform')[0].reset();
			//$('#editform').parsley().reset();
			$("#tableMain").dataTable().fnDraw();
}


		
			$('#submit').attr('disabled',false);
			$('#submit').val('Submit');
		
		
		   }
	});
	}


});





}









function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",

	url: SITEURL+"/deleteproductRoute",
	
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
					toastr.error("This Product Deleted Successfully");

				}, 1300);

		}
		
		//alert("success");
		//console.log(response);
		//$("#tableMain").dataTable().fnDraw();

		$("#tableMain").dataTable().fnDraw();
	},
	

});
}
















function discountform(){




$('#discountform').parsley();



$('#discountform').on('submit', function(event){
	event.preventDefault();
	if($('#discountform').parsley().isValid())
{
	$.ajax({
			url: SITEURL +"/discountform",
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
				toastr.success("This Product has been Updated Successfully");

			}, 1300);

			//$('#editform')[0].reset();
			//$('#editform').parsley().reset();
			$("#tableMain").dataTable().fnDraw();
}



			
			$('#submit').attr('disabled',false);
			$('#submit').val('Submit');
		
		
		   }
	});
	}


});





}




















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
		        "url": "<?php route('viewproductlistroute') ?>",
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
		                                $('#productname').val(aData['product_cart_id']).trigger("chosen:updated");
		                               
		                                $('#price').val(aData['price']);
		                               
		                                $('#tags').val(aData['tags']);
		                                $('#stock').val(aData['stock']).trigger("chosen:updated");
		                                $('#remarks').val(aData['Remarks']);



		                    

									    

										
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







//Discount


					$('a.discount', tablemain.fnGetNodes()).each(function() {
		               
					   $(this).click(function() {

						    var nTr = this.parentNode.parentNode;
		                    var aData = tablemain.fnGetData(nTr);

							$.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to Discount the Product',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
								buttons: {

									confirm: function () {

		                                
										$('#disrecordid').val(aData['id']);
		                                  

										
										discountpanel();
										
										
		                                //$.alert('Confirmed!');
		                            },
									cancel: function () {
		                                //$.alert('Canceled!');
		                            }


								}

							});


					   });
					});
















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
		        {"data":"product_cart_id","bVisible" : false},
		       		   
			    {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"productname","sWidth": "12%"},
		        {"data":"price","sWidth": "12%"},
		        {"data":"discount","sWidth": "12%"},

		        {"data":"tags","sWidth": "19%"},
		
		       
	
			   
				{"data":"imageurl","sWidth": "20%",
                    "render": function(data) {
                        return '<img src="images/'+data+'" width="80" height="70" />';
                    } 
				},
			   
			    //{"data":"imageurl","sWidth": "10%"},

		        {"data":"Remarks","sWidth": "10%"},	
		        {"data":"stock","sWidth": "10%"},	

		        {"data":"action","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		    
		    ]










});

editproduct();
geteditproductlist();
discountform();
$('.chosen-select').chosen({width: "100%"});








$('#cancel').click(function(){

formpanel();

});


$('#discancel').click(function(){

	discountcancel();

});






});

</script>




@endsection
