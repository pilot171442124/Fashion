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




<section>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Please Choose Products Size</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <form  id="sizeentry" method="POST">
         @csrf
         <select data-placeholder="Choose Product Size..." class="chosen-select" id="productsize" name="productsize" >
                     <option value="">Select size </option>
                     
                                                        
             </select>

             <br>
             <br>
     
         <input type="hidden"  name="catidtake" id="catidtake" >
        <input type="submit" class="btn btn-primary" name="submit" value=" Done">
        
        </form>      
        
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>

</section>










@if(Auth::check())

<section id="payment" style="display:none"> 

<div class="container">
<div>

<button id="bKash_button">Payment with Bkash</button>

</div>

</div>

</section>

@endif








@if(Auth::check())
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

@endif



<p id="p"> </p>


<section class="testimonial-area pt-10 pb-10" id="formpanel">

<div class="container">




                <div class="row">
					<div class="col-lg-12">	
                     <form id="cartdataadd"action="post">
                   
							<table id="tableMain" class="table  table-striped table-bordered " style="width:100%" >
								<thead>
									<tr>
										
                                      <th style="display:none">ID</th>
						
										<th>Product Name</th>

										<th>Price</th>
										<th>Image</th>
										<th>Discount</th>
										<th>Size</th>
										<th>Color</th>

										<th>Quantity</th>
										<th>Total</th>
										

										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
                                @foreach($data as $row)
                                <tr>  
                                    <td style="display:none">{{$row->id}}</td>
                            
                                     <td>{{$row->productname}} <input type="hidden"  value="{{$row->productname}}" name="proname[]"></td>
                                     <td>{{ $row->product_price}}.Tk <input type="hidden"  value="{{$row->product_price}}" name="price[]"></td>
                                     <td><img style="height:100px" src="{{ URL::asset('images/') }}/{{$row->imageurl}}" alt="" /> <input type="hidden"  value="{{$row->imageurl}}" name="image[]"></td>
                                     <td>{{$row->product_discount}}%   <input type="hidden" name="product_discount[]" value="{{$row->product_discount}}">    </td>   
                                    
                                    
                                     <td>  <input type="checkbox" id="chec" value="{{$row->id}}" data-toggle="modal" data-target="#myModal" ></td>
                                      
                                     
                                     <td>{{$row->tags}}  <input type="hidden" name="tags[]" value="{{$row->tags}}"></td>
                                      <td> <input type="number" name="quantity[]" id="quantity"value="{{$row->quantity}}"> </td>
                                     <!-- <td>{{$row->quantity}} <input type="text" name="quantity[]" value="{{$row->quantity}}"> </td>-->

                                     <td style=""id="totalprice">{{ (($row->product_price)-($row->product_price*$row->product_discount)/100)*$row->quantity}}    <input type="hidden" name="total[]" value="{{ (($row->product_price)-($row->product_price*$row->product_discount)/100)*$row->quantity}}"> </td>
                                     
                                     
   
                                     <td><a class="btn btn-danger"href="cartid/{{$row->id}}">Cancel</a></td>
                                     
                                </tr>

                                <tr>

                                <input type="hidden" name="id[]" value="{{$row->id}}">
                                <input type="hidden" name="product_id[]" value="{{$row->product_id}}">


                                </tr>
                                
                                
                                
                                  
                        
                                @endforeach
                               
                                
								</tbody>
                                
                                <tfoot>

                                        <tr>
                                            <td colspan="7">Total =</td>
              
                                            
                                            

                                            <td colspan="1"><span id="total"></span> <input type="hidden" id="totalinputtaka"></td>
                                        </tr>
                                </tfoot>

						    </table>
                
               


                           







            @if(Auth::check())


                    <p style="font-size:20px">Delivery Charge: <span id="deliverycharge" style="color:red">0</span></p>
                    <p style="font-size:20px">Discount Offer: <span id="discounttaka" style="color:red">0</span></p>

                
                    <p style="font-size:20px">Total Taka: <span id="totaltaka" style="color:red">0</span></p>

  <div class="row">
        <div class="col-lg-12">	
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
                            <input type="text" class="form-control "  value="{{Auth::user()->phone}}"  name="phone" id="quantities" required data-parsley-type="number"  data-parsley-length="[11, 11]"   data-parsley-trigger="keyup" placeholder="Enter Phone">
                    
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
              
                
                     </div>
                    </div>
                </div>


                
            

                <input type="submit" id="submit" name="submit" class="bg-info " value="+  Cheout Processed">
                
                            @else

                <input type="submit" id="chechout" name="submit" class="bg-info " value="+  Check Out">

                @endif
                
     


                        </form>
                        </div>
					</div>
				

</div>

</section>








<br>	

<br>	
<br>	
<br>	
<br>	
<br>	
	

					

									

@endsection

@section('getjs')
<script>
var SITEURL = '{{URL::to('')}}';

//make invoice Number
 var d = new Date();
  var s= d.getSeconds();
  var m = d.getMinutes();
  var ms= d.getMilliseconds();
  var mo = d.getMonth();
var sumall=s+m+ms+mo;
//

var tablemain;
var deliverycharge=50;
var getinputtotaltaka=[];









function productsizeentry(){


    $('#sizeentry').on('submit', function(event){
        event.preventDefault();
        if($('#sizeentry').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/sizeentry",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
				cache: false,
			    processData:false,
			
				success:function(data)
				{
			

                $('#myModal').modal('toggle');
				
		
			
			
			   }
		});
		}

			});






}














