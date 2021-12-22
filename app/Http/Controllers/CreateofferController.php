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
class CreateofferController extends Controller
{
    

public function getproductnametoffer(Request $request)

{

$product_cat=DB::table('product_category')->select('product_category.*')->get();


return $product_cat;


}


public function createofferspecialandfestivalinsert(Request $request)



{

   
    $dateaandtime=date ( 'Y-m-d H:i:s' );
   


    $obj = DB::table('productoffer')->Insert(
   
        [
        'offername' => $request->input("offername"),       
        'promo_code' => $request->input("promocode"), 
        'min_price' => $request->input("minprice"), 
        'product_name' => $request->input("productname"),
        'qt' => $request->input("quantity"), 
        'discount' => $request->input("discount"),
        'srt_date' => $request->input("startdate"),
        'last_date' => $request->input("lastdate"),

     
        'created_at' =>$dateaandtime
        ]		       
    );
    if($obj==true){
        echo 1; 

    }

}



public function getproductoffer(Request $request)


{
    
	$columns = array(1=>'Serial',2=>'offername',3=>'promocode',4=>'discount',5=>'min_price',6=>'productname',7=>'qt',8=>'startdate',9=>'lastdate');

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('productoffer')
   //->join('product_category', 'productoffer.product_name', '=', 'product_category.id')
  


    ->select(DB::raw('count(*) as rcount'))
    

   ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
                            //$query->Where('productname','like', '%' . $search . '%');
                            $query->Where('offername','like', '%' . $search . '%');
                            $query->orWhere('promo_code','like', '%' . $search . '%');
                            $query->orWhere('srt_date','like', '%' . $search . '%');
                            $query->orWhere('last_date','like', '%' . $search . '%');
		
					
			
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('productoffer')
    // ->join('product_category', 'productoffer.product_name', '=', 'product_category.id')
       
   	         	
             ->select('productoffer.*',)
      
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					//$query->Where('productname','like', '%' . $search . '%');
					$query->Where('offername','like', '%' . $search . '%');
					$query->orWhere('promo_code','like', '%' . $search . '%');
					$query->orWhere('srt_date','like', '%' . $search . '%');
					$query->orWhere('last_date','like', '%' . $search . '%');

			

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("id desc")
            ->get();


		$data = array();

		if($posts){

            
            
            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Update Offer</span></a>";
            $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete Offer</span></a>";
            



			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
       
				$arr['id'] = $r->id;	
				$arr['Serial'] = $serial++;
				$arr['offername'] =$r->offername;
				$arr['promocode'] =$r->promo_code;
				//$arr['discount'] =$r->discount;


                if($r->discount>0)
                {
                    $arr['discount'] =$r->discount;
                }
                else{
                    $arr['discount'] ="NULL";
    
                }


				$arr['min_price'] =$r->min_price;

				//$arr['productname'] =$r->product_name;

                if($r->product_name>0)
                {


                    $pname = DB::table('product_category')
                    ->select('productname')
                    ->where('id',$r->product_name)
                    ->get();
                    foreach ($pname as $key => $pname) {
                        $pname=$pname->productname;
                    }
                    $arr['productname'] = $pname;

                }
                else{
                    $arr['productname'] ="NULL";
    
                }

				$arr['startdate'] =$r->srt_date;
				$arr['lastdate'] =$r->last_date;
				
                if($r->qt>0)
			{
                $arr['qt'] =$r->qt;
            }
            else{
                $arr['qt'] ="NULL";

            }
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



public function updateproductoffer(Request $request){


    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $id=$request->input("recordid");
       $obj = DB::table('productoffer')->where('id',$id)->update(
   
           [
           'offername' => $request->input("offername"), 
           'promo_code' => $request->input("promocode"), 
           'min_price' => $request->input("minprice"), 
           'discount' => $request->input("discount"),
           'product_name' => $request->input("productname"),
           'qt' => $request->input("quantity"),
           'srt_date' => $request->input("startdate"),
           'last_date' => $request->input("lastdate"),
           'updated_at' =>$dateaandtime
          
           ]		       
       );
       if($obj==true){
           echo 1; 
   
       }



}



public function deleteproductoffers(Request $request)

{

    $id=$request->input("id");
    $obj = DB::table('productoffer')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }

}



}
