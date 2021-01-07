<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Validator;
use \DB;

class AdminController extends Controller
{
    
    
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

            }
                
       
        }

       

      

        
    }


        

    /**
     * Admin Dashboartd.
     *
     */

    public function dashboard(){
        return view('admin.dashboard.index');

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
                
                echo "Your Inputed OTP is CXorrect";

            }else{
                echo "Your Inputed OTP is not Correct";
            }

        }

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

                // Save Database 
                $status =  DB::table('admins')->where('id',1)->update(
                        ['otp' => $code]);
                

                $this->sendSms($request->phone,$code);


                return redirect()->route('admin.send_otpadmin_otp');

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
