<?php

class chat_controller extends base_controller {

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	}

	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/chat/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		#Not logged in (or signed up) send to login or signup page
		if(!$this->user) {
			Router::redirect('/');

		}else {
			# First, set the content of the template with a view file
			$this->template->content = View::instance('v_chat');

			# Now set the <title> tag
			$this->template->title = "Storm Chat";
			
			$this->template->content->username = $this->user->username;

			# Render the view
			echo $this->template;
		}
	} # End of method

	/*User to send a chat message into the database */
	public function send($flag = 0){
		if(!$this->user) {
			Router::redirect('/');
		}
		if(isset($_POST['message'])){
			if(strlen($_POST['message']) == 0){	//do nothing if stringlength is 0
			}else{
				$_POST['user_id'] = $this->user->user_id;
				$_POST['timestamp'] = Time::now();
				$_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
				DB::instance(DB_NAME)->insert('messages', $_POST);
			}//end if
		}//end if	
	}//end send

	
	public function get(){
		if(!$this->user) {
			Router::redirect('/');
		}
		
		$q = 'SELECT * FROM
		(SELECT messages.message, messages.message_id, messages.flag, users.username
		FROM `messages`
		INNER JOIN users
		ON messages.user_id=users.user_id
		ORDER BY `message_id` desc limit 50) tmp
		ORDER BY message_id ASC
		';
		
		$messages = DB::instance(DB_NAME) ->select_rows($q);
		echo json_encode($messages);

	}
	
	
	
	

} # End of class