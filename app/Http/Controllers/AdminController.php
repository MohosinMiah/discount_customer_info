<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Seller;
use Illuminate\Http\Request;
use Validator;
use Session;
use Carbon\Carbon;
use \DB;

class AdminController extends Controller
{



    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
    

    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    
    
    /**
     * Admin Login.
     *
     */
    public function login()
    {

        return view('admin.auth.login');

    }

    
    /**
     * Admin Login Authentication.
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

            $admin =  DB::table('admins')->where(['phone'=> $phone,'password'=> $password ])->first();
            // Check Admin Login Success Or Fail
            if($admin){

                return redirect()->route('admin.dashboardadmin_dashboard');

                //   Test  ********************   
                // var_dump($admin);
                //  die;

            }else{

                Session::flash('message', 'Mobile Number Or Passwod is wrong!'); 
                return  redirect()->back();


            }
                
       
        }

       

      

        
    }


        

    /**
     * Admin Dashboartd.
     *
     */

    public function dashboard(){

        return view('admin.dashboard.main.main');


    }







    /**
     * Admin Forgotten Password.
     *
     */

    public function forgotten_password(){
        return view('admin.auth.forgotten_password');

    }


     /**
     *  OTP Fill UP
     *
     */

    public function otp_updata(){
            


        $admin_forgetpass_phone = Session::get('admin_forgetpass_phone');


        // Check Phone and OPT is Exist

        if($admin_forgetpass_phone == null){
          

            return redirect()->route('admin.forgottenadmin_forgotten_password');

        }

        return view('admin.auth.otp');

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
            $is_otp_correct = DB::table('admins')->where('otp',$otp)->first();
         
            // Check Given OTP Code with Actual OTP Code 
            if($is_otp_correct){

                // If OTP is currect then otp number store in variable
                Session::put('admin_forgetpass_otp', $otp);


                return redirect()->route('admin.pass_resetadmin_reset_pass');

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

        
        $admin_forgetpass_phone = Session::get('admin_forgetpass_phone');

        $admin_forgetpass_otp = Session::get('admin_forgetpass_otp');


        // Check Phone and OPT is Exist

        if($admin_forgetpass_phone == null || $admin_forgetpass_otp == null ){
          

            return redirect()->route('admin.forgottenadmin_forgotten_password');

        }
    
        return view('admin.auth.passwordreset');
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
                // Check This Associate Number user is Admin or Not

            $is_admin = DB::table('admins')->where('phone',$phone)->first();
            

            if($is_admin){

                // Update OTP  admins ntable 
                $status =  DB::table('admins')
                ->where('phone',$is_admin->phone)
                ->update(['otp' => $code]);

                // If Mobile Number is  currect then Mobile number store in session
                Session::put('admin_forgetpass_phone', $phone);

                // var_dump(Session::get('phone'));
                //       die();
                

                $this->sendSms($request->phone,$code);


                return redirect()->route('admin.send_otpadmin_otp');

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

        $admin_forgetpass_phone = Session::get('admin_forgetpass_phone');

        $admin_forgetpass_otp = Session::get('admin_forgetpass_otp');
 
        

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


        // Update Password in admins table based on phone and otp code 

         // Update OTP  admins ntable 
             $status =  DB::table('admins')
             ->where(
                 [
                    ['phone' , '=', $admin_forgetpass_phone],  
                    ['otp' , '=', $admin_forgetpass_otp],  
                 ]
                 )
             ->update(
                ['password' => $password]
            );
           

          // Check Password Update successfully or not
          
          if($status){
                        
            // Forget multiple keys...
            $request->session()->forget(['admin_forgetpass_phone', 'admin_forgetpass_otp']);

            return redirect()->route('admin.dashboardadmin_dashboard');

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
        return view('admin.users.create');
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

    $admin_id = 1;

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
                'admin_id' => $admin_id,
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

   

        return view('admin.users.all',compact('sellers'));

   }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($seller_id)
    {
        $seller = Seller::where('id',$seller_id)->first();
        return view('admin.users.update',compact('seller'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
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

    $admin_id = 1;

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
                'admin_id' => $admin_id,
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
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($seller_id)
    {

        $seller = Seller::where('id',$seller_id)->first();

        return view('admin.users.show',compact('seller'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
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
 * ******************************** Admin Settings Implementation  END ************
 * *******************************************************************************************
 */


 public function admin_settings(){

    $admin_id = 1;

    $admin = Admin::where('id',$admin_id)->first();

    $data = [
        'admin'  => $admin,
    ];
     
    return view('admin.dashboard.setting.setting')->with('data',$data);
 }
    


 /**
 *  ******************************************************************************************
 * ******************************** Admin Settings Implementation  END ************
 * *******************************************************************************************
 */

  
}
