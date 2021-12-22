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





<button id="adduserbtn" class="pull-right btn btn-primary"> <i class="fa fa-plus"></i> Create an User Account </button>

<br>






             <div id="formpanel" class="panel panel-default " style="display:none">
			

        <button id="backuserbtn" class="pull-right bg-primary"> <i class="fa fa-arrow-left"></i> Back </button>
		<br>
		<br>
			 
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Create User Account Of users') }}</a></div>
								<div class="card-body">
								
								
									<form  id="addeditform" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>User Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="name" id="name" required  data-parsley-trigger="keyup" placeholder="Enter User Full Name">
												</div>
											</div>

										

											<div class="col-md-6">
												<div class="form-group">
													<label>Phone No<span class="red">*</span></label>
													<input type="text" class="form-control " name="phone" id="phone" required data-parsley-type="number" required data-parsley-length="[11, 11]" data-parsley-trigger="keyup" placeholder="Enter User Phone No">
												</div>
											</div>
											

										</div>


										<div class="row">

										<div class="col-md-6">
											<div class="form-group">
												<label>Role<span class="red">*</span></label>													
												<select data-placeholder="Choose Role..." class="chosen-select" id="userrole" name="userrole" required>
													<option value="">Select Role</option>
													<option value="Admin">Admin</option>
													<option value="Logistician">Logistician</option>
													<option value="Salesman">Salesman</option>
													<!--<option value="Other">Other</option>-->
												</select>
											</div>											
										</div>



										<div class="col-md-6">
												<div class="form-group">
													<label>E-mail <span class="red">*</span></label>
													<input type="text" class="form-control " name="email" id="email" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter User E-mail">
												</div>
											</div>
											</div>


											<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Gender<span class="red">*</span></label>
													<br>
                                                    <input type="radio" name="gender" value="male" required> Male <input type="radio" name="gender" value="female"> Female
													<input type="radio" name="gender" value="female"> Other
												
												</div>
											</div>
											</div>


											
											<div class="row">
											<div class="col-md-6">
											<div class="form-group">
											   
       												<label for="password">Password <span class="red">*</span></label>
       												<input type="password" name="password" id="password" placeholder="Password" required data-parsley-length="[8, 16]" data-parsley-trigger="keyup" class="form-control" />
     										 
     										 </div>
     										</div>




											<div class="col-md-6">
												<div class="form-group">
       												<label for="cpassword">Confirm Password<span class="red">*</span></label>
														<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"data-parsley-equalto="#password" data-parsley-trigger="keyup" required class="form-control" />
													</div>
											</div>
										</div>





										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Active Status<span class="red">*</span></label>													
													<select data-placeholder="Choose Active Status..." class="chosen-select" id="activestatus" name="activestatus" required>
														<option value="">Select Status</option>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select>
												</div>											
											</div>
											
										</div>
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
	


<!--Edit panel-->


<section class="testimonial-area pt-10 pb-10" >

<div class="container">





             <div id="editpanel" class="panel panel-default " style="display:none">
			

        <button id="backuserbtn" class="pull-right bg-primary"> <i class="fa fa-arrow-left"></i> Back </button>
		<br>
		<br>
			 
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header  p-3"> <a href="#"><i class="fa fa-plus"></i> {{ __('Create User Account Of users') }}</a></div>
								<div class="card-body">
								
								
									<form  id="editform" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>User Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="name" id="editname" required  data-parsley-trigger="keyup" placeholder="Enter User Full Name">
												</div>
											</div>

										

											<div class="col-md-6">
												<div class="form-group">
													<label>Phone No<span class="red">*</span></label>
													<input type="text" class="form-control " name="phone" id="editphone" required data-parsley-type="number" required data-parsley-length="[11, 11]" data-parsley-trigger="keyup" placeholder="Enter User Phone No">
												</div>
											</div>
											

										</div>


										<div class="row">

										<div class="col-md-6">
											<div class="form-group">
												<label>Role<span class="red">*</span></label>													
												<select data-placeholder="Choose Role..." class="chosen-select" id="edituserrole" name="userrole" required>
													<option value="">Select Role</option>
													<option value="Admin">Admin</option>
													<option value="Logistician">Logistician</option>
													<option value="Salesman">Salesman</option>
													<option value="Customer">Customer</option>

													<!--<option value="Other">Other</option>-->
												</select>
											</div>											
										</div>



										<div class="col-md-6">
												<div class="form-group">
													<label>E-mail <span class="red">*</span></label>
													<input type="text" class="form-control " name="email" id="editemail" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter User E-mail">
												</div>
											</div>
											</div>


											<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Gender<span class="red">*</span></label>
													<br>
                                                    <input type="radio" name="gender" id="editmale" value="male" required> Male <input type="radio" name="gender" id="editfemale"value="female"> Female
													<input type="radio" name="gender"  id="editother" value="female"> Other
												
												</div>
											</div>
											</div>


									

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Active Status<span class="red">*</span></label>													
													<select data-placeholder="Choose Active Status..." class="chosen-select" id="editactivestatus" name="activestatus" required>
														<option value="">Select Status</option>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select>
												</div>											
											</div>
											
										</div>




										<div class="row">
											
										

											<div class="col-md-6">
												<div class="form-group">
												
													<input type="hidden" class="form-control " name="recordid" id="recordid" required data-parsley-type="number" required data-parsley-length="[11, 11]" data-parsley-trigger="keyup" placeholder="Enter User Phone No">
												</div>
											</div>
											

										</div>










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
	














