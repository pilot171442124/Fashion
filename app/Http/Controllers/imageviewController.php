<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use Session;
use DB;
class imageviewController extends Controller
{


public function imageview(Request $request)

{

    $imageid=$request->id;
    
    Session::put('imageviewid', $imageid);
    
    
  
return redirect('/viewimage');
    
    
   
}




public function getimageviewlist(Request $request)

{

    
    
$imageviewid=Session::get('imageviewid');
    
  

    
    


    $productimage= DB::table('product')->select('imageurl','Remarks')
    ->where('id',$imageviewid)
    ->get();


return view('viewimage',['productimage'=>$productimage]);


}







}
