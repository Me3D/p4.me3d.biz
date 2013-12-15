<?php

class target_controller extends base_controller {

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	}

	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/update/ used by AJAX to update the targets table
	-------------------------------------------------------------------------------------------------*/
	public function update() {
		
		$q = 'SELECT * from targets';
		$targets = DB::instance(DB_NAME)->select_rows($q);
		
		echo json_encode($targets);

	} # End of method

	
	
	/*Put user back to main interface */
	public function index() {
		Router::redirect('/');
	}

	/*Select the target via target id at /target/target/## */
	public function target( $target_id = NULL) {

		if ($target_id >= 1 ) {
			$q = 'SELECT * from targets WHERE target_id = "'.$target_id.'" ';
			$target = DB::instance(DB_NAME) ->select_rows($q);
			$c = count($target);

			if ($c >=1 ) {
				echo json_encode($target);
			}
		}//end if
	} //end of target()
	
	//Updates a target in the database from the modal dialog.
	public function update_target () {
		
		# Dump out the results of POST to see what the form submitted
		//echo '<pre>';
		//print_r($_POST);
		
		if(isset($_POST['update'])) {
			$tid = $_POST["tid"];
			$ip = $_POST["ip_address"];
			$os = $_POST["os"];
			$scanned = $_POST["scanned"];
			$notes = htmlspecialchars($_POST["notes"], ENT_QUOTES, 'UTF-8');
			$description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
			
			$q = "UPDATE targets SET
			target_ip = '".$ip."',  
			notes = '".$notes."',
			description = '".$description."',
			os = '".$os."',
			scanned = '".$scanned."'
			WHERE target_id = '".$tid."'
			";
			
			DB::instance(DB_NAME)->query($q);
			//echo '</pre>';
			Router::redirect('/');
		}elseif(isset($_POST['delete'])){
			$tid = $_POST["tid"];
			$q = "DELETE from targets WHERE target_id = '".$tid."' ";
			DB::instance(DB_NAME)->query($q);
			Router::redirect('/');		
		}//end elseif
	}//end update target
	
	
	/* Add a target*/
	public function add_target(){
		$ip = $_POST["ip_address"];
		$os = $_POST["os"];
		$scanned = $_POST["scanned"];
		$notes = htmlspecialchars($_POST["notes"], ENT_QUOTES, 'UTF-8');
		$description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
		
		$q = "INSERT into targets SET
		target_ip = '$ip',
		notes = '$notes',
		os = '$os',
		scanned = '$scanned',
		description = '$description'		
		";
		DB::instance(DB_NAME)->query($q);
		Router::redirect('/');
	}
	
	

} # End of class
