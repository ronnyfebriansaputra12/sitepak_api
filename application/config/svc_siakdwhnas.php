<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Integrasi Siak
// $config['nfs2_url_ip']='192.168.105.45';
// $config['nfs2_url_ip']='118.97.79.29';
$config['nfs2_url_ip']='127.0.0.1';
$config['nfs2_url_port']=80;
$config['nfs2_url_name']="http://".$config['nfs2_url_ip'].":".$config['nfs2_url_port']."/svc_siakdwhnas";
$config['nfs2_conn_timeout']=1000;