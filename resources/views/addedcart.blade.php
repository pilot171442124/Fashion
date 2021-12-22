
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


<section id="promo" style="display:none">
<div class="container">
<form id="promocode" method="post">
<div class="row">
<div class="col-md-6">
    <div class="form-group">
    <label>Promo Code </label>
    <br>
            <input type="text"   name="promo_code" id="promo_code"  required data-parsley-trigger="keyup" placeholder="Enter Code">
            <input type="submit" style="color:green"value="Apply">

    </div>
    <span id="validityCheckmsg" style="color:red"> </span>											

</div>

</div>

</form>
</div>


</section>




<section id="payment" style="display:none"> 

<div class="container">
<div>

<button id="bKash_button">Payment with Bkash</button>

</div>

</div>

</section>




<section class="testimonial-area pt-10 pb-10">
	

<div id="listpanel" >
			<div class="container">
           


					<div class="row">
						<div class="col-lg-12">	
                        <form id="cartaddeddata" method="post">
							<table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:90%;">
								<thead>
									<tr>
                                       <th>serial</th>
																
                                        <th>Product Name</th>
										<th>Price</th>
										<th>Discount</th>
										<th>Tags</th>
										<th>Size</th>

										<th>Quantity</th>
										<th>Image</th>
										<th>Total</th>
										
									</tr>
								</thead>
								<tbody>
                                <?php $i = 0 ?>
                                  @foreach($addedcartdata as $row)
                                  
                                  <?php $i++ ?>
                                  <tr>
                                   <td>{{$i}}</td>
                                  <td> {{$row->product_name}} <input type="hidden"  name="product_name[]"value="{{$row->product_name}}"></td>
                                  <td> {{$row->product_price}} <input type="hidden"  name="product_price[]" value="{{$row->product_price}}"></td>
                                  <td> {{$row->discount}}%  <input type="hidden" name="product_discount[]"value="{{$row->discount}}"></td>
                                  <td> {{$row->tags}} <input type="hidden" name="tags[]"value="{{$row->tags}}"></td>
                                  <td> {{$row->size}} <input type="hidden" name="size[]" value="{{$row->size}}"></td>
                                  <td> {{$row->quantity}} <input type="hidden" name="quantity[]" value="{{$row->quantity}}"></td>
                                  <td><img style="height:100px" src="{{ URL::asset('images/') }}/{{$row->image}}" alt="" /> <input type="hidden" name="image[]" value="{{$row->image}}"></td>                                                    
                                  <td> {{$row->total}} <input type="hidden" name="total" value="{{$row->total}}">  <input type="hidden" name="total[]" value="{{$row->size}}"> </td>

                                  </tr>
                            
                               
                                  @endforeach


								</tbody>				
							</table>
						</div>
					</div>


                    <p style="font-size:20px">Delivery Charge: <span id="deliverycharge" style="color:red">0</span></p>
                    <p style="font-size:20px">Discount Offer: <span id="discounttaka" style="color:red">0</span></p>

                    <p style="font-size:20px">Total: <span id="total">0</span></p>

 <input type="checkbox" id="check"><span style="color:red"> Please give Your Current Address to Delivery</span>
				
                
                
<div id="address" style="display:none"> 
            
            
<div class="row">
<div class="col-md-6">
    <div class="form-group">
    <label>name<span class="red">*</span></label>
            <input type="text" class="form-control " value="{{Auth::user()->name}}" name="name" id="price"  required data-parsley-trigger="keyup" placeholder="Enter Name">
    </div>											
</div>



 <div class="col-md-6">
        <div class="form-group">
        <label>Phone<span class="red">*</span></label>
            <input type="number" class="form-control " value="{{Auth::user()->phone}}" name="phone" id="quantities" required data-parsley-type="number" required  data-parsley-trigger="keyup" placeholder="Enter Phone">
    
        </div>
    </div>											

    </div>
    <div class="row">

<div class="col-md-12">
 
<label for="w3review">Address<span class="red">*</span></label>
<textarea id="w3review" class="form-control" name="address" rows="4" cols="50">
											
</textarea>
										

    </div>
    </div>
     <br>       
<input type="submit" name="submit" value="Check out Proccssed">

</form>    

            </div>
        </div>
		</div>

</section>





@endsection

@section('getjs')
<script>

var SITEURL = '{{URL::to('')}}';

//$('#editform').parsley();

var deliverycharge=50;



$(document).ready(function(){

   
    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
              $("#address").show();
            }
            else if($(this).prop("checked") == false){
                $("#address").hide();

            }
        });



