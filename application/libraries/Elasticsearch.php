<?php 
require APPPATH.'/third_party/vendor/autoload.php';

use Basemkhirat\Elasticsearch\Connection;

class Elasticsearch{

    public $client;
	private $host;

    public function __construct(){
		$this->hosts = [
    		'servers' => [
	        	[
    	        	"host" => '172.16.5.125',
        	    	"port" => 9200,
            		'user' => '',
	            	'pass' => '',
    	        	'scheme' => 'http',
        		]
    		],
    		'index' => 'siak'
		];
        //$this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
		$this->client = Connection::create($this->hosts);		
    } 
}