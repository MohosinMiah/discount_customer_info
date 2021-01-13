<?php

namespace App\Http\Controllers;

use App\Seller;
use App\seller;
use Illuminate\Http\Request;
use Validator;
use Session;
use Carbon\Carbon;
use \DB;


class SellerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seller.auth.login');
    }

    
    
    /**
     * seller Login.
     *
     */
    public function login()
    {

        return view('seller.auth.login');

    }

    
    /**
     * seller Login Authentication.
     *
     */
    public function login_post(Request $request){


        // Data Validation

        $validatedData =Validator::make($request->all(), [
            'phone' => ['required'],
            'password' => ['required'],
        ]);

        // Store Data In Valriables

        $phone = $request->phone;

        $password =md5($request->password);

        // Check Data Validation

        if ($validatedData->fails()) {
            // dd($validatedData);

            return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

        }else{

            $seller =  DB::table('sellers')->where(['phone'=> $phone,'password'=> $password ])->first();
            // Check seller Login Success Or Fail
            if($seller){

                return redirect()->route('seller.dashboardseller_dashboard');

                //   Test  ********************   
                // var_dump($seller);
                //  die;

            }else{

                Session::flash('message', 'Mobile Number Or Passwod is wrong!'); 
                return  redirect()->back();


            }
                
       
        }

       

      

        
    }


        

    /**
     * seller Dashboartd.
     *
     */

    public function dashboard(){

        return view('seller.dashboard.main.main');


    }







    /**
     * seller Forgotten Password.
     *
     */

    public function forgotten_password(){

        return view('seller.auth.forgotten_password');


    }


     /**
     *  OTP Fill UP
     *
     */

    public function otp_updata(){
            


        $seller_forgetpass_phone = Session::get('seller_forgetpass_phone');


        // Check Phone and OPT is Exist

        if($seller_forgetpass_phone == null){
          

            return redirect()->route('seller.forgottenseller_forgotten_password');

        }

        return view('seller.auth.otp');

    }


        
        /**
         * Check OTP
         *
         */ 
    public function otp_check(Request $request){

           // Data Validation

           $validatedData =Validator::make($request->all(), [
            'otp' => ['required'],
        ]);

        // Store Data In Valriables

        $otp = $request->otp;


        // Check Data Validation

        if ($validatedData->fails()) {
            // dd($validatedData);

            return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

        }else{

            // Collect Data From User Table 
            $is_otp_correct = DB::table('sellers')->where('otp',$otp)->first();
         
            // Check Given OTP Code with Actual OTP Code 
            if($is_otp_correct){

                // If OTP is currect then otp number store in variable
                Session::put('seller_forgetpass_otp', $otp);


                return redirect()->route('seller.pass_resetseller_reset_pass');

            }else{
                
                Session::flash('message', 'Check Your OTP Code!'); 
                return  redirect()->back();

            }

        }

    }


    /**
     * Password Reset Form
     */

    public function password_reset(){

        
        $seller_forgetpass_phone = Session::get('seller_forgetpass_phone');

        $seller_forgetpass_otp = Session::get('seller_forgetpass_otp');


        // Check Phone and OPT is Exist

        if($seller_forgetpass_phone == null || $seller_forgetpass_otp == null ){
          

            return redirect()->route('seller.forgottenseller_forgotten_password');

        }
    
        return view('seller.auth.passwordreset');
    }

     /**
     * Send OTP
     */
    public function send_otp(Request $request)
    {





        $code = rand(1000,9999);

            
        // Data Validation

        $validatedData =Validator::make($request->all(), [
            'phone' => ['required'],
        ]);

        // Store Data In Valriables

        $phone = $request->phone;


        // Check Data Validation

        if ($validatedData->fails()) {
            // dd($validatedData);

            return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

        }else{
                // Check This Associate Number user is seller or Not

            $is_seller = DB::table('sellers')->where('phone',$phone)->first();
            

            if($is_seller){

                // Update OTP  sellers ntable 
                $status =  DB::table('sellers')
                ->where('phone',$is_seller->phone)
                ->update(['otp' => $code]);

                // If Mobile Number is  currect then Mobile number store in session
                Session::put('seller_forgetpass_phone', $phone);

                // var_dump(Session::get('phone'));
                //       die();
                

                $this->sendSms($request->phone,$code);


                return redirect()->route('seller.send_otpseller_otp');

            }else{


                Session::flash('message', 'Phone Number Is Not Found.'); 
                return  redirect()->back();


            }

   
    

        }



     

    }

    public function sendSms($number,$code){
  

        // Twilio::message('8801816073636', $code);
        // to  8801857126452
        //  ar  8801767086814


        $url = "http://66.45.237.70/api.php";

        // $number="8801857126452";
        // $text="Hello Dear, Customer . Your OPT  Code ".$code;

        
        $text="From DISCOUNT A2Z OPT code =  ".$code;
        $data= array(
        'username'=>"01857126452",
        'password'=>"2RVXW48F",
        // 
        'number'=>"$number",
        'message'=>"$text"
        );


        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
        return $sendstatus;

    }


