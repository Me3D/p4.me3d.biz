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

			# Render the view
			echo $this->template;
		}


	} # End of method


} # End of class