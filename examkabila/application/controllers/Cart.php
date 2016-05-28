	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
	public function purchase_item()
	{
		$this->load->model('cart_model');
		$this->load->model('user_info_model');

		$userid  =$this->session->userdata('userid');

		$MERCHANT_KEY = "36z0lv";
		$SALT = "0KjssVkC";
		$PAYU_BASE_URL = "https://secure.payu.in";
		$action = $PAYU_BASE_URL . '/_payment';	


		
		$firstname =$this->session->userdata('name');
		$email = $this->session->userdata('email');
		$phone = $this->session->userdata('phone');

		//$product_info = $this->cart_model->prodect_info($userid);
		$product_info = "this is demo";
		$amount =$this->cart_model->cart_total_amount($userid);



		$surl = "http://www.examkabila.com/Bankpo";
		$furl = "http://www.examkabila.com/Blog";
		$service_provider = "payu_paisa";
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
			//$txnid=	"asfdsa786786sfdfdfd";
		$hash_string  = $MERCHANT_KEY."|".$txnid."|".$amount."|".$product_info."|".$firstname."|".$email."|||||||||||";
		//$hash_string = "36z0lv|asfdsa786786sfdfdfd|20|this is demo|vikas sharma|vikassharma9782@gmail.com|||||||||||";
			$hash_string .= $SALT;

		$hash = strtolower(hash('sha512', $hash_string));
		



		$array = array();
		$array['key'] = $MERCHANT_KEY;
		$array['hash'] = $hash;
		$array['txnid'] = $txnid;
		$array['amount'] = $amount;
		$array['firstname'] = $firstname;
		$array['email'] = $email;
		$array['phone'] = $phone;
		$array['product_info'] = $product_info;
		$array['surl'] = $surl;
		$array['furl'] = $furl;
		$array['service_provider']=  $service_provider;
		$array['action'] = $action;


		$this->load->view('purchase-view',$array);


	}




	
	
}
