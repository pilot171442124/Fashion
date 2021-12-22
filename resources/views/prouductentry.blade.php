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
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Product Entry') }}</a></div>
								<div class="card-body">
								
								
									<form  id="addproduct" method="POST">
									@csrf
										<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label>Select Product Category<span class="red">*</span></label>													
												<select data-placeholder="Choose Category..." class="chosen-select" id="productname" name="productname" required>
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
													<input type="text" class="form-control " name="price" id="price" required data-parsley-type="number" required data-parsley-trigger="keyup" placeholder="Enter Price">
											</div>											
										</div>
										
										
											</div>


											
												




											
											<div class="row">
											<div class="col-md-6">
											<div class="form-group">
											   
											<label for="w3review">Product Tags<span class="red">*</span></label>
											<textarea id="w3review" class="form-control" name="tags" rows="4" cols="50">
											
											</textarea>
     										 </div>
     										</div>

											 <div class="col-lg-6">
                                                <div class="form-group p-4 m-2">
                                                    <label > Insert Product Image</label>
                                                     <input type="file" name="file" required>
                                                </div>
                                            </div>



										</div>





										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
											
												<label>Stock<span class="red">*</span></label>													
												<select data-placeholder="Choose Stock..." class="chosen-select" id="stock" name="stock" required>
													<option value="">Select Stock</option>
													<option value="Instock">In stock</option>
													<option value="Outstock">Out stock</option>
			
													
													<!--<option value="Other">Other</option>-->
												</select>
												</div>											
											</div>
										
											
										<div class="col-md-6">
												<div class="form-group">
													
												<label>Select Generations<span class="red">*</span></label>													
												<select data-placeholder="Choose Size..." class="chosen-select" id="gen" name="gen" required>
													<option value="">Select Generations</option>
													
										           @foreach($selectgen as $selectgen)	
													
													<option value="{{$selectgen->id}}">{{$selectgen->product_type}}</option>

													@endforeach
				
													
													<!--<option value="Other">Other</option>-->
												</select>
												

												</div>
											</div>
										</div>

										   <div class="row">
											  <div class="col-md-6">
											    <div class="form-group">
											   
													<label for="w3review">Product Remarks<span class="red">*</span></label>
													<textarea id="w3review" class="form-control" name="remarks" rows="4" cols="50">
												
													</textarea>
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
	





<br>	

<br>	
<br>	
<br>	

					

									

@endsection

@section('getjs')
<script>
var SITEURL = '{{URL::to('')}}';




function getproductcategory() {

$.ajax({
    type: "post",
    url: SITEURL+"/getproductcategory",
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
        toastr.error("Dropdown can not fillup");

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


    
    $('#addproduct').parsley();




    $('#addproduct').on('submit', function(event){
        event.preventDefault();
        if($('#addproduct').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/addproductentry",
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
					toastr.success("Product Added Successfully");

				}, 1300);

				$('#addproduct')[0].reset();
				$('#addproduct').parsley().reset();
}



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});


		











 $('.chosen-select').chosen({width: "100%"});

 getproductcategory();

});

</script>



@endsection
