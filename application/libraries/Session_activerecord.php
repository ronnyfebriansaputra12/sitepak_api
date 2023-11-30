<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (BASEPATH.'libraries/Session.php');
class Session_activerecord extends CI_Session
{
	
	function __construct()
	{
		$this->sess_use_database = false;
		call_user_func_array(array('parent', '__construct'), func_get_args());
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the current session data if it exists
	 *
	 * @access	public
	 * @return	bool
	 */
	function sess_read()
	{
		if (!parent::sess_read())
		{
			//log_message('error','Tidak bisa karena parent dari Session');
			return false;
		}
		if(strpos($this->CI->input->user_agent(),'Java') || strpos($this->CI->input->user_agent(),'shockwave')){
			$this->userdata['session_id']=$_GET['session_id'];
			$this->userdata['ip_address']=$this->CI->ip_address();
			$session = Fpd2k_session_model::find(array(
				'conditions' => array(
					'session_id = ? AND ip_address = ?',
					$this->userdata['session_id'],
					$this->userdata['ip_address']					
				)
			));
			if($session){
				$this->userdata['user_agent']=$session[0]->user_agent;
			}
		}else{
			$where=array();
			$where['session_id']=$this->userdata['session_id'];
			if($this->sess_match_ip){
				$where['ip_address']=$this->userdata['ip_address'];
			}
			if($this->sess_match_useragent){
				$where['user_agent']=$this->userdata['user_agent'];
			}
			$list_session=Fpd2k_session_model::get_criteria(array('where'=>$where));
			$session=null;
			if($list_session){
				$session=$list_session[0];	
			}		
			/*$session = Fpd2k_session_model::find(array(
				'conditions' => array(
					'session_id = ? AND ip_address = ? AND user_agent = ?',
					$this->userdata['session_id'],
					$this->userdata['ip_address'],
					$this->userdata['user_agent']
				)
			));*/
		}
		// No result?  Kill it!
		if (!$session)
		{			
			$this->sess_destroy();			
			return false;
		}

		// Is there custom data?  If so, add it to the main session array
		if (isset($session->user_data) AND $session->user_data != '')
		{
			$custom_data = $this->_unserialize($session->user_data);

			if (is_array($custom_data))
			{
				foreach ($custom_data as $key => $val)
				{
					$this->userdata[$key] = $val;
				}
			}
		}

		return true;
	}

	// --------------------------------------------------------------------

	/**
	 * Write the session data
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_write()
	{
		// set the custom userdata, the session data we will set in a second
		$custom_userdata = $this->userdata;
		$cookie_userdata = array();

		// Before continuing, we need to determine if there is any custom data to deal with.
		// Let's determine this by removing the default indexes to see if there's anything left in the array
		// and set the session data while we're at it
		foreach (array('session_id','ip_address','user_agent','last_activity') as $val)
		{
			unset($custom_userdata[$val]);
			$cookie_userdata[$val] = $this->userdata[$val];
		}

		// Did we find any custom data?  If not, we turn the empty array into a string
		// since there's no reason to serialize and store an empty array in the DB
		if (count($custom_userdata) === 0)
		{
			$custom_userdata = '';
		}
		else
		{
			// Serialize the custom data array so we can store it
			$custom_userdata = $this->_serialize($custom_userdata);
		}

		// Run the update query
		$set = array(
			'user_data'     => $custom_userdata,
			'last_activity' => $this->userdata['last_activity']
		);
		if(isset($this->userdata['user_id'])){
			$set['user_id']=$this->userdata['user_id'];	
		}
		Fpd2k_session_model::table()->update(
			$set,
			array('session_id' => $this->userdata['session_id'])
		);

		// Write the cookie.  Notice that we manually pass the cookie data array to the
		// _set_cookie() function. Normally that function will store $this->userdata, but
		// in this case that array contains custom data, which we do not want in the cookie.		
		$this->_set_cookie($cookie_userdata);
	}

	// --------------------------------------------------------------------

	/**
	 * Create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_create()
	{
		parent::sess_create();

		$session = new Fpd2k_session_model;
		$session->set_attributes($this->userdata);
		$this->last_activity = $this->now;
		$session->save();
	}

	// --------------------------------------------------------------------

	/**
	 * Update an existing session
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_update()
	{
		// We only update the session every five minutes by default
		
		if (($this->userdata['last_activity'] + $this->sess_time_to_update) >= $this->now)
		{
			return;
		}
		
		if(strpos($this->CI->input->user_agent(),'Java') || strpos($this->CI->input->user_agent(),'shockwave')){
			return;
		}
		// Find the session information
		$CI =& get_instance();

        if($session=Fpd2k_session_model::first(array('conditions' =>array('session_id = ?',$this->userdata['session_id'])))){
    		$session->last_activity=$this->now;
    		$session->save();
    		$cookie_data = array();
			foreach (array('session_id','ip_address','user_agent','last_activity') as $val){
				$cookie_data[$val] = $this->userdata[$val];
			}
			$cookie_data['last_activity']=$this->now;
			$this->_set_cookie($cookie_data);
        }
		
	}

	// --------------------------------------------------------------------

	/**
	 * Destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	function sess_destroy()
	{
		if(isset($this->userdata['session_id'])){
			Fpd2k_session_model::table()->delete(array('session_id' => $this->userdata['session_id']));	
		}		
		parent::sess_destroy();
	}


	// --------------------------------------------------------------------

	/**
	 * Garbage collection
	 *
	 * This deletes expired session rows from database
	 * if the probability percentage is met
	 *
	 * @access	public
	 * @return	void
	 */
	function _sess_gc()
	{
		srand(time());
		if ((rand() % 100) < $this->gc_probability)
		{
			$expire = $this->now - $this->sess_expiration;

 			Fpd2k_session_model::delete_all(array('conditions' => array('last_activity < ?', $expire))); 			
			log_message('debug', 'Session garbage collection performed.');
		}
	}
}