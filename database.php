<?php
class Database{

	public $hostname = "localhost";
	//public $username = "root";
	public $username = "pmauser";
	//public $passowrd = "";
	public $passowrd = "123456";
	public $database = "vocabulary";
	public $connection;
	public $message = array(); 

	//Connect with database for mysql database
	public function __construct()
	{
		$this->connection = new mysqli($this->hostname, $this->username, $this->passowrd, $this->database);

		//Check Connection
		if($this->connection->connect_errno){
			die("Connection Fail ".$this->connection->connect_error);
		}
		else{
			//echo "Connection is ok <br>";
		}
	}// End of constructor


	//Function to Create Table
	public function CreateTable($sql){
		//Create Table
		if ($this->connection->query($sql) === TRUE) {
		    echo "Table has been created successfully";
		} else {
		    echo "Error to creating table: ".$this->connection->error;
		}
		echo "<br>";
	}//End of function CreateTable



	//Fetch data by accepting table name and columns(1 dimentional array) name
	public function fetch($table, array $columns, array $condition){
		
		$where_condition = "";
		if(!empty($condition)){
			$where_condition =" WHERE ";
			foreach ($condition as $key => $value) {
				$where_condition .= $key." = '".$value."' AND ";
			}
			$where_condition = rtrim($where_condition, "AND ");
		}
		$columns = (empty($columns)) ? "*" : rtrim(implode(",",$columns), ",");
		$result=$this->connection->query("SELECT $columns FROM $table $where_condition");
	
		if($this->connection->errno){
			die("Fail Select ".$this->connection->error);
		}

		//return tow dimentional array as required columns result
		return $result->fetch_all(MYSQLI_ASSOC);
	}




	# Insert Data within table by accepting TableName and Table column => Data as associative array
	public function insert($tblname, array $val_cols){

		$keysString = implode(", ", array_keys($val_cols));

		$i=0;
		foreach($val_cols as $key=>$value) {
			$StValue[$i] = "'".$value."'";
		    $i++;
		}

		$StValues = implode(", ",$StValue);
		
		if (mysqli_connect_errno()) {
		  $this->message['msg'] = "Failed to connect to MySQL: " . mysqli_connect_error();
		  $this->message['return'] = false;
		  return $this->message;
		}

		//Perform Insert operation
		if($this->connection->query("INSERT INTO $tblname ($keysString) VALUES ($StValues)") === TRUE){
			$this->message['msg'] =  "New record has been inserted successfully into the ".$tblname;
			$this->message['insert_id'] = $this->connection->insert_id;
			$this->message['return'] = true;
			return $this->message;
		}else{
			$this->message['msg'] =  "Error ".$this->connection->error;
			$this->message['return'] = false;
			return $this->message;			
		}
	}//End of function insert




	//Delete data form table; Accepting Table Name and Keys=>Values as associative array
	public function delete($tblname, array $val_cols){
		//Append each element of val_cols associative array 
		$i=0;
		foreach($val_cols as $key=>$value) {
			$exp[$i] = $key." = '".$value."'";
		    $i++;
		}

		$Stexp = implode(" AND ",$exp);

		//Perform Delete operation
		if($this->connection->query("DELETE FROM $tblname WHERE $Stexp") === TRUE){
			if(mysqli_affected_rows($this->connection)){
				$this->message['msg'] =  "Record has been deleted successfully";
				$this->message['return'] = true;
				return $this->message;
			}
			else{
				$this->message['msg'] = "The Record you want to delete is no loger exists";
				$this->message['return'] = false;
				return $this->message;
			}
		}
		else{
			$this->message['msg'] = "Error to delete".$this->connection->error;
			$this->message['return'] = false;
			return $this->message;	
		}	
	}




	//Update data within table; Accepting Table Name and Keys=>Values as associative array
	public function update($tblname, array $set_val_cols, array $cod_val_cols){
		
		//append set_val_cols associative array elements 
		$i=0;
		foreach($set_val_cols as $key=>$value) {
			$set[$i] = $key." = '".$value."'";
		    $i++;
		}

		$Stset = implode(", ",$set);

		//append cod_val_cols associative array elements
		$i=0;
		foreach($cod_val_cols as $key=>$value) {
			$cod[$i] = $key." = '".$value."'";
		    $i++;
		}

		$Stcod = implode(" AND ",$cod);

		//Update operation
		if($this->connection->query("UPDATE $tblname SET $Stset WHERE $Stcod") === TRUE){
			if(mysqli_affected_rows($this->connection)){
				$this->message['msg'] =  "Record updated successfully!";
				$this->message['return'] = true;
				return $this->message;
			}
			else{
				$this->message['msg'] =  "The Record you want to updated is no loger exists or It is already updated";
				$this->message['return'] = false;
				return $this->message;
			}
		}else{
			$this->message['msg'] =  "Error to update ".$this->connection->error;
			$this->message['return'] = false;
			return $this->message;
		}
	}

