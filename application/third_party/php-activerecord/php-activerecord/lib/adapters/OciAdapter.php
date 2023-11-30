<?php
/**
 * @package ActiveRecord
 */
namespace ActiveRecord;

//use PDO;
//use PDOOCI;

/**
 * Adapter for OCI (not completed yet).
 * 
 * @package ActiveRecord
 */
class OciAdapter extends Connection
{
	static $QUOTE_CHARACTER = '';
	static $DEFAULT_PORT = 1521;

	public $dsn_params;

	protected function __construct($info)
	{
		try {
			if(property_exists($info,"port")){
				static::$DEFAULT_PORT=$info->port;
			}
			static::$PDO_OPTIONS[\PDO::ATTR_PERSISTENT]=TRUE;
			if(strpos($info->db,":")!==false){
				list($service_name,$server)=explode(":",$info->db);
			}else{
				$service_name=$info->db;
				$server="DEDICATED";
			}
			$this->dsn_params="oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$info->host)(PORT=".static::$DEFAULT_PORT."))(CONNECT_DATA=(SERVICE_NAME=$service_name)(SERVER=$server)))";
			$this->dsn_params .= isset($info->charset) ? ";charset=$info->charset" : "";
			$this->connection = new \PDOOCI\PDO($this->dsn_params,$info->user,$info->pass,static::$PDO_OPTIONS);
			//print_r($this->connection);
		} catch (PDOException $e) {
			throw new DatabaseException($e);
		}
	}

	public function supports_sequences() { return true; }
	
	public function get_next_sequence_value($sequence_name)
	{
		return $this->query_and_fetch_one('SELECT ' . $this->next_sequence_value($sequence_name) . ' FROM dual');
	}

	public function next_sequence_value($sequence_name)
	{
		return "$sequence_name.nextval";
	}

	public function date_to_string($datetime)
	{
		return $datetime->format('Y-m-d H:i:s');
	}

	public function datetime_to_string($datetime)
	{
		return $datetime->format('Y-m-d H:i:s');
	}

	// $string = DD-MON-YYYY HH12:MI:SS(\.[0-9]+) AM
	public function string_to_datetime($string)
	{
		$date = date_create($string);
		$errors = \DateTime::getLastErrors();

		if ($errors['warning_count'] > 0 || $errors['error_count'] > 0)
			return null;

		return new DateTime($date->format('Y-m-d H:i:s'));
	}

	public function limit($sql, $offset, $limit)
	{
		$offset = intval($offset);
		$stop = $offset + intval($limit);
		return 
			"SELECT * FROM (SELECT a.*, rownum ar_rnum__ FROM ($sql) a " .
			"WHERE rownum <= $stop) WHERE ar_rnum__ > $offset";
	}

	public function query_column_info($table)
	{
		$table_array=explode('.',$table);
		if(count($table_array)==1){
				$owner="sys_context('USERENV','SESSION_USER')";
				$table_name=$table_array[0];
		}else{
				$owner="'".strtoupper($table_array[0])."'";
				$table_name=$table_array[1];
		}
		$sql="SELECT c.column_name, c.data_type, c.data_length, c.data_scale, c.data_default, c.nullable, " .
							"(SELECT a.constraint_type " .
							"FROM all_constraints a, all_cons_columns b ".
							"WHERE a.constraint_type='P' ".
							"AND a.constraint_name=b.constraint_name ".
							"AND a.table_name = c.table_name AND b.column_name=c.column_name AND a.owner=b.owner AND a.owner=c.owner) AS pk " .
					"FROM all_tab_columns c ".
					"WHERE (c.owner=$owner or c.owner=(SELECT table_owner FROM user_synonyms WHERE synonym_name=? AND rownum=1)) AND c.table_name=?";
		$values = array(strtoupper($table_name),strtoupper($table_name));
		return $this->query($sql,$values);
	}

	public function query_for_tables()
	{
		return $this->query("SELECT table_name FROM user_tables");
	}

	public function create_column(&$column)
	{
		$column['column_name'] = strtolower($column['COLUMN_NAME']);
		$column['data_type'] = strtolower(preg_replace('/\(.*?\)/','',$column['DATA_TYPE']));

		if ($column['DATA_DEFAULT'] !== null)
			$column['data_default'] = trim($column['DATA_DEFAULT'],"' ");
		else
		$column['data_default'] = NULL;
		if ($column['data_type'] == 'number')
		{
			if ($column['DATA_SCALE'] > 0)
				$column['data_type'] = 'decimal';
			elseif ($column['DATA_SCALE'] == 0)
				$column['data_type'] = 'int';
		}

		$c = new Column();
		$c->inflected_name	= Inflector::instance()->variablize($column['column_name']);
		$c->name			= $column['column_name'];
		$c->nullable		= $column['NULLABLE'] == 'Y' ? true : false;
		$c->pk				= $column['PK'] == 'P' ? true : false;
		$c->length			= $column['DATA_LENGTH'];
	
		if ($column['data_type'] == 'timestamp')
			$c->raw_type = 'datetime';
		else
			$c->raw_type = $column['data_type'];

		$c->map_raw_type();
		$c->default	= $c->cast($column['data_default'],$this);

		return $c;
	}

	public function set_encoding($charset)
	{
		$this->query("ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI:SS' NLS_TIMESTAMP_FORMAT = 'YYYY-MM-DD HH24:MI:SS' NLS_LANGUAGE = 'AMERICAN'");
	}

	public function native_database_types()
	{
		return array(
			'primary_key' => "NUMBER(38) NOT NULL PRIMARY KEY",
			'string' => array('name' => 'VARCHAR2', 'length' => 255),
			'text' => array('name' => 'CLOB'),
			'integer' => array('name' => 'NUMBER', 'length' => 38),
			'float' => array('name' => 'NUMBER'),
			'datetime' => array('name' => 'DATE'),
			'timestamp' => array('name' => 'DATE'),
			'time' => array('name' => 'DATE'),
			'date' => array('name' => 'DATE'),
			'binary' => array('name' => 'BLOB'),
			'boolean' => array('name' => 'NUMBER', 'length' => 1)
		);
	}
}
?>