//check promo code and get  discount offer data

    $('#promocode').parsley();

    $('#promocode').on('submit', function(event){
    event.preventDefault();

    if($('#promocode').parsley().isValid())
{
    $.ajax({
            url: SITEURL +"/promocode",
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
        

                a = parseInt(data.discountoffer),
                b = parseInt(deliverycharge); 
                sum= a+b;

                if (data.discountoffer>0) {
                  $('#total').html(sum+'.Tk');                 
                  $('#discounttaka').html('-'+data.discountaka+'.00.Tk');
                  
                  payment(sum);


                }


               else if (data.exit=="exit") {
                                  
                  $('#validityCheckmsg').html('you already used this code');
                  
                }




               else if (data.productname && data.quantity>0) {
                    $('#discounttaka').html(data.quantity+'-'+data.productname+' '+'free');
                  
                  $('#validityCheckmsg').html('Applied');    

                  
                                  
                    }

              



            },





 error:function(error){
            

$('#validityCheckmsg').html('Invalid Promo Code');

    
            }

});

}
});



//gettotalprrice

$.ajax({
            type: "post",
            url: SITEURL+"/totalpriceaddedcart",
            data: {
                "id":1,
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){    
            a = parseInt(response),
            b = parseInt(deliverycharge); 
            sum= a+b;
            $('#total').html(sum+'.00.Tk');
           

            payment(sum);
            
            }

            });

// show promo input box
//check the product discount offer is true or not

            $.ajax({
            type: "post",
            url: SITEURL+"/checkproductdiscount",
            data: {
                "id":1,
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){    
           
                
                if (response>0) {
                  $('#promo').show();  
                }
                
                
                

            }

            });






$('#cartaddeddata').parsley();


$('#cartaddeddata').on('submit', function(event){
    event.preventDefault();
    if($('#cartaddeddata').parsley().isValid())
{
    $.ajax({
            url: SITEURL +"/makepayment",
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
        



$('#payment').show();
$('#listpanel').hide();


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

            $('#cartaddeddata')[0].reset();
            $('#cartaddeddata').parsley().reset();
}


         
  
            $('#submit').attr('disabled',false);
            //$('#submit').val('+  Cart Add to Buy');
        
        
           }
    });
    }

        });







// bkash start

$.ajax({
            url: "{!! route('token') !!}",
        
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                console.log('got data from token  ..');
				console.log(JSON.stringify(data));
				
                accessToken=JSON.stringify(data);
            },
			error: function(){
						console.log('error');
                        
            }

    
        });

             
        var paymentConfig={
            createCheckoutURL: "{!! route('createpayment') !!}",
            executeCheckoutURL: "{!! route('executepayment') !!}"
        };

		
        var paymentRequest;

function payment(amount)

{



        paymentRequest = {amount:amount, intent: 'sale', invoice:102};


        

		console.log(JSON.stringify(paymentRequest));



        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function(request){
                console.log('=> createRequest (request) :: ');
                console.log(request);
                
                $.ajax({
                   
                   
                    url: paymentConfig.createCheckoutURL + "?amount=" + paymentRequest.amount + "&invoice=" + paymentRequest.invoice,
                   
                    //url: paymentConfig.createCheckoutURL+"?amount="+paymentRequest.amount,
                    type:'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        console.log('got data from create  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));
                        
                        var obj = JSON.parse(data);
                        
                        if(data && obj.paymentID != null){
                            paymentID = obj.paymentID;
                            bKash.create().onSuccess(obj);
                        }
                        else {
							console.log('error');
                            bKash.create().onError();
                        }
                    },
                    error: function(){
						console.log('error');
                        bKash.create().onError();
                    }
                });
            },
            
            executeRequestOnAuthorization: function(){
                console.log('=> executeRequestOnAuthorization');
                $.ajax({
                    url: paymentConfig.executeCheckoutURL+"?paymentID="+paymentID,
                    type: 'GET',
                    contentType:'application/json',
                    success: function(data){
                       // console.log('got data from execute  ..');
                       // console.log('data ::=>');
                       // console.log(JSON.stringify(data));
                        
                        data = JSON.parse(data);
                        if(data && data.paymentID != null){
                         alert('[SUCCESS] data : ' + JSON.stringify(data));
                            
                            
                            
                            
                            
                            

            $.ajax({
            type: "post",
            url: SITEURL+"/paymentinsertroute",
            data: {
                "id":1,
                'paymentid':data.paymentID,
                'amount':data.amount,
                'invoice':data.merchantInvoiceNumber,

                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){    
           
                
                
                

            }

            });
              
            window.location.href = "{{ url('/payment') }}";                              
                        }
                        else {
                            bKash.execute().onError();
                        }
                    },
                    error: function(){
                        bKash.execute().onError();
                    }
                });
            }
        });






}	

//bkash end













$('#deliverycharge').html(deliverycharge+'.Tk');



});




function callReconfigure(val){
        bKash.reconfigure(val);
    }

    function clickPayButton(){
        $("#bKash_button").trigger('click');
    }


</script>




@endsection
