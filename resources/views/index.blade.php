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




<section >

<section>
   <div class="container">

   <marquee style="color:rgb(200, 100, 50)"behavior="" direction=""> Discount on Pant 20% Promotion Code *#12134#</marquee>
   </div> 
</section>
<div class="container bg-dark">
<center>
<div class="slider ">

    <div>

    <img src="public/images/s1.jpg"  height="300" width="98%" >

    </div>
    <div>
    <img src="public/images/s2.jpg"  height="300" width="98%"  >
    
    </div>
    <div>
    <img src="public/images/p1.jpg"    height="300" width="98%" >
    
    </div>
    </center>

</div>

</div>

</section>
<br>

<section>
<div class="container">
<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'fashion');
$sql = "select * from producttype";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)) {
	$producttypeid = $row['id'];
	$productname = $row['product_type'];
    
    ?>



<a style="background-color:rgb(100, 100, 60);" class="getvalue btn "href="<?php echo $producttypeid; ?>"> <?php echo $productname; ?> <input type="hidden" id="getval" value="<?php echo $producttypeid; ?>"></a>

<?php } ?>


</div>

</section>




<center>



<section>

<div> 
  <div class="container">
                          

  <article class="animate__animated animate__rotateIn animate__delay-1s">
      <span style="color:blue; font-size:70px">    &nbsp;</span>

      <span class="animate__animated animate__fadeInDown"style= "color:blue; font-size:70px">  F</span>
      <span style="color:red; font-size:70px"> a</span>
      <span style="color:#F39B0C; font-size:70px"> s</span>
      <span style="color:blue; font-size:70px"> h</span>
      <span style="color:#0CF37A; font-size:70px"> i</span>
      <span style="color:red; font-size:70px"> o</span>
      <span style="color:blue; font-size:70px"> n</span>

      
  </article>

  </div>
</div>

</section>
</center>

<section>

<div class="container">
<center>

<form id="searchproduct" class="example" method="POST">
  <input type="text" class="form-control "  placeholder="Search Products....." style="border-radius:25px;color:green;" id="search" name="search">

</form>

</center>

</div>

</section>






        <!-- /Blog Section -->
 <section >
    <center><p id="p" style="font-size:20px; display:none"></p></center>  

<div class="blog-area ptb-30">
            <div class="container">
                <div class="row" id="productlist">



                    
                </div>
            </div>
        </div>


</ssection >








@endsection

@section('getjs')   

    
 <script>


var tableMain;
var SITEURL = '{{URL::to('')}}';

var getidarry=[];









new WOW().init();




function voicesearch(){

const searchForm = document.querySelector("#searchproduct");
const searchFormInput = searchForm.querySelector("input"); // <=> document.querySelector("#search-form input");
const info = document.querySelector(".info");

// The speech recognition interface lives on the browser’s window object
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition; // if none exists -> undefined

if(SpeechRecognition) {
  console.log("Your Browser supports speech Recognition");
  
  const recognition = new SpeechRecognition();
  recognition.continuous = true;
  // recognition.lang = "en-US";

  searchForm.insertAdjacentHTML("beforeend", '<button type="button"><i class="fas fa-microphone"></i></button>');
  searchFormInput.style.paddingRight = "50px";

  const micBtn = searchForm.querySelector("button");
  const micIcon = micBtn.firstElementChild;

  micBtn.addEventListener("click", micBtnClick);
  function micBtnClick() {
    if(micIcon.classList.contains("fa-microphone")) { // Start Voice Recognition
      recognition.start(); // First time you have to allow access to mic!
    }
    else {
      recognition.stop();
    }
  }

  recognition.addEventListener("start", startSpeechRecognition); // <=> recognition.onstart = function() {...}
  function startSpeechRecognition() {
    micIcon.classList.remove("fa-microphone");
    micIcon.classList.add("fa-microphone-slash");
    searchFormInput.focus();
    

    console.log("Voice activated, SPEAK");
  }




  recognition.addEventListener("end", endSpeechRecognition); // <=> recognition.onend = function() {...}
  function endSpeechRecognition() {
    micIcon.classList.remove("fa-microphone-slash");
    micIcon.classList.add("fa-microphone");
    searchFormInput.focus();
    console.log("Speech recognition service disconnected");
  }

  recognition.addEventListener("result", resultOfSpeechRecognition); // <=> recognition.onresult = function(event) {...} - Fires when you stop talking
  function resultOfSpeechRecognition(event) {
    const current = event.resultIndex;
    const transcript = event.results[current][0].transcript;
    
    voicesearchlive(transcript);


    if(transcript.toLowerCase().trim()==="stop recording") {
      recognition.stop();
    }
    else if(!searchFormInput.value) {
    searchFormInput.value = transcript;
    


    }
    else {
      if(transcript.toLowerCase().trim()==="go") {
        searchForm.submit();
       

      
      }
      else if(transcript.toLowerCase().trim()==="reset input") {
        searchFormInput.value = "";
      }
      else {
        searchFormInput.value = transcript;
      }
    }
    // searchFormInput.value = transcript;
    // searchFormInput.focus();
    // setTimeout(() => {
    //   searchForm.submit();
    // }, 500);
  }
  
  //info.textContent = 'Voice Commands: "stop recording", "reset input", "go"';
  
}
else {
  console.log("Your Browser does not support speech Recognition");
  info.textContent = "Your Browser does not support Speech Recognition";
}



}






















