<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userentryController extends Controller
{



public function userentry(Request $request)

{


    $email= $request->input("email");
    $usercode= $request->input("usercode");
    $phone= $request->input("phone");
   
   
   
    $emailquery=DB::table('users')->where('email',$email)->count();
    $usercodequery=DB::table('users')->where('usercode',$usercode)->count();
    $phonequery=DB::table('users')->where('phone', $phone)->count();
   
   
    
   if($emailquery>0)
   {
   echo "getemail";
   }
   elseif($usercodequery>0){
       echo "getusercode";
   }
   
   elseif($phonequery>0){
       echo "getphonenumber";
   }
   else{
       $dateaandtime=date ( 'Y-m-d H:i:s' );
       $obj = DB::table('users')->updateOrInsert(
   
           ['name' => $request->input("name"), 
           'usercode' => time(), 
           'phone' => $request->input("phone"), 
           'email' => $request->input("email"),
           'gender' => $request->input("gender"), 
           'userrole' => $request->input("userrole"),
           'activestatus' => $request->input("activestatus"),
           'password' => Hash::make($request->input("password")),
           'created_at' =>$dateaandtime
           ]		       
       );
       if($obj==true){
           echo 1; 
   
       }
   }
   



}



public function usertabledatafetch(Request $request){


    //datatable column index => database column name. here considaer datatable visible and novisible column
    
    $columns = array(2=>'name',3=>'usercode',4=>'phone',5=>'email',6=>'userrole',7=>'gender',8=>'activestatus');

    $totalData = User::count();
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];

    $posts = DB::table('users')
        ->select('id','name','usercode','email','userrole','gender','activestatus','password','phone')
        ->where('name', 'LIKE', '%'.$search.'%')
        ->orWhere('usercode', 'LIKE', '%'.$search.'%')
        ->orWhere('phone', 'LIKE', '%'.$search.'%')
        ->orWhere('email', 'LIKE', '%'.$search.'%')
        ->orWhere('userrole', 'LIKE', '%'.$search.'%')
        ->orWhere('gender', 'LIKE', '%'.$search.'%')

        ->orWhere('activestatus', 'LIKE', '%'.$search.'%')
        ->offset($start)
        ->limit($limit)
        ->orderByRaw("$order $dir")
        ->get();

    $data = array();

    if($posts){

        //$fileNot = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-upload'></i></span></a>";
        //$fileExist = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-file-pdf-o'></i></span></a>";


        $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
        $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
        
        $serial = $_POST['start']+1;
        foreach($posts as $r){
            $arr['id'] = $r->id;
            $arr['Serial'] = $serial++;
            $arr['name'] = $r->name;
            $arr['usercode'] = $r->usercode;
            $arr['phone'] = $r->phone;
            $arr['email'] = $r->email;
            $arr['gender'] = $r->gender;
            $arr['userrole'] = $r->userrole;
            $arr['activestatus'] = $r->activestatus;
            $arr['action'] =$y.$z;
            $arr['password'] = $r->password;
            
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







public function edituserform(Request $request){
		

	
    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $id=$request->input("recordid");
       $obj = DB::table('users')->where('id',$id)->update(
   
           ['name' => $request->input("name"), 
           'phone' => $request->input("phone"), 
           'gender' => $request->input("gender"), 

           'email' => $request->input("email"),
           'userrole' => $request->input("userrole"),
           'activestatus' => $request->input("activestatus"),
           'updated_at' =>$dateaandtime
          
           ]		       
       );
       if($obj==true){
           echo 1; 
   
       }
   
   

}   






public function deleteUser(Request $request){

    $id=$request->input("id");
       $obj = DB::table('users')->where('id',$id)->delete();
   
           if($obj==true){

            return 1;
           }


}






}
