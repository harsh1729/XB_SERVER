<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
	
	public function set_cart()
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				echo json_encode(array("status"=>'notlogin'));
		}
		else if($is_logged_in)
		{
			$this->load->model('cart_model');
			$this->load->model('examtest_model');
			$name = $this->input->post('name');
			$item_id = $this->input->post('item_id');
			$price = $this->input->post('price');
			$set_type = $this->input->post('set_type');
			$userid = $this->examtest_model->get_session_userid();

			echo $this->cart_model->set_cart($name,$item_id,$price,$set_type,$userid);
		}

	}


	public function get_cart()
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				echo json_encode(array("status"=>'notlogin'));
		}
		else if($is_logged_in)
		{
			$this->load->model('cart_model');
			$this->load->model('examtest_model');
			
			$userid = $this->examtest_model->get_session_userid();
			echo $this->cart_model->get_cart($userid);
		}
	}

	public function empty_cart()
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				echo json_encode(array("status"=>'notlogin'));
		}
		else if($is_logged_in)
		{
			$this->load->model('cart_model');
			$this->load->model('examtest_model');
			
			$userid = $this->examtest_model->get_session_userid();
			echo $this->cart_model->empty_cart($userid);
		}
	}

	public function delete_single_cart()
	{
		$this->load->model('user_info_model');
		$is_logged_in = $this->user_info_model->is_logged_in();
		if(!$is_logged_in)
		{
				echo json_encode(array("status"=>'notlogin'));
		}
		else if($is_logged_in)
		{
			$this->load->model('cart_model');
			$this->load->model('examtest_model');
			$id = $this->input->post('id');
			$userid = $this->examtest_model->get_session_userid();
			echo $this->cart_model->delete_single_cart($id,$userid);
		}
	}
}