<section class="testimonial-area pt-10 pb-10">
	<div id="listpanel" >
			<div class="container">

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">Id</th>
										<th>Serial</th>
										<th>User Name</th>
										<th>User ID</th>
										<th>Phone No</th>
										<th>E-mail</th>
										<th>Role</th>
										<th>Gender</th>

										<th>Status</th>
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













<br>	

<br>	
<br>	
<br>	

					

									

@endsection

@section('getjs')
<script>
var SITEURL = '{{URL::to('')}}';



function editpanel(){
$("#editpanel").show();
$("#listpanel").hide();


}

//edituser
function edituser(){




$('#editform').parsley();



$('#editform').on('submit', function(event){
	event.preventDefault();
	if($('#editform').parsley().isValid())
{
	$.ajax({
			url: SITEURL +"/edituserform",
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
				toastr.success("Data Updated Successfully");

			}, 1300);

			$('#editform')[0].reset();
			$('#editform').parsley().reset();
			$("#tableMain").dataTable().fnDraw();
}



			
			$('#submit').attr('disabled',false);
			$('#submit').val('Submit');
		
		
		   }
	});
	}


});

















}



//deleteuser


function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	//url: "http://localhost/olms/deleteBookTypeRoute",
	url: SITEURL+"/deleteUserRoute",
	
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
					toastr.error("Data Deleted Successfully");

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


$("#adduserbtn").click(function(){

$("#formpanel").show();
$("#adduserbtn").hide();
$("#listpanel").hide();



});

$("#backuserbtn,#cancel").click(function(){

$("#formpanel").hide();
$("#adduserbtn").show();
$("#listpanel").show();
$("#editpanel").hide();



});


 $('#addeditform').parsley();


 $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    
    $('#addeditform').parsley();



    $('#addeditform').on('submit', function(event){
        event.preventDefault();
        if($('#addeditform').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/adduserentry",
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
			
          if(data=="getemail")
		  {

			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("This email already taken");

				}, 1300);
		  }

  if(data=="getphonenumber")
{
	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						//progressBar: true,
						//showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("This Phone number already taken");

				}, 1300);

}


if(data=="getusercode")
{
	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("This ID already taken");

				}, 1300);

}

if(data==1){

	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Data Inserted Successfully");

				}, 1300);

				$('#addeditform')[0].reset();
				$('#addeditform').parsley().reset();
}


               $("#tableMain").dataTable().fnDraw();

				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});


		
//tablelist






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
		        "url": "<?php route('usertabledatafetch') ?>",
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
		                                $('#editname').val(aData['name']);
		                               // $('#usercode').val(aData['usercode']);
		                                $('#editphone').val(aData['phone']);
		                                $('#editemail').val(aData['email']);
		                                //$('#password').vala(Data['password']);
		                                $('#edituserrole').val(aData['userrole']).trigger("chosen:updated");
		                               
									   
									   
										if(aData['gender']=="female")

											{


										$("#editfemale").attr('checked', true).trigger('click');
											


											}
									   
											if(aData['gender']=="male")

											{


											$("#editmale").attr('checked', true).trigger('click');



											}
		
									   


											if(aData['gender']=="other")

											{


											$("#editother").attr('checked', true).trigger('click');



											}







									    $('#editactivestatus').val(aData['activestatus']).trigger("chosen:updated");

										
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
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"name","sWidth": "22%"},
		        {"data":"usercode","sWidth": "12%"},
		        {"data":"phone","sWidth": "12%"},
		        {"data":"email","sWidth": "19%"},
		        {"data":"userrole","sWidth": "10%"},
		        {"data":"gender","sWidth": "10%"},

		        {"data":"activestatus","sWidth": "10%"},		       
		        {"data":"action","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        {"data":"password", "bVisible": false}
		    ]








});







edituser();


 $('.chosen-select').chosen({width: "100%"});



});

</script>



@endsection
