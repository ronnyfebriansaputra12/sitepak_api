<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Memcached settings
| -------------------------------------------------------------------------
| Your Memcached servers can be specified below.
|
|	See: https://codeigniter.com/user_guide/libraries/caching.html#memcached
|
*/
$config = array(
	'socket_type' => 'tcp',
	'host' => '192.168.105.45',
	'password' => NULL,
	'port' => 6379,
	'timeout' => 10
);
