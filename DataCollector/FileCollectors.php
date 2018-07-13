<?php 
namespace DataCollectors;
use Interfaces\DataReader;

Class FileCollectors implements  DataReader {

	public $base_path;
	public $file_type;

	public $file_path;

   public function __construct ( $data = array() ) {
		  $this->base_path = $data['base_path'];
		  $this->file_type = $data['type'];
		  $this->file_path = $data['path'];		    
  }

	public function setFileType($type){
		$this->file_type = $type;
	}
	public function setFilePath($path){
		$this->file_path = $path;
	}
	public function setBasePath($path){
		$this->base_path = $path;
	}
	public function getFileType(){
		return $this->file_type;
	}

	public function getFilePath(){
		return $this->file_path;
	}
	public function getBasePath(){
		return $this->base_path;
	}

	public function Read(){
	  // $file_handle = fopen($, 'r');
		if($this->file_type == 'csv'){
			$lines = explode( "\n", file_get_contents( $this->getBasePath().'/'.$this->getFilePath()) );
			$headers = str_getcsv( array_shift( $lines ) );
			$data = array();
			foreach ( $lines as $line ) {
				$row = array();
				foreach ( str_getcsv( $line ) as $key => $field )
					$row[ $headers[ $key ] ] = $field;
				$row = array_filter( $row );
				$data[] = $row;
			}
		}
		if($this->file_type == 'json'){
			$string = file_get_contents($this->getBasePath().'/'.$this->getFilePath());
			$data = json_decode($string, true);

		}
	
		return $data;

	 }


























}











?>