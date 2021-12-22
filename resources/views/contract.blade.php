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


		<!-- Section -->
	
		<!-- /Section -->	

		<!-- Contact info Section -->
		<section class="contact style-1">
			<div class="container " >
				<div class="row">

					<div class="col-lg-4" style="background: rgba(120, 140, 107, 0.9)">
						<div class="contact-address">
							<h2>Contact Info</h2>
							<ul class="contact-info">
								<li>
									<span class="con-icon">
										<i class="fa fa-map-marker"></i>
									</span>
									<div class="con-desc">
										House/Holding No-A/66, Word No-06<br>Dhanmondi,kalabagan,Dhaka
									</div>
								</li>
								<li>
									<span class="con-icon">
										<i class="fa fa-envelope-o"></i>
									</span>
									<div class="con-desc">
                                    juwelcj248@gmail.com 
									</div>
								</li>
								<li>
									<span class="con-icon">
										<i class="fa fa-phone"></i>
									</span>
									<div class="con-desc">
										01789xxxxxx
									</div>
								</li>
								
							</ul>
						</div>
					</div>
					<div class="col-lg-8">
						<!-- Google Map Section -->
						<div id="map" class="google-map"></div>
						<!-- /Google Map Section -->
					</div>



				</div>
			</div>
		</section>
		<!-- /Contact info Section -->
<br>

		
 @endsection

@section('extralibincludefooter')
   <!-- Highchart -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7tvmKDI1rNPxCezId3lorKS5n4fI7oOM&callback=initMap"></script>
@endsection


@section('getjs')
	
<script>

	function initMap() {
		//var latlng = {lat: Your Latitude, lng: Your Longitude};
		var latlng = {lat: 23.7470304, lng: 90.3671072};
	
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: latlng,
			zoomControl: true,
			scaleControl: false,
			scrollwheel: false,
			disableDoubleClickZoom: true
		});
		//Tooltip info
		var contentString = '<div class="map-tooltip">'+
				'<div class="map-tooltip-content">'+
					'<ul class="map-tooltip-info">'+
						'<li>'+
								'<h2>Office Loaction</h2>'+
								'House/Holding No-A/66,<br>'+
								'Dhanmondi,Dhaka</p>'+
						'</li>'+
					'</ul>'+
				'</div>' +
		'</div>';
		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});
		var marker = new google.maps.Marker({
		  position: latlng,
		  map: map
		});
		marker.addListener('click', function() {
		  infowindow.open(map, marker);
		});
	}

     
</script>
@endsection