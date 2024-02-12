<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If this is not set then CodeIgniter will guess the protocol, domain and
| path to your installation.
|
*/

/* Pastikan konfigurasi php_openssl.so atau php_openssl.ddl sudah diaktifkan di php.ini */

// $config['email'] = Array(
// 							'newline'	=> "\r\n",
// 							'mailtype'	=> 'html',
// 							'protocol'  => 'smtp',
// 							'smtp_host' => "mail.bekasikab.go.id",
// 							'smtp_port' => '25',
// 							'smtp_user' => 'disdukcapil@bekasikab.go.id',
// 							'smtp_pass' => 'j4ng4nm41nm41nd3ng4nb3k4s1',
// 							'smtp_crypto'=>'tls',
// 							'charset'	=> 'iso-8859-1',
// 							'smtp_timeout'=> '10'
// 						 );

						 $config['email'] = Array(
							'newline'	=> "\r\n",
							'mailtype'	=> 'html',
							'protocol'  => 'smtp',
							'smtp_host' => "mail.bekasikab.go.id",
							'smtp_port' => '25',
							'smtp_user' => 'disdukcapil@bekasikab.go.id',
							'smtp_pass' => 'j4ng4nm41nm41nd3ng4nb3k4s1',
							'smtp_crypto'=>'tls',
							'charset'	=> 'iso-8859-1',
							'smtp_timeout'=> '10'
						 );
//$config['email_enesis']		="admin@enesis.coo.id";
//$config['email_enesis']		="wahidin@begamax.com";
//$config['email_enesis']		="samsul@geraisoft.com";
$config['jwt_secret'] = "sitepak2023";