
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

<section>

<div class="container">


<div id="formpanel" class="panel panel-default " style="">
			

            <br>
            <br>
                 
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                <div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Create Special or Festival Offer') }}</a></div>
                                    <div class="card-body">
                                    
                                    
                                        <form  id="createofferspecial" method="POST">
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
                                                    <input type="radio" id="taka" name="prize" value="taka" required> Taka <input type="radio" id="product" name="prize" value="product">Products
													
												
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
												<input type="text" class="form-control " name="quantity" id="quantity"  data-parsley-type="number"  data-parsley-trigger="keyup" placeholder="Enter Quantity">
											</div>											
										</div>


                                            </div>
    
    
                                              
    
    
                                                
                                                <div class="row">
                                                
                                                <div class="col-md-6">
											<div class="form-group">
											<label> Start Offer Date<span class="red">*</span></label>
													<input type="date" class="form-control " name="startdate" id="" required data-parsley-type="date" required >
											</div>											
										</div>
    
                                     
    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                           <label >End Offer Date<span class="red">*</span></label>
                                                            <input type="date" name="lastdate" id="lastdate"  data-parsley-trigger="keyup" required class="form-control" />
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


</div>

<br>


</section>



@endsection

@section('getjs')
<script>

var SITEURL = '{{URL::to('')}}';


var deliverycharge=50;


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
    url: SITEURL+"/getproductnametoffer",
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












$(document).ready(function(){

   
    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});









// hide and show for  select taka or product





//check promo code and get  discount offer data

        



$('#createofferspecial').parsley();



$('#createofferspecial').on('submit', function(event){
	event.preventDefault();
	if($('#createofferspecial').parsley().isValid())
{
	$.ajax({
			url: SITEURL +"/createofferspecialandfestival",
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
				toastr.success("Offer Created Successfully");

			}, 1300);

			$('#createofferspecial')[0].reset();
			$('#createofferspecial').parsley().reset();
		
}



			
			$('#submit').attr('disabled',false);
			$('#submit').val('Submit');
		
		
		   }
	});
	}


});




$('#taka').click(function(){

    discounttaka();

});


$('#product').click(function(){
    discounproduct();

});


$('.chosen-select').chosen({width: "100%"});

getproductname();

});






</script>




@endsection