function getProductList() {



        $.ajax({
            type: "post",
            url: SITEURL+"/getAllProductsRoute",
            data: {
                "id":1,
                //"search":search,
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){     
                
                var producthtml="";
                
                $.each(response, function(i, obj) {
                    //console.log(obj.BlogType);

                    var singleproduct="";
                    var surl = "{{url('placeorder')}}/"+obj.id;
                    var imgsurl = "{{url('image')}}/"+obj.id;

              

                    var bcontent = "";
                    
                    if(!obj.Remarks){
                        bcontent = "";
                    }
                    else if(obj.Remarks.length>80){
                        bcontent = obj.Remarks.substring(0, 80)+"...";
                    }
                    else{
                        bcontent = obj.Remarks;                     
                    }

                    
                    if(!obj.ImageURL){
                        obj.ImageURL = "products/noimage.jpg";
                    }



                    singleproduct +='<div class="col-lg-4 col-md-4 col-sm-12">';
                 
                    
                        singleproduct +='<article class="post style-2">';
                            singleproduct +='<div class="post-thumbnail height-blog">';
                                //singleproduct +='<img src="{{ URL::asset('storage/app/bookfile/pic1.jpg') }}" alt="" />';
                                singleproduct +='<img class="animate__animated wow animate__lightSpeedInLeft animate__delay-1s" src="{{ URL::asset('images/') }}/'+obj.imageurl+'" alt="" />';
                            singleproduct +='</div>';
                            singleproduct +='<div class="post-header">';
                                singleproduct +='<h2 class="post-title font20">';
                                    singleproduct +=obj.productname
                                singleproduct +='</h2>';
                                singleproduct +='<div class="post-meta">';
                                    singleproduct +='<span class="productprice"><i class="fa fa-money"></i>'+'BDT-'+obj.price+' ৳ </span>';
                                
                                    if(obj.discount >0 ){
                                
                                    singleproduct +='<span class="productprice" style="color:green;">Discount-'+obj.discount+'% </span>';
                               
                                                          
                            
                                  }
                                else{

                                    singleproduct +='<span class="productprice" style="display:none">Discount'+obj.discount+'% </span>';

                                }
                                
                                singleproduct +='</div>';


                                singleproduct +='<div class="post-meta">';
                                    
                                //singleproduct +='<span>'+'Size:'+obj.size+'</span>'; 
                                singleproduct +='<span class="Availability"><i class="fa fa-snowflake-o"></i>Stock: '+obj.stock+' </span>';
                                    
                                singleproduct +='</div>';

                            singleproduct +='</div>';
                            singleproduct +='<div class="post-content">';
                                
                            singleproduct +='<span>'+'Color:'+obj.tags+'</span>'; 
                            
                                
                            singleproduct +='<p>'+bcontent+'</p>';
                               
                               
                                if(obj.id > 0 && obj.stock=="Instock"){
                                
                                    singleproduct +='<a class="btn blue-btn" id="getid" href=" '+surl+' " target="_self"> <i class="fas fa-shopping-cart"></i>Add to Cart</a>';
                                   
                                   
                                   
                                    singleproduct +=' &nbsp;&nbsp;&nbsp; <a class="btn blue-btn" id="" href=" '+imgsurl+' " target="_self"> <i class="fa fa-search-plus"></i>View</a>';

                                                         
                                
                                }else{
                                    singleproduct +='<span class="Availability" style="color:red"><i class="fa fa-stop-circle-o"></i> Not Available</span>';
                                }

                            singleproduct +='</div>';
                        singleproduct +='</article>';
                    singleproduct +='</div>';


                    producthtml +=singleproduct;

           
             


                });



                $("#productlist").html(producthtml);
                 
            },
            error:function(error){
                //alert("fail");
                setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                toastr.error("Product can not fillup");

                }, 1300);

            }

        });
    }






















