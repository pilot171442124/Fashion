<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use BD;
use Auth;
use Session;
use Cookie;


class BkashController extends Controller
{
   
    public function token()
    {
        session_start();

        $request_token = $this->_bkash_Get_Token();
       $idtoken = $request_token['id_token'];

        $_SESSION['token'] = $idtoken;

        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $array['token'] = $idtoken;

        $newJsonString = json_encode($array);
        File::put(storage_path() . '/app/public/config.json', $newJsonString);

        echo $idtoken;
    }

    protected function _bkash_Get_Token()
    {
        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $post_token = array(
            'app_key' => $array["app_key"],
            'app_secret' => $array["app_secret"]
        );

        $url = curl_init($array["tokenURL"]);
        $proxy = $array["proxy"];
        $posttoken = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'password:' . $array["password"],
            'username:' . $array["username"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $posttoken);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    protected function _get_config_file()
    {
        $path = storage_path() . "/app/public/config.json";
        return json_decode(file_get_contents($path), true);
    }

    public function createpayment()
    {
        session_start();

        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $amount = $_GET['amount'];
        $invoice = $_GET['invoice']; // must be unique
        $intent = "sale";
        $proxy = $array["proxy"];
        $createpaybody = array('amount' => $amount, 'currency' => 'BDT', 'merchantInvoiceNumber' => $invoice, 'intent' => $intent);
        $url = curl_init($array["createURL"]);

        $createpaybodyx = json_encode($createpaybody);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array["token"],
            'x-app-key:' . $array["app_key"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $createpaybodyx);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdata = curl_exec($url);
        curl_close($url);
        echo $resultdata;
    }

    public function executepayment()
    {
        session_start();

        /*$strJsonFileContents = file_get_contents("config.json");
        $array = json_decode($strJsonFileContents, true);*/

        $array = $this->_get_config_file();

        $paymentID = $_GET['paymentID'];
        $proxy = $array["proxy"];

        $url = curl_init($array["executeURL"] . $paymentID);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $array["token"],
            'x-app-key:' . $array["app_key"]
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($url, CURLOPT_PROXY, $proxy);

        $resultdatax = curl_exec($url);
        curl_close($url);

       // $this->_updateOrderStatus($resultdatax);

        return $resultdatax;
    }


public function paymentinsert(Request $request)
{
    $loginuserid = Auth::user()->id;

    $pyment_id=$request->paymentid;
    $amount=$request->amount;
    $invoice_machant=$request->invoice;








   // return $pyment_id;

    $address_code=Session::get('address_code');


    $addedcart = DB::table('addtocart')
    ->select('addtocart.*')
    ->where('payment_status','unpaid')
    ->where('customer_id',$loginuserid)
    ->get();

    $sum_quantity = DB::table('addtocart')
    ->select('addtocart.*')
    ->where('payment_status','unpaid')
    ->where('customer_id',$loginuserid)
    ->sum('quantity');

$multipledata=array();

foreach ($addedcart as $key => $value) {
        
$addtocart_id=$value->id;
$product_id=$value->product_id;
$cart_price=$value->cart_price;
$product_price=$value->product_price;
$product_discount=$value->product_discount;
$quantity=$value->quantity;
$product_size=$value->products_size;

$cupon_status=$value->cupon_status;
$payment_status=$value->payment_status;
$curDateTime = date ( 'Y-m-d' );








$stor_payment[]=array( "addedcart_id"=>$addtocart_id, "user_id"=>$loginuserid,

"product_name"=>$product_id, "payment_txr"=>$pyment_id,"amount"=>$cart_price,  
"merchantInvoice"=>$invoice_machant,"address_code"=>$address_code,"discount"=>$product_discount,
"quantity"=>$quantity, "product_size"=>$product_size,  "status"=>"processing","created_at"=>$curDateTime
);

  

}


    $obj = DB::table('payment')->insert($stor_payment);




    $invoice = DB::table('invoice')
    ->insert(
    ["Invoice"=>$invoice_machant,
    "payment_txr_id"=>$pyment_id,
    "quantity"=>$sum_quantity,
    "addrs_code"=>$address_code,
    "amount"=>$amount,
    "user_id"=>$loginuserid,


    
    ]
    );


/*
    $addtocart = DB::table('addtocart')
    ->where('payment_status','unpaid')
    ->where('customer_id',$loginuserid)
    ->update(
    [
    "payment_status"=>"processing",
   

    ]
    );

*/

$delete = DB::table('addtocart')

->where('payment_status','unpaid')
->where('customer_id',$loginuserid)
->delete();
   



  
}

}
