<?php
namespace Consumer;
use DataCollectors\ApiCollectors;
use DataCollectors\FileCollectors;



/**
 * 
 */
class Consumer
{
	
	function __construct()
	{
		# code...
	}

	public function API($base_url,$path,$method,$post_parametres=[]){
		$api = new ApiCollectors([
			'base_url' =>$base_url,
			'path'     =>$path,
			'method'   => $method,
			'request_parameters'=>$post_parametres
		]);

		$result = $api->Read()->toArray();
		return  $result;
			
	
	}

	public function file($base_path,$file_type,$file_path){
		$file = new FileCollectors([
			'base_path' =>$base_path,
			'type' =>$file_type,
			'path' =>$file_path
		]);
		return $file->Read();

	}

}




?>