function voicesearchlive(search){


$.ajax({
       type: "post",
       url: SITEURL+"/getAllProductsRoute",
       data: {
           "id":1,
           "search":search,
           "_token":$('meta[name="csrf-token"]').attr('content')
       },
       success:function(response){     
           
           var producthtml="";
           
           $.each(response, function(i, obj) {
               //console.log(obj.BlogType);

               var singleproduct="";
               var surl = "{{url('placeorder')}}/"+obj.id;
               var imgsurl = "{{url('image')}}/"+obj.id;


               var bcontent = "";
               
               if(!obj.Remarks){
                   bcontent = "";
               }
               else if(obj.Remarks.length>80){
                   bcontent = obj.Remarks.substring(0, 80)+"...";
               }
               else{
                   bcontent = obj.Remarks;                     
               }

               
               if(!obj.ImageURL){
                   obj.ImageURL = "products/noimage.jpg";
               }



               singleproduct +='<div class="col-lg-4 col-md-4 col-sm-12">';
                   singleproduct +='<article class="post style-2">';
                       singleproduct +='<div class="post-thumbnail height-blog">';
                           //singleproduct +='<img src="{{ URL::asset('storage/app/bookfile/pic1.jpg') }}" alt="" />';
                           singleproduct +='<img class="animate__animated wow animate__lightSpeedInLeft animate__delay-1s"   src="{{ URL::asset('images/') }}/'+obj.imageurl+'" alt="" />';
                       singleproduct +='</div>';
                       singleproduct +='<div class="post-header">';
                           singleproduct +='<h2 class="post-title font20">';
                               singleproduct +=obj.productname
                           singleproduct +='</h2>';
                           singleproduct +='<div class="post-meta">';
                               singleproduct +='<span class="productprice"><i class="fa fa-money"></i>'+'BDT'+obj.price+' ৳ </span>';
                           
                           
                               if(obj.discount >0 ){
                           
                           singleproduct +='<span class="productprice" style="color:green;">Discount-'+obj.discount+'% </span>';
                      
                                                 
                   
                         }
                       else{

                           singleproduct +='<span class="productprice" style="display:none">Discount'+obj.discount+'% </span>';

                       }
                           
                           
                           
                           
                           
                           singleproduct +='</div>';


                           singleproduct +='<div class="post-meta">';
                              
                           //singleproduct +='<span>'+'Size:'+obj.size+'</span>'; 
                           singleproduct +='<span class="Availability"><i class="fa fa-snowflake-o"></i>Stock: '+obj.stock+' </span>'; 
                              
                           singleproduct +='</div>';

                       singleproduct +='</div>';
                       singleproduct +='<div class="post-content">';
                       singleproduct +='<span>'+'Color:'+obj.tags+'</span>'; 
                          
                       singleproduct +='<p>'+bcontent+'</p>';
                           if(obj.id > 0 && obj.stock=="Instock"){


                                   singleproduct +='<a class="btn blue-btn" href=" '+surl+' " target="_self"> <i class="fas fa-shopping-cart"></i>Add to Cart</a>';

                                   singleproduct +=' &nbsp;&nbsp;&nbsp;<a class="btn blue-btn" href=" '+imgsurl+' " target="_self"> <i class="fa fa-search-plus"></i>View</a>';



                           }else{
                               singleproduct +='<span class="Availability" style="color:red"><i class="fa fa-stop-circle-o"></i> Not Available</span>';
                           }
                       singleproduct +='</div>';
                   singleproduct +='</article>';
               singleproduct +='</div>';


               producthtml +=singleproduct;










           });



           $("#productlist").html(producthtml);
            
       },
       error:function(error){
           //alert("fail");
           setTimeout(function() {
               toastr.options = {
                   closeButton: true,
                   progressBar: true,
                   showMethod: 'slideDown',
                   timeOut: 4000
               };
           toastr.error("Product can not fillup");

           }, 1300);

       }

   });

}




























// for live search 