	# Perform SQL operations
	public function execution($sql){
		if (mysqli_connect_errno()) {
			$this->message['msg'] = "Failed to connect to MySQL: " . mysqli_connect_error();
			$this->message['return'] = false;
			return $this->message;
		}

		$result=$this->connection->query("$sql");
	
		if($this->connection->errno){
			die("Fail Select ".$this->connection->error);
		}

		return $result->fetch_all(MYSQLI_ASSOC);
	}//End of function execution

	public function validation($fieldname, $fieldvalue, $fieldlength){
		$fieldvalue = trim($fieldvalue);
		$errorMSG = "";
		if (isset($fieldvalue) && empty($fieldvalue)) {
			$errorMSG .= "<li>".$fieldname." is required</<li>"; 
			$name_validation = false;
		}
		else{
			if(!preg_match("/^[a-zA-Z]([\w -.,]*[a-zA-Z])?$/i", $fieldvalue)){
				$errorMSG .= "<li>".$fieldname." only allow alphanumeric, hyphen, dot, comma, underscore and space</<li>"; 
				$name_validation = false;
			}
			else {
				if(strlen($fieldvalue)>$fieldlength){
					$errorMSG .= "<li>".$fieldname." must be less than ".$fieldlength." characters</<li>"; 
					$name_validation = false;
				}
				else {
					$errorMSG .= "<li>".$fieldname." is correct</<li>"; 
					$name_validation = true;
				}
			}
		}
		$validation_result = array("errorMSG" => $errorMSG, "validation" => $name_validation);
		return $validation_result;
	}

	public function TagValidation($POST){
		$name_validation = $description_validation = false;
		$validation = false;
		$errorMSG = "";

		/*------ Start: Check Validation --------*/
		$name_validation_check = $this->validation("Name", $POST["name"], 100);
		$errorMSG .= $name_validation_check["errorMSG"];
		$name_validation = $name_validation_check["validation"];
		if($name_validation){$name = $POST['name'];}

		$description_validation_check = $this->validation("Description", $POST["description"], 1000);
		$errorMSG .= $description_validation_check["errorMSG"];
		$description_validation = $description_validation_check["validation"];
		if($description_validation){$description=$POST['description'];}
		/*------ End: Check Validation --------*/

		if($name_validation && $description_validation) $validation = true;
		$validation_result = array("errorMSG" => $errorMSG, "validation" => $validation);
		return $validation_result;
	}

	public function WordsValidation($POST){	
		$word_validation = false;
		$validation = false;
		$errorMSG = "";

		/*------ Start: Check Validation --------*/
		$word_validation_check = $this->validation("Word", $POST["word"], 100);
		$errorMSG .= $word_validation_check["errorMSG"];
		$word_validation = $word_validation_check["validation"];
		if($word_validation){$word = $POST['word'];}
		/*------ End: Check Validation --------*/

		if($word_validation) $validation = true;
		$validation_result = array("errorMSG" => $errorMSG, "validation" => $validation);
		return $validation_result;
	}



	public function ParagraphValidation($POST){	
		$name_validation = false;
		$validation = false;
		$errorMSG = "";

		/*------ Start: Check Validation --------*/
		$name_validation_check = $this->validation("Name", $POST["name"], 100);
		$errorMSG .= $name_validation_check["errorMSG"];
		$name_validation = $name_validation_check["validation"];
		if($name_validation){$name = $POST['name'];}
		/*------ End: Check Validation --------*/

		if($name_validation) $validation = true;
		$validation_result = array("errorMSG" => $errorMSG, "validation" => $validation);
		return $validation_result;
	}

	public function PassageChecker($str){
		$count = 0;
		$memorize = 0;
		$accuracy = 0;
		$string = "";
		$errorMSG = "";
		$description = explode(" ",$str); 

		foreach ($description as $key => $value) {
			$mvalue = str_replace(array('\'', '"'), '', $value); 
			$words = $this->fetch("words", array(), array("word"=>$mvalue));

			if(!empty($words)){
				if($words[0]['complete']){
					$class = "memorized"; $memorize++;
				}else{
					$class = "unmemorized";
				}
				// save-word.php?action=view&id=".$words[0]['id']."
				$string .= "<a href='javascript:void(0)' data-id=".$words[0]['id']." class='word-class ".$class."'>".$value."</a> ";
				$count++;
			}else{
				$string .= $value." ";
			}
		}
		$accuracy = round(($memorize * 100)/$count);
		$result = array("errorMSG" => $errorMSG, "count" => $count, "memorize" => $memorize, "accuracy" => $accuracy, "string" => $string);
		return $result;
	}

