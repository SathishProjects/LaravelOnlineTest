<?php namespace App\Http\Controllers\Auth;

use App;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Response;

use Cache;

class AuthController extends Controller {                                                                       

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
    |--------------------------------------------------------------------------
    | API URL needs to be set in this property
    |--------------------------------------------------------------------------
    */
    private $_API = null;

    /**
     * Store Object
     * @var Session
     */
    protected $session;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar, Store $session) {
	     
			$this->auth = $auth;
	     $this->registrar = $registrar;
	     $this->session = $session;
	     $this->_API = Config::get('app.API');
	     $this->middleware('guest', ['except' => 'new_signup','get_test_password','get_college_branch','get_college_degree','test_details','submit_question','getLogout', 'starttest','testlogin','testadmin_logout','testadmin_feedback','student_feedback','goto_test_details']);
    }


    /** Get General records **/

    public function get_district(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_district', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_multiple_district(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_multiple_district', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_city(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_city', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_branch(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_branch', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_ug_branch(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_ug_branch', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_multiple_branch(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_multiple_branch', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_venue_college(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_venue_college', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_invited_college(Request $request)
    {
         $API = App::make('APIService');
        
        $API->request('/get_invited_college', "POST", $request->all());

        $data = [$API->responseJSON()];     

        return $data;
    }

    public function get_chapter(Request $request)
    {
        $API = App::make('APIService');
        $API->request('/get_chapter', "POST", $request->all());

        $data = (array)$API->responseJSON();    

        return $data;
    }

    /**  **/
	
	/**
     * Sathish
     * Login dropdown datas
     */
	 
	public function viewLogin()
    {
	
		return view('landing_page');
    }

    


    /**
     * Login Authentication with email & password
     * @param Request $request
     */
    public function login(Request $request) {

	 if(!isset($request['id'])){
	     $request['id'] = null;
	 }

	 try {
	     $API = App::make('APIService');
			
	     $API->request('/auth/login', "POST", [ 
		  'email'     => $request->get('email'), 
		  'password'  => $request->get('password'),
		  'test_id'  => $request->get('id')

	     ]);

			if (200 == $API->responseStatusCode()) {
				
		  if(isset($API->responseJSON()->error) && isset($API->responseJSON()->errortype) ){

		      return redirect('/')->with('error', $API->responseJSON()->error)->with('errortype', $API->responseJSON()->errortype);

		  }
		  elseif(isset($API->responseJSON()->error)){

		      return redirect('/')->with('error', $API->responseJSON()->error);
		  }
				
				$this->session->set('user_authenticated.token', $API->responseJSON()->token);
		  $this->session->set('user_authenticated.id', $API->responseJSON()->user->id);
		  $this->session->set('user_authenticated.reg_id', $API->responseJSON()->user->reg_id);
		  $this->session->set('user_authenticated.user_type', $API->responseJSON()->user->user_type);
		  $this->session->set('user_authenticated.email', $API->responseJSON()->user->email);
		  $this->session->set('user_authenticated.name', $API->responseJSON()->user->name);
				
				$usertype = $this->session->get('user_authenticated.user_type');
				$id = $this->session->get('user_authenticated.id');
		 
				if( $usertype == 1 ) {
                    
		      		return redirect('student/dashboard');
		      
				}
                elseif ( $usertype == 2 ){
                    // return redirect('college/dashboard');

                    $redirectURL = 'college/batch/active';
                    return redirect($redirectURL);
                }
				else{
					return redirect('/')->with('error', 'Sorry ! login access restricted only to College Admin & Students');
				}
	     }
	 }
	 catch(\GuzzleHttp\Exception\ClientException $exception) {
	     return redirect('/')->with('error', 'Username or password incorrect ! Try Again')->with('errortype',1);
	 }
    }

/**
     * Logging Out the user
     * @return type
     */
    public function logout() {
     $this->session->flush(); 
     return redirect('/')->with('error', 'Successfully Logged out');
    }


}
