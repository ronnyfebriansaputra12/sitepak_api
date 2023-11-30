<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kelurahan_model extends MY_Model {
	static $table_name='setup_kel';
	static $primary_key=array('no_prop','no_kab','no_kec','no_kel');
}