	//Call destructor function 
	public function __destruct() {
		if($this->connection){
			// Close the connection
        	$this->connection->close();
        	//echo "Connection is release";
        }	
	}

}//end of class


// Create Connection
$obj = new Database();

//echo $_GET["page"]; 
//echo "<pre>"; print_r($_GET); die;


if(isset($_GET["page"])){

	/* ======= START: Insert and Update Operation ======== */
	if(($_GET["page"]=="tag" || $_GET["page"]=="words" || $_GET["page"]=="paragraph") && ($_GET["action"]=="update" || $_GET["action"]=="insert")) {
		extract($_POST);
		$errorMSG = "";

		if (isset($_GET['page']) && isset($_GET['action'])) {
			$page=$_GET['page'];
			$action=$_GET['action'];

			if ($page == 'tag') {
				$result_validation = $obj->TagValidation($_POST);
			}elseif ($page == 'words') {
				$result_validation = $obj->WordsValidation($_POST);
			}elseif ($page == 'paragraph') {
				$result_validation = $obj->ParagraphValidation($_POST);
			}
		} else {
			$data_result ="failed";
			$data_msg = "There is no PAGE and ACTION";
			$data_message = "Illegal Operator";
			echo json_encode(['result'=>$data_result, 'msg'=>$data_msg, 'message'=>$data_message]); exit;
		}

		if($result_validation['validation']){
			$tablename = $page;
			if ($page == 'tag'){
				$ColumnVal = array("name"=>$name,"slug"=>$name,"description"=>$description);
			}
			elseif ($page == 'words') {
				$complete = (isset($complete)) ? 1 : 0;
				$ColumnVal = array(
								"word"=>$word,
								"past"=>$past,
								"participle"=>$participle,
								"pos"=>$pos,
								"spelling"=>$spelling,
								"utterance"=>$utterance,
								"mnemonics"=>$mnemonics,
								"smeaning"=>$smeaning,
								"lmeaning"=>$lmeaning,
								"sentence"=>$sentence,
								"complete"=>$complete,
								"meaning_number"=>$meaning_number,
							);
			}elseif ($page == 'paragraph') {
				$ColumnVal = array("name"=>addslashes($name),"slug"=>addslashes($name),"description"=>addslashes($description),"iframe"=>addslashes($iframe),"count"=>$count,"memorize"=>$memorize,"accuracy"=>$accuracy);
			}

			if($action=="update"){
				$condition = array("id"=>$_POST['id']);
				$dbreturn = $obj->update($tablename, $ColumnVal, $condition);
			}else{
				$dbreturn = $obj->insert($tablename, $ColumnVal);
			}

			if($dbreturn["return"]){
				$data_result = "success";
				$data_msg = $dbreturn['msg'];
				$data_message = $page." Successfully ".$action;
			}else{
				$data_result ="failed";
				$data_msg = $dbreturn['msg'];
				$data_message = $page." unable to ".$action;
			}
		}else{
			$data_result ="failed";
			$data_msg = "<ul>".$result_validation['errorMSG']."</ul>";
			$data_message = $page." unable to ".$action;
		}
		echo json_encode(['result'=>$data_result, 'msg'=>$data_msg, 'message'=>$data_message]);
	}
	/* ======= END: Insert and Update Tag ======== */



	/* ======= START: Insert and Update Tag ======== */
	/*if($_GET["page"]=="tag" && ($_GET["action"]=="update" || $_GET["action"]=="insert")) {
		$name_validation = $description_validation = false;
		$errorMSG = "";

		if (isset($_GET['page']) && isset($_GET['action'])) {
			$page=$_GET['page'];
			$action=$_GET['action'];

			$name_validation_check = $obj->validation("Name", $_POST["name"], 100);
			$errorMSG .= $name_validation_check["errorMSG"];
			$name_validation = $name_validation_check["validation"];
			if($name_validation){$name = $_POST['name'];}

			$name_validation_check = $obj->validation("Description", $_POST["description"], 200);
			$errorMSG .= $name_validation_check["errorMSG"];
			$description_validation = $name_validation_check["validation"];
			if($description_validation){$description=$_POST['description'];}
		} else {
			$data_result ="failed";
			$data_msg = "There is no PAGE and ACTION";
			$data_message = "Illegal Operator";
			echo json_encode(['result'=>$data_result, 'msg'=>$data_msg, 'message'=>$data_message]); exit;
		}

		if($name_validation && $description_validation){
			$slug = $name;
			$tablename = "tag";
			$ColumnVal = array("name"=>$name,"slug"=>$slug,"description"=>$description);

			if($action=="update"){
				$condition = array("id"=>$_POST['id']);
				$dbreturn = $obj->update($tablename, $ColumnVal, $condition);
			}else{
				$dbreturn = $obj->insert($tablename, $ColumnVal);
			}

			if($dbreturn["return"]){
				$data_result = "success";
				$data_msg = $dbreturn['msg'];
				$data_message = $page." Successfully ".$action;
			}else{
				$data_result ="failed";
				$data_msg = $dbreturn['msg'];
				$data_message = $page." unable to ".$action;
			}
		}else{
			$data_result ="failed";
			$data_msg = "<ul>".$errorMSG."</ul>";
			$data_message = $page." unable to ".$action;
		}
		echo json_encode(['result'=>$data_result, 'msg'=>$data_msg, 'message'=>$data_message]);
	}*/
	/* ======= END: Insert and Update Tag ======== */




	/* ======= START: Delete Tag ======== */
	if(($_GET["page"]=="tag" || $_GET["page"]=="words" || $_GET["page"]=="paragraph") && $_GET["action"]=="delete") {
		$page=$_GET['page'];
		$action=$_GET['action'];
		$id=$_GET['id'];

		$tablename = $page;
		$DelColumnVal = array("id"=>$id);
		$dbreturn = $obj->delete($tablename, $DelColumnVal);

		if($dbreturn["return"]){
			$data_result = "success";
			$data_msg = $dbreturn['msg'];
			$data_message = $page." Successfully ".$action;
		}else{
			$data_result ="failed";
			$data_msg = $dbreturn['msg'];
			$data_message = $page." unable to ".$action;
		}
		echo json_encode(['result'=>$data_result, 'msg'=>$data_msg, 'message'=>$data_message]);	
	}
	/* ======= END: Delete Tag ======== */


	//page=words&action=complete&id='+id
	/* ======= START: Word Memorize check ======== */
	if($_GET["page"]=="words" && $_GET["action"]=="complete") {
		$page=$_GET['page'];
		$action=$_GET['action'];
		$id=$_GET['id'];
		$complete = ($_GET['complete'])?$_GET['complete']:0;
		//echo "complete=".$complete." | id=".$id." | action=".$action." | page=".$page; die;

		$data_result ="failed";
		$data_msg = "";
		$data_message = "";

		$tablename = $page;
		$condition = array("id"=>$id);
		$ColumnVal = array("complete"=>$complete);
		$dbreturn = $obj->update($tablename, $ColumnVal, $condition);
		
		if($dbreturn["return"]){
			$data_result = "success";
			$data_msg = $dbreturn['msg'];
			$data_message = $page." Successfully ".$action;
		}else{
			$data_result ="failed";
			$data_msg = $dbreturn['msg'];
			$data_message = $page." unable to ".$action;
		}
		echo json_encode(['result'=>$data_result, 'msg'=>$data_msg, 'message'=>$data_message]);	
	}
	/* ======= END: Word Memorize check ======== */




	//database.php?id=1 & page=paragraph & action=viewword
	/* ======= START: Click to Open Word Modal ======== */
	if($_GET["page"]=="words" && $_GET["action"]=="viewword") {
		$page=$_GET['page'];
		$action=$_GET['action'];
		$id=$_GET['id'];

		$data_result ="failed";
		$data_msg = "";
		$data_message = "";

		$table = $page;
		$condition = array("id"=>$id);
		$columns = array();
		$dbreturn = $obj->fetch($table, $columns, $condition);
		
		if($dbreturn){
			$data_result = "success";
			$data_msg = $dbreturn['msg'];
			$data_message = $page." Successfully ".$action;
		}else{
			$data_result ="failed";
			$data_msg = $dbreturn['msg'];
			$data_message = $page." unable to ".$action;
		}
		echo json_encode(['result'=>$data_result, 'msg'=>$data_msg, 'message'=>$data_message, 'data'=>$dbreturn]);
	}
	/* ======= END: Click to Open Word Modal ======== */







}
/*
// Assign table name
$tablename = "student";
// Create table query
$CreateTableSql = "CREATE TABLE $tablename(Roll INT,Name CHAR(50),Marks DOUBLE)";
//Call Create Table
$obj->CreateTable($CreateTableSql);
*/

/*
//Associative array for insert function
$InsColumnVal = array("Roll"=>4,"Name"=>'Zahan',"Marks"=>64.8);
//Call insert function to insert record
$obj->insert($tablename, $InsColumnVal);
*/


/*
//Associative array for delete function
$DelColumnVal = array("Roll"=>4,"Name"=>'Zahan');
//Call Delete function
$obj->delete($tablename, $DelColumnVal);
*/

/*
//Associative array to set query for update function
$set = array("Roll"=>5,"Marks"=>75.3);
//Associative array to condition query for update function
$condition = array("Roll"=>3,"Name"=>'Hatim');
//call update function
$obj->update($tablename, $set,$condition);
*/

/*
// Fetch data from the table
$show = $obj->fetch($tablename, array("Roll","Name","Marks"));
// Show data from table
echo "<pre>";
print_r($show);
echo "</pre>";
*/
?>