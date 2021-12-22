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










<section class="testimonial-area pt-10 pb-10 " >

<div class="container bg-light" id="printinvoice">

<center>
<article>
      <span style="font-family: 'Brush Script MT', cursive;font-size:40px;"> Welcome to Our Fashoin</span>
     
      


  </article>
  </center>
  
@foreach($customer_information as $c_information)

<article>
  <p> Name:  <span style=""> {{$c_information->name}} </span></p>
  <p> Phone:  <span style=" "> {{$c_information->phone}} </span></p>
  <p> Address:  <span style=""> {{$c_information->address}} </span></p>
     
      
  <p> Add Delivery Charge:  <span style="">50.Tk </span></p>


  </article>

  @endforeach


                <div class="row">
					<div class="col-lg-12">	
                    
                   
							<table id="tableMain" class="table  table-striped table-bordered " style="width:100%" >
								<thead>
									<tr>
										
                                  
                                        <th>Serial</th>
										<th>Product Name</th>
										<th>Quantity</th>
										<th>Size</th>
										<th>Total</th>
					

										<th>Status</th>
										
									</tr>
								</thead>
								<tbody>
                                <?php 
                                    
                                    $i=0;
                                    
                                    ?>                    
@foreach($orders as $orders)
<?php $i++?>                    
                        <tr> 
         <td>  {{$i}} </td>   

         <td>  {{$orders->productname}} </td>   
         <td>  {{$orders->quantity}} </td> 
         <td>  {{$orders->product_size}} </td>   
         <td>  {{$orders->amount}} </td>   
         @if($orders->status=="processing")
         <td> <a class="btn btn-sm btn-primary"href="status/paid/{{$orders->paymentid}}">Paid</a> <a class="btn btn-sm btn-primary"href="status/unpaid/{{$orders->id}}">Unpaid</a> </td>   
         @elseif($orders->status=="paid")
         <td>  paid</td>   
         @elseif($orders->status=="unpaid")
         <td>  unpaid</td>   

         @endif
                    
                    </tr>
                              
@endforeach
                                
								</tbody>
                            
                                <tfoot> 
                                <tr>
                                            <td >Total =</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td >@foreach($total as $total)  {{$total->total}} @endforeach .Tk</td>
                                            <td></td>

                                       
                                        </tr>

                                </tfoot>
						    </table>
                          
                            <p> <span class="float-left"> Customer Signature:.................... </span><span class="float-right"> Admin Signature:.................... </span></p> 
              <br> 
              <br>              
                        

                        </div>
					
                    </div>
				

</div>

</section>

<section>
<div class="container">

<a class="btn btn-primary" id="print">Print</a>
<a  class="btn btn-warning"href="{{ url('/checkpayment') }}">Back</a>


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

var tablemain;




$(function() {

$("#print").on('click', function() {

  $.print("#printinvoice");

//console.log('jfhjh');


  

});

});









</script>







@endsection