function search(){

 
  



     $( "#search" ).keyup(function() {
        var search = $( this ).val();
    
        //var searwch = searche;


    $.ajax({
            type: "post",
            url: SITEURL+"/getAllProductsRoute",
            data: {
                "id":1,
                "search":search,
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){     
                
                var producthtml="";
                
                $.each(response, function(i, obj) {
                    //console.log(obj.BlogType);

                    var singleproduct="";
                    var surl = "{{url('placeorder')}}/"+obj.id;
                    var imgsurl = "{{url('image')}}/"+obj.id;


                    var bcontent = "";
                    
                    if(!obj.Remarks){
                        bcontent = "";
                    }
                    else if(obj.Remarks.length>80){
                        bcontent = obj.Remarks.substring(0, 80)+"...";
                    }
                    else{
                        bcontent = obj.Remarks;                     
                    }

                    
                    if(!obj.ImageURL){
                        obj.ImageURL = "products/noimage.jpg";
                    }



                    singleproduct +='<div class="col-lg-4 col-md-4 col-sm-12">';
                        singleproduct +='<article class="post style-2">';
                            singleproduct +='<div class="post-thumbnail height-blog">';
                                //singleproduct +='<img src="{{ URL::asset('storage/app/bookfile/pic1.jpg') }}" alt="" />';
                                singleproduct +='<img class="animate__animated wow animate__lightSpeedInLeft animate__delay-1s" src="{{ URL::asset('images/') }}/'+obj.imageurl+'" alt="" />';
                            singleproduct +='</div>';
                            singleproduct +='<div class="post-header">';
                                singleproduct +='<h2 class="post-title font20">';
                                    singleproduct +=obj.productname
                                singleproduct +='</h2>';
                                singleproduct +='<div class="post-meta">';
                                    singleproduct +='<span class="productprice"><i class="fa fa-money"></i>'+'BDT'+obj.price+' ৳ </span>';
                                
                                
                                    if(obj.discount >0 ){
                                
                                singleproduct +='<span class="productprice" style="color:green;">Discount-'+obj.discount+'% </span>';
                           
                                                      
                        
                              }
                            else{

                                singleproduct +='<span class="productprice" style="display:none">Discount'+obj.discount+'% </span>';

                            }
                                
                                
                                
                                
                                
                                singleproduct +='</div>';


                                singleproduct +='<div class="post-meta">';
                                   
                                //singleproduct +='<span>'+'Size:'+obj.size+'</span>'; 
                                singleproduct +='<span class="Availability"><i class="fa fa-snowflake-o"></i>Stock: '+obj.stock+' </span>'; 
                                   
                                singleproduct +='</div>';

                            singleproduct +='</div>';
                            singleproduct +='<div class="post-content">';
                            singleproduct +='<span>'+'Color:'+obj.tags+'</span>'; 
                               
                            singleproduct +='<p>'+bcontent+'</p>';
                                if(obj.id > 0 && obj.stock=="Instock"){


                                        singleproduct +='<a class="btn blue-btn" href=" '+surl+' " target="_self"> <i class="fas fa-shopping-cart"></i>Add to Cart</a>';

                                        singleproduct +='&nbsp;&nbsp;&nbsp;<a class="btn blue-btn" href=" '+imgsurl+' " target="_self"> <i class="fa fa-search-plus"></i>View</a>';



                                }else{
                                    singleproduct +='<span class="Availability" style="color:red"><i class="fa fa-stop-circle-o"></i> Not Available</span>';
                                }
                            singleproduct +='</div>';
                        singleproduct +='</article>';
                    singleproduct +='</div>';


                    producthtml +=singleproduct;










                });



                $("#productlist").html(producthtml);
                 
            },
            error:function(error){
                //alert("fail");
                setTimeout(function() {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                toastr.error("Product can not fillup");

                }, 1300);

            }

        });

    });



}







