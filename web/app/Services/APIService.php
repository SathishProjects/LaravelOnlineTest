<?php namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class APIService extends Client {
    
    /**
     * Response Property
     * 
     * @var type 
     */
    private $_response = null;

    public function construct() {
        parent::construct([
            'base_uri' => Config::get('app.API')
        ]);
    }
   
    public function request($url, $method = "GET", $requestOptions = []) {
        $this->_request($url, $method, $requestOptions);       
    }
    
    
    /**
     * Handle Request based on its method
     * 
     * @param string $url
     * @param type $method
     * @param type $requestOptions
     * @return boolean
     */
    private function _request($url, $method = "GET", $requestOptions = []) {
        $url    = Config::get('app.API') . $url;
        $method = strtoupper($method);
        $options= [];
        // encode Form Data to JSON
        if ($requestOptions) {
            $options["json"]['post'] = json_encode($requestOptions);
        }

        if (!in_array($method, ["GET", "POST"])) {
            trigger_error("Un-Supported Request Method", E_USER_WARNING);
            return false;
        }

        // Required after login
        if (Session::has('user_authenticated.token')) {
            $header = "Authorization";
            $value  = sprintf("Bearer %s", Session::get('user_authenticated.token'));
        }

        $request = parent::createRequest($method, $url, $options);
        if (isset($header) && isset($value)) {
            $request->setHeader($header, $value);
        }
		
        $this->_response = parent::send($request);
        //dd($this->_response->getBody()->read(1000)); exit;
    }

    /**
     * get the response status code
     * 
     * @return type HTTP Status code
     */
    public function responseStatusCode(){
        return $this->_response->getStatusCode();
    }
    /**
     * get the raw response
     * 
     * @return type HTML
     */
    public function responseRawBody() {
        return $this->_response->getBody();
    }

    /**
     * get the reponse in JSON
     * 
     * @return type JSON
     */
    public function responseJSON() {
        return json_decode($this->_response->getBody());
    }
}
