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






<section class="testimonial-area pt-10 pb-10">
	<div id="listpanel" >
			<div class="container">


@foreach($productimage as $row)

 <p>{{$row->Remarks}}</p>  




<img  class="xzoom" height="400" width="500" src="{{ URL::asset('images/') }}/{{$row->imageurl}}"  xoriginal="{{ URL::asset('images/') }}/{{$row->imageurl}}" alt="" />					
  










</div>





@endforeach				
				



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




$(document).ready(function(){

 
$(".xzoom").xzoom({

  position:'right',

  mposition:'inside',

  rootOutput:true,

  Xoffset: 10,

  Yoffset: 0,

  fadeIn:true,

  fadeTrans:true,

  fadeOut:false,

  smooth:true,

  smoothZoomMove: 3,

  smoothLensMove: 1,

  smoothScale: 6,

  defaultScale: 0,

  scroll:true,

  tint:false,

  tintOpacity: 0.5,

  lens:false,

  lensOpacity: 0.5,

  lensShape:'box',

  zoomWidth:'auto',

  zoomHeight:'auto',

  sourceClass:'xzoom-source',

  loadingClass:'xzoom-loading',

  lensClass:'xzoom-lens',

  zoomClass:'xzoom-preview',

  activeClass:'xactive',

  hover:true,

  adaptive:true,

  lensReverse:false,

  adaptiveReverse:false,

  lensCollision:true,

  title:false,

  titleClass:'xzoom-caption',

  bg:false

});




});















</script>



@endsection
