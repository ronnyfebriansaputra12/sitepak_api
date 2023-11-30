<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends ActiveRecord\Model{
	static $CI;
	protected $__old=array();	
	static function init(){
		self::$CI=& get_instance();
		self::connection()->query("ALTER SESSION SET NLS_DATE_FORMAT='DD-MON-YYYY HH:MI:SS PM'");
		self::connection()->query("ALTER SESSION SET NLS_TIMESTAMP_FORMAT='DD-MON-YYYY HH:MI:SS PM'");
		self::connection()->query("ALTER SESSION SET NLS_LANGUAGE= 'AMERICAN'");	
	}
	static function get_criteria($criteria=array()){
		$conditions=array();
		if (isset($criteria['where'])) {			
			$conditions=self::_get_where($criteria['where']);
			unset($criteria['where']);
		}
		if(isset($criteria['conditions']) && isset($conditions[0])){
			if(count($criteria['conditions'])>0){
				$penghubung=' AND ';				
				$key=array_shift($criteria['conditions']);
				$conditions[0].=$penghubung.$key;
				$conditions=array_merge($conditions,$criteria['conditions']);			
			}			
		}
		if(count($conditions)>0){
			$criteria['conditions']=$conditions;
		}
		//print_r($criteria);
		if(count($criteria)>0)
			return self::find('all',$criteria);
		else
			return self::find('all');
	}
	static function create_date($string_date){
		if(strpos($string_date,' ')===false)
			$string_date.=' 00:00:00';
		return ActiveRecord\DateTime::createFromFormat(ActiveRecord\DateTime::$DEFAULT_FORMAT,$string_date);
	}
	static function count_criteria($criteria){
		$conditions=array();
		if (isset($criteria['where'])) {			
			$conditions=self::_get_where($criteria['where']);
			unset($criteria['where']);
		}
		if(isset($criteria['conditions']) && isset($conditions[0])){
			if(count($criteria['conditions'])>0){
				$penghubung=' AND ';				
				$key=array_shift($criteria['conditions']);
				$conditions[0].=$penghubung.$key;
				$conditions=array_merge($conditions,$criteria['conditions']);			
			}			
		}
		if(count($conditions)>0){
			$criteria['conditions']=$conditions;
		}
		if(isset($criteria['group'])){
			$tabel_kk=self::table();			
			$sql=$tabel_kk->options_to_sql($criteria);
			$values = $sql->get_where_values();
			$wrapper = "SELECT COUNT(1) jml_data FROM ({$sql->to_s()}) TMP";		
			return self::connection()->query_and_fetch_one($wrapper,$values);						
		}else{
			return self::count($criteria);	
		}		
	}
	static function _has_operator($str)
	{
		$str = trim($str);
		if ( ! preg_match("/(\s|<|>|!|=|is null|is not null)/i", $str))
		{
			return FALSE;
		}

		return TRUE;
	}
	static function _get_where($where){
		$penghubung=' AND ';
		$conditions=array();
		foreach ($where as $key => $value) {				
			if(self::_has_operator($key)){
				if(preg_match("/(\sin$)/i", $key)){
					$conditions[0]=(isset($conditions[0]))?$conditions[0].$penghubung.$key.' (?)':$key.' (?)';
				}else{
					if(!is_null($value)){
						$conditions[0]=(isset($conditions[0]))?$conditions[0].$penghubung.$key.' ?':$key.' ?';
					}else{
						$conditions[0]=(isset($conditions[0]))?$conditions[0].$penghubung.$key:$key;
					}
				}
			}else{
				$conditions[0]=(isset($conditions[0]))?$conditions[0].$penghubung.$key.' = ?':$key.' = ?';
			}
			if(!is_null($value)){
				if($value instanceof DateTime){
					$conditions[]=$value->format("Y-m-d H:i:s");
				}else{
					$conditions[]=$value;
				}
				
			}				
		}

		return $conditions;
	}
	function insert_returning($pk=null,$validate=true){
		if ($this->is_readonly())
			throw new ActiveRecord\ReadOnlyException(get_class($this), 'insert');
		$table = static::table();		
		if (($validate && !$this->_validate() || !$table->callback->invoke($this,'before_create',false)))
			return false;				
		if (!($attributes = $this->dirty_attributes()))
			$attributes = $this->attributes;
		if(is_null($pk)){
			$pk = $this->get_primary_key(true);	
		}		
		$use_sequence = false;								
		if ($table->sequence && !isset($attributes[$pk])){
			$conn = static::connection();			
			if ($conn instanceof ActiveRecord\OciAdapter || $conn instanceof ActiveRecord\PgsqlAdapter){			
				$data = $this->process_data($attributes);
				$sql = new ActiveRecord\SQLBuilder($conn,$table->get_fully_qualified_table_name());
				$sql->insert($data);
				$values = array_values($data);				
				$sql_text=$sql->to_s();
				$sql_text=vsprintf(str_replace("?", "%s", $sql_text), array_map(function($value){
					return ':pdo'.$value;
				}, range(1,count($values))));
				$sql_text.=' RETURNING '.$pk.' INTO :RETURN_ID';				
				$pk_value=0;												
				try {
					if (!($sth = $conn->connection->prepare($sql_text)))
						throw new ActiveRecord\DatabaseException($conn);
				} catch (PDOException $e) {
					throw new ActiveRecord\DatabaseException($conn);
				}				
				$sth->setFetchMode(PDO::FETCH_ASSOC);
				$kolom_pk=$this->colums_type($pk);																
				if($kolom_pk->type==2){
					$sth->bindParam(':RETURN_ID', $pk_value, OCI_B_INT, $kolom_pk->length);					
				}else{
					$sth->bindParam(':RETURN_ID', $pk_value, SQLT_CHR, $kolom_pk->length);
				}
				$i=1;				
				foreach ($attributes as $key => $value) {					
					$sth->bindValue(':pdo'.$i, $values[$i-1]);					
					$i++;
				}
				//return $sth->debugDumpParams();				
				try {
		            $valid = $sth->execute();
					if (!$valid)
						throw new ActiveRecord\DatabaseException($conn);
				} catch (PDOException $e) {
					throw new ActiveRecord\DatabaseException($sth);
				}				
				$table->last_sql = $sql_text;				
				$this->$pk = $pk_value;
				//print_r($this);
			}else{
				return false;
			}
		}else{
			return false;
		}		
		$table->callback->invoke($this,'after_create',false);
		$this->__new_record = false;
		return true;
	}
	private function &process_data($hash){
		if (!$hash)
			return $hash;
		$table=static::table();
		$conn=static::connection();
		foreach ($hash as $name => &$value){
			if ($value instanceof \DateTime){
				if (isset($table->columns[$name]) && $table->columns[$name]->type == ActiveRecord\Column::DATE && !($conn instanceof ActiveRecord\OciAdapter))
					$hash[$name] = $conn->date_to_string($value);
				else
					$hash[$name] = $conn->datetime_to_string($value);
			}
			else
				$hash[$name] = $value;
		}
		return $hash;
	}
	private function colums_type($kolom){
		$columns = static::table()->columns;
		$hasil="";
		foreach ($columns as $column) {
			if($column->name==$kolom){
				$hasil=$column;
			}		    
		}
		return $hasil;
	}
	public function assign_attribute($name, $value){
		//return parent::assign_attribute($name, $value);
		if($this->is_new_record()){			
			return parent::assign_attribute($name, $value);
		}else{
			if (!isset($this->__old[$name])){
	          	$attributes = $this->attributes();
	          	if(isset($attributes[$name])){
	          		$this->__old[$name] =	$attributes[$name];
	          	}	          	 
	      	}
     		return parent::assign_attribute($name, $value);
 		}
 	}		
}