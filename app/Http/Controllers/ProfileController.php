<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_user;
use Abraham\TwitterOAuth\TwitterOAuth;

use DB;

class ProfileController extends Controller
{
    
    public function index()
    {
       return view('create_profile');
    }

    public function register_submit(Request $req)
     {
       $this->validate($req,[ 
                            'username'  => 'required',
                            'email'     => 'required',
                            'password'  => 'required',
                            'image'     => 'required',
                           ],[
                            'username.required'  => 'Please Enter Username.',
                            'email.required'     => 'Please Enter Email Id.',
                            'password.required'  => 'Please Enter Password.',
                            'image.required'     => 'Please Enter Image.',
                     ]);

            if(!empty($req->file('image'))) {  

                    $cover            = $req->file('image');
                    $cover_image      = time().'.'.$cover->getClientOriginalName();
                    $destinationPath1 = public_path('assets/profile_image');
                    $cover->move($destinationPath1, $cover_image);
                  }


             $data = [
                       'username'      => trim($req->get('username')),
                       'email'         => trim($req->get('email')),
                       'password'      => md5(trim($req->get('password'))),
                       'image'         => $cover_image,
                     ];

               $create_profile = tbl_user::where(['email' =>$req->get('email')])->first();

                 if(empty($create_profile)){

                     $record_save = tbl_user::add_register_record($data);

                     if(!empty($record_save)){
                        $req->session()->flash('success', 'Your Account Has Been Successfully.');  
                       return redirect('/signin');
                      }else{
                        $req->session()->flash('error', 'Some Error Occurred!.');
                        return redirect('/create_profile');
                      }

                 }else{
                    $req->session()->flash('error', 'This Email Id Already Registered!.');
                    return redirect('/create_profile');
                 }    
     }  /*  End Created Account. */

     
     public function signin(){

       return view('login');
     }

    public function login_submit(Request $req)
      {
        $this->validate($req,
                  ['password'  => 'required',
                   'email'     => 'required',
                  ],[
                    'password.required'   => 'Please Enter Password.',
                    'email.required'      => 'Please Enter Email Id.',
                  ]);
    
                 $email     = trim($req->get('email'));
                 $password  = trim($req->get('password'));

                $check_login_status = tbl_user::where(['email' => $email, 'password' => md5($password)])->first();  

             if(!empty($check_login_status)){
                        
                        $pid = $check_login_status->id;
                        $req->session()->put('SignIn_id', $check_login_status->id);
                        $req->session()->put('username', $check_login_status->username);
                        $req->session()->put('image', $check_login_status->image);
                        //echo "message".session()->get('SignIn_id'); exit;
                        $req->session()->flash('success', 'Login has successfully.');
                        return redirect('/dashboard');
               }else{
                     $req->session()->flash('error', 'Some Error Occurred!.');
                     return redirect('/signin');
             }
   }
    
