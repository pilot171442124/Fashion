
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

<section class="testimonial-area pt-10 pb-10 ">
	<div id="listpanel" >
			<div class="container">

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered table-responsive  " style="width:100%">
								<thead>
									<tr>
										<th style="display:none">Id</th>
						
										<th>Serial</th>
                                        <th>Offer Name</th>
										<th>Promo Code</th>
										<th>Discount</th>
										<th>Min Price</th>
										<th>Product Name</th>
										<th>Quantity</th>

										<th>Start Date</th>
										<th>Last Date</th>								
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



<!--update panel-->

<section>

<div class="container">


<div id="formpanel" class="panel panel-default" style="display:none">
			

            <br>
            <br>
                 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                <div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Update Special or Festival Offer') }}</a></div>
                                    <div class="card-body">
                                    
                                    
                                        <form  id="updateproductoffer" method="POST">
                                        @csrf
                                           
                                        
                                        
                                        
                                    <div class="row">
                                            <div class="col-md-6">
											<div class="form-group">
											<label>Offer Name<span class="red">*</span></label>
													<input type="text" class="form-control " name="offername" id="offername" required   data-parsley-trigger="keyup" placeholder="Enter Offer Name">
											</div>											
										</div>

                                    </div> 
                                        
                                                                                        
                                        <div class="row">
                                            <div class="col-md-6">
											<div class="form-group">
											<label>Promotion Code<span class="red">*</span></label>
													<input type="text" class="form-control " name="promocode" id="promocode" required   data-parsley-trigger="keyup" placeholder="Enter Promo Code Number">
											</div>											
										</div>

                                    </div>

    
                                    <div class="row">
											
                                    <div class="col-md-6">
											<div class="form-group">
											<label> Minimum to Buy<span class="red">*</span></label>
													<input type="text" class="form-control " name="minprice" id="minprice" required data-parsley-type="number" required data-parsley-trigger="keyup" placeholder="Enter Price">
											</div>											
										</div>
									</div>




                                            <div class="row">
                                            <div class="col-md-4">
												<div class="form-group">
													<label>Select button to choose<span class="red">*</span></label>
													<br>
                                                    <input type="radio" id="taka" name="prize" value="taka" > Taka <input type="radio" id="product" name="prize" value="product">Products
													
												
												</div>
											</div>
    
    
                                        <div class="col-md-4" id="discountproduct" style="display:none">
                                                <div class="form-group">
                                                    <label>Product Name<span class="red">*</span></label>													
                                                    <select data-placeholder="Choose Product Name..." class="chosen-select" id="productname" name="productname" >
                                                        <option value="">Select Product</option>
                                                        <option value=""></option>
                                                        
                                                    </select>
                                                </div>											
                                            </div>

                                            <div class="col-md-4" id="discounttaka" style="display:none">
											<div class="form-group">
											<label> Discount Price<span class="red">*</span></label>
													<input type="text" class="form-control " name="discount" id="discount"  data-parsley-type="number"  data-parsley-trigger="keyup" placeholder="Enter Price">
											</div>											
										</div>

                                        <div class="col-md-4" id="quantity" style="display:none">
											<div class="form-group">
											<label> Quantity<span class="red">*</span></label>
												<input type="text" class="form-control " name="quantity" id="productquantity"    data-parsley-trigger="keyup" placeholder="Enter Quantity">
											</div>											
										</div>


                                            </div>
    
    
                                              
    
    
                                                
                                                <div class="row">
                                                
                                                <div class="col-md-6">
											<div class="form-group">
											<label> Start Offer Date<span class="red">*</span></label>
													<input type="date" class="form-control " name="startdate" id="startdate" required data-parsley-type="date" required >
											</div>											
										</div>
    
                                     
    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                           <label >End Offer Date<span class="red">*</span></label>
                                                            <input type="date" name="lastdate" id="lastdate"  data-parsley-trigger="keyup" required class="form-control" />
                                                        </div>
                                                </div>
                                            </div>
    



											<div class="row">
											
											<div class="col-md-6">
													<div class="form-group">
												
															<input type="hidden" class="form-control " name="recordid" id="recordid" required data-parsley-type="number" required data-parsley-trigger="keyup" placeholder="Enter Price">
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












@endsection

@section('getjs')
<script>

var SITEURL = '{{URL::to('')}}';


function editpanel(){
$('#listpanel').hide();
$('#formpanel').show(1000);


}

function listpanel(){
$('#listpanel').show(1000);
$('#formpanel').hide();


}

function discounttaka(){
$('#discounttaka').show(100);
$('#discountproduct').hide();
$('#quantity').hide();



}



function discounproduct(){
$('#discounttaka').hide();
$('#discountproduct').show(100);
$('#quantity').show(500);


}



function getproductname() {

$.ajax({
    type: "post",
    url: SITEURL+"/getproductoffernametoedit",
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
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
        toastr.error("Product Category can not fillup");

        }, 1300);

    }

});
}




//product update

function productofferedit(){

$('#updateproductoffer').parsley();



    $('#updateproductoffer').on('submit', function(event){
        event.preventDefault();
        if($('#updateproductoffer').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/updateproductoffer",
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
					toastr.success("Offer has been Changed");

				}, 1300);

				$('#updateproductoffer')[0].reset();
				$('#updateproductoffer').parsley().reset();
				$("#tableMain").dataTable().fnDraw();

                listpanel();

}



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});



		}


//delete product offers

function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	//url: "http://localhost/olms/deleteBookTypeRoute",
	url: SITEURL+"/deleteproductoffers",
	
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
					toastr.error("Product offer Deleted ");

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
		        "url": "<?php route('getproductoffer') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },


		
			"fnDrawCallback" : function(oSettings) {
				
				if (oSettings.aiDisplay.length == 0) {
		                return;
		            }



//update productoffer
				

$('a.itmEdit', tablemain.fnGetNodes()).each(function() {
		               
					   $(this).click(function() {

						    var nTr = this.parentNode.parentNode;
		                    var aData = tablemain.fnGetData(nTr);

							$.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to update this offers?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
								buttons: {

									confirm: function () {

		                                
										$('#recordid').val(aData['id']);
		                                $('#offername').val(aData['offername']);
		                                $('#promocode').val(aData['promocode']);
		                                $('#minprice').val(aData['min_price']);
		                                $('#discount').val(aData['discount']);
		                                $('#productname').val(aData['Shirt']).trigger("chosen:updated");
										$('#productquantity').val(aData['qt']);
		                        	   
									    $('#startdate').val(aData['startdate']);
		                                $('#lastdate').val(aData['lastdate']);

		                               
									   
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


// products offer delete

$('a.itmDrop', tablemain.fnGetNodes()).each(function() {

$(this).click(function() {

	var nTr = this.parentNode.parentNode;
	var aData = tablemain.fnGetData(nTr);

	$.confirm({
	title: 'Are you sure?!',
	content: 'Do you really want to delete this Offer?',
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
			    {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"offername","sWidth": "12%"},
		       
			    {"data":"promocode","sWidth": "12%"},
		        {"data":"discount","sWidth": "12%"},
		        {"data":"min_price","sWidth": "12%"},

		        {"data":"productname","sWidth": "12%"},
		        {"data":"qt","sWidth": "12%"},

		        {"data":"startdate","sWidth": "12%"},
		        {"data":"lastdate","sWidth": "12%"},




				
		        {"data":"action","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		    
		    ]







});





$('#taka').click(function(){

discounttaka();

});


$('#product').click(function(){
discounproduct();

});



getproductname();

productofferedit();






$('.chosen-select').chosen({width: "100%"});









});

</script>




@endsection
