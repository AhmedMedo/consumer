<?php 
namespace DataCollectors;

use GuzzleHttp\Client;

use Interfaces\DataReader;


Class ApiCollectors implements DataReader{

	public $base_path;
	public $path;
	public $method;
	public $status_code;
	public $request_parameters =[];
	public $query_parameters;
	public $response;


	 public function __construct ( $data = array() ) {
		    $this->base_path = $data['base_url'];
		    $this->method = $data['method'];
		    $this->path = $data['path'];
		    $this->request_parameters = (array_key_exists('request_parameters', $data)) ? $data['request_parameters'] : [];
		    
  }

	public function setBasePath($base_path){
		$this->base_path = $base_path;

	}
   public function setPath($path){
		$this->path = $path;

	}

	public function setResponse($response){
		$this->response = $response;

	}


	public function setMethod($method){
		$this->method = $method;
	}
  public function setStatusCode($status_code){
		$this->status_code = $status_code;
	}


  public function setRequest_parameters($parameters=[]){
		$this->request_parameters = $parameters;
	}

	public function getBasePath(){
		return $this->base_path;
	}

	public function getPath(){
		return $this->path;
	}

	public function getMethod(){
		return $this->method;
	}

	public function getResponse(){
		return $this->response;
	}

    public function getRequest_parameters(){
		return $this->request_parameters;
	}

	public function getStatusCode(){
		return $this->status_code;
	}


	public function Read(){
		$client = new Client(['verify' => false,'base_uri'=>$this->getBasePath()]);
		switch ($this->getMethod()) {
			case 'GET':
				$res = $client->request('GET', $this->getPath());

				break;
			case 'POST':
			$res = $client->request('POST', $this->getPath(), [
			    'json' => $this->getRequest_parameters(),
			   
			  'debug' => false
			    
			]);
			//var_dump($res->getBody());die;
			default:
				# code...
				break;
		}
		
		if(($res->getStatusCode() == 200) || $res->getStatusCode() == 201){

		   $this->setResponse($res);
		   //echo $this->getResponse()->getHeader('Content-Type')[0];

		}else{
		   $this->setResponse([]);
		}
		

		return ($this);
	}

	public function toArray(){
		if($this->getResponse() == []){
			
			return [];
		}else{
			//check if JSON or XML
			if((strpos($this->getResponse()->getHeader('Content-Type')[0], 'application/json') !== false)){
				return json_decode($this->getResponse()->getBody()->getContents(),true);
			}

			if((strpos($this->getResponse()->getHeader('Content-Type')[0], 'text/xml') !== false))
				{
				//die('ss');
				 $ob = simplexml_load_string($this->getResponse()->getBody());
				 $json  = json_encode($ob);
				 return json_decode($json, true);
			}else{
				return [];
			}
		  
		}

	}


	// public function save(){
	// 	$data_array = $this->toArray();

	// }

















}











?>