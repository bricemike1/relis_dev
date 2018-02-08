<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biblerproxy_lib
{
	private  $instance;
	private  $url='http://tron.iro.umontreal.ca/bibler/';
	public function __construct()
	{

		$this->CI =& get_instance();


	}



	//private function __construct()	{}

	public function setURL($uri) {
		$this->url=$uri;
	}

	public static function getInstance() {
		if (!$instance) {
			$instance=new BiBlerProxy();
		}
			
		return $instance;


	}


	private function httpPost($url, $data)
	{

		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, urlencode($data));
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec( $ch );
		return $response;
	}

	public function addEntry($data) {
		return $this->httpPost($this->url."addentry/",$data);
	}

	public function getBibtex($data) {
		return $this->httpPost($this->url."getbibtex/",$data);
	}

	public function formatBibtex($data) {
		return $this->httpPost($this->url."formatbibtex/",$data);
	}

	public function previewEntry($data) {
		return $this->httpPost($this->url."previewentry/",$data);
	}

	public function validateEntry($data) {
		return $this->httpPost($this->url."validateentry/",$data);
	}

	public function bibtextobibtex($data) {
		return $this->httpPost($this->url."bibtextobibtex/",$data);
	}

	public function bibtextosql($data) {
		return $this->httpPost($this->url."bibtextosql/",$data);
	}

	public function bibtextocsv($data) {
		return $this->httpPost($this->url."bibtextocsv/",$data);
	}

	public function bibtextohtml($data) {
		return $this->httpPost($this->url."bibtextohtml/",$data);
	}
	public function createentryforreliS($data) {
		return $this->httpPost($this->url."createentryforrelis/",$data);
	}
	public function importbibtexstringforrelis($data) {
		return $this->httpPost($this->url."importbibtexstringforrelis/",$data);
	}
	
	public function importendnotestringforrelis($data) {
		return $this->httpPost($this->url."importendnotestringforrelis/",$data);
	}

	public  function fixJSON($json) {
		$regex = <<<'REGEX'
~
    "[^"\\]*(?:\\.|[^"\\]*)*"
    (*SKIP)(*F)
  | '([^'\\]*(?:\\.|[^'\\]*)*)'
~x
REGEX;
	
		return preg_replace_callback($regex, function($matches) {
			return '"' . preg_replace('~\\\\.(*SKIP)(*F)|"~', '\\"', $matches[1]) . '"';
		}, $json);
	}

}
