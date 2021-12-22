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




                <div class="row">
					<div class="col-lg-12">	
                     <form id="cartdataadd"action="post">
                   
							<table id="tableMain" class="table  table-striped table-bordered " style="width:100%" >
								<thead>
									<tr>
										
                                  
                                        <th>Serial</th>
										<th>Product Name</th>
										<th>Price</th>
										<th>Image</th>
										<th>Size</th>
										<th>Color</th>
										<th>Quantity</th>
										<th>Total</th>
					

										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
                                <?php 
                                    
                                    $i=0;
                                    
                                    ?>                    
@foreach($payment as $payment)
<?php $i++?>                    
                        <tr> 
                       <td> {{$i}}</td>

                       <td> {{$payment->productname}}</td>
                       <td> {{$payment->price}}</td>
                       <td> <img style="height:100px" src="{{ URL::asset('images/') }}/{{$payment->imageurl}}" alt="" /></td>
                       <td> {{$payment->product_size}}</td>
                       <td> {{$payment->tags}}</td>
                       <td> {{$payment->quantity}}</td>
                       <td> {{$payment->amount}}</td>
                       <td> {{$payment->status}}</td>        
                    
                    </tr>
                              
@endforeach
                                
								</tbody>
                            
						    </table>
                          
                            
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

var tablemain;













</script>







@endsection