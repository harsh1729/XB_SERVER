<?php

	
	class Bankpo_model extends CI_Model
	{
		function get_all_set($type,$userid)
		{
			$array =array();
			$this->db->order_by('set_info_id', 'asc');
                        $this->db->where('isactive',1);
			$this->db->where('set_type',$type);
			$this->db->join("user_setpurchage_mapping","set_info.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type = '".$type."' and userid = '".$userid."'",'left');
			$this->db->join("seen_exam","set_info.id=seen_exam.seen_set_id and seen_exam.userid='".$userid."'",'left');
			$this->db->select('seen_exam.seen_set_id as seen_set_id,set_info.isactive_pre,set_info.isactive_main,set_info.id as set_info_id,set_info.slug,set_info.set_type as set_info_type, set_info.pay_type as pay_type, set_info.payment_amount as amount, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('set_info');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$set_info_id = $row->set_info_id;
				$pay_type = $row->pay_type;
				$set_info_type = $row->set_info_type;
				$amount = $row->amount;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				$seen_set_id = $row->seen_set_id;	
				$userid =  $row->userid;
                $slug = $row->slug;
                $isactive_pre =$row->isactive_pre;
                $isactive_main = $row->isactive_main;

				$array1['set_info_id'] = $set_info_id;
				$array1['pay_type'] = $pay_type;
				$array1['set_info_type'] = $set_info_type;
				$array1['amount'] = $amount;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['seen_set_id'] = $seen_set_id;
				$array1['userid'] = $userid;
                $array1['slug'] = $slug;
                $array1['isactive_pre'] = $isactive_pre;
                $array1['isactive_main'] = $isactive_main;
				array_push($array, $array1);
 			}
 			return $array;
 				//return $this->db->last_query();

		}

                function set_session_setno($slug)
		{
			$this->db->like('slug',$slug);
			$this->db->select('id');
			$query = $this->db->get('set_info');
			foreach ($query->result() as  $row) 
			{
				
				$set_no = $row->id;
				$this->session->set_userdata('set_no', $set_no);
				
				
 			}

		}



		  function getparrentcatid($catid){
           /* $CI = &get_instance();
			$this->db = $CI->load->database('db', TRUE);*/
			$this->db->where('id',$catid);
			$this->db->where('isactive','1');
			$this->db->select('parentId');
			$query = $this->db->get('category_table');
			/* $this->db->from('category_table'); 
			 return $this->db->get()->result();*/
			 $parentid = 0;
			 foreach ($query->result() as  $row) 
			{
                    $parentid = $row->parentId;
			}
           return $parentid;
         }
        function get_allcate(){
        	/*$CI = &get_instance();
			$this->db = $CI->load->database('db', TRUE);*/
			$this->db->where('parentid','0');
			$this->db->where('isactive','1');
			$this->db->select('*');
			$query = $this->db->get('category_table');
			$category = array();
			foreach ($query->result() as  $row) 
			{
				$item = array();
				$item['id'] = $row->id;
				$item['name'] = $row->category;
				$item['parentid'] = $row->parentId;
				$subcat = array();
				$this->db->where('parentId',$row->id);
			    $this->db->select('*');
			    $querysub = $this->db->get('category_table');
			    foreach ($querysub->result() as  $row) 
			     {
			     	$itemsub = array();
			     	$itemsub['id'] = $row->id;
				    $itemsub['name'] = $row->category;
				    $itemsub['parentid'] = $row->parentId;
				    array_push($subcat,$itemsub);
			     }
                $item['subcate'] = $subcat;
                array_push($category, $item);
			}
			return $category;
        }
       function get_cate($parentid){
        	/*$CI = &get_instance();
			$this->db = $CI->load->database('db', TRUE);*/
			$this->db->where('parentid',$parentid);
			$this->db->select('*');
			$this->db->where('isactive','1');
			$query = $this->db->get('category_table');
			$category = array();
			foreach ($query->result() as  $row) 
			{
				$item = array();
				$item['id'] = $row->id;
				$item['name'] = $row->category;
				$item['parentid'] = $row->parentId;
				/*$subcat = array();
				$this->db1->where('parentId',$row->id);
			    $this->db1->select('*');
			    $querysub = $this->db1->get('category_table');
			    foreach ($querysub->result() as  $row) 
			     {
			     	$itemsub = array();
			     	$itemsub['id'] = $row->id;
				    $itemsub['name'] = $row->category;
				    $itemsub['parentid'] = $row->parentId;
				    array_push($subcat,$itemsub);
			     }
                $item['subcate'] = $subcat;*/
                array_push($category, $item);
			}
			return $category;
        }

		function get_gk($off_set,$limit)
		{
                        $off_set = ($off_set-1)*15;
			$array =array();
			$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
            $this->db1->order_by('id','desc');
			$this->db1->limit($limit,$off_set);
			$this->db1->where('langCode',$this->session->userdata('web_language'));
			$this->db1->select('*');
			$query = $this->db1->get('GkUpdates');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$id = $row->id;
				$GkContent = $row->GkContent;
				$date = $row->date;

				$array1['id'] = $id;
				$array1['GkContent'] = $GkContent;
				$array1['date']=$date;

				array_push($array, $array1);

			}

			return $array;
		}


		function get_gk_ajax($off_set,$limit)
		{
                       $off_set = ($off_set-1)*15;
		    $array =array();
			$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
            $this->db1->order_by('id','desc');
			$this->db1->limit($limit,$off_set);
			$this->db1->where('langCode',$this->session->userdata('web_language'));
			$this->db1->select('*');
			$query = $this->db1->get('GkUpdates');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$id = $row->id;
				$GkContent = $row->GkContent;
				$date = $row->date;

				$array1['id'] = $id;
				$array1['GkContent'] = $GkContent;
				$array1['date']=$date;

				array_push($array, $array1);

			}

			return json_encode($array);
		}
                

               function get_gk_page()
		{
			$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
                        $this->db1->order_by('id','desc');
                        $this->db1->where('langCode','en');
			$this->db1->select('id');
			$query = $this->db1->get('GkUpdates');

			$page = $query->num_rows();
			$page = $page /15 ;
			return json_encode($page);

		}
		function get_all_set_without_login($type)
		{
			$array =array();
			$this->db->order_by('set_info_id', 'asc');
                        $this->db->where('isactive',1);
			$this->db->where('set_type',$type);
			$this->db->select('set_info.id as set_info_id,set_info.set_type as set_info_type, set_info.pay_type as pay_type, set_info.payment_amount as amount');
			$query = $this->db->get('set_info');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$set_info_id = $row->set_info_id;
				$pay_type = $row->pay_type;
				$set_info_type = $row->set_info_type;
				$amount = $row->amount;
				

				$array1['set_info_id'] = $set_info_id;
				$array1['pay_type'] = $pay_type;
				$array1['set_info_type'] = $set_info_type;
				$array1['amount'] = $amount;
				
				array_push($array, $array1);
 			}
 			return $array;
		}

		function get_lastyear_pdf($type,$userid)
		{
			$array =array();
			$this->db->order_by('set_info_id', 'asc');
			$this->db->where('set_type',$type);
			$this->db->join("user_setpurchage_mapping","set_info.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type = '".$type."' and userid = '".$userid."'",'left');
			$this->db->select('set_info.id as set_info_id,set_info.set_type as set_info_type, set_info.pay_type as pay_type, set_info.payment_amount as amount, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('set_info');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$set_info_id = $row->set_info_id;
				$pay_type = $row->pay_type;
				$set_info_type = $row->set_info_type;
				$amount = $row->amount;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				$userid =  $row->userid;

				$array1['set_info_id'] = $set_info_id;
				$array1['pay_type'] = $pay_type;
				$array1['set_info_type'] = $set_info_type;
				$array1['amount'] = $amount;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;

				array_push($array, $array1);
 			}
 			return $array;
		}

		function get_all_pdf($type,$userid)
    	{
			$array =array();
			if($type == '2')
			{
				$this->db->order_by('pdf_table.id','desc');
			}
			else 
			{
				$this->db->order_by('pdf_table.id','asc');		
			}	
			$this->db->where('pdf_table.type',$type);

			$this->db->join("user_setpurchage_mapping","pdf_table.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type='".$type."' and userid = '".$userid."'",'left');

			$this->db->select('pdf_table.id as pdf_id,pdf_table.amount as pdf_amount,pdf_table.pay_type as pdf_pay_type,pdf_table.isactive_pre,pdf_table.isactive_main,pdf_table.item_id as pdf_item_id, pdf_table.type as pdf_type,pdf_table.name as pdf_name,pdf_table.date as pdf_date, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->pdf_id;
				$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;
				
				$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;
				$pdf_name = $row->pdf_name;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				if($userid!=0)
				   $userid =  $row->userid;
				$isactive_pre = $row->isactive_pre;
				$isactive_main = $row->isactive_main;

				$array1['pdf_id'] = $pdf_id;
				$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;
				
				$array1['pdf_type'] = $pdf_type;
				$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;
				$array1['isactive_main'] = $isactive_main;
				$array1['isactive_pre'] = $isactive_pre;

				array_push($array, $array1);
 			}
 				return $array;
 			//return $this->db->last_query();
		}

     function get_all_pdf_CurrentGk($type,$userid)
    	{
			$array =array();
			$this->db->order_by('pdf_table.date','desc');
			$this->db->where('pdf_table.type',$type);
            $this->db->limit(7);
			$this->db->join("user_setpurchage_mapping","pdf_table.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type='".$type."' and userid = '".$userid."'",'left');

			$this->db->select('pdf_table.id as pdf_id,pdf_table.amount as pdf_amount,pdf_table.pay_type as pdf_pay_type,pdf_table.isactive_pre,pdf_table.isactive_main,pdf_table.item_id as pdf_item_id, pdf_table.type as pdf_type,pdf_table.name as pdf_name,pdf_table.date as pdf_date, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->pdf_id;
				$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;
				
				$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;
				$pdf_name = $row->pdf_name;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				if($userid!=0)
				   $userid =  $row->userid;
				$isactive_pre = $row->isactive_pre;
				$isactive_main = $row->isactive_main;

				$array1['pdf_id'] = $pdf_id;
				$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;
				
				$array1['pdf_type'] = $pdf_type;
				$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;
				$array1['isactive_main'] = $isactive_main;
				$array1['isactive_pre'] = $isactive_pre;

				array_push($array, $array1);
 			}
 				return $array;
 			//return $this->db->last_query();
		}


       function get_impotant_pdf(){
       	    $array = array();
			
			/*$this->db->order_by('pdf_table.id','asc');*/		
				
			
            $this->db->select('*');
            $this->db->where('type','5');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->id;
				/*$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;*/
				
				/*$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;*/
				$pdf_name = $row->name;
				/*$set_type = $row->set_type;
				$item_id = $row->item_id;*/
				/*$userid =  $row->userid;
				$isactive_pre = $row->isactive_pre;
				$isactive_main = $row->isactive_main;*/

				$array1['pdf_id'] = $pdf_id;
				/*$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;*/
				
				//$array1['pdf_type'] = $pdf_type;
				//$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				//$array1['set_type'] = $set_type;
				//$array1['item_id'] = $item_id;
				/*$array1['userid'] = $userid;
				$array1['isactive_main'] = $isactive_main;
				$array1['isactive_pre'] = $isactive_pre;*/

				array_push($array, $array1);
 			}
 				return $array;
       }


		function get_all_pdf_edit()
		{
			$array = array();
			$this->db->select('*');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$id = $row->id;
				$type = $row->type;
				$item_id = $row->item_id;
				$name = $row->name;
				$date = $row->date;
				$pay_type = $row->pay_type;
				$amount = $row->amount;
				$pdf_link = $row->pdf_link;
				$size =  $row->size;
				$download = $row->download;
				$discription = $row->discription;
				$isactive_pre = $row->isactive_pre;
				$isactive_main = $row->isactive_main;

				

				$array1['id'] = $id;
				$array1['type'] = $type;
				$array1['item_id'] = $item_id;
				$array1['name'] = $name;
				
				$array1['date'] = $date;
				$array1['pay_type'] = $pay_type;
				$array1['amount'] = $amount;
				$array1['pdf_link'] = $pdf_link;
				$array1['size'] = $size;
				$array1['download'] = $download;
				$array1['discription'] = $discription;
				$array1['isactive_pre'] = $isactive_pre;
				$array1['isactive_main'] = $isactive_main;

				array_push($array, $array1);
 			}
 				return $array;
		}



		function submit_edit_pdf($id,$name,$date,$pay_type,$amount,$discription,$isactive_pre,$isactive_main)
		{
			$data = array(
               'name' => $name,
               'date' => $date,
               'pay_type' => $pay_type,
               'amount' => $amount,
               'discription' => $discription,
               'isactive_pre' => $isactive_pre,
               'isactive_main' => $isactive_main
            );

	     	$this->db->where('id', $id);
			$flag = $this->db->update('pdf_table', $data); 
			
			if($flag)
			{
				return json_encode("success");

			}
			else
			{
				return json_encode("not success");
			}

		}


                function importantpdf($type,$userid)
		{
			$array =array();
			
			$this->db->order_by('pdf_table.id','desc');
			$this->db->where('pdf_table.type',$type);

			$this->db->join("user_setpurchage_mapping","pdf_table.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type='".$type."' and userid = '".$userid."'",'left');

			$this->db->select('pdf_table.id as pdf_id,pdf_table.pdf_link,pdf_table.discription,pdf_table.size,pdf_table.download,pdf_table.amount as pdf_amount,pdf_table.pay_type as pdf_pay_type,pdf_table.item_id as pdf_item_id, pdf_table.type as pdf_type,pdf_table.name as pdf_name,pdf_table.date as pdf_date, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->pdf_id;
				$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;
				$pdf_link = $row->pdf_link;
				$size = $row->size;
				$discription = $row->discription;
				$download = $row->download;
				$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;
				$pdf_name = $row->pdf_name;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				$userid =  $row->userid;

				$array1['pdf_id'] = $pdf_id;
				$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;

				$array1['pdf_link'] = $pdf_link;
				$array1['size'] = $size;
				$array1['download'] = $download;
				$array1['discription'] = $discription;
				
				$array1['pdf_type'] = $pdf_type;
				$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;

				array_push($array, $array1);
 			}
 				return $array;
		}


        function purchageditem($userid)
    	{
			$thisuserid = $userid  ;
			$array2 =array();
			$type =2;
			$all_type_array = array();
			$this->db->order_by('pdf_table.id','asc');
			$this->db->where('pdf_table.type',$type);

			$this->db->join("user_setpurchage_mapping","pdf_table.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type='".$type."' and userid = '".$thisuserid."'",'left');

			$this->db->select('pdf_table.id as pdf_id,pdf_table.amount as pdf_amount,pdf_table.pay_type as pdf_pay_type,pdf_table.item_id as pdf_item_id, pdf_table.type as pdf_type,pdf_table.name as pdf_name,pdf_table.date as pdf_date, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->pdf_id;
				$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;
				
				$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;
				$pdf_name = $row->pdf_name;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				$userid =  $row->userid;

				$array1['pdf_id'] = $pdf_id;
				$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;
				
				$array1['pdf_type'] = $pdf_type;
				$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;

				array_push($array2, $array1);
 			}
 			array_push($all_type_array, $array2);




 			$array3 =array();
 			$type =4;
			$this->db->order_by('pdf_table.id','asc');
			$this->db->where('pdf_table.type',$type);

			$this->db->join("user_setpurchage_mapping","pdf_table.item_id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type='".$type."' and userid = '".$thisuserid."'",'left');

			$this->db->select('pdf_table.id as pdf_id,pdf_table.amount as pdf_amount,pdf_table.pay_type as pdf_pay_type,pdf_table.item_id as pdf_item_id, pdf_table.type as pdf_type,pdf_table.name as pdf_name,pdf_table.date as pdf_date, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->pdf_id;
				$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;
				
				$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;
				$pdf_name = $row->pdf_name;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				$userid =  $row->userid;

				$array1['pdf_id'] = $pdf_id;
				$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;
				
				$array1['pdf_type'] = $pdf_type;
				$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;

				array_push($array3, $array1);
 			}
 			array_push($all_type_array, $array3);


 			$array4 = array();
 			$type =3;
			$this->db->order_by('set_info_id', 'asc');
			$this->db->where('set_info.set_type',$type);
			$this->db->join("user_setpurchage_mapping","set_info.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type = '".$type."' and userid = '".$thisuserid."'",'left');
			$this->db->select('set_info.id as set_info_id,set_info.name as name,set_info.set_type as set_info_type, set_info.pay_type as pay_type, set_info.payment_amount as amount, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('set_info');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$set_info_id = $row->set_info_id;
				$pay_type = $row->pay_type;
				$set_info_type = $row->set_info_type;
				$amount = $row->amount;
				$name = $row->name;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				$userid =  $row->userid;

				$array1['set_info_id'] = $set_info_id;
				$array1['pay_type'] = $pay_type;
				$array1['set_info_type'] = $set_info_type;
				$array1['amount'] = $amount;
				$array1['name'] = $name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;

				array_push($array4, $array1);
 			}
 			array_push($all_type_array, $array4);


 			return $all_type_array;
 		//return $this->db->last_query();



		}
                function examalert()
		{
			$array =array();
			$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
                        $this->db1->order_by('Id','desc');
			$this->db1->limit('10','0');
			$this->db1->select('Id,Name,OpeningDate,OnlineLastDate,link');
			$query = $this->db1->get('XamAlert_Details');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$name = $row->Name;
				$openingdate = $row->OpeningDate;
				$lastdate  = $row->OnlineLastDate;
				$link = $row->link;
				

				$array1['name'] = $name;
				$array1['openingdate'] = $openingdate;
				$array1['lastdate']= $lastdate;
				$array1['link'] = $link;
				

				array_push($array, $array1);

			}		
			return json_encode($array);	
		}

		//////////////////////////////////////////////////////download


		function updatedownload($id)
		{
			$download =0;
			$this->db->where('id',$id);
			$this->db->select('download');
			$query=	$this->db->get('pdf_table');

			foreach ($query->result() as  $row) 
			{
				$download = $row->download;

			}

			$data=array
			(
				'download' =>(int)($download+1),
			);

			$this->db->where('id',$id);
	        $this->db->update('pdf_table',$data);
                     return json_encode("success");
    	}



    	function download($userid,$product_type,$price_type)
    	{
    		$counting_array = array();
    		$final_array = array();

    		$this->db->where('type','4');
    		$this->db->where('isactive_main',1);
    		$this->db->select('id');
    		$a = $this->db->get('pdf_table');
    		$all_main_set = $a->num_rows(); 

    		$this->db->where('type','2');
    		$this->db->select('id');
    		$b = $this->db->get('pdf_table');
    		$all_gk_pdf = $b->num_rows();

    		$this->db->where('type','5');
    		$this->db->select('id');
    		$c = $this->db->get('pdf_table');
    		$all_important_pdf = $c->num_rows();

    		$this->db->where('pay_type','0');
    		$this->db->select('id');
    		$d = $this->db->get('pdf_table');
    		$all_free_pdf = $d->num_rows();

    		$this->db->where('pay_type','1');
    		$this->db->select('id');
    		$e = $this->db->get('pdf_table');
    		$all_paid_pdf = $e->num_rows();

    		$counting_array[0] = $all_gk_pdf;
    		$counting_array[1] = $all_main_set;
    		$counting_array[2] = $all_important_pdf;
    		$counting_array[3] = $all_free_pdf;
    		$counting_array[4] = $all_paid_pdf;



    		$a = sizeof($product_type);
    		$b = sizeof($price_type);
    		$where = "";
    		$where1 = "";
    		for($i=0;$i < $a;$i++)
    		{
    			if($i == 0)
    			{
    				if($product_type[$i] == "")
    				{
    					$where = $where.'(';
    				}
    				else
    				{
    					$where = $where.'(pdf_table.type="'.$product_type[$i].'"';	
    				}
    				
    			}
    			else if($i == ($a-1))
    			{
    				if($product_type[$i] == "")
    				{
    					$where =$where.')';	
    				}
    				else
    				{
    					if($product_type[$i-1] == "" && $where == '(')
    					{
    						$where =$where.' pdf_table.type = "'.$product_type[$i].'")';		
    					}
    					else
    					{
    						$where =$where.' or pdf_table.type = "'.$product_type[$i].'")';		
    					}
    						
    				}
    				
    			}
    			else
    			{
    				if($product_type[$i] == "")
    				{
    					
    				}
    				else
    				{
    					if($product_type[$i-1] == "" && $where == '(')
    					{
    						$where =$where.' pdf_table.type = "'.$product_type[$i].'"';	
    					}
    					else
    					{
    						$where =$where.' or pdf_table.type = "'.$product_type[$i].'"';		
    					}
    					
    				}
    				
    			}
    		}
    		 





    		for($j = 0; $j < $b;$j++)
    		{
    			if($j == 0)
    			{
    				if($price_type[$j] == "")
    				{
    					$where1 = $where1.'(';
    				}
    				else
    				{
    					$where1 = $where1.'(pdf_table.pay_type="'.$price_type[$j].'"';

    				}
    				
    			}
    			else if($j == ($b-1))
    			{
    				if($price_type[$j] == "")
    				{
    					$where1 =$where1.')';	
    				}
    				else
    				{
    					if($price_type[$j-1] == "" && $where1 == '(')
    					{
    					 	$where1 =$where1.' pdf_table.pay_type = "'.$price_type[$j].'")';	
						}
						else
						{
							$where1 =$where1.' or pdf_table.pay_type = "'.$price_type[$j].'")';	
						}
    				}
    				
    			}
    			else
    			{
    				if($price_type[$j] == "")
    				{
    						
    				}
    				else
    				{
    					if($price_type[$j-1] == "" && $where1 == '(')
    					{
    						
    						$where1 =$where1.' pdf_table.pay_type = "'.$price_type[$j].'"';		
    					}
    					else
    					{
    						$where1 =$where1.' or pdf_table.pay_type = "'.$price_type[$j].'"';
    					}
    					
    				}
    			}
    		}
    		$array =array();
			$this->db->order_by('pdf_table.id','desc');
			if($where !== '()')
			{
    			$this->db->where($where);	
    		}

    		if($where1 !== '()')
			{
    				$this->db->where($where1);	
    		}
    	
			
			$this->db->join("user_setpurchage_mapping","pdf_table.item_id = user_setpurchage_mapping.item_id and pdf_table.type = user_setpurchage_mapping.type and userid = '".$userid."'",'left');

			$this->db->select('pdf_table.id as pdf_id,pdf_table.amount as pdf_amount,pdf_table.pay_type as pdf_pay_type,pdf_table.isactive_pre,pdf_table.isactive_main,pdf_table.item_id as pdf_item_id, pdf_table.type as pdf_type,pdf_table.name as pdf_name,pdf_table.date as pdf_date, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->pdf_id;
				$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;
				
				$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;
				$pdf_name = $row->pdf_name;
				$set_type = $row->set_type;
				$item_id = $row->item_id;
				$userid =  $row->userid;
				$isactive_pre = $row->isactive_pre;
				$isactive_main = $row->isactive_main;

				$array1['pdf_id'] = $pdf_id;
				$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;
				
				$array1['pdf_type'] = $pdf_type;
				$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;
				$array1['isactive_main'] = $isactive_main;
				$array1['isactive_pre'] = $isactive_pre;
				$array1['all_gk_pdf'] = $all_gk_pdf;
				$array1['all_main_set'] = $all_main_set;
				$array1['all_important_pdf'] = $all_important_pdf;

				array_push($array, $array1);
 			}
 				array_push($final_array, $array);
 				array_push($final_array,$counting_array);
 				return $final_array;
 			//return $this->db->last_query();
    	}



    	function download_single($userid,$pdf_type,$pdf_item_id)
    	{
    		$array =array();
			$this->db->order_by('pdf_table.id','desc');
			$this->db->where('pdf_table.type',$pdf_type);	
    		$this->db->where('pdf_table.item_id',$pdf_item_id);	
    		
    		$this->db->join("user_setpurchage_mapping","pdf_table.item_id = user_setpurchage_mapping.item_id and pdf_table.type = user_setpurchage_mapping.type and userid = '".$userid."'",'left');

			$this->db->select('pdf_table.id as pdf_id,pdf_table.amount as pdf_amount,pdf_table.pay_type as pdf_pay_type,pdf_table.isactive_pre,pdf_table.pdf_link,pdf_table.isactive_main,pdf_table.item_id as pdf_item_id, pdf_table.type as pdf_type,pdf_table.name as pdf_name,pdf_table.date as pdf_date,pdf_table.discription, user_setpurchage_mapping.type as set_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('pdf_table');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$pdf_id = $row->pdf_id;
				$pdf_amount = $row->pdf_amount;
				$pdf_pay_type = $row->pdf_pay_type;
				$pdf_item_id = $row->pdf_item_id;
				
				$pdf_type = $row->pdf_type;
				$pdf_date = $row->pdf_date;
				$pdf_name = $row->pdf_name;
				$set_type = $row->set_type;
				$pdf_link = $row->pdf_link;
				$item_id = $row->item_id;
				$userid =  $row->userid;
				$discription = $row->discription;
				$isactive_pre = $row->isactive_pre;
				$isactive_main = $row->isactive_main;

				$array1['pdf_id'] = $pdf_id;
				$array1['pdf_pay_type'] = $pdf_pay_type;
				$array1['pdf_amount'] = $pdf_amount;
				$array1['pdf_item_id'] = $pdf_item_id;
				$array1['discription'] = $discription;
				$array1['pdf_link'] = $pdf_link;

				$array1['pdf_type'] = $pdf_type;
				$array1['pdf_date'] = $pdf_date;
				$array1['pdf_name'] = $pdf_name;
				$array1['set_type'] = $set_type;
				$array1['item_id'] = $item_id;
				$array1['userid'] = $userid;
				$array1['isactive_main'] = $isactive_main;
				$array1['isactive_pre'] = $isactive_pre;

				array_push($array, $array1);
 			}
 				return $array;
 			//return $this->db->last_query();
    	}




    	function get_top_five_months_current_affairs()
    	{
    		$array = array();
    		$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
			$this->db1->group_by('MONTH(date), YEAR(date)');
			$this->db1->order_by('id','desc');
			$this->db1->limit(5,0);
			$this->db1->select('*');
			$query = $this->db1->get('GkUpdates');
			foreach ($query->result() as  $row) 
			{
				array_push($array,$row->date);
			}
			//return $this->db1->last_query();
			return $array;

                       
    	}

    	function get_last_update_date($lang)
    	{
    		$array = array();
    		$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
			$this->db1->group_by('date');
			$this->db1->order_by('id','desc');
			$this->db1->limit(1,0);
			$this->db1->where('langCode',$lang);
			$this->db1->select('*');
			$query = $this->db1->get('GkUpdates');
			foreach ($query->result() as  $row) 
			{
				array_push($array,$row->date);
			}
			//return $this->db1->last_query();
			return $array[0];

    	}

    	function get_last_update_gk($date)
    	{
    		$array = array();
    		$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
			$this->db1->order_by('id','desc');
			$this->db1->like('date',$date);
			$this->db1->where('langCode',$this->session->userdata('web_language'));
			$this->db1->select('*');
			$query = $this->db1->get('GkUpdates');
			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$id = $row->id;
				$GkContent = $row->GkContent;
				$date = $row->date;

				$array1['id'] = $id;
				$array1['GkContent'] = $GkContent;
				$array1['date']=$date;

				array_push($array, $array1);

			}
			return $array;
    	}


    	function get_gk_by_month($monthdate,$lang)
    	{
    		$array = array();
    		$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
			$this->db1->group_by('date, MONTH(date)');
			$this->db1->order_by('id','desc');
			//$this->db1->limit(5,0);
			$this->db1->like('date',$monthdate);
			$this->db1->where('langCode',$lang);
			$this->db1->select('*');
			$query = $this->db1->get('GkUpdates');
			foreach ($query->result() as  $row) 
			{
				array_push($array,$row->date);
			}
			//return $this->db1->last_query();
			return $array;
    	}


