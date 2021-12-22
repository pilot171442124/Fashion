<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use Redirect,Response;
use App\Models\ProductCategory;
use DB;
use Session;
use Auth;
use Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class addedcartController extends Controller
{
  



public function getdataaddedcarttable(Request $request)


{

    $posts = DB::table('addedcart')->select('addedcart.*')
    
    ->where('payment_status','unpaid')
    ->get();
   
  return view('addedcart',['addedcartdata'=>$posts]);

}






public function promocode(Request $request)


{
  $cookie=Cookie::get('c_code');
  
$dateaandtime=date ( 'Y-m-d');

$promo_code=$request->promo_code;


  $sum_total = DB::table('addtocart')
   
  ->where('payment_status','unpaid')
  
  ->sum('cart_price');


/* 
  $check_cupon_code = DB::table('addtocart')->select('cupon_status','payment_status')
  ->where('cupon_status',$promo_code)

  ->get();


$count_cupon_code=count($check_cupon_code);

*/




  $product_offer = DB::table('productoffer')
  
  //->join('product_category', 'productoffer.product_name', '=', 'product_category.id')
  
  ->select('productoffer.*',)
  ->where('promo_code',$promo_code)
  ->get();

foreach ($product_offer as $key => $productoffer) {


$discount=$productoffer->discount;
$min_price=$productoffer->min_price;
$srt_date=$productoffer->srt_date;
$last_date=$productoffer->last_date;
//$product_name=$productoffer->productname;

$quantity=$productoffer->qt;


}














  
if ($cookie==$promo_code) {
 

  return ["exit"=>"exit"];
}

else{


             if ($dateaandtime>=$srt_date && $dateaandtime<=$last_date) {
                  



                         if (!empty($discount)) {


                                            
                                            if ($min_price<=$sum_total) {
                                            
                                          $discount_execute=$sum_total-$discount;
                                          
                                        
                                          
                //

                                              $obj = DB::table('addtocart')

                                              ->whereNull('cupon_status')
                                              ->update(
                                                
                                                [
                                                'cupon_status' =>$promo_code, 
                                                
                                                'updated_at' =>$dateaandtime
                                              
                                                ]		       
                                              );

                //
                                     Cookie::queue('c_code', $promo_code,1800);

                                      return ['discountoffer'=>$discount_execute,'discountaka'=>$discount];
                                            }


                                          }
                                        else {
                                          
                                          
                                          

                                          $product_offer = DB::table('productoffer')
  
                                          ->join('product_category', 'productoffer.product_name', '=', 'product_category.id')
                                          
                                          ->select('productoffer.*','product_category.productname')
                                          ->where('promo_code',$promo_code)
                                          ->get();
                                        
                                        foreach ($product_offer as $key => $productoffer) {
                                        
                                     
                                        $product_name=$productoffer->productname;
                                        
                          
                                        
                                        
                                        }



                                          
                                          
                                          $obj = DB::table('addtocart')

                                          ->whereNull('cupon_status')
                                          ->update(
                                            
                                            [
                                            'cupon_status' =>$promo_code, 
                                            
                                            'updated_at' =>$dateaandtime
                                          
                                            ]		       
                                          );
                                          
                                          

                                       
                                     Cookie::queue('c_code', $promo_code,1800);
                                      
                                          
                                          return ['quantity'=>$quantity,'productname'=>$product_name];

                                        }




                }


                else {
                  return 0;

                }


}







}


public function totalsumaddedcart(Request $request)
{



  $sum_total = DB::table('addedcart')
  ->where('payment_status','unpaid')
  ->sum('total');


return $sum_total;

}





public function checkproductdiscount(Request $request)
 

{

$dateaandtime=date ( 'Y-m-d');
  
//$check_srt= ($srt_date<=$dateaandtime);
//$check_last=($last_date>=$dateaandtime);

$product_offer = DB::table('productoffer')
  ->where('srt_date','<=',$dateaandtime)
  ->where('last_date','>=',$dateaandtime)

  ->get();


$count=count($product_offer);



return $count;

}




public function chechout(Request $request)

{


if(Auth::check())

{







  $loginuserid = Auth::user()->id;
   
  $name = $request->name;
  $phone = $request->phone;
  $address = $request->address;
  $time=time();
  
  Session::put('address_code', $time);


  $customer_address= array(

    [
        'name'=>$name,
        'customer_id'=>$loginuserid,
        'phone'=>$phone,
        'address'=>$address,
        'address_code'=>$time,

  
    ]

  );



  $obj = DB::table('address')->insert($customer_address);








  return "authpermit";
}

else {
  return "login";
  
}
}


}
