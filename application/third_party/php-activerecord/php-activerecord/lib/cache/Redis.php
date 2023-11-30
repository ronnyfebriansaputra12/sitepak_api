<?php
namespace ActiveRecord;

class Redis
{
	protected static $_default_config_redis = array(
		'socket_type' => 'tcp',
		'host' => '127.0.0.1',
		'password' => NULL,
		'port' => 6379,
		'timeout' => 0
	);

	private $redis;
	private $CI;
	/**
	 * Creates a Memcache instance.
	 *
	 * Takes an $options array w/ the following parameters:
	 *
	 * <ul>
	 * <li><b>host:</b> host for the memcache server </li>
	 * <li><b>port:</b> port for the memcache server </li>
	 * </ul>
	 * @param array $options
	 */
	public function __construct($options)
	{
		$this->CI= & get_instance();
		if(property_exists($this->CI,"webservicelib")){
			if(property_exists($this->CI->webservicelib,"redis")){
				$this->redis=$this->CI->webservicelib->redis;
				return;	
			}
		}
		if($this->CI->config->load('redis', TRUE, TRUE)){
			$this->config_redis=array_merge(self::$_default_config_redis, $this->CI->config->item('redis'));
		}else{
			$this->config_redis=self::$_default_config_redis;
		}		
		$this->config_redis['scheme']=$this->config_redis["socket_type"];
		unset($this->config_redis["socket_type"]);		
		$this->redis=new \Predis\Client($this->config_redis);		
	}

	public function flush()
	{		
		$this->redis->flushdb();		
	}

	public function read($key)
	{			
		return unserialize($this->redis->get($key));
	}

	public function write($key, $value, $expire)
	{		
		$this->redis->set($key,serialize ($value));
		$this->redis->expire($key,$expire);
	}
}
?>