/////////////////////////////////////////////////daily test


    	function daily_test_exam($cat)
    	{
    		$cat1 = $cat;
    		if($cat1 == 'current_affaire')
    		{
    			$lang = $this->session->userdata('web_language');

	    		$CI = &get_instance();
				$this->db1 = $CI->load->database('db1', TRUE);
				$final_array = array();
				$array = array();
				$queston_array = array();
				$this->db1->limit(120,0);
				$this->db1->where('LangId',$lang);
				$this->db1->select('date');
				$this->db1->group_by('date'); 
	 			//$this->db1->order_by('QuesId', 'desc'); 
	 			$this->db1->order_by('date', 'desc'); 
	 			$query=$this->db1->get('currentGKQrecord');

	 			$a = 0;
	 			foreach ($query->result() as  $row) 
				{
					$date = $row->date;
					array_push($array,$date);
					if($a == 0)
					{
						
						$this->db1->like('date',$date);
						$this->db1->order_by('QuesId','desc');
						$this->db1->select('*');
						$query1 = $this->db1->get('currentGKQrecord');
						foreach ($query1->result() as $row1) 
						{
							$opt_array = array(); 
							$q_id = $row1->QuesId;
							$q_text = $row1->Question;
							$answer = $row1->correctOption;
							$solution = $row1->Solution;
							$q_date = $row1->date;

							$this->db1->where('QuesId',$q_id);
							$this->db1->select('*');
							$query2 = $this->db1->get('currentGKOptions');
							foreach ($query2->result() as $row2)
							{

								$option_text = $row2->OptionText;
								$option_no = $row2->OptionNo;

								$opt['option_text'] = $option_text;
								$opt['option_no'] = $option_no;

								array_push($opt_array,$opt);
							}

							$queston_array_single = array();

							$queston_array_single['id'] = $q_id;
							$queston_array_single['q_text'] = $q_text;
							$queston_array_single['answer'] = $answer;
							$queston_array_single['solution'] = $solution;
							$queston_array_single['q_date'] = $q_date;
							$queston_array_single['options'] =$opt_array;
							array_push($queston_array, $queston_array_single);
						}
					}
					$a++;
				}
				array_push($final_array,$array);
				array_push($final_array,$queston_array);
				return $final_array;
    		}
    		else
    		{
    			$array = array();
    			$final_array = array();

    			

    			$this->db->where('daily_test_table.category',$cat1);
    			$this->db->join("category_table","category_table.id = daily_test_table.category");
    			$this->db->select('category_table.id as categoryid,category_table.category as catname,daily_test_table.id as daily_test_id,daily_test_table.category as daily_test_cat,daily_test_table.dates as daily_test_date');
    			$query = $this->db->get('daily_test_table');
    			foreach ($query->result() as  $row) 
				{
					$array1 = array();
					$array1['test_no'] = $row->daily_test_id;
					$array1['name'] = $row->catname;
					$array1['category'] =  $row->daily_test_cat;
					$array1['date'] = $row->daily_test_date;

					array_push($array,$array1);
				}

				array_push($final_array,$array);
				return $final_array;
    		}
    		
    	}
    	


    	function get_daily_test_date()
    	{
    		$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
			$this->db1->limit(1,0);
			$this->db1->select('date');
			$this->db1->group_by('date'); 
 			$this->db1->order_by('QuesId', 'desc'); 
 			$query=$this->db1->get('currentGKQrecord');
 			foreach ($query->result() as  $row) 
			{
				$date = $row->date;
				return $date;
			}

    	}

    	function get_daily_test_current_affaire_question($date,$lang)
    	{
    		//return json_encode($date);	
    		$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
    				$queston_array = array();
    				$this->db1->like('date',$date);
    				$this->db1->where('LangId',$lang);
					$this->db1->order_by('QuesId','desc');
					$this->db1->select('*');
					$query1 = $this->db1->get('currentGKQrecord');
					foreach ($query1->result() as $row1) 
					{
						$opt_array = array(); 
						$q_id = $row1->QuesId;
						$q_text = $row1->Question;
						$answer = $row1->correctOption;
						$solution = $row1->Solution;
						$q_date = $row1->date;

						$this->db1->where('QuesId',$q_id);
						$this->db1->select('*');
						$query2 = $this->db1->get('currentGKOptions');
						foreach ($query2->result() as $row2)
						{

							$option_text = $row2->OptionText;
							$option_no = $row2->OptionNo;

							$opt['option_text'] = $option_text;
							$opt['option_no'] = $option_no;
							$opt['optimg']="";

							array_push($opt_array,$opt);
						}

						$queston_array_single = array();

						$queston_array_single['id'] = $q_id;
						$queston_array_single['q_text'] = $q_text;
						$queston_array_single['answer'] = $answer;
						$queston_array_single['solution'] = $solution;
						$queston_array_single['q_date'] = $q_date;
						$queston_array_single['options'] =$opt_array;
						$queston_array_single['status'] ="0";
						$queston_array_single['u_answer'] ='';
						$queston_array_single['q_img'] = "";
						$queston_array_single['solution_img'] = "";
						$queston_array_single['pretext']= "";
						$queston_array_single	['pretext_image']="";
						array_push($queston_array, $queston_array_single);
					}
				return json_encode($queston_array);	
    	}



    	function get_daily_test_question($cat,$testno,$lang)
    	{
    		//return json_encode($date);	
    		
    				
					$queston_array = array();
					$this->db->where('qrecord.lang_id',$lang);
					$this->db->where('ques_info.quescatid',$cat);
					$this->db->where('ques_info.daily_test',1);
					$this->db->where('ques_info.test_no',$testno);
					$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
					$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
					$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
					$query = $this->db->get('qrecord');
					foreach ($query->result() as  $row) 
					{
						$option_array= array();
						$id = $row->id;
						$ques_info_id = $row->ques_info_id;
						$catid =$row->quescatid;
						$question = nl2br($row->ques_text);
						$correctopt=$row->correctopt;
						$lang_id = $row->lang_id;
						$solution =  nl2br($row->sol_text);
						$q_image = $row->ques_image;
						$solutionimg = $row->sol_image;
						$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

						$this->db->where('QuesId='.$id);
						$this->db->select('*');
						$query1 = $this->db->get('options');
						
						foreach($query1->result() as $row1)
						{
							
							$opt['option_text'] =$row1->OptionText;
							if($row1->image != "")
							{
								$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
							}
							else
							{
								$opt['optimg'] = "";		
							}
							if($opt['option_text'] !=="" || $opt['optimg'] !== "")
							{
								array_push($option_array,$opt);
							}
							
						}
				
						$array1= array();
						$array1['id']= $id;
						$array1['ques_info_id']= $ques_info_id;
						$array1['catid'] =$catid;
						$array1['q_text']=$question;
						$array1['status'] ="0";
						$array1['u_answer'] ='';
						$array1['answer']=$correctopt;
						$array1['solution']=$solution;
						$array1['options'] =$option_array;
						if($q_image == "")
						{
							$array1['q_img'] = $q_image;	
						}
						else
						{
							$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
						}
						if($solutionimg == "")
						{
							$array1['solution_img']=$solutionimg;	
						}
						else
						{
							$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
						}
						if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                            if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }    
                        }
						

						array_push($queston_array,$array1);

					}
				return json_encode($queston_array);				
    	}




        function getexamquestion()
		{

			$set_no = $this->session->userdata('set_no');
			$english_categoryid = array(
					19,
					21,
					22,
					23,
					24,
					47,
					48
					);
			$reasoning_categoryid = array(
	/*reasoning*/	6,
					//,
					8,
					9,
					10,
					11,
					12,
					13,
					//14=>1,
					15,
					16,
					17,
					18,
					);
			$math_categoryid = array(

	/*Maths*/		25,
					26,
					27,
					28,
					29,
					30,
					31,
					32,
					33,
					34,
					35,
					36,
					37,
					38,
					39,
					43,
					44,
					45,
					46
					);
			$gk_categoryid =array(
					
	/*GK*/			41,
					42
					     	);
					
			$computer_categoryid = array(5);



			$set_no = $this->session->userdata('set_no');
			$type = $this->session->userdata('section');

			if($type == 'pre')
			
			{
				$array_hindi = array();
				 $array2_hindi = array();
				 $array3_hindi=array();
				 $array4_hindi=array();
				 $array5_hindi=array();

				 	$array_english = array();
				 $array2_english = array();
				 $array3_english=array();
				 $array4_english=array();
				 $array5_english=array();
				 

				 $array_section_hindi=array();
				 $array_section_english=array();

				 $array_main = array();
					
					$this->db->where('set_no',$set_no);
					$this->db->like('type',$type);
					$this->db->where_in('quescatid',$reasoning_categoryid);
					$this->db->order_by('qrecord.id','asc');
					$this->db->limit('80');
					$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
					$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
					$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
					$query = $this->db->get('qrecord');
					foreach ($query->result() as  $row) 
					{
						$option_array= array();
						$id = $row->id;
						$ques_info_id = $row->ques_info_id;
						$catid =$row->quescatid;
						$question = nl2br($row->ques_text);
						$correctopt=$row->correctopt;
						$lang_id = $row->lang_id;
						$solution =  nl2br($row->sol_text);
						$q_image = $row->ques_image;
						$solutionimg = $row->sol_image;
						$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

						$this->db->where('QuesId='.$id);
						$this->db->select('*');
						$query1 = $this->db->get('options');
						
						foreach($query1->result() as $row1)
						{
							
							$opt['opttext'] =$row1->OptionText;
							if($row1->image != "")
							{
								$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
							}
							else
							{
								$opt['optimg'] = "";		
							}
							if($opt['opttext'] !=="" || $opt['optimg'] !== "")
							{
								array_push($option_array,$opt);
							}
							
						}
				
						$array1= array();
						$array1['id']= $id;
						$array1['ques_info_id']= $ques_info_id;
						$array1['catid'] =$catid;
						$array1['question']=$question;
						$array1['answer']=-1;
						$array1['status']="";
						$array1['correctopt']=$correctopt;
						$array1['solution']=$solution;
						$array1['option'] =$option_array;
						if($q_image == "")
						{
							$array1['q_img'] = $q_image;	
						}
						else
						{
							$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
						}
						if($solutionimg == "")
						{
							$array1['solution_img']=$solutionimg;	
						}
						else
						{
							$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
						}
						if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                            if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }    
                        }
						

						if($lang_id == 'hi')
						{
							array_push($array_hindi,$array1);
						}
						else
						{
							array_push($array_english,$array1);
						}	

					}
					array_push($array_section_hindi,$array_hindi);
					array_push($array_section_english,$array_english);




					$this->db->where('set_no',$set_no);
					$this->db->like('type',$type);
					$this->db->where_in('quescatid',$english_categoryid);
					$this->db->order_by('qrecord.id','asc');
					$this->db->limit('80');
					$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
					$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
					$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
					$query = $this->db->get('qrecord');
					foreach ($query->result() as  $row) 
					{
						$option_array= array();
						$id = $row->id;
						$ques_info_id =$row->ques_info_id;
						$catid =$row->quescatid;
						$question = nl2br($row->ques_text);
						$correctopt=$row->correctopt;
						$lang_id = $row->lang_id;
						$solution =  nl2br($row->sol_text);
						$q_image = $row->ques_image;
						$solutionimg = $row->sol_image;

						$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

						$this->db->where('QuesId='.$id);
						$this->db->select('*');
						$query1 = $this->db->get('options');
						
						foreach($query1->result() as $row1)
						{
							
							$opt['opttext'] =$row1->OptionText;
							if($row1->image != "")
							{
								$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
							}
							else
							{
								$opt['optimg'] = "";		
							}
							if($opt['opttext'] !=="" || $opt['optimg'] !== "")
							{
								array_push($option_array,$opt);
							}
							
						}
				
						$array1= array();
						$array1['id']= $id;
						$array1['ques_info_id']= $ques_info_id;
						$array1['catid'] =$catid;
						$array1['question']=$question;
						$array1['answer']=-1;
						$array1['status']="";
						$array1['correctopt']=$correctopt;
						$array1['solution']=$solution;
						$array1['option'] =$option_array;
						if($q_image == "")
						{
							$array1['q_img'] = $q_image;	
						}
						else
						{
							$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
						}
						if($solutionimg == "")
						{
							$array1['solution_img']=$solutionimg;	
						}
						else
						{
							$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
						}
						
						if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                           if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }    
                        }
					
							array_push($array2_hindi,$array1);
							array_push($array2_english,$array1);
					
					}
						array_push($array_section_hindi,$array2_hindi);
					array_push($array_section_english,$array2_english);




					$this->db->where('set_no',$set_no);
					$this->db->like('type',$type);
					$this->db->where_in('quescatid',$math_categoryid);
					$this->db->order_by('qrecord.id','asc');
					$this->db->limit('80');
					$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
					$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
					$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
					$query = $this->db->get('qrecord');
					foreach ($query->result() as  $row) 
					{
						$option_array= array();
						$id = $row->id;
						$ques_info_id = $row->ques_info_id;
						$catid =$row->quescatid;
						$question = nl2br($row->ques_text);
						$correctopt=$row->correctopt;
						$lang_id = $row->lang_id;
						$solution =  nl2br($row->sol_text);
						$q_image = $row->ques_image;
						$solutionimg = $row->sol_image;

						$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

						$this->db->where('QuesId='.$id);
						$this->db->select('*');
						$query1 = $this->db->get('options');
						
						foreach($query1->result() as $row1)
						{
							
							$opt['opttext'] =$row1->OptionText;
							if($row1->image != "")
							{
								$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
							}
							else
							{
								$opt['optimg'] = "";		
							}
							if($opt['opttext'] !=="" || $opt['optimg'] !== "")
							{
								array_push($option_array,$opt);
							}
							
						}
				
						$array1= array();
						$array1['id']= $id;
						$array1['ques_info_id']= $ques_info_id;
						$array1['catid'] =$catid;
						$array1['question']=$question;
						$array1['answer']=-1;
						$array1['status']="";
						$array1['correctopt']=$correctopt;
						$array1['solution']=$solution;
						$array1['option'] =$option_array;
						if($q_image == "")
						{
							$array1['q_img'] = $q_image;	
						}
						else
						{
							$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
						}
						if($solutionimg == "")
						{
							$array1['solution_img']=$solutionimg;	
						}
						else
						{
							$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
						}


						if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }


                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                           if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }  
                        }


						if($lang_id == 'hi')
						{
							array_push($array3_hindi,$array1);
						}
						else
						{
							array_push($array3_english,$array1);
						}
					}	
						array_push($array_section_hindi,$array3_hindi);
					array_push($array_section_english,$array3_english);





					array_push($array_main,$array_section_hindi);
					array_push($array_main,$array_section_english);
					
					return json_encode($array_main);

			}	
			else
			{
				$array_hindi = array();
			 $array2_hindi = array();
			 $array3_hindi=array();
			 $array4_hindi=array();
			 $array5_hindi=array();

			 	$array_english = array();
			 $array2_english = array();
			 $array3_english=array();
			 $array4_english=array();
			 $array5_english=array();
			 

			 $array_section_hindi=array();
			 $array_section_english=array();

			 $array_main = array();
				
				$this->db->where('set_no',$set_no);
				$this->db->like('type',$type);
				$this->db->where_in('quescatid',$reasoning_categoryid);
				$this->db->order_by('qrecord.id','asc');
				$this->db->limit('80');
				$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
				$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
				$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
				$query = $this->db->get('qrecord');
				foreach ($query->result() as  $row) 
				{
					$option_array= array();
					$id = $row->id;
					$ques_info_id = $row->ques_info_id;
					$catid =$row->quescatid;
					$question = nl2br($row->ques_text);
					$correctopt=$row->correctopt;
					$lang_id = $row->lang_id;
					$solution =  nl2br($row->sol_text);
					$q_image = $row->ques_image;
					$solutionimg = $row->sol_image;

					$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

					$this->db->where('QuesId='.$id);
					$this->db->select('*');
					$query1 = $this->db->get('options');
					
					foreach($query1->result() as $row1)
					{
						
						$opt['opttext'] =$row1->OptionText;
						if($row1->image != "")
						{
							$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
						}
						else
						{
							$opt['optimg'] = "";		
						}
						if($opt['opttext'] !=="" || $opt['optimg'] !== "")
						{
							array_push($option_array,$opt);
						}
						
					}
			
					$array1= array();
					$array1['id']= $id;
					$array1['ques_info_id']= $ques_info_id;
					$array1['catid'] =$catid;
					$array1['question']=$question;
					$array1['answer']=-1;
					$array1['status']="";
					$array1['correctopt']=$correctopt;
					$array1['solution']=$solution;
					$array1['option'] =$option_array;
					if($q_image == "")
					{
						$array1['q_img'] = $q_image;	
					}
					else
					{
						$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
					}
					if($solutionimg == "")
					{
						$array1['solution_img']=$solutionimg;	
					}
					else
					{
						$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
					}

					if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                            if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }    
                        }

					if($lang_id == 'hi')
					{
						array_push($array_hindi,$array1);
					}
					else
					{
						array_push($array_english,$array1);
					}	

				}
				array_push($array_section_hindi,$array_hindi);
				array_push($array_section_english,$array_english);




				$this->db->where('set_no',$set_no);
				$this->db->like('type',$type);
				$this->db->where_in('quescatid',$english_categoryid);
				$this->db->order_by('qrecord.id','asc');
				$this->db->limit('80');
				$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
				$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
				$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
				$query = $this->db->get('qrecord');
				foreach ($query->result() as  $row) 
				{
					$option_array= array();
					$id = $row->id;
					$ques_info_id =$row->ques_info_id;
					$catid =$row->quescatid;
					$question = nl2br($row->ques_text);
					$correctopt=$row->correctopt;
					$lang_id = $row->lang_id;
					$solution =  nl2br($row->sol_text);
					$q_image = $row->ques_image;
					$solutionimg = $row->sol_image;

					$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

					$this->db->where('QuesId='.$id);
					$this->db->select('*');
					$query1 = $this->db->get('options');
					
					foreach($query1->result() as $row1)
					{
						
						$opt['opttext'] =$row1->OptionText;
						if($row1->image != "")
						{
							$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
						}
						else
						{
							$opt['optimg'] = "";		
						}
						if($opt['opttext'] !=="" || $opt['optimg'] !== "")
						{
							array_push($option_array,$opt);
						}
						
					}
			
					$array1= array();
					$array1['id']= $id;
					$array1['ques_info_id']= $ques_info_id;
					$array1['catid'] =$catid;
					$array1['question']=$question;
					$array1['answer']=-1;
					$array1['status']="";
					$array1['correctopt']=$correctopt;
					$array1['solution']=$solution;
					$array1['option'] =$option_array;
					if($q_image == "")
					{
						$array1['q_img'] = $q_image;	
					}
					else
					{
						$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
					}
					if($solutionimg == "")
					{
						$array1['solution_img']=$solutionimg;	
					}
					else
					{
						$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
					}

					if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                            if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }    
                        }
				
						array_push($array2_hindi,$array1);
			
				
				
						array_push($array2_english,$array1);
				
				}
					array_push($array_section_hindi,$array2_hindi);
				array_push($array_section_english,$array2_english);




				$this->db->where('set_no',$set_no);
				$this->db->like('type',$type);
				$this->db->where_in('quescatid',$math_categoryid);
				$this->db->order_by('qrecord.id','asc');
				$this->db->limit('80');
				$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
				$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
				$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
				$query = $this->db->get('qrecord');
				foreach ($query->result() as  $row) 
				{
					$option_array= array();
					$id = $row->id;
					$ques_info_id = $row->ques_info_id;
					$catid =$row->quescatid;
					$question = nl2br($row->ques_text);
					$correctopt=$row->correctopt;
					$lang_id = $row->lang_id;
					$solution =  nl2br($row->sol_text);
					$q_image = $row->ques_image;
					$solutionimg = $row->sol_image;

					$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

					$this->db->where('QuesId='.$id);
					$this->db->select('*');
					$query1 = $this->db->get('options');
					
					foreach($query1->result() as $row1)
					{
						
						$opt['opttext'] =$row1->OptionText;
						if($row1->image != "")
						{
							$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
						}
						else
						{
							$opt['optimg'] = "";		
						}
						if($opt['opttext'] !=="" || $opt['optimg'] !== "")
						{
							array_push($option_array,$opt);
						}
						
					}
			
					$array1= array();
					$array1['id']= $id;
					$array1['ques_info_id']= $ques_info_id;
					$array1['catid'] =$catid;
					$array1['question']=$question;
					$array1['answer']=-1;
					$array1['status']="";
					$array1['correctopt']=$correctopt;
					$array1['solution']=$solution;
					$array1['option'] =$option_array;
					if($q_image == "")
					{
						$array1['q_img'] = $q_image;	
					}
					else
					{
						$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
					}
					if($solutionimg == "")
					{
						$array1['solution_img']=$solutionimg;	
					}
					else
					{
						$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
					}

					if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                            if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newonlinexamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }   
                        }

					if($lang_id == 'hi')
					{
						array_push($array3_hindi,$array1);
					}
					else
					{
						array_push($array3_english,$array1);
					}
				}	
					array_push($array_section_hindi,$array3_hindi);
				array_push($array_section_english,$array3_english);




				$this->db->where('set_no',$set_no);
				$this->db->like('type',$type);
				$this->db->where_in('quescatid',$gk_categoryid);
				$this->db->order_by('qrecord.id','asc');
				$this->db->limit('80');
				$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
				$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
				$this->db->select('ques_info.quesid as ques_info_id,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
				$query = $this->db->get('qrecord');
				foreach ($query->result() as  $row) 
				{
					$option_array= array();
					$id = $row->id;
					$ques_info_id = $row->ques_info_id;
					$catid =$row->quescatid;
					$question = nl2br($row->ques_text);
					$correctopt=$row->correctopt;
					$lang_id = $row->lang_id;
					$solution =  nl2br($row->sol_text);
					$q_image = $row->ques_image;
					$solutionimg = $row->sol_image;

					$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

					$this->db->where('QuesId='.$id);
					$this->db->select('*');
					$query1 = $this->db->get('options');
					
					foreach($query1->result() as $row1)
					{
						
						$opt['opttext'] =$row1->OptionText;
						if($row1->image != "")
						{
							$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
						}
						else
						{
							$opt['optimg'] = "";		
						}
						if($opt['opttext'] !=="" || $opt['optimg'] !== "")
						{
							array_push($option_array,$opt);
						}
						
					}
			
					$array1= array();
					$array1['id']= $id;
					$array1['ques_info_id']= $ques_info_id;
					$array1['catid'] =$catid;
					$array1['question']=$question;
					$array1['answer']=-1;
					$array1['status']="";
					$array1['correctopt']=$correctopt;
					$array1['solution']=$solution;
					$array1['option'] =$option_array;
					if($q_image == "")
					{
						$array1['q_img'] = $q_image;	
					}
					else
					{
						$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
					}
					if($solutionimg == "")
					{
						$array1['solution_img']=$solutionimg;	
					}
					else
					{
						$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
					}

					if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                            if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }    
                        }

					if($lang_id == 'hi')
					{
						array_push($array4_hindi,$array1);
					}
					else
					{
						array_push($array4_english,$array1);
					}
				}	
					array_push($array_section_hindi,$array4_hindi);
				array_push($array_section_english,$array4_english);




				$this->db->where('set_no',$set_no);
				//$this->db->where('type',$type);
				$this->db->like('type',$type);
				$this->db->where_in('quescatid',$computer_categoryid);
				$this->db->order_by('qrecord.id','asc');
				$this->db->limit('80');
				$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
				$this->db->join('pretext_record','pretext_record.id = qrecord.pretextid','left');
				$this->db->select('ques_info.quesid as ques_info_id,ques_info.type as type,ques_info.set_no,ques_info.quesid,ques_info.quescatid,ques_info.correctopt,qrecord.id,qrecord.lang_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,qrecord.pretextid,pretext_record.pretext,pretext_record.image as pretext_image');
				$query = $this->db->get('qrecord');
				foreach ($query->result() as  $row) 
				{
					$option_array= array();
					$id = $row->id;
					$ques_info_id = $row->ques_info_id;
					$catid =$row->quescatid;
					$question = nl2br($row->ques_text);
					$correctopt=$row->correctopt;
					$lang_id = $row->lang_id;
					$solution =  nl2br($row->sol_text);
					$q_image = $row->ques_image;
					$solutionimg = $row->sol_image;

					$pretext = nl2br($row->pretext);
						$pretext_image = $row->pretext_image;

					$this->db->where('QuesId='.$id);
					$this->db->select('*');
					$query1 = $this->db->get('options');
					
					foreach($query1->result() as $row1)
					{
						
						$opt['opttext'] =$row1->OptionText;
						if($row1->image != "")
						{
							$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;	
						}
						else
						{
							$opt['optimg'] = "";		
						}
						
						if($opt['opttext'] !=="" || $opt['optimg'] !== "")
						{
							array_push($option_array,$opt);
						}
						
					}
			
					$array1= array();
					$array1['id']= $id;
					$array1['ques_info_id']= $ques_info_id;
					$array1['catid'] =$catid;
					$array1['question']=$question;
					$array1['answer']=-1;
					$array1['status']="";
					$array1['correctopt']=$correctopt;
					$array1['solution']=$solution;
					$array1['option'] =$option_array;
					if($q_image == "")
					{
						$array1['q_img'] = $q_image;	
					}
					else
					{
						$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;		
					}
					if($solutionimg == "")
					{
						$array1['solution_img']=$solutionimg;	
					}
					else
					{
						$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;		
					}
					

					if($pretext == null)
                        {
                            $array1['pretext']= "";
                        }
						else
                        {
                             $array1['pretext']= $pretext;
                        }
                        if($pretext_image == null)
                        {
                            $array1['pretext_image']="";    
                        }
                        else
                        {
                        	if($pretext_image == "")
                        	{
                            	$array1['pretext_image']=$pretext_image;    
                            }
                            else
                            {
                            	$array1['pretext_image']= "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image; 
                            }
                        }

					if($lang_id == 'hi')
					{
						array_push($array5_hindi,$array1);
					}
					else
					{
						array_push($array5_english,$array1);
					}
				}	


					array_push($array_section_hindi,$array5_hindi);
				array_push($array_section_english,$array5_english);



				array_push($array_main,$array_section_hindi);
				array_push($array_main,$array_section_english);
				
				return json_encode($array_main);
				//return $this->db->last_query();
			}	
		}

		function get_seenexams_question($exam_no,$language)
		{
			$array =array();
			

			$this->db->where('qrecord.lang_id',$language);
			$this->db->where('exam_record.exam_no',$exam_no);
			$this->db->join('ques_info','ques_info.quesid = qrecord.quesid');
			$this->db->join('exam_record','ques_info.quesid = exam_record.quesid');
			$this->db->join('pretext_record','qrecord.pretextid = pretext_record.id','left');
			$this->db->select('exam_record.exam_no,exam_record.answer as exam_answer,exam_record.status as exam_status,qrecord.id as qrecord_id,qrecord.ques_text,qrecord.sol_text,qrecord.sol_image,qrecord.ques_image,ques_info.correctopt,pretext_record.pretext,pretext_record.image as pretext_image');
			$query = $this->db->get('qrecord');
			foreach ($query->result() as  $row) 
			{
				$option_array= array();
				$id = $row->qrecord_id;
                                if($row->pretext == "")
                                {
				   $question = ltrim(nl2br($row->ques_text));
                                }
                                else
                                {
                                   $question = ltrim(nl2br($row->pretext."<br>".$row->ques_text));
                                }
				$correctopt=$row->correctopt;
				$answer = nl2br($row->exam_answer);	
				$status = $row->exam_status;
				$solution =  nl2br($row->sol_text);
				$q_image = $row->ques_image;
				$pretext_image = $row->pretext_image;
				$solutionimg = $row->sol_image;
				$this->db->where('QuesId='.$id);
				$this->db->where('OptionNo',$correctopt);
				$this->db->select('*');
				$query1 = $this->db->get('options');
				
				foreach($query1->result() as $row1)
				{
					
					$opt['opttext'] =$row1->OptionText;
					if($row1->image == null)
					{
						$opt['optimg'] = "";
					}
					else
					{
						if($row1->image == "")
						{
							$opt['optimg'] =$row1->image;
						}
						else
						{
							$opt['optimg'] ="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$row1->image;
						}
					}
						
					
					if($opt['opttext'] !=="" || $opt['optimg'] !== "")
					{
						array_push($option_array,$opt);
					}
					
				}
		
				$array1= array();
				$array1['id']= $id;
				
				$array1['question']=$question;
				$array1['answer']=$answer;
				$array1['status']=$status;	
				$array1['correctopt']=$correctopt;
				$array1['solution']=$solution;
				$array1['option'] =$option_array;

				if($q_image == null)
				{
					$array1['q_img'] = "";
				}
				else
				{
					if($q_image == "")
					{
						$array1['q_img'] = $q_image;
					}
					else
					{
					  	$array1['q_img'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$q_image;	
					}
				}

				if($pretext_image == null)
				{
					$array1['pretext_image'] = "";
				}
				else
				{
					if($pretext_image == "")
					{
						$array1['pretext_image'] = $pretext_image;	
					}	
					else
					{
						$array1['pretext_image'] = "http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$pretext_image;	
					}
				}	

				if($solutionimg == null)
				{
					$array1['solution_img']= "";
				}
				else
				{
					if($solutionimg == "")
					{
						$array1['solution_img']=$solutionimg;
					}
					else
					{
						$array1['solution_img']="http://xercesblue.in/newOnlineXamserver_samequestion/liquid_data/uploads_image/".$solutionimg;
					}
				}
				
					array_push($array,$array1);
				
			}
			return json_encode($array);
			//return json_encode($this->db->last_query());
		}

		function get_session_userid()
		{
			return $this->session->userdata('userid');
		}



                function results($userid)
		{
			$array = array();
			$this->db->where('userid',$userid);
			$this->db->select('*');
			$query = $this->db->get('exam_info ');
			$no_of_set = (int)$query->num_rows();
			foreach ($query->result() as $row) 
			{
				$array1 = array();
				$array1['no_of_set'] = $no_of_set;
				$array1['id'] = $row->id;
				$array1['marks'] = $row->marks;
				$array1['total_attempt'] =$row->total_attempt;
				$array1['attempt_right'] =$row->attempt_right;
				$array1['attempt_wrong'] = $row->attempt_wrong;
				$array1['date'] = $row->date;
				$array1['language'] =$row->language;
				array_push($array,$array1);
			}

			return $array;
		}

               function set_seen_questionid($questionid,$session_userid)
		{
			$this->db->where('QuesId',$questionid);
			$this->db->where('userid',$session_userid);
			$this->db->select('*');
			$query = $this->db->get('old_question_table');
			if($query->num_rows() > 0)
			{
				 $attempt=0;
				 foreach ($query->result() as $row) 
				 {
				 	 $attempt= $row->attempt;
		 			 $attempt = $attempt + 1;
				 }
				 $data = array(
               		'attempt' => $attempt
            	 );
            	 $this->db->where('QuesId',$questionid);
            	 $this->db->update('old_question_table',$data);
            	 return json_encode('exist');
			}
			else
			{
				 $data = array(
               		'QuesId' => $questionid,
               		'userid' => $session_userid
            	 );
            	 $this->db->insert('old_question_table',$data);
            	 return json_encode('not exist');
			}
		}

		
               function set_language($lang)
		{
			$this->session->set_userdata('language', $lang);
			return $this->session->userdata('language');
		}


		function get_session_language()
		{
			return $this->session->userdata('language');
		}

               function get_numberof_sets()
		{
			$this->db->select_max('set_no');
			$result = $this->db->get('ques_info')->row();  
			return json_encode($result->set_no);
		}


              function submitexamrecord($exam_record_array,$language,$userid,$date,$marks,$total_attempt,$attempt_right,$attempt_wrong)
    	{
			$data1=array(
							'userid' =>$userid,
							'language'=>$language,
							'date'=>$date,
							'total_attempt' =>$total_attempt,
							'attempt_wrong' =>$attempt_wrong,
							'attempt_right'=>$attempt_right,
							'marks'=>$marks
				);
			$this->db->insert('exam_info', $data1);
			$exam_no =$this->db->insert_id();
			if(count($exam_record_array) !== 0)
			{
				foreach ($exam_record_array as $row) 
				{
					$data = array(
	   								'quesid' => $row['id'],
	   								'answer' => $row['answer'],
	   								'exam_no' => $exam_no,
	   								'status' =>$row['status'],
	   								
								);
					$this->db->insert('exam_record', $data);
				}
			}
			return json_encode('success');
		}


        function submitseenexam($userid,$seen_set_id)
    	{
			$this->db->where('seen_set_id',$seen_set_id);
            $this->db->where('userid',$userid);
			$this->db->select('*');
			$query = $this->db->get('seen_exam');
			if($query->num_rows() > 0)
			{
				return json_encode('exist');
			}
			else
			{
				$data = array(
               		'userid' => $userid,
               		'seen_set_id' => $seen_set_id
            	 );
			 $this->db->insert('seen_exam',$data);
            	 return json_encode('not exist');
			}
			
		}

		function get_profile($id)
		{
			$this->db->where('userid',$id);
			$this->db->select('*');
			$query = $this->db->get('user_information_table');

			foreach($query->result() as $row)
			{
				$array = array();	
					
				$array['name'] = $row->name;
				$array['rollno'] = (300000+$row->userid);
				$array['email']	= $row->email;
				$array['phone'] = $row->phone;
				$array['username'] = $row->username;

				return json_encode($array);
			}
		}

		function get_session_username()
		{

			return $this->session->userdata('username');
		}




		function get_all_category($cat)
		{


			$array1 = array();
			$this->db->where('category_table.id',$cat);
			$this->db->join('category_table as t2','t2.parentId  = category_table.id','left');
			$this->db->join('category_table as t3','t3.parentId  = t2.id','left');
			$this->db->select('category_table.id as category_table_id,category_table.category as category_table_cat,category_table.parentId as category_table_parentid,t2.id as t2_id,t2.category as t2_cat,t2.parentId as t2_parentid,t3.id as t3_id,t3.category as t3_cat,t3.parentId as t3_parentid');
			$query = $this->db->get('category_table');
			foreach($query->result() as $row)
			{
				$array = array();	
				if($row->t3_parentid == null && $row->t2_parentid != null)
				{
					$array['id'] = $row->t2_id;
					$array['category'] = $row->t2_cat;
					$array['parentid']	= $row->t2_parentid;
					array_push($array1, $array);
				}
				else if($row->t2_parentid == null && $row->category_table_parentid != null)
				{
					$array['id'] = $row->category_table_id;
					$array['category'] = $row->category_table_cat;
					$array['parentid']	= $row->category_table_parentid;
					array_push($array1, $array);
				}	
				else
				{
					$array['id'] = $row->t3_id;
					$array['category'] = $row->t3_cat;
					$array['parentid']	= $row->t3_parentid;
					array_push($array1, $array);
				}
				
			}
			return $array1;
		//return $this->db->last_query();

		}
	}