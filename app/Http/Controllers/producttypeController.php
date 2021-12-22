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

class producttypeController extends Controller
{
    
public function producttype()
{
    $producttype = DB::table('producttype')
    ->select('producttype.*')
    ->get();
    return view('index',['producttype'=>$producttype]);
}




function getgenerationProductslist(Request $request){ 

    $curDateTime = date ( 'Y-m-d' );
   
    $search_generation = $request->getgenid;


    $posts = DB::table('product')
    ->join('product_category', 'product.product_cat_id', '=', 'product_category.id')
            ->select('product.*','product_category.productname')
            
        ->where('product_gen', 'LIKE', '%'.$search_generation.'%')
        //->orWhere('price', 'LIKE', '%'.$search.'%')
       // ->orWhere('price', 'LIKE', '%'.$search.'%')

       
            
            ->orderByRaw("id asc")
            ->get();

    $data = array();
    if($posts){
        foreach($posts as $r){

            $arr['id'] = $r->id;

            $arr['productname'] = $r->productname;
            $arr['price'] = $r->price;
           // $arr['quantities'] = $r->quantities;
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

public function addproductgeneration(Request $request)
{
$generation=$request->gen;

$obj = DB::table('producttype')->updateOrInsert(
   
    [
    'product_type' =>$generation , 
    

    ]		       
);
if($obj==true){
    echo 1; 

}

}




public function viewproductggenerations (Request $request)

{

    $columns = array(1=>'Serial',2=>'product_type',3=>'action',);

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('producttype')
   //->join('product_category', 'productoffer.product_name', '=', 'product_category.id')
  


    ->select(DB::raw('count(*) as rcount'))
    

   ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
                            //$query->Where('productname','like', '%' . $search . '%');
                            $query->Where('product_type','like', '%' . $search . '%');
                           
			
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('producttype')
    // ->join('product_category', 'productoffer.product_name', '=', 'product_category.id')
       
   	         	
             ->select('producttype.*',)
      
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					//$query->Where('productname','like', '%' . $search . '%');
					$query->Where('product_type','like', '%' . $search . '%');
					
			

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("id desc")
            ->get();


		$data = array();

		if($posts){

            
            
           // $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Update Offer</span></a>";
            $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete Product Type</span></a>";
            



			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
       
				$arr['id'] = $r->id;	
				$arr['Serial'] = $serial++;
				$arr['producttype'] =$r->product_type;
				
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

public function deleteproducttype(Request $request)

{

    $id=$request->input("id");
    $obj = DB::table('producttype')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        } 
}

}