function getproductsize(addtocartid) {

$.ajax({
    type: "post",
    url: SITEURL+"/getproductsize",
    data: {
        "id":1,
        "addtocartid":addtocartid,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
        $("#productsize").append($('<option></option>').val('').html('Select size'));
       
        $.each(response, function(i, obj) {
            
            $("#productsize").append($('<option></option>').val(obj.id).html(obj.product_size));
        
   
        
        });
        $("#productsize").val(' ').trigger("chosen:updated");



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


//when quantity would be click

$("#quantity").click(function(){
    setTimeout(function() {
           
        location.reload();

        

        }, 2000);

});







$(document).ready(function(){



  

//var qt = $( "#quantity" ).val();
//var id = $( "#percartid" ).val();

//$("#p").html(qt);
$( "#tableMain tbody tr" ).click(function() {

//$('#tableMain tbody tr').on('click', function  () {
           
           
           
           
            var cartid = $(this).children("td:eq(0)").text();
     
            var totalprice = $(this).children("td:eq(8)").text();
            var qt = $(this).find("td:eq(7) input[type='number']").val();

            //setTimeout(function() {
           // window.open('addtocart','_self');
                                
                          //  },2000);



            $.ajax({
            type: "post",
            url: SITEURL+"/updatequantityandtotalprice",
            data: {
                "id":cartid,
                "total":totalprice,
                "qt":qt,

              

                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){    
           
               $("#p").html(response);
				//$("#tableMain").fnDraw();
                
                calculateColumn();              



  





            }

            });
              





        });








//









    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});






$('#cartdataadd').parsley();

$('#cartdataadd').on('submit', function(event){
event.preventDefault();

if($('#cartdataadd').parsley().isValid())
{
$.ajax({
        url: SITEURL +"/chechout",
        type:"POST",
    
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend:function(){
			$('#chechout').attr('disabled','disabled');
		
			},
        success:function(data)
        {
            
       $('#payment').show();
       $('#formpanel').hide();
       $('#promo').hide();

total= $('#totalinputtaka').val();
        
getinputtotaltaka.push(total); 
payment(total);
       
     if (data=="login") {
        window.open('login','_self');
        
    }


        }

});

}

});




















    $("#cartdataadd").hover(function(){
 
        

        $.ajax({
            type: "post",
            url: SITEURL+"/checkdiscountandprice",
            data: {
                "id":1,
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){    
     
       
        
     
                $.each(response, function(i, obj) {

                             
                            setTimeout(function() {
                                toastr.options = {
                                    closeButton: true,
                                    progressBar: true,
                                    showMethod: 'slideDown',
                                    timeOut: 10000
                                };
                                toastr.success( obj.productname+" "+"Product Price or Discount has been Updated in Your Cart");
                            }, 100);
    


                     setTimeout(function() {
                    window.open('addtocart','_self');

                }, 11000);
                            
    

                });


                
                    $.ajax({
                            type: "post",
                            url: SITEURL+"/updateaddtocartstatus",
                            data: {
                                "id":1,
                                "_token":$('meta[name="csrf-token"]').attr('content')
                            },
                        });




            }

            

            });




});











$('.chosen-select').chosen({width: "100%"});




 



$(document).ready(function () {
            $('table thead th').each(function (i) {
                calculateColumn(i);
            });
        });
        function calculateColumn(index) {
     
            var total = 0;
            $('table tr').each(function () {
                var value = parseInt($('td', this).eq(8).text());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            totalparse = parseInt(total);
            sum=totalparse+deliverycharge;
        $('#total').eq(index).text('Total: ' + total);
        $('#deliverycharge').html(deliverycharge);
        $('#totaltaka').html(sum);
        $('#totalinputtaka').val(sum);
  
       
       
        }





//address

$('#check').click(function(){
            if($(this).prop("checked") == true){
              $("#address").show();
            }
            else if($(this).prop("checked") == false){
                $("#address").hide();

            }
        });






// promo code start


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
      
        success:function(data)
        {
    

            a = parseInt(data.discountoffer);
            b = parseInt(deliverycharge); 
            c = parseInt(data.discountaka);


      
          
            if (data.discountoffer>0) {
                            
              $('#discounttaka').html('-'+data.discountaka+'.00.Tk');
              $('#validityCheckmsg').html('Aplied');
              
            //payment(sum);

        sum=a+b;

        $('#totaltaka').html(sum);
        $('#totalinputtaka').val(sum);
        
 //console.log(a+b);
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


// promo code end



// promocode validity
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







$( "#tableMain tbody tr" ).click(function() {
                     
var addtocartid = $(this).find("td:eq(5) input[type='checkbox']").val();
 //alert(qt);
 $('#productsize').empty();
 
 $('#catidtake').val(addtocartid);
 
 

   getproductsize(addtocartid);


});


productsizeentry();


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

        

        payment();

});


function payment(amount)

{


     
    var paymentConfig={
            createCheckoutURL: "{!! route('createpayment') !!}",
            executeCheckoutURL: "{!! route('executepayment') !!}"
        };

		
        var paymentRequest;

        
        

        paymentRequest = {amount:amount, intent: 'sale', invoice:sumall};


        

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
                        // alert('[SUCCESS] data : ' + JSON.stringify(data));
                            
                            
                            
                            
                            
                            

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


function callReconfigure(val){
        bKash.reconfigure(val);
    }

    function clickPayButton(){
        $("#bKash_button").trigger('click');
        
    
        
    }
    
</script>







@endsection