$(document).ready(function(){
    
    
    $('.slider').slick({
    
    slidesToShow:1 ,
  slidesToScroll: 1,
  autoplay: true,
  dots:true,
  arrows:true,
  autoplaySpeed:2000,
  accessibility:true
  
      });


      getProductList();


      search();






      $.ajax({
    dataType: 'json',
    url: 'http://api.hostip.info/get_json.php',
    success: function(data) {
        var ip = data['ip'];




/*
        $.ajax({
            type: "post",
            url: SITEURL+"/addtocartroute",
            data: {
                "ip":ip ,
         
                "_token":$('meta[name="csrf-token"]').attr('content')
            },
        });
    
    */
    
    }
});




//search for generation



$('.getvalue').click(function() {
    event.preventDefault();
    var get = $(this).attr('href');
    //alert(get);
    //console.log(get);    
   

$.ajax({
    type: "post",
    url: SITEURL+"/getgenerationProductsRoute",
    data: {
        "id":1,
        "getgenid":get,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){     
        
      
        if (response.length==0) {
           $("#p").show(); 
        $("#p").html("not found the results");
         
        $("#productlist").hide(); 

        
       }
       
    else{    
          
        $("#productlist").show(); 
  
        $("#p").hide(); 
       
        var producthtml="";
        
        $.each(response, function(i, obj) {
            //console.log(obj.BlogType);

            var singleproduct="";
            var surl = "{{url('placeorder')}}/"+obj.id;
            var imgsurl = "{{url('image')}}/"+obj.id;

      

            var bcontent = "";
            
            if(!obj.Remarks){
                bcontent = "";
            }
            else if(obj.Remarks.length>80){
                bcontent = obj.Remarks.substring(0, 80)+"...";
            }
            else{
                bcontent = obj.Remarks;                     
            }

            
            if(!obj.ImageURL){
                obj.ImageURL = "products/noimage.jpg";
            }



            singleproduct +='<div class="col-lg-4 col-md-4 col-sm-12">';
         
            
                singleproduct +='<article class="post style-2">';
                    singleproduct +='<div class="post-thumbnail height-blog">';
                        //singleproduct +='<img src="{{ URL::asset('storage/app/bookfile/pic1.jpg') }}" alt="" />';
                        singleproduct +='<img class="animate__animated wow animate__lightSpeedInLeft animate__delay-1s" src="{{ URL::asset('images/') }}/'+obj.imageurl+'" alt="" />';
                    singleproduct +='</div>';
                    singleproduct +='<div class="post-header">';
                        singleproduct +='<h2 class="post-title font20">';
                            singleproduct +=obj.productname
                        singleproduct +='</h2>';
                        singleproduct +='<div class="post-meta">';
                            singleproduct +='<span class="productprice"><i class="fa fa-money"></i>'+'BDT-'+obj.price+' ৳ </span>';
                        
                            if(obj.discount >0 ){
                        
                            singleproduct +='<span class="productprice" style="color:green;">Discount-'+obj.discount+'% </span>';
                       
                                                  
                    
                          }
                        else{

                            singleproduct +='<span class="productprice" style="display:none">Discount'+obj.discount+'% </span>';

                        }
                        
                        singleproduct +='</div>';


                        singleproduct +='<div class="post-meta">';
                            
                        //singleproduct +='<span>'+'Size:'+obj.size+'</span>'; 
                        singleproduct +='<span class="Availability"><i class="fa fa-snowflake-o"></i>Stock: '+obj.stock+' </span>';
                            
                        singleproduct +='</div>';

                    singleproduct +='</div>';
                    singleproduct +='<div class="post-content">';
                        
                    singleproduct +='<span>'+'Color:'+obj.tags+'</span>'; 
                    
                        
                    singleproduct +='<p>'+bcontent+'</p>';
                       
                       
                        if(obj.id > 0 && obj.stock=="Instock"){
                        
                            singleproduct +='<a class="btn blue-btn" id="getid" href=" '+surl+' " target="_self"> <i class="fas fa-shopping-cart"></i>Add to Cart</a>';
                           
                           
                           
                            singleproduct +=' &nbsp;&nbsp;&nbsp; <a class="btn blue-btn" id="" href=" '+imgsurl+' " target="_self"> <i class="fa fa-search-plus"></i>View</a>';

                                                 
                        
                        }else{
                            singleproduct +='<span class="Availability" style="color:red"><i class="fa fa-stop-circle-o"></i> Not Available</span>';
                        }

                    singleproduct +='</div>';
                singleproduct +='</article>';
            singleproduct +='</div>';


            producthtml +=singleproduct;

   
     


        });



        $("#productlist").html(producthtml);
        
    }  

    },
    error:function(error){
        //alert("fail");
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
        toastr.error("Product can not fillup");

        }, 1300);

    }

});


});


























//voice search
voicesearch();
voicesearchlive();


    });









 </script>



    <style>


body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;

  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}







/*voice Seach */








@import url('https://fonts.googleapis.com/css?family=Montserrat');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}


#searchproduct {
  width: 30%;
  margin: 0 auto;
  position: relative;
}
#searchproduct input {
  width: 100%;
  font-size: 1.5rem;
  padding: 10px 15px;
  border: 2px solid #ccc;
  border-radius: 2px;
}
#searchproduct button {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  background-color: transparent;
  outline: none;
  border: none;
  width: 3rem;
  text-align: center;
  font-size: 1.75rem;
  cursor: pointer;
  color: #333;
}
.info {
  margin-top: 0.5rem;
  text-align: center;
  font-size: 0.75rem;
}

@media (max-width: 1200px) {
  #searchproduct { width: 50%; }
}
@media (max-width: 768px) {
  .container { padding: 30px 35px; }
  #search-form { width: 100%; }
  .info { font-size: 0.5rem; }
}










    </style>

@endsection
