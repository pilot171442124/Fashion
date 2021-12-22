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


class invoiceController extends Controller
{
    
    public function orders(Request $request){
        
        $payment_txr=$request->id;
        $customer_payment = DB::table('payment')
        ->join('product', 'payment.product_name', '=', 'product.id')
       
       
        ->join('productsize', 'payment.product_size', '=', 'productsize.id')
        
        ->join('invoice', 'payment.payment_txr', '=', 'invoice.payment_txr_id')
       ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
      
        
    ->select('payment.*','payment.id as paymentid','product_category.productname','invoice.amount as total','productsize.product_size')

   

        
        ->where('payment_txr',$payment_txr )
        ->where('status','!=','unpaid' )

      
        ->get();
      
    
    
    
     $total = DB::table('invoice')
        
    ->select('invoice.amount as total')
 
    ->where('payment_txr_id',$payment_txr )
   
      
    ->get();

    $customer_information = DB::table('invoice')
    ->join('users', 'invoice.user_id', '=', 'users.id')
    ->join('address', 'invoice.addrs_code', '=', 'address.address_code')

        
    ->select('address.*')
 
    ->where('payment_txr_id',$payment_txr )
      
    ->get();

return view('invoice',['orders'=>$customer_payment,'total'=>$total,'customer_information'=>$customer_information]);


    }


public function updatepaymentstatuspaid(Request $request)

{

  $payment_id=$request->id;
  
  $customer_information = DB::table('payment')
  ->where('id',$payment_id)
  ->update(
      ['status'=>'paid']
    );

    $payment_txr = DB::table('payment')->select('payment_txr','product_name','quantity')
    ->where('id',$payment_id)
    ->get();
foreach ($payment_txr as $key => $payment_txr) {
   
    $pay_txr=$payment_txr->payment_txr;
    $product_id=$payment_txr->product_name;
    $quantity=$payment_txr->quantity;


}



$product = DB::table('product')->select('product_cat_id')
    ->where('id',$product_id)
    ->get();
foreach ($product as $key => $product) {
   

$product_cat_id=$product->product_cat_id;


}




$productsize = DB::table('productsize')->select('product_qt')
    ->where('product_name',$product_cat_id)
    ->get();
foreach ($productsize as $key => $product) {
   
$perquantity=$product->product_qt;



}


$sub_quantity=$perquantity-$quantity;


//return $perquantity;




$update_quantity = DB::table('productsize')
->where('product_name',$product_cat_id)
->update(
    ['product_qt'=>$sub_quantity]
  );









return redirect('/order/'.$pay_txr);

}

public function updatepaymentstatusunpaid(Request $request)

{

  $payment_id=$request->id;
  
  $customer_information = DB::table('payment')
  ->where('id',$payment_id)
  ->update(
      ['status'=>'unpaid']
    );

    $payment_txr = DB::table('payment')->select('payment_txr','amount')
    ->where('id',$payment_id)
    ->get();
foreach ($payment_txr as $key => $payment_txr) {
   
    $pay_txr=$payment_txr->payment_txr;
    $payment_amount=$payment_txr->amount;

}

$get_amount = DB::table('invoice')->select('amount')
    ->where('payment_txr_id',$pay_txr)
    ->get();
    foreach ($get_amount as $key => $totalamount) {
   
        $amount=$totalamount->amount;
    }

$subamount=$amount-$payment_amount;
    
    $customer_information = DB::table('invoice')
    ->where('payment_txr_id',$pay_txr)
    ->update(
        ['amount'=>$subamount]
      );



return redirect('/order/'.$pay_txr);
}







}
