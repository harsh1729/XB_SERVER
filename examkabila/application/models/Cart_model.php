<?php

	
	class Cart_model extends CI_Model
	{
		

		function set_cart($name,$item_id,$price,$set_type,$userid)
		{

			$this->db->where('item_id',$item_id);
			$this->db->where('set_type',$set_type);
                        $this->db->where('userid',$userid);
			$this->db->select("item_id");
			$query = $this->db->get('cart');
			$num = $query->num_rows();
			if($num < 1)
			{
				$data=array(
							'name' =>$name,
							'item_id'=>$item_id,
							'price'=>$price,
							'set_type' =>$set_type,
							'userid' =>$userid
							
				);
			$this->db->insert('cart', $data);
			return json_encode("success");
				
			}
			else
			{
				return json_encode("not success");
			}

			

		}
		
		function get_cart($userid)
		{
			$array = array();
			$this->db->where('userid',$userid);
			$this->db->select('*');
			$query=	$this->db->get('cart');

			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				$id = $row->id;
				$name = $row->name;
				$item_id = $row->item_id;
				$price = $row->price;
				$set_type = $row->set_type;
				
				$array1['id'] = $id;
				$array1['name'] = $name;
				$array1['item_id'] = $item_id;
				$array1['price'] = $price;
				$array1['set_type'] = $set_type;
				

				array_push($array, $array1);
 			}

 			return json_encode($array);
		}

               function prodect_info($userid)
		{
			$array = array();
			$this->db->where('userid',$userid);
			$this->db->select('*');
			$query=	$this->db->get('cart');

			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				
				$name = $row->name;
				$price = $row->price;
								
			
				$array1['name'] = $name;
				$array1['description'] ="";
				$array1['value'] =$price;
				$array1['isRequired']=false;
			
				array_push($array, $array1);
 			}

 			return json_encode($array);
		}

		function cart_total_amount($userid)
		{
			 $this->db->where('userid',$userid);
			$this->db->select_sum('price');
			 $query = $this->db->get('cart');
    		return $query->row()->price;
		}

		function empty_cart($userid)
		{
			$this->db->where('userid',$userid);
			$this->db->delete('cart');
			return json_encode("success");
		}

		function delete_single_cart($id,$userid)
		{
			$this->db->where('id',$id);
			$this->db->where('userid',$userid);
			$this->db->delete('cart');
			return json_encode("success");
		}
		
	}