    public function dashboard(Request $req)
     {   
          $user_data = tbl_user::get();

          if(isset($user_data[0]->id)) 
          {
                $instg_record = tbl_user::where(['id' => session()->get('SignIn_id')])->first();
                
                if(!empty($instg_record->instakey)){

                  $access_token =$instg_record->instakey;
                  $photo_count = 9;
                  $json_link = "https://api.instagram.com/v1/users/self/media/recent/?";
                  $json_link .="access_token={$access_token}&count={$photo_count}";
                  $json         = file_get_contents($json_link);
                  $insta_record = json_decode(preg_replace('/("\w+"):(\d+)/', '\\1:"\\2"', $json), true);
                }else{
                  $insta_record = "null";
                }
                
             if (!empty(session()->get('access_token'))) { 
                    
                  $access_token = session()->get('access_token');
                  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'],
                                                  $access_token['oauth_token_secret']);
                  $twitter_record = $connection->get("account/verify_credentials", ['include_email' => 'true']);
                }else{
                  $twitter_record = "null";
                }
               
               $allrecord = [

                             'user'       => $user_data,
                             'instagram'  => $insta_record,
                             'twitter'    => $twitter_record
                ];

               return view('admin/dashboard')->with(['allrecord' => $allrecord]);
          }
    } /* open dashboard section .*/

     public function login_out(Request $request)
     {
        $request->session()->forget('SignIn_id');
        $request->session()->flush();
        return redirect('/signin');

     }  /* End Logout Admin Section.*/

     public function edit_profile(Request $req){

      $data = tbl_user::where(['id' => session()->get('SignIn_id')])->first();
      return view('admin/update_profile')->with(['data' => $data]);

     }

     public function update_profile(Request $req){

       $this->validate($req,[ 
                            'username'  => 'required',
                            'email'     => 'required',
                            //'password'  => 'required',
                           ],[
                            'username.required'  => 'Please Enter Username.',
                            'email.required'     => 'Please Enter Email Id.',
                            //'password.required'  => 'Please Enter Password.',
                     ]);

        if(!empty($req->file('image'))){  

              $cover            = $req->file('image');
              $cover_image      = time().'.'.$cover->getClientOriginalName();
              $destinationPath1 = public_path('assets/profile_image');
              $cover->move($destinationPath1, $cover_image);
          }else{

              $cover_image      =  $req->get('profile_image');
          }
          
          if(!empty($req->get('password'))){
            
            $password = md5($req->get('password'));
          }else{
            $password = $req->get('old_pass'); 
          }

             $data = [
                       'username'      => trim($req->get('username')),
                       'email'         => trim($req->get('email')),
                       'password'      => $password,
                       'image'         => $cover_image,
                     ];

             $update_response = tbl_user::where(['id' =>$req->get('id')])->update($data);

                /*echo "<pre>@@" . $update_response;
                print_r($data); exit;*/

                 if(!empty($update_response)){
                        
                        
                        $req->session()->put('username', $req->get('username'));
                        $req->session()->put('image', $cover_image);

                        $req->session()->flash('success', 'update has successfully.');
                        return redirect('/dashboard');
                
                 }else{
                     $req->session()->flash('error', 'Some Error Occurred!.');
                     return redirect('/edit-profile');
                 }  
     }
    
     public function get_instagram(){

        $url = $this->authInstagram();
       return redirect($url);
    }

     // Authentication
  public function authInstagram(){

    $url = "https://api.instagram.com/oauth/authorize/?client_id="._INSTAGRAM_CLIENT_ID."&redirect_uri="._INSTAGRAM_REDIRECT_URL."&response_type=code";
     return $url;
    
  }

  public function callback(Request $req){

    $instakey = $this->setAccess_token($req->code);

     if($instakey){
            
           return redirect(base_url.'/dashboard');
      }else{
           return redirect(base_url.'/edit-profile');
      }
  }

   // Set Access Token
  public function setAccess_token($code){ 

    $this->token_array = array("client_id"=>_INSTAGRAM_CLIENT_ID,
        "client_secret"=>_INSTAGRAM_CLIENT_SECRET,
        "grant_type"=>'authorization_code',
        "redirect_uri"=>_INSTAGRAM_REDIRECT_URL,
        "code"=>$code);

     $result = $this->getUserDetails();
     
     $data = [  'instakey' => $result->access_token ];

     $update_response = tbl_user::where(['id' =>session()->get('SignIn_id')])
                                                         ->update($data);
      return $update_response;
  }

  public function getUserDetails(){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://api.instagram.com/oauth/access_token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->token_array );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec ($ch);

    curl_close ($ch);

    return json_decode($result);

  }


  public function autoload(){

        spl_autoload_register(function ($class) {

        // project-specific namespace prefix
        $prefix = 'Abraham\\TwitterOAuth\\';

        // base directory for the namespace prefix
        $base_dir = __DIR__ . '/src/';

        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            return;
        }

        // get the relative class name
        $relative_class = substr($class, $len);

        // replace the namespace prefix with the base directory, replace namespace
        // separators with directory separators in the relative class name, append
        // with .php
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // if the file exists, require it
          if (file_exists($file)) {
              require $file;
           }
        });
    }

     public function get_callback(Request $req){

        $this->autoload();  

        if (asset($req->oauth_verifier, $req->oauth_token) && $req->oauth_token == $req->oauth_token) {   
           //In project use this session to change login header after successful login 

          $request_token = [];
          $request_token['oauth_token']        = session()->get('oauth_token');
          $request_token['oauth_token_secret'] = session()->get('oauth_token_secret');

          $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], 
                        $request_token['oauth_token_secret']);
          $access_token = $connection->oauth("oauth/access_token",["oauth_verifier" => $req->oauth_verifier]);

          if(isset($access_token['oauth_token'])){
              session()->put('access_token', $access_token);
             return redirect(base_url.'/dashboard');
          }
        }
     }

/*
  public function get_twitter(Request $req){

       $this->autoload();

      if (!empty($req->session()->put('access_token'))){

        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
       

        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        
        echo "@@@" .$url; exit;
        echo "<a href='$url'><img src='twitter-login-blue.png' style='margin-left:4%; margin-top: 4%'></a>";

      } else {

        $access_token = $req->session()->get('access_token');
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], 
                     $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials", ['include_email' => 'true']);

        echo "<pre>";
        print_r($user); exit;
     
      }
  }*/
    
}   
  
