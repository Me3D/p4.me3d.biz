<?php

class index_controller extends base_controller {

	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	}

	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		#Not logged in (or signed up) send to login or signup page
		if(!$this->user) {
			# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');

			# Now set the <title> tag
			$this->template->title = "Storm Chat";

			# Render the view
			echo $this->template;
		}

		else {
			Router::redirect('/chat');
		}


	} # End of method


} # End of class