/**
 * New Password - Update Password
 */


    public function new_password(Request $request) {


        // Stored Session Phone and OTP

        $seller_forgetpass_phone = Session::get('seller_forgetpass_phone');

        $seller_forgetpass_otp = Session::get('seller_forgetpass_otp');
 
        

        // Data Validation

        $validatedData =Validator::make($request->all(), [
            'password' => ['required'],
        ]);

        // Store Data In Valriables

        $password = $request->password;

        // Password Hashing Technique
        $password = md5($password);


        // Check Data Validation

        if ($validatedData->fails()) {
            // dd($validatedData);

            return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

        }else{


        // Update Password in sellers table based on phone and otp code 

         // Update OTP  sellers ntable 
             $status =  DB::table('sellers')
             ->where(
                 [
                    ['phone' , '=', $seller_forgetpass_phone],  
                    ['otp' , '=', $seller_forgetpass_otp],  
                 ]
                 )
             ->update(
                ['password' => $password]
            );
           

          // Check Password Update successfully or not
          
          if($status){
                        
            // Forget multiple keys...
            $request->session()->forget(['seller_forgetpass_phone', 'seller_forgetpass_otp']);

            return redirect()->route('seller.dashboardseller_dashboard');

            // var_dump($status);
            //  echo "Update Successfully";
            // die;

          }else{
         
            
            Session::flash('message', 'Password Is Not Changed.'); 

            return  redirect()->back();



          


        }

             }

    }







/**
 *  ******************************************************************************************
 * ******************************** Dashboard Functionality Implementation  START ************
 * *******************************************************************************************
 */

/**
     * Show the form for creating a new Seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.users.create');
    }




    /**
     * Store a newly created seller in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Data Validation

       $validatedData = Validator::make($request->all(), [
        'name' => 'required',
        'area_code' => 'required',
        'phone' => 'required|unique:sellers',
        'email' => 'required|unique:sellers',
        'password' => 'required',
        'address' => 'required',
    ]);

    // Store Data In Valriables

    $name = $request->name;

    $area_code = $request->area_code;

    $phone = $request->phone;

    $email = $request->email;

    $address = $request->address;

    $password =md5($request->password);

    $seller_id = 1;

    // Check Data Validation

    if ($validatedData->fails()) {

        // dd($validatedData);

        return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

    }else{

        $sellers =  DB::table('sellers')->insert(
            [
                'name'=> $name,
                'area_code'=> $area_code,
                'phone'=> $phone,
                'email'=> $email,
                'address'=> $address,
                'seller_id' => $seller_id,
                'created_at' => Carbon::now(),
                'password'=> $password,
            ]
        );
        // Check Seller Created Successfully or not
        if($sellers){

            Session::flash('message', 'Seller Created Successfuly!'); 
            return  redirect()->back();

        }

    }

    }



    public function all(){

        $sellers = Seller::orderBy('created_at', 'desc')->get();

   

        return view('seller.users.all',compact('sellers'));

   }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit($seller_id)
    {
        $seller = Seller::where('id',$seller_id)->first();
        return view('seller.users.update',compact('seller'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
          // Data Validation

       $validatedData = Validator::make($request->all(), [
        'name' => 'required',
        'area_code' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'address' => 'required',
    ]);

    // Store Data In Valriables

    $name = $request->name;

    $area_code = $request->area_code;

    $phone = $request->phone;

    $email = $request->email;

    $address = $request->address;

    $seller_id = 1;

    // Check Data Validation

    if ($validatedData->fails()) {

        // dd($validatedData);

        return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

    }else{

        $sellers =  DB::table('sellers')
        ->where('id',$id)
        ->update(
            [
                'name'=> $name,
                'area_code'=> $area_code,
                'phone'=> $phone,
                'email'=> $email,
                'address'=> $address,
                'seller_id' => $seller_id,
                'updated_at' => Carbon::now(),
            ]
            );
        // Check Seller Created Successfully or not
        if($sellers){

            Session::flash('message', 'Seller Updated Successfuly!'); 
            return  redirect()->back();

        }

    }



    }

  /**
     * Display the specified resource.
     *
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show($seller_id)
    {

        $seller = Seller::where('id',$seller_id)->first();

        return view('seller.users.show',compact('seller'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\seller  $seller
     * @return \Illuminate\Http\Response
     */


    public function destroy($seller_id)
    {

        $seller = Seller::where('id',$seller_id)->delete();

        if( $seller){

            Session::flash('message', 'Seller Delete Successfuly!'); 
            return  redirect()->back();

        }else{

            Session::flash('message', 'Error Not Deleted'); 
            return  redirect()->back();

        }

    }


