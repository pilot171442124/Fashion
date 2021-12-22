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


class dashboardController extends Controller
{
    

public function dashboardgetiboxdata(Request $request)


{

    $curDateTime = date ( 'Y-m-d' );
    $curmonth = date ( 'Y-m' );
    $curyear= date ( 'Y' );



    $customercount = DB::table('users')->where('userrole','Customer')->count();
    $salesmancount = DB::table('users')->where('userrole','Salesman')->count();

    $totalusers = DB::table('users')->count();
    
    $today = DB::table('payment')->where('created_at',$curDateTime)->sum('amount');

    $curentmonth = DB::table('payment')->where('created_at', 'LIKE', '%'.$curmonth.'%')->sum('amount');
    
    $year = DB::table('payment')->where('created_at', 'LIKE', '%'.$curyear.'%')->sum('amount');
    
    
    
   

    return  ['coustomercount'=>$customercount,'salesmancount'=> $salesmancount,'totalusers'=>$totalusers,'today'=>$today,
              'month'=>$curentmonth,'year'=>$year];

}




public function highchart(Request $request)
{



   // $loginuserid = Auth::user()->id;


    $posts = DB::table('payment')
    //->select(DB::raw("CONCAT(YEAR(`IssueDate`),'-',MONTH(`IssueDate`)) AS IssuedYearMonth,COUNT(`RequestId`) AS RequestCount"))
    ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS IssuedYearMonth,COUNT(`id`) AS RequestCount "))
   
   
    ->whereNotNull('created_at')
    //->where('status','=','paid')

    ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
    //->tosql();
    ->get();


    $get_amounts = DB::table('payment')->select('amount')
    ->whereNotNull('created_at')


    //->where('status','=','paid')
    ->get();

    $amount= array();

    foreach($get_amounts as $r){
    
      $amount[] = $r->amount;
  
     
      
    }





  $category = array();
  $series = array("name"=>"Customer","data"=>array(),"color"=>"#00587E");

  foreach($posts as $r){
    $category[] = $r->IssuedYearMonth;
   

    settype($r->RequestCount,"int");
    $series["data"][] = $r->RequestCount;
  }
  
  $output = array();
  $output["category"] = $category;
  $output["series"][] = $series;

  //$output["amount"] = $amount;
  
  return $output;//json_encode($output);



  }











}
