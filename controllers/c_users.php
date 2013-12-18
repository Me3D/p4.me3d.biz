<?php

class users_controller extends base_controller {

    public function __construct(){
        parent::__construct();
/*        echo "users_controller contructor called <br><br>";*/
    }

    
/* nothing to see here..go back to index */    
    public function index() {
            Router::redirect('/');
    } //end index()

 
   
/* login and signup all in one function */
 
 public function p_login(){
     
     /* If box is checked then this is a noob and we need to sign him in.*/
     if (isset($_POST['checkbox'])) {
	 $_POST = DB::instance(DB_NAME)->sanitize($_POST);						//sanitize the POST var of cooties
	 $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']); 				//hash and salt the PW
	 $_POST['token'] = sha1(TOKEN_SALT.$_POST['username'].Utils::generate_random_string()); 	//make a token
	 
	 $_POST['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');		//sanitize the username of SQLi cooties
	 
	 //check if that username is taken.
	$q = 'SELECT count(*)
                FROM users
                WHERE username = "'.$_POST['username'].'"';
	$count = DB::instance(DB_NAME)->select_rows($q);
	
	if(intval($count[0]['count(*)']) >= 1) {  	//username taken
                Router::redirect('/users/login/error');
            } else {					//username not taken	
		//make the user and dump him into chat
		DB::instance(DB_NAME)->insert_row('users',$_POST);
		
		//get the token from the DB and sanitize it
		$q = 'SELECT token
		 FROM users
		 WHERE username = "'.$_POST['username'].'"
		 AND password = "'.$_POST['password'].'"';
		 
		$token = DB::instance(DB_NAME)->select_field($q);
		$token = DB::instance(DB_NAME)->sanitize($token);
		#success
		if($token) {
		    //name, actual value, time length, directory access
		    //pull out cookie from browser developer tools
		    setcookie('token', $token, strtotime('+1 year'), '/');
		    //drop a info message in chat about joining!
		    $q = 'SELECT user_id
		    FROM users
		    WHERE token = "'.$token.'" ';
		    $user_id =  DB::instance(DB_NAME)->select_field($q);
		    
		    

		    $q = 'INSERT INTO `messages`(`message`, `user_id`, `flag`) VALUES ('."'has entered the chat!'" .','."'$user_id'".','."'2'".')';
	    
		    DB::instance(DB_NAME)->query($q);
		    
		    Router::redirect('/chat');
		}
		#fail
		else {
		    Router::redirect('/users/login/error');
		    }//end little else
	       } //end big else
	} else { //person is not a noob
	    $_POST = DB::instance(DB_NAME)->sanitize($_POST);
	    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
	    
	    //get the token from the DB and sanitize it
	    $q = 'SELECT token
		FROM users
		WHERE username = "'.$_POST['username'].'"
		AND password = "'.$_POST['password'].'"';
		
	    $token = DB::instance(DB_NAME)->select_field($q);
	    $token = DB::instance(DB_NAME)->sanitize($token);
	    #success
	    if($token) {
		//name, actual value, time length, directory access
		//pull out cookie from browser developer tools
		setcookie('token', $token, strtotime('+1 year'), '/');
		
		    //drop a info message in chat about joining!
		    $q = 'SELECT user_id
		    FROM users
		    WHERE token = "'.$token.'" ';
		    $user_id =  DB::instance(DB_NAME)->select_field($q);
		    
		   

		    $q = 'INSERT INTO `messages`(`message`, `user_id`, `flag`) VALUES ('."'has entered the chat!'" .','."'$user_id'".','."'2'".')';
	    
		    DB::instance(DB_NAME)->query($q);
		
		Router::redirect('/chat');
	    }
	 #fail
	 else {
	     Router::redirect('/users/login/error');
	 }
		 
	     
     }//end big if
     

 }//end p_login
    
    /* Login error*/    
    public function login($error = NULL){
	# First, set the content of the template with a view file
	$this->template->content = View::instance('v_users_login');
	
	#pass the existance(NULL or not NULL) of $error
	$this->template->content->error = $error;
	
	# Now set the <title> tag
	$this->template->title = "Storm Chat";
    
	# Render the view
	echo $this->template;
    }   
    
    /*Logout the user*/
    public function logout(){
	$q = 'SELECT user_id
	    FROM users
	    WHERE username = "'.$this->user->username.'" ';
	$user_id =  DB::instance(DB_NAME)->select_field($q);

        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->username.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

	//drop a info message in chat about logging out!
	
	$q = 'INSERT INTO `messages`(`message`, `user_id`, `flag`) VALUES ('."'has left the chat!'" .','."'$user_id'".','."'2'".')';
	DB::instance(DB_NAME)->query($q);
	
	
        # Send them back to the main index.
        Router::redirect("/");
    }
    
    
    /* get a list of users and last seen times*/
    public function get_users(){
	if(!$this->user) {
	    Router::redirect('/');
	}else {
	    $q = "SELECT username, lastseen FROM users";
	    $lastseen = DB::instance(DB_NAME)->select_rows($q);
	    echo json_encode($lastseen);
	}//end else      
    }//end get_users
    
    /* update the lastseen time of the user*/
    public function lastseen(){
	    $seen = Time::now();
	
		$q = "UPDATE users SET
			lastseen = '".$seen."'  
			WHERE user_id = '".$this->user->user_id."'
			";
	
		DB::instance(DB_NAME)->query($q);
	}//end lastseen
    
    
    public function useredit(){
	if(!$this->user) {
	    Router::redirect('/');
	}else {
	    $old_username =  $this->user->username;
	     //check if that username is taken.
	    $q = 'SELECT count(*)
                FROM users
                WHERE username = "'.$_POST['username'].'"';
	    $count = DB::instance(DB_NAME)->select_rows($q);
	
	    if(intval($count[0]['count(*)']) >= 1) {  	//username taken
                Router::redirect('/');
	    }else{
		if(strlen($_POST['username']) >= 1 ) {
		    $_POST['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
		    $q = "UPDATE users SET
		    username = '".$_POST['username']."'
		    WHERE user_id = '".$this->user->user_id."'
		    ";
		    DB::instance(DB_NAME)->query($q);
		    
		    $user_id = $this->user->user_id;
		   
		    //let everyone know of namechange!		    
		   
		    $q = 'INSERT INTO `messages`(`message`, `user_id`, `flag`) VALUES ('."'$old_username has changed his/her/its name to $username!'" .','."'$user_id'".','."'2'".')';
		    DB::instance(DB_NAME)->query($q);
		}
		
		if(strlen($_POST['password']) >= 1 ) {
		    $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		    $q = "UPDATE users SET
		    password = '".$_POST['password']."'
		    WHERE user_id = '".$this->user->user_id."'
		    ";
		    DB::instance(DB_NAME)->query($q);
		}
		    
		    
		    
		    Router::redirect('/');



	    }//end inside else
	    
	    
	    
	}//end big else
	
    }
    
    
    
    
}//end of users_controller class

?>