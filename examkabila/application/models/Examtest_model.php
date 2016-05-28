<?php

    
	class Examtest_model extends CI_Model
	{
		function get_session_userid()
		{
			return $this->session->userdata('userid');
		}
	

		

		

		

		

		function get_session_username()
		{

			return $this->session->userdata('username');
		}

		
		
		
		




	}