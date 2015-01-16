<?php
/**
 * ClouDNS API class
 * @copyright 2014 Techreanimate
 * @author Luis Rodriguez
 */
class ClouDNS
{
    /**
	 * API credential information required to execute requests
	 */
    private $api_url = 'https://api.cloudns.net/';
    private $auth_id;
    private $auth_password;
	
	/**
	 * Verify SSL connection
	 */
	private $ssl_check = true;
	
    /**
	 * storage for API responses
	 */
    public $Response;
	
	/**
	 * Pass in options to set as an array
	 * @param $options
	 */
	public function set_options(Array $options = array()){
		$this->api_url = isset($options['api_url']) ? $options['api_url'] : $this->api_url;
		$this->auth_id = isset($options['auth_id']) ? $options['auth_id'] : $this->auth_id;
		$this->auth_password = isset($options['auth_password']) ? $options['auth_password'] : $this->auth_password;
		
		/* Check if login still works */
		$status = $this->login();
		if($status['status'] != 'Success') return $status;
		
		
		return array('status' => 'Success');
	}
	
	/**
	 * Test login details
	 */
	private function login(){
		$get = array(
			'auth-id' => $this->auth_id,
			'auth-password' => $this->auth_password
		);
		
		/* Clean options for GET */
		$get_string = $this->url_encode($get);
		
		/* Connect */
		$result = $this->connect($get_string,'dns/login.json');
		
		/* Return an array result */
		return json_decode($result,true);
	}
    
    /**
	 * determine our IP address
	 * @return string our public IP address, as seen by icanhazip.com
	 */
    public function detect_ip(){
        $ch = curl_init( 'http://icanhazip.com' );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
        $result = rtrim(curl_exec( $ch ) );
        curl_close( $ch );
        return $result;
    }
	
	/**
	 * Get a list with available domain name servers.
	 */
	public function list_name_servers(){
		$get = array(
			'auth-id' => $this->auth_id,
			'auth-password' => $this->auth_password
		);
		
		/* Clean options for GET */
		$get_string = $this->url_encode($get);
		
		/* Connect */
		$result = $this->connect($get_string,'dns/available-name-servers.json');
		
		/* Return an array result */
		return json_decode($result,true);
	}
	
	/** 
	 * Runs the final connection with all the data needed
	 * @param $get_string
	 * @param $directory (optional) - The directory of the api you are calling dns/ or domains/
	 * @return Response
	 */
	private function connect($get_string, $directory = 'dns/'){
		$request = curl_init($this->api_url.$directory.'?'.$get_string); // initiate curl object
			curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			curl_setopt($request, CURLOPT_SSL_VERIFYPEER, $this->ssl_check); // uncomment this line if you get no gateway response.
			$this->Response = curl_exec($request); // execute curl post and store results in $post_response
		curl_close ($request); // close curl object
		
		return $this->Response;
	}
	
	/** 
	 * This section takes the input fields and converts them to the proper format
	 * for an http post.  For example: "auth_id=username&auth_password=a1B2c3D4"
	 */
	private function url_encode(Array $get_values = array()){
		$get_string = "";
		foreach( $get_values as $key => $value ){
			$get_string .= "$key=" . urlencode( $value ) . "&";
		}
		return rtrim( $get_string, "& " );
	}
}
