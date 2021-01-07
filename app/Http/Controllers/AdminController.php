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


public function otp_check(Request $request){
    echo "'Thats Fine";
}


     /**
     * Send OTP
     */
    public function send_otp(Request $request)
    {
        $code = rand(1000,9999);

       

      // Data Validation

      $validated = $request->validate([
        'phone_number' => 'required',
    ]);

     $phone = $request->phone_number;


      // Check This Associate Number user is Admin or Not

      $is_admin = DB::table('admins')->where('phone',$phone)->first();
    

      if($is_admin){
          echo "OK SUCCESS";
          die;

      }else{
          echo "NI";
          die;
      }

   
        $this->sendSms($request->phone_number,$code);


        return redirect()->route('admin.send_otpadmin_otp');

        // die();

        // Save Database 
    //    $status =  DB::table('deal_lists')->insert([
    //         ['deal_name' => $request->deal_name,
    //         'phone' => $request->phone,
    //         'otp' => $code]
    //     ]);

        // // Send SMS
        // if( $status ){
        //     $this->sendSms($request->phone,$code);
        // }
        // return redirect('/customer/success');

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
