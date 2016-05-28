<?php

	
	class Contactus_model extends CI_Model
	{
		
		function contactus($name,$message)
		{
			$data=array(
							'name' =>$name,
							'message'=>$message
				);
			$this->db->insert('contactus_table', $data);
			return json_encode("success");	
		}
	}