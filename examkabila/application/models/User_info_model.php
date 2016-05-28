<?php

	
	class User_info_model extends CI_Model
	{
		
		function admin_login($usr,$pwd)
		{
			$this->db->where('admin_user.username',$usr);
			$this->db->where('admin_user.password',$pwd);
			$this->db->select('admin_user.id,admin_user.name,admin_user.username');
			$query = $this->db->get('admin_user');
			$no_of_rows = $this->db->count_all_results();
			if($no_of_rows == 1)
			{

				foreach ($query->result() as $row)
				{
					return array(	"isValidated" => 1,
								"userid" => $row->id,
								"name" => $row->name,
								"username" => $row->username,
								
							);
					}
				
			}
			else
			{
				return array("isValidated"=>0);
			}


		}
		function login($usr,$pwd)
		{

			$this->db->where('user_information_table.username',$usr);
			$this->db->where('user_information_table.password',$pwd);
			$this->db->select('user_information_table.userid,user_information_table.name, user_information_table.phone, user_information_table.username, user_information_table.email');
			$query = $this->db->get('user_information_table');
			$no_of_rows = $this->db->count_all_results();
			if($no_of_rows == 1)
			{

				foreach ($query->result() as $row)
				{
					return array(	"isValidated" => 1,
								"userid" => $row->userid,
								"name" => $row->name,
								"phone" => $row->phone,
								"username" => $row->username,
								"email" => $row->email
							);
					}
				
			}
			else
			{
				return array("isValidated"=>0);
			}
		}


		

		function register($name,$phone,$email,$username,$password)
		{

			$this->db->where('user_information_table.username',$username);
			$this->db->select('*');
			$query = $this->db->get('user_information_table');
			$number = $query->num_rows();
			if($number > 0)
			{
				return array(
					'is_logged_in' =>false,
					);
			}
			else
			{
				$data = array(
				'name' => $name,
				'phone' => $phone,
				'email' => $email,
				'username' => $username,
				'password' => $password
				);

				$result = $this->db->insert('user_information_table', $data);
				if($result)
				{
					$insert_id = $this->db->insert_id();
					return array(
					'is_logged_in' =>true,
					'name' => $name,
					'phone' => $phone,
					'email' => $email,
					'username' => $username,
					'userid' =>$insert_id
					);
				}
				else
				{
					return array(
					'is_logged_in' =>false,
					);
				}
			}
			
		}


		function is_logged_in()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			if(!isset($is_logged_in) || $is_logged_in != true)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		function user_name()
		{
			$name = $this->session->userdata('name');
			return $name;

		}
                function get_session_userid()
		{
			return $this->session->userdata('userid');
		}

	}