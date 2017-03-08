<?php namespace App\Http\Controllers\Auth;

use App;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Mail;
class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;
        $this->middleware('guest',['except' => ['postPassword']]);
	}
	
	
	
	
	  public function postPassword(Request $request) {

        $auth = $request->json('post');
        if (is_string($auth)) {
            $auth = json_decode($auth, true);
        }
		$password =  \DB::select(sprintf("SELECT password as pwd FROM users WHERE email = '".$auth['email']."'"));
		   
		  
			 if($password[0]->pwd == null)
		   {
       $reset = \DB::select(sprintf("CALL reset_password('%s','%s')",$auth['email'],$auth['password']));
		
		return response()->json(["success" => "Your Password is Successfully Created"], 200);	
		exit;	
			 }
			 else
			 {
			  return response()->json(["success" => "Your Password change link is expired,<br><br>please go to forgot password change your password"], 200);	
		       exit;
			 }
            
       
    }
	
}
