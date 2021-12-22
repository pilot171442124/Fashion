<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cookie;
use DB;
//use App\Http\Controllers\producttypeController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    
        $this->middleware(['auth'=>'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
   
   

        
    

   
        $loginuserid = Auth::user()->id;
        
        $cookie=Cookie::get('temp_userid');
       
  
        if(Auth::user()->userrole =='Customer')
        {
                    if(!empty($cookie))
                    {
                 
                        
                        $obj = DB::table('addtocart')->where('temp_userid',$cookie)->update(
   
                            [
                            'customer_id' => $loginuserid, 
                          
                           
                            ]		       
                        );  
                        
                        
                        
                        return redirect('/addtocart');
                    }

                    else
                    {
                    
                    
                                
                    
                        return view('index');
                    }   

       }

        else{
             
   
            
            return view('index');
            
            
            }


    
    
    
        }



   



}
