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




class ProductCategoryController extends Controller
{
    public function productCategoryentry(Request $request)
    {
       

        $dateaandtime=date ( 'Y-m-d H:i:s' );


        $product_name=$request->name;
     

        $product_name_count = count($product_name);
    
    
        if($product_name_count > 0)  
        {  
             for($i=0; $i<$product_name_count; $i++)  
             {  
             
    
                    $dateaandtime=date ( 'Y-m-d H:i:s' );
                    $obj = DB::table('product_category')->updateOrInsert(
                
                        ['productname' => $product_name[$i], 
                        'created_at' => $dateaandtime, 
                        
                   
                        ]		       
                    );
    
           
        } 
    


    }
}




public function getproductname(Request $request)
{
    
    $posts = DB::table('product_category')
           //->select('StudentsId', 'StudentName')
            ->select(DB::raw("id,CONCAT(productname) as productname"))
            ->orderByRaw("productname asc")
            ->get();

         return $posts;



}




public function addproductentry(Request $request){

    $dateaandtime=date ( 'Y-m-d H:i:s' );

    $file=$request->file('file');
    $nam=$file->getClientOriginalName();
    $file->move('images/',$nam); 
   

    $obj = DB::table('product')->updateOrInsert(
   
        ['product_cat_id' => $request->input("productname"), 
       
        'price' => $request->input("price"),
        //'quantities' => $request->input("quantities"),

        'tags' => $request->input("tags"),
        'stok' => $request->input("stock"),
        'product_gen' => $request->input("gen"),
        
        'imageurl' => $nam,
        'Remarks' => $request->input("remarks"),
        

        'updated_at' =>$dateaandtime
       
        ]		       
    );
    if($obj==true){
        echo 1; 

    }


}




function getAllProductslist(Request $request){ 

    $curDateTime = date ( 'Y-m-d' );
    $search = $request->search;
    $search_generation = $request->getgenid;


    $posts = DB::table('product')
    ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
            ->select('product.*','product_category.productname')
            
        ->where('productname', 'LIKE', '%'.$search.'%')
        ->orWhere('price', 'LIKE', '%'.$search.'%')
        ->orWhere('price', 'LIKE', '%'.$search.'%')

       
            
            ->orderByRaw("id asc")
            ->get();

    $data = array();
    if($posts){
        foreach($posts as $r){

            $arr['id'] = $r->id;

            $arr['productname'] = $r->productname;
            $arr['price'] = $r->price;
            //$arr['quantities'] = $r->quantities;
            $arr['imageurl'] = $r->imageurl;
            $arr['stock'] = $r->stok;
           // $arr['size'] = $r->size;
            $arr['tags'] = $r->tags;

            $arr['discount'] = $r->discount;

            $arr['Remarks'] = $r->Remarks;


            $data[] = $arr;



}
}

return $data;

}



public function getproductid(Request $request)



{

    $id= $request->id;


    $get_product_data= DB::table('product')->select('discount','price',)->where('id',$id)->get();

    
    foreach( $get_product_data as $row)
    
    {

    $discount=$row->discount;
    $price=$row->price;



    }
    
  
   
    if(Auth::check())
    {



        $loginuserid = Auth::user()->id;



        $cookie=Cookie::get('temp_userid');

        if(empty($cookie)){
        
        $temp_userid=uniqid();
        
        Cookie::queue('temp_userid', $temp_userid,50);
        
        }
        
        $dateaandtime=date ( 'Y-m-d H:i:s' );
        
        $id= $request->id;
        
       // $publicIP = json_decode(file_get_contents("http://api.hostip.info/get_json.php"));
        
      //  $ip=$publicIP->ip;
        
        
        
        if(empty($cookie))
        {
        
           
           
           
            if( !empty($discount))
                                    {
        
                                        
                                    $discount_execute=$price*$discount;
                                        
                                    $discount_result=$discount_execute/100;
                                    $minus_price=$price-$discount_result;
                                   
                                   
                                    $multi_discount=$minus_price*1;
                                    
                                
        
                                    $obj = DB::table('addtocart')->updateOrInsert(
        
        
                                        [
                                            'product_id' =>$id, 
                                            //'client_ip' => $ip,
                                            'cart_price' => $multi_discount,
        
        
                                            'product_price' => $price,
                                            'product_discount' => $discount,
        
                                            'quantity' => 1,
                                            'temp_userid' => $temp_userid,
                                            'customer_id' => $loginuserid ,

                                            'payment_status' => 'unpaid', 
        
                                            'created_at' =>$dateaandtime
                                            ]		       
                                            );
        
        
        
                                    
                                    }
        
        
        
           
           
                                else{
                                
                                    
                                
                                    $obj = DB::table('addtocart')->updateOrInsert(
                                
                                        [
                                        'product_id' =>$id, 
                                        //'client_ip' => $ip,
                                        'cart_price' => $price,
                                        'product_price' => $price,
        
                                        'temp_userid' => $temp_userid, 
                                        'customer_id' => $loginuserid ,

                                        'quantity' => 1,
                                        'payment_status' => 'unpaid', 
                                    
                                        'created_at' =>$dateaandtime
                                        ]		       
                                        );
        
                                    }
        
        }
        
        
        
        
        
        
        else{
        
            
        
                    $cart_data= DB::table('addtocart')
                    
                    ->where('product_id',$id)
                    ->where('temp_userid',$cookie)
                    //->where('client_ip',$ip)
                    
                    ->get();
                    
                    $cart_data_count=count($cart_data);
        
            
        
        //
        
        
        
        
                    $get_addtocart_data= DB::table('addtocart')->select('quantity')
                    ->where('product_id',$id)
                        ->where('temp_userid',$cookie)
                       // ->where('client_ip',$ip)
                     

                        
                    ->get();
        
                        
                    foreach( $get_addtocart_data as $row)
        
                    {
        
                    $quantity=$row->quantity;
        
                    $add_quantity=$quantity+1;
        
        
        
                    }
        
        
        
        
        if($cart_data_count>0)
        {
                 
           
            
        
                        if( !empty($discount))
                        {
        
                                  
        
                                    $discount_execute=$price*$discount;
                                        
                                    $discount_result=$discount_execute/100;
                                    $minus_price=$price-$discount_result;
                                   
                                   
                                    $multi_discount=$minus_price*$add_quantity;
        
                                    $obj = DB::table('addtocart')
                                    
                                    ->where('product_id',$id)
                                    ->where('temp_userid',$cookie)
                                    //->where('client_ip',$ip)
                                    
                                    
                                    ->update(
        
        
                                        [
                                            
                                            'cart_price' => $multi_discount,
                                            'quantity' => $add_quantity,
                                            'product_price' => $price,
                                            'product_discount' => $discount,
                                            'customer_id' => $loginuserid, 
                                            
                                            'payment_status' => 'unpaid', 
        
        
                                            ]		       
                                            );
        
        
        
                        
                        }
        
                        else{
                            
                            $nodiscount_price=$price*$add_quantity;
                            
                            
                            $obj = DB::table('addtocart')
                                    ->where('product_id',$id)
                                    ->where('temp_userid',$cookie)
                                    //->where('client_ip',$ip)
                                    
                                    ->update(
                                
                                        [
                                    
                                        'quantity' => $add_quantity,
                                        'cart_price' => $nodiscount_price,
                                        'product_discount' => $discount,
                                        'product_price' => $price,
                                        'payment_status' => 'unpaid', 
        
        
                                        ]		       
                                        );
        
        
                                }
        
        
        }
        
        
        else{
        
        
        
                                    if( !empty($discount))
                                    {
        
                                        
                                    $discount_execute=$price*$discount;
                                        
                                    $discount_result=$discount_execute/100;
                                    $minus_price=$price-$discount_result;
                                   
                                   
                                    $multi_discount=$minus_price*1;
                                    
                                
        
                                    $obj = DB::table('addtocart')->updateOrInsert(
        
        
                                        [
                                            'product_id' =>$id, 
                                            //'client_ip' => $ip,
                                            'cart_price' => $multi_discount,
                                            'product_price' => $price,
        
                                            'quantity' => 1,
                                            'product_discount' => $discount,
                                            'payment_status' => 'unpaid', 
        
                                            'temp_userid' => $cookie,
                                            'customer_id' => $loginuserid ,
                                             
                                            'created_at' =>$dateaandtime
                                            ]		       
                                            );
        
        
        
                                    
                                    }
        
        
        
        
        
                            else{
        
                                        $obj = DB::table('addtocart')->updateOrInsert(
        
        
                                            [
                                                'product_id' =>$id, 
                                                //'client_ip' => $ip,
                                                'cart_price' => $price,
                                                'product_price' => $price,
        
                                                'quantity' => 1,
                                                'temp_userid' => $cookie,
                                                'customer_id' => $loginuserid,

                                                'created_at' =>$dateaandtime,
                                                'payment_status' => 'unpaid', 
        
                                                ]		       
                                                );
                                
                                            }
        
        }
        
        
        
        
        
         
        
        
        }
        
        
        
        
        return redirect('/addtocart');










    }
else{

    
 $cookie=Cookie::get('temp_userid');

 if(empty($cookie)){
 
 $temp_userid=uniqid();
 
 Cookie::queue('temp_userid', $temp_userid,50);
 
 }
 
 $dateaandtime=date ( 'Y-m-d H:i:s' );
 
 $id= $request->id;
 
 //$publicIP = json_decode(file_get_contents("http://api.hostip.info/get_json.php"));
 
 //$ip=$publicIP->ip;
 
 
 
 if(empty($cookie))
 {
 
    
    
    
     if( !empty($discount))
                             {
 
                                 
                             $discount_execute=$price*$discount;
                                 
                             $discount_result=$discount_execute/100;
                             $minus_price=$price-$discount_result;
                            
                            
                             $multi_discount=$minus_price*1;
                             
                         
 
                             $obj = DB::table('addtocart')->updateOrInsert(
 
 
                                 [
                                     'product_id' =>$id, 
                                     //'client_ip' => $ip,
                                     'cart_price' => $multi_discount,
 
 
                                     'product_price' => $price,
                                     'product_discount' => $discount,
 
                                     'quantity' => 1,
                                     'temp_userid' => $temp_userid,
                                     'payment_status' => 'unpaid', 
 
                                     'created_at' =>$dateaandtime
                                     ]		       
                                     );
 
 
 
                             
                             }
 
 
 
    
    
                         else{
                         
                             
                         
                             $obj = DB::table('addtocart')->updateOrInsert(
                         
                                 [
                                 'product_id' =>$id, 
                                 //'client_ip' => $ip,
                                 'cart_price' => $price,
                                 'product_price' => $price,
 
                                 'temp_userid' => $temp_userid, 
                                 'quantity' => 1,
                                 'payment_status' => 'unpaid', 
                             
                                 'created_at' =>$dateaandtime
                                 ]		       
                                 );
 
                             }
 
 }
 
 
 
 
 
 
 else{
 
     
 
             $cart_data= DB::table('addtocart')
             
             ->where('product_id',$id)
             ->where('temp_userid',$cookie)
             //->where('client_ip',$ip)
             
             ->get();
             
             $cart_data_count=count($cart_data);
 
     
 
 //
 
 
 
 
             $get_addtocart_data= DB::table('addtocart')->select('quantity')
             ->where('product_id',$id)
                 ->where('temp_userid',$cookie)
                 //->where('client_ip',$ip)
                 
             ->get();
 
                 
             foreach( $get_addtocart_data as $row)
 
             {
 
             $quantity=$row->quantity;
 
             $add_quantity=$quantity+1;
 
 
 
             }
 
 
 
 
 if($cart_data_count>0)
 {
          
    
     
 
                 if( !empty($discount))
                 {
 
                           
 
                             $discount_execute=$price*$discount;
                                 
                             $discount_result=$discount_execute/100;
                             $minus_price=$price-$discount_result;
                            
                            
                             $multi_discount=$minus_price*$add_quantity;
 
                             $obj = DB::table('addtocart')
                             
                             ->where('product_id',$id)
                             ->where('temp_userid',$cookie)
                             //->where('client_ip',$ip)
                             
                             
                             ->update(
 
 
                                 [
                                     
                                     'cart_price' => $multi_discount,
                                     'quantity' => $add_quantity,
                                     'product_price' => $price,
                                     'product_discount' => $discount,
                                     'payment_status' => 'unpaid', 
 
 
                                     ]		       
                                     );
 
 
 
                 
                 }
 
                 else{
                     
                     $nodiscount_price=$price*$add_quantity;
                     
                     
                     $obj = DB::table('addtocart')
                             ->where('product_id',$id)
                             ->where('temp_userid',$cookie)
                             ///->where('client_ip',$ip)
                             
                             ->update(
                         
                                 [
                             
                                 'quantity' => $add_quantity,
                                 'cart_price' => $nodiscount_price,
                                 'product_discount' => $discount,
                                 'product_price' => $price,
                                 'payment_status' => 'unpaid', 
 
 
                                 ]		       
                                 );
 
 
                         }
 
 
 }
 
 
 else{
 
 
 
                             if( !empty($discount))
                             {
 
                                 
                             $discount_execute=$price*$discount;
                                 
                             $discount_result=$discount_execute/100;
                             $minus_price=$price-$discount_result;
                            
                            
                             $multi_discount=$minus_price*1;
                             
                         
 
                             $obj = DB::table('addtocart')->updateOrInsert(
 
 
                                 [
                                     'product_id' =>$id, 
                                     //'client_ip' => $ip,
                                     'cart_price' => $multi_discount,
                                     'product_price' => $price,
 
                                     'quantity' => 1,
                                     'product_discount' => $discount,
                                     'payment_status' => 'unpaid', 
 
                                     'temp_userid' => $cookie, 
                                     'created_at' =>$dateaandtime
                                     ]		       
                                     );
 
 
 
                             
                             }
 
 
 
 
 
                     else{
 
                                 $obj = DB::table('addtocart')->updateOrInsert(
 
 
                                     [
                                         'product_id' =>$id, 
                                         //'client_ip' => $ip,
                                         'cart_price' => $price,
                                         'product_price' => $price,
 
                                         'quantity' => 1,
                                         'temp_userid' => $cookie, 
                                         'created_at' =>$dateaandtime,
                                         'payment_status' => 'unpaid', 
 
                                         ]		       
                                         );
                         
                                     }
 
 }
 
 
 
 
 
  
 
 
 }
 
 
 
 
 return redirect('/addtocart');

}






      
} 


 



public function getcartdata(Request $request)
{


    $cookie=Cookie::get('temp_userid');

    //$publicIP = json_decode(file_get_contents("http://api.hostip.info/get_json.php"));

   // $ip=$publicIP->ip; 


if(Auth::check())
{
    $loginuserid = Auth::user()->id;

    $posts = DB::table('addtocart')
    ->join('product', 'addtocart.product_id', '=', 'product.id')
    ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
    //->join('productsize', 'product.product_cat_id', '=', 'productsize.product_name')

    
    ->select('addtocart.*','product.price','product.imageurl','product.discount','product.tags','product_category.productname')
        
        ->where('customer_id',$loginuserid)
        ->where('payment_status','unpaid')
        ->orwhere('temp_userid',$cookie)   

        ->orderByRaw("id asc")
        ->get();

     return view('addtocart', ['data'=>$posts]); 


}

 else{

    $posts = DB::table('addtocart')
    ->join('product', 'addtocart.product_id', '=', 'product.id')
    ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
    
    ->select('addtocart.*','product.price','product.imageurl','product.discount','product.tags','product_category.productname')
        //->where('client_ip',$ip)
        ->where('temp_userid',$cookie)
       

        
        
        ->orderByRaw("id asc")
            ->get();
 
 
            return view('addtocart', ['data'=>$posts]); 
 
 
        }    




           


            

        
          
          
}




public function totalprice(Request $request)

{

    $cookie=Cookie::get('temp_userid');

   





    $totalprice = DB::table('addtocart')
    ->where('temp_userid',$cookie)
    ->sum('product_price'+10);







return  $totalprice;

}








public function deletecartprodut(Request $request)
{

    $cart_id=$request->id;


  


    $obj = DB::table('addtocart')->select('quantity','product_id','cart_price')
    
    ->where('id',$cart_id)
    ->get();
    
foreach( $obj as $quantity)

    {
   
        $quatity_get=$quantity->quantity;
        
        $product_id=$quantity->product_id;
        $cart_price=$quantity->cart_price;

    }
           
    



    $obj = DB::table('product')->select('discount','price')
    
    ->where('id',$product_id)
    ->get();


    foreach( $obj as $product)

    {
   
        $discount=$product->discount;
        $price=$product->price;
      
    }


//
    $discount_execute=$price*$discount;
                                
    $discount_result=$discount_execute/100;
    $minus_price=$price-$discount_result;
   
   
    $multi_discount=$minus_price*1;

$minus_cart_price=$cart_price-$multi_discount;


    
    
    
    
    if($quatity_get>1)
            
            {

                        $quantity_sub=$quatity_get-1;


                        $obj = DB::table('addtocart')
                        ->where('id',$cart_id)
                    
                        ->update(

                            [
                        
                            'quantity' => $quantity_sub,
                            'cart_price' => $minus_cart_price,


                            ]		       
                            );



                        return redirect('/addtocart');



            }
            
                else{
                
                        $cart_id=$request->id;

                        $obj = DB::table('addtocart')->where('id',$cart_id)->delete();

                        return redirect('/addtocart');
                }




}




public function cartdataadd(Request $request)

{

if(Auth::check())

{

    $loginuserid = Auth::user()->id;
    $id=$request->id;
    $make_code=time();  
    $product_id=$request->product_id;
    $product_name=$request->proname;
    $product_price=$request->price;
    $image=$request->image;
    $product_discount=$request->product_discount;
    $product_size=$request->size;
    $product_tags=$request->tags;
    $product_quantity=$request->quantity;
    $product_total=$request->total;

    foreach($product_name as $key => $d )
{
    $products = array("addtocart_id"=>$id[$key], "product_id"=>$product_id[$key], "user_id"=>$loginuserid, "product_name"=>$product_name[$key], "product_price"=>$product_price[$key],
     "image"=>$image[$key],"discount"=>$product_discount[$key], 
      "size"=>$product_size[$key],"tags"=> $product_tags [$key],"quantity"=> $product_quantity[$key]
      ,"cartcode"=> $make_code,"payment_status"=> "unpaid","total"=> $product_total[$key]
    );



    $obj = DB::table('addedcart')->insert($products);


       
     

    




}




if ($obj==true) {
    
return "sucessful";

}
   


}




   


    else{

    
       return "login";


    }






}





public function viewproductlistroute(Request $request)


{


    
	$columns = array(1=>'Serial',2=>'productname',3=>'price',4=>'discount',5=>'tags',6=>'imageurl',7=>'Remarks',8=>'stok',9=>'stok',);

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('product')
     ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')

    ->select(DB::raw('count(*) as rcount'))
    

   ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('productname','like', '%' . $search . '%');
					$query->orWhere('price','like', '%' . $search . '%');
					$query->orWhere('discount','like', '%' . $search . '%');
					$query->orWhere('tags','like', '%' . $search . '%');
				
					
					$query->orWhere('imageurl','like', '%' . $search . '%');
					$query->orWhere('Remarks','like', '%' . $search . '%');
					$query->orWhere('stok','like', '%' . $search . '%');

					
			
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('product')
        ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')

         	         	
             ->select('product.*', 'product_category.productname')
      
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					$query->Where('productname','like', '%' . $search . '%');
					$query->orWhere('price','like', '%' . $search . '%');
					$query->orWhere('discount','like', '%' . $search . '%');
					$query->orWhere('tags','like', '%' . $search . '%');
				
					$query->orWhere('imageurl','like', '%' . $search . '%');
					$query->orWhere('Remarks','like', '%' . $search . '%');

					$query->orWhere('stok','like', '%' . $search . '%');
					
				   

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

            
            
            $x = "<a class='task-del discount' style='margin-left:4px' href='javascript:void(0);'><span class='label bg-primary'>Discount</span></a>";
            
            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				
                
			$s = "<a class='task-del size' style='margin-left:4px' href='size/$r->product_cat_id'><span class='label bg-primary'>Size</span></a>";
                
                
                
                         
                
                $arr['id'] = $r->id;
				$arr['product_cart_id'] = $r->product_cat_id;

				$arr['Serial'] = $serial++;
				$arr['productname'] = $r->productname;
				$arr['price'] = $r->price;
				$arr['tags'] = $r->tags;
				//$arr['size'] = $r->size;
				//$arr['quantity'] = $r->quantities;

				$arr['discount'] = $r->discount;
				$arr['imageurl'] = $r->imageurl;

				$arr['Remarks'] = $r->Remarks;
				$arr['stock'] = $r->stok;

				
				$arr['action'] =$s.$x.$y.$z;


				
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







public function checkdiscountandprice(Request $request)

{

   
    $cookie=Cookie::get('temp_userid');

   // $publicIP = json_decode(file_get_contents("http://api.hostip.info/get_json.php"));

    //$ip=$publicIP->ip; 




    $both_Check = DB::table('addtocart')
    
    ->join('product', 'addtocart.product_id', '=', 'product.id')
    ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
    
    ->select('product_category.productname')
    //->where('client_ip',$ip)
    ->where('temp_userid',$cookie)
    

    
    ->where(function($query)
      {
         $query->where('update_price_status',1);
         $query->orwhere('update_disc_status',1);
      })

    ->get();





    $discountCheck = DB::table('addtocart')
    
    ->join('product', 'addtocart.product_id', '=', 'product.id')
    ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
    
    ->select('product_category.productname')
    //->where('client_ip',$ip)
    ->where('temp_userid',$cookie)
    ->where('update_disc_status',1)
    ->orwhere('update_price_status',1)
  


    ->get();



    $price_Check = DB::table('addtocart')
    
    ->join('product', 'addtocart.product_id', '=', 'product.id')
    ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
    
    ->select('product_category.productname')
   // ->where('client_ip',$ip)
    ->where('temp_userid',$cookie)
    ->where('update_price_status',1)
    ->orwhere('update_disc_status',1)


    ->get();








$data = array();
    if($discountCheck){
        foreach($discountCheck as $r){


            $arr['productname'] = $r->productname;
       

            $data[] = $arr;

        }

    }





$count_discountCheck=count($discountCheck);

$count_priceCheck=count($price_Check);
$both_Checkdisandprice=count($both_Check);









if($both_Checkdisandprice>0 )
{


    $data = array();
    if($both_Check){
        foreach($both_Check as $r){


            $arr['productname'] = $r->productname;
       

            $data[] = $arr;

        }

    }



return $data;





}













/*

if($count_priceCheck>0)
{





    $data = array();
    if($price_Check){
        foreach($price_Check as $r){


            $arr['productname'] = $r->productname;
       

            $data[] = $arr;

        }

    }



return 46;





}



if($count_discountCheck>0 )
{


    $data = array();
    if($discountCheck){
        foreach($discountCheck as $r){


            $arr['productname'] = $r->productname;
       

            $data[] = $arr;

        }

    }



return 47;





}


*/










    



}





public function updateaddtocartstatus(Request $request)

{


    $cookie=Cookie::get('temp_userid');

   // $publicIP = json_decode(file_get_contents("http://api.hostip.info/get_json.php"));

    ///$ip=$publicIP->ip;




    $obj = DB::table('addtocart')
 
    //->where('client_ip',$ip)
    ->where('temp_userid',$cookie)

    ->update(
   
        [
        'update_disc_status' => 0, 
        'update_price_status' =>0, 
    
     
        ]		       
    );





}






public function geteditproductlist(Request $request)


{

    $obj = DB::table('product_category')->select('id','productname')->get();
 


    return  $obj;

}



public function editproduct(Request $request)

{

    $id=$request->input("recordid");

    $file=$request->file('file');
     
    $dateaandtime=date ( 'Y-m-d H:i:s' );
   
      $price=$request->input("price");
   if(!empty($price))
{

                $obj = DB::table('addtocart')->where('product_id',$id)->update(

                    ['product_price' => $price, 
                    
                    'update_price_status' =>1, 
            
                    'updated_at' =>$dateaandtime
                    
                    ]		       
                );


}




   if(empty($file))
   
          {

                    

                    $obj = DB::table('product')->where('id',$id)->update(

                    ['product_cat_id' => $request->input("productname"), 
                    
                    //'size' => $request->input("productsize"), 
                    'price' => $request->input("price"),
                    //'quantities' => $request->input("quantities"),

                    'tags' => $request->input("tags"),
                    'stok' => $request->input("stock"),
                    'Remarks' => $request->input("remarks"),
                    

                    'updated_at' =>$dateaandtime
                    
                    ]		       
                );
                if($obj==true){
                    echo 1; 

                }

    
         }
         else {
            
            $nam=$file->getClientOriginalName();
            $file->move('images/',$nam);

            $id=$request->input("recordid");
                    

            $obj = DB::table('product')->where('id',$id)->update(

            ['product_cat_id' => $request->input("productname"), 
            
            //'size' => $request->input("productsize"), 
            'price' => $request->input("price"),
            //'quantities' => $request->input("quantities"),

            'tags' => $request->input("tags"),
            'stok' => $request->input("stock"),
            
            'imageurl' => $nam,
            'Remarks' => $request->input("remarks"),
            
            'updated_at' =>$dateaandtime
            
            ]		       
        );
        if($obj==true){
            echo 1; 

        }







         }
    


}





public function deleteproductRoute(Request $request){

    $id=$request->input("id");
       $obj = DB::table('product')->where('id',$id)->delete();
   
           if($obj==true){

            return 1;
           }


}


public function discountform(Request $request)
{

    $id=$request->input("disrecordid");
    $discount=$request->input("discount");
    $dateaandtime=date ( 'Y-m-d H:i:s' );

    $obj = DB::table('product')->where('id',$id)->update(

        [
        
        'discount' =>$discount,  
        'updated_at' =>$dateaandtime
        
        ]		       
    );


    $obj2 = DB::table('addtocart')->where('product_id',$id)->update(

        [
        
        'product_discount' =>$discount,
        'update_disc_status' =>1,  

        'updated_at' =>$dateaandtime
        
        ]		       
    );


    if($obj==true){
        echo 1; 

    }




}







public function viewproductcategory(Request $request)

{


	$columns = array(1=>'Serial',2=>'productname',3=>'invoice',);

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('product_category')
   //->join('address', 'invoice.addrs_code', '=', 'address.address_code')
  //->join('users', 'payment.user_id', '=', 'users.id')


    ->select(DB::raw('count(*) as rcount'))
    

   ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('productname','like', '%' . $search . '%');
		
					
			
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('product_category')
       
       //->join('address', 'invoice.addrs_code', '=', 'address.address_code')
       
        // ->join('payment', 'invoice.payment_txr_id', '=', 'payment.payment_txr')
       //->join('users', 'payment.user_id', '=', 'users.id')

         	         	
             ->select('product_category.*')
      
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					$query->Where('productname','like', '%' . $search . '%');
			

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("id desc")
            ->get();


		$data = array();

		if($posts){

            
            
            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Update Product</span></a>";
            $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
            



			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
       
				$arr['id'] = $r->id;	
				$arr['Serial'] = $serial++;
				$arr['productname'] =$r->productname;
			
				$arr['action'] =$y.$z;

				
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



public function updateproduct(Request $request)

{


    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $id=$request->input("recordid");
       $obj = DB::table('product_category')->where('id',$id)->update(
   
           [
            'productname' => $request->input("pname"), 
            'updated_at' =>$dateaandtime
   
           ]		       
       );
       if($obj==true){
           echo 1; 
   
       }

}


public function deleteproduct(Request $request)

{

    $id=$request->input("id");
    $obj = DB::table('product_category')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }

}



public function updatequantityandtotalprice(Request $request)
{

$id=$request->id;
$total=$request->total;

$qt=$request->qt;


$updatequantity = DB::table('addtocart')->select('product_price','product_discount')
->where('id',$id)
->get();

foreach ($updatequantity as $key => $updatequantity) {
$product_price=$updatequantity->product_price;
$product_discount=$updatequantity->product_discount;




}
$product_price_mul_quantity=$product_price*$qt;

$find_percentage=$product_price_mul_quantity*$product_discount;

$percentage_excute=$find_percentage/100;
$result=$product_price_mul_quantity-$percentage_excute;




  
       $obj = DB::table('addtocart')->where('id',$id)->update(
   
           [
            'cart_price' => $result,
            'quantity' => $qt, 

          
          
           ]		       
       );
 




}


public function selectgeneration(){


    $selectgen = DB::table('producttype')->select('product_type','id')
   ->get();

   return view('prouductentry',['selectgen'=>$selectgen]);

}






public function getproductsize(Request $request)

{

    $addtocartid=$request->addtocartid;

    $productsize = DB::table('addtocart')
    
    
    ->join('product', 'addtocart.product_id', '=', 'product.id')
    ->join('productsize', 'product.product_cat_id', '=', 'productsize.product_name')
    
    ->where('addtocart.id',$addtocartid)
    ->where('productsize.product_qt','>',0)

    ->select('productsize.id','productsize.product_size','productsize.product_qt')
    
    ->get();
return $productsize;
}



public function sizeupdate(Request $request){



    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $id=$request->input("catidtake");
       $obj = DB::table('addtocart')->where('id',$id)->update(
   
           [
            'products_size' => $request->input("productsize"), 
  

        
           'updated_at' =>$dateaandtime
          
           ]		       
       );
    

}




public function viewsizeasproduct(Request $request){


    $product_cat_id= $request->id;
    $productsize = DB::table('productsize')
    ->select('product_size','product_qt')
    ->where('product_name',$product_cat_id)
    ->get();

return view('/viewsize',["productsize"=>$productsize]);

}



public function getproductcategorydata(Request $request)

{


    
    $productcategory = DB::table('product_category')
    ->select('product_category.*')
  
    ->get();

return view('/productsizeentry',["productcategory"=>$productcategory]);

}


public function productsizeentry(Request $request)

{
    $catname=$request->pname;
    $productsize=$request->productsize;
    $qt=$request->qt;


    $obj = DB::table('productsize')->insert(
   
        [
        'product_name' => $catname, 
        'product_size' => $productsize, 
        'product_qt' => $qt, 

       
    
       
        ]		       
    );
    if($obj==true){
        echo 1; 

    }


}




public function viewproductsize(Request $request)


{



$columns = array(1=>'Serial',2=>'product_name',3=>'product_size',4=>'product_qt');

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('productsize')
   ->join('product_category', 'productsize.product_name', '=', 'product_category.id')
  //->join('users', 'payment.user_id', '=', 'users.id')


    ->select(DB::raw('count(*) as rcount'))
    

   ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('product_name','like', '%' . $search . '%');
		
					
			
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('productsize')
       
   ->join('product_category', 'productsize.product_name', '=', 'product_category.id')
       
       
        // ->join('payment', 'invoice.payment_txr_id', '=', 'payment.payment_txr')
       //->join('users', 'payment.user_id', '=', 'users.id')

         	         	
             ->select('productsize.*','product_category.productname')
      
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					$query->Where('product_name','like', '%' . $search . '%');
			

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("id desc")
            ->get();


		$data = array();

		if($posts){

            
            
            //$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Update Product</span></a>";
            $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
            



			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
       
				$arr['id'] = $r->id;	
				$arr['Serial'] = $serial++;
				$arr['productname'] =$r->productname;
				$arr['productsize'] =$r->product_size;
				$arr['productqt'] =$r->product_qt;

			
				$arr['action'] =$z;

				
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


  
    
public function deleteproductsize(Request $request)

{

    $id=$request->input("id");
     
    
    
 
    
    $obj = DB::table('productsize')->where('id',$id)->delete();
   
           if($obj==true){

            return 1;
           }
}

}