/**
 *  ******************************************************************************************
 * ******************************** Dashboard Functionality Implementation  END ************
 * *******************************************************************************************
 */





 /**
 *  ******************************************************************************************
 * ******************************** seller Settings Implementation  END ************
 * *******************************************************************************************
 */


 public function seller_settings(){

    $seller_id = 1;

    $seller = seller::where('id',$seller_id)->first();

    $data = [
        'seller'  => $seller,
    ];
     
    return view('seller.dashboard.setting.setting')->with('data',$data);
 }
    

/**
 * 
 * seller Info Update ******************************************************************
 * 
 */


public function info(Request $request){
        // Data Validation

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        // Store Data In Valriables

        $name = $request->name;

        $email = $request->email;

        $address = $request->address;

        $seller_id = 1;

        // Check Data Validation

        if ($validatedData->fails()) {

            // dd($validatedData);

            return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

        }else{

            $seller =  DB::table('sellers')
            ->where('id',$seller_id)
            ->update(
                [
                    'name'=> $name,
                    'email'=> $email,
                    'address'=> $address,
                    'updated_at' => Carbon::now(),
                ]
                );
            // Check seller Info Updated Successfully or not
            if($seller){

                Session::flash('message', 'seller Updated Successfuly!'); 
                return  redirect()->back();

            }

        }
    
}




/**
 * 
 * seller Password Change ******************************************************************
 * 
 */


public function change_pass(Request $request){
    // Data Validation

    $validatedData = Validator::make($request->all(), [
        'old_password' => 'required',
        'password' => 'required',
    ]);


    


    // Store Data In Valriables

    $old_password = $request->old_password;

    $password = $request->password;

    $seller_id = 1;
    // Hashing Password
    $password = md5($password);
    $old_password = md5($old_password);

    // Check Data Validation

    if ($validatedData->fails()) {

        // dd($validatedData);

        return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

    }else{

       


      // Check Old Password

      $seller_password = DB::table('sellers')->where('password',$old_password)->first();

      if($seller_password == null){
              // If Old Password Does not Match
              Session::flash('message', 'Old Password Wrong'); 
              return  redirect()->back();
      }

       if($seller_password->password == $old_password ){
     
        $seller =  DB::table('sellers')
        ->where('id',$seller_id)
        ->update(
            [
                'id'=> $seller_id,
                'password'=> $password,
                'updated_at' => Carbon::now(),
            ]
            );
        // Check seller Info Updated Successfully or not
            Session::flash('message', 'seller Password Successfuly!'); 
            return  redirect()->back();

        }else{

            // If Old Password Does not Match
            Session::flash('message', 'Old Password Wrong'); 
            return  redirect()->back();
            
        }

    }

}




/**
 * 
 * seller Phone Update ******************************************************************
 * 
 */


public function change_phone(Request $request){
    // Data Validation

    $validatedData = Validator::make($request->all(), [
        'phone' => 'required',
    ]);

    // Store Data In Valriables

    $phone = $request->phone;

    $seller_id = 1;

    // Check Data Validation

    if ($validatedData->fails()) {

        // dd($validatedData);

        return redirect()->back()->withErrors($validatedData)->withInput();;  // Redirect Back With Errors

    }else{

        $is_phone =  DB::table('sellers')
        ->where('id',$seller_id)
        ->update(
            [
                'phone'=> $phone,
                'updated_at' => Carbon::now(),
            ]
            );
        // Check seller Info Updated Successfully or not
        if($is_phone){

            Session::flash('message', 'Phone Number Updated Successfuly!'); 
            return  redirect()->back();

        }

    }

}





 /**
 *  ******************************************************************************************
 * ******************************** seller Settings Implementation  END ************
 * *******************************************************************************************
 */

  
}
