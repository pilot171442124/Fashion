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


class paymentController extends Controller
{
    
public function makepayment(Request $request)

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


       
     

}
    



public function checkcustomerpayment(Request $request)


{
  $loginuserid = Auth::user()->id;

  $customer_payment = DB::table('payment')
  ->join('product', 'payment.product_name', '=', 'product.id')
  ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
  ->join('productsize', 'payment.product_size', '=', 'productsize.id')

  
  ->select('payment.*','product_category.productname',
  'product.*','productsize.product_size')
  
  ->where('user_id',$loginuserid )

  ->get();




return view('payment',['payment'=>$customer_payment]);




}




public function getinvoicedata(Request $request)


{

  
    
  
	$columns = array(1=>'Serial',2=>'customername',3=>'invoice',4=>'payment_txr',5=>'quantity',6=>'amount');

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('invoice')
   ->join('address', 'invoice.addrs_code', '=', 'address.address_code')
  //->join('users', 'payment.user_id', '=', 'users.id')


    ->select(DB::raw('count(*) as rcount'))
    

   ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					//$query->Where('productname','like', '%' . $search . '%');
		
					
			
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('invoice')
       
       ->join('address', 'invoice.addrs_code', '=', 'address.address_code')
       
        // ->join('payment', 'invoice.payment_txr_id', '=', 'payment.payment_txr')
       //->join('users', 'payment.user_id', '=', 'users.id')

         	         	
             ->select('invoice.*','address.name','address.phone')
      
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					//$query->Where('productname','like', '%' . $search . '%');
			

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("id desc")
            ->get();


		$data = array();

		if($posts){

            
            
           // $x = "<a class='task-del discount' style='margin-left:4px' href='javascript:void(0);'><span class='label bg-primary'>Discount</span></a>";
            



			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
        $y = "<a class='task-del products' style='margin-left:4px' href='order/$r->payment_txr_id'><span class='label label-info'>View Orders</span></a>";
				$arr['id'] = $r->id;	
				$arr['Serial'] = $serial++;
				$arr['customername'] =$r->name;
				$arr['invoice'] = $r->Invoice;
				$arr['payment_txr'] = $r->payment_txr_id;
				$arr['quantity'] = $r->quantity;
				$arr['amount'] = $r->amount;				
				$arr['action'] =$y;

				
				$data[] = $arr;
			}

			$json_data = array(
				"iTotalRecords"=> intval($totalData),
				"iTotalDisplayRecords"=> intval($totalData),
				"draw"=>intval($request->input('draw')),
				"recordsTotal"=> intval($totalData),
				"data"=>$data
			);

			echo json_encode($json_data);
		
		}

}




}
