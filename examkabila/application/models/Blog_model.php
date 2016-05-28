<?php

class Blog_model extends CI_Model
{
	function submit_blog($blog_text,$blog_link,$image_align,$blog_name,$date)
	{
		
		
			$data = array(
               		'align' => $image_align,
               		'image' => $blog_link,
               		'blog_text' => $blog_text,
               		'name'=>$blog_name,
               		'date'=>$date
               		
            	 );
	
		if($this->db->insert('blog',$data))
		{
			return json_encode('success');
		}
		else
		{
			return json_encode('not success');
		}
	}
	function submit_status($status_text,$status_link_image,$status_category,$status_name,$date,$status_language,$image_align)

	{
		$CI = &get_instance();
			$this->db1 = $CI->load->database('db1', TRUE);
		$last_id=0;
		if($status_category == '1')
		{
			$data1 = array(
               		'GkContent' => $status_text,
               		'date'=> $date,
               		'langCode'=> $status_language

               		
            	 );
			$this->db1->insert('gkupdates',$data1);
				$last_id = $this->db1->insert_id();

		}
		else if($status_category == '2')
		{
			/*$data1 = array(
               		'content' => $status_text,
               		'heading'=>$status_name,
               		'date'=>$date
               		
            	 );
			$this->db->insert('daily_status',$data1)*/
		}		
		else if($status_category == '3')
		{
			/*$data1 = array(
               		'content' => $status_text,
               		'heading'=>$status_name,
               		'date'=>$date
               		
            	 );
			$this->db->insert('daily_status',$data1)*/
		}	
		else if($status_category == '4')
		{
			$date1="";
			$year=substr($date,0,4);
						$month=substr($date,5,2);
						$day=substr($date,8,2);
						if($month=='01')
						    {
						    $month1= 'January';	

						    }
						    else if($month=='02')
						    {
						    	$month1= 'February';		
						    }
						    else if($month=='03')
						    {
						    	$month1= 'March';	
						    }
						    else if($month=='04')
						    {
						    	$month1= 'April';	
						    }
						    else if($month=='05')
						    {
						    	$month1= 'May';	
						    }
						    else if($month=='06')
						    {
						    	$month1= 'June';	
						    }
						    else if($month=='07')
						    {
						    	$month1= 'July';	
						    }
						    else if($month=='08')
						    {
						    	$month1= 'August';	
						    }
						    else if($month=='09')
						    {
						    	$month1= 'September';	
						    }
						    else if($month=='10')
						    {
						    	$month1= 'October';	
						    }
						    else if($month=='11')
						    {
						    	$month1= 'November';	
						    }
						    else if($month=='12')
						    {
						    	$month1= 'December';	
						    }
						    $date1=$day.'-'.$month1.'-'.$year;

			$data = array(
               		'align' => $image_align,
               		'image' => $status_link_image,
               		'blog_text' => $status_text,
               		'name'=>$status_name,
               		'date'=>$date1

               		
            	 );
	

               		
            	
			$this->db->insert('blog',$data);
			$last_id=$this->db->insert_id();
		}	

			
		
			$data = array(
               		'content' => $status_text,
               		'image' => $status_link_image,
               		'heading'=>$status_name,
               		'date'=>$date,
               		'category'=>$status_category,
               		'lastid'=>$last_id,
               		'align' => $image_align,
               		'langCode'=> $status_language
               		
            	 );
	
		if($this->db->insert('daily_status',$data))
		{
			return json_encode('success');
		}
		else
		{
			return json_encode('not success');
		}
	}
	function get_all_status_data($page){
		
		$langid=$this->session->userdata('web_language');

		$this->db->select('id');
		$this->db->where('langCode',$langid);
		$queryResult = $this->db->get('daily_status');
		$rows = $queryResult->num_rows();
		if($page==false && $page ==null){
			$page = 1;
		}
		$a=$rows%6;
		if($a==0)
		{
		$rows=($rows/6);
		}
		else
		{
		 $rows=($rows/6)+1;	
		}

		$page=(int)$page;
		
		$this->db->select('*');
		$this->db->where('langCode',$langid);
		$this->db->limit(6,($page-1)*6);
		$this->db->order_by("date","desc");
		$this->db->order_by("id","desc");
	$queryResult = $this->db->get('daily_status');
	$queryResult->result();
	$allstatus = array();
		foreach ($queryResult->result() as $index => $row) {
			$singlestatus = array();

			$singlestatus['id'] = $row->id;
			$singlestatus['heading'] = $row->heading;
			$singlestatus['content'] = $row->content;
			$singlestatus['date'] = $row->date;
			$singlestatus['category'] = $row->category;
			$singlestatus['lastid'] = $row->lastid;
			$singlestatus['page'] = $page;
			$singlestatus['rows'] = $rows;

			if($row->image != "")
				$singlestatus['image'] = base_url('admin_docs/upload_image/'.$row->image);
			else
				$singlestatus['image'] = "";
		
			array_push($allstatus, $singlestatus);
		}
		return $allstatus;
	}

	function submit_sub_text($blog_text,$blog_link,$image_align,$blog_id)
	{
		
		$data = array(
               		'align' => $image_align,
               		'image' => $blog_link,
               		'blog_text' => $blog_text,
               		'blog_id'=>$blog_id,
               		
               		
            	 );

			if($this->db->insert('blog_sub_text',$data))
			{
				return json_encode('success');
			}
			else
			{
				return json_encode('not success');
			}
	}

	function get_all_blog()
	{
		$final_array = array();
		
		$array =  array();
		$array_all = array();

		$this->db->order_by("id", "desc");
		$this->db->select('blog.id,blog.name');
		$all_blog_query = $this->db->get('blog');
		foreach ($all_blog_query->result() as $all_blog)
		{
			$array_all1 = array();
			$blog_name = $all_blog->name;
			$blog_id = $all_blog->id;

			$array_all1['blog_name'] = $blog_name;
			$array_all1['blog_id'] = $blog_id;

			array_push($array_all, $array_all1);
		}



		array_push($final_array, $array_all);


		$this->db->order_by("id", "desc");
		$this->db->limit(1,0);
		$this->db->select('*');
		$query = $this->db->get('blog');
		foreach ($query->result() as  $row)
		{
			$final_sub_array = array();
			$array1 = array();
			
			$comment = array();
			$id = $row->id;
			$align = $row->align;
			$image = $row->image;
			$name = $row->name;
			$blog_text = nl2br($row->blog_text);
			$date = $row->date;

			$day = substr($date,0,2);
			$year = substr($date,-4);
			$month = substr($date,3,-5);

			$this->db->where('blog_id',$id);
			$this->db->select('*');
			$query1 = $this->db->get('blog_sub_text');
			foreach ($query1->result() as $row1)
			{
				$sub_array = array();
				$sub_image = $row1->image;	
				$sub_text = nl2br($row1->blog_text);
				$sub_align = $row1->align;

				$sub_array['sub_image'] = $sub_image;
				$sub_array['sub_text'] = $sub_text;
				$sub_array['sub_align'] = $sub_align; 

				array_push($final_sub_array, $sub_array);
				

			}


			$this->db->where('blog_id',$id);
			$this->db->select('id');
			$query3 = $this->db->get('blog_comment');
			$total_comment = $query3->num_rows();	

			$this->db->where('blog_id',$id);
			$this->db->order_by("id", "desc");
			$this->db->limit(2,0);
			$this->db->select('*');
			$query2 = $this->db->get('blog_comment');
			foreach ($query2->result() as $row2)
			{
					$comment_array = array();
					$comment_text = $row2->comment;
					$username = $row2->username;
					$comment_array['text'] = $comment_text;
					$comment_array['username'] = $username;
					array_push($comment,$comment_array);
			}

			$array1['id'] = $id;
			$array1['align'] = $align;
			$array1['image'] = $image;
			$array1['name'] = $name;
			$array1['blog_text'] = $blog_text;
			$array1['date'] = $date;
			$array1['sub_array'] = $final_sub_array;
			$array1['comment'] = $comment;
			$array1['total_comment'] = $total_comment;
			$array1['day'] = $day;
			$array1['month'] = $month;
			$array1['year'] = $year;
			
			array_push($array, $array1);

		}
		array_push($final_array, $array);
		return $final_array;
	}




	function get_blog_by_id($blogid)
	{
			

		$final_array = array();
		
		$array =  array();
		$array_all = array();

		$this->db->order_by("id", "desc");
		$this->db->select('blog.id,blog.name');
		$all_blog_query = $this->db->get('blog');
		foreach ($all_blog_query->result() as $all_blog)
		{
			$array_all1 = array();
			$blog_name = $all_blog->name;
			$blog_id = $all_blog->id;

			$array_all1['blog_name'] = $blog_name;
			$array_all1['blog_id'] = $blog_id;

			array_push($array_all, $array_all1);
		}



		array_push($final_array, $array_all);

		$this->db->like('id',$blogid);
		//$this->db->order_by("id", "desc");
	//	$this->db->limit(2,0);
		$this->db->select('*');
		$query = $this->db->get('blog');
		foreach ($query->result() as  $row)
		{
			$final_sub_array = array();
			$array1 = array();
			
			$comment = array();
			$id = $row->id;
			$align = $row->align;
			$image = $row->image;
			$name = $row->name;
			$blog_text = nl2br($row->blog_text);
			$date = $row->date;

			$day = substr($date,0,2);
			$year = substr($date,-4);
			$month = substr($date,3,-5);

			$this->db->where('blog_id',$id);
			$this->db->select('*');
			$query1 = $this->db->get('blog_sub_text');
			foreach ($query1->result() as $row1)
			{
				$sub_array = array();
				$sub_image = $row1->image;	
				$sub_text = nl2br($row1->blog_text);
				$sub_align = $row1->align;

				$sub_array['sub_image'] = $sub_image;
				$sub_array['sub_text'] = $sub_text;
				$sub_array['sub_align'] = $sub_align; 

				array_push($final_sub_array, $sub_array);
				

			}


			$this->db->where('blog_id',$id);
			$this->db->select('id');
			$query3 = $this->db->get('blog_comment');
			$total_comment = $query3->num_rows();	

			$this->db->where('blog_id',$id);
			$this->db->order_by("id", "desc");
			$this->db->limit(2,0);
			$this->db->select('*');
			$query2 = $this->db->get('blog_comment');
			foreach ($query2->result() as $row2)
			{
					$comment_array = array();
					$comment_text = $row2->comment;
					$username = $row2->username;
					$comment_array['text'] = $comment_text;
					$comment_array['username'] = $username;
					array_push($comment,$comment_array);
			}

			$array1['id'] = $id;
			$array1['align'] = $align;
			$array1['image'] = $image;
			$array1['name'] = $name;
			$array1['blog_text'] = $blog_text;
			$array1['date'] = $date;
			$array1['sub_array'] = $final_sub_array;
			$array1['comment'] = $comment;
			$array1['total_comment'] = $total_comment;
			$array1['day'] = $day;
			$array1['month'] = $month;
			$array1['year'] = $year;
			
			array_push($array, $array1);

		}
		array_push($final_array, $array);
		return $final_array;
	}






	function get_ajax_blog()
	{
			$array = array();
			$this->db->limit(10,0);
			$this->db->order_by('id','desc');
			$this->db->select('*');
			$query = $this->db->get('blog');
			foreach ($query->result() as $row1)
			{
				$array1 = array();
				$id = $row1->id;
				$name = $row1->name;
				

				$array1['id'] = $id;
				$array1['name'] = $name;
				array_push($array,$array1);
				

			}
			return $array;
	}

	function submit_comment($blog_comment,$blog_id,$username)
	{
		$blog_comment = $this->db->escape_str($blog_comment);
		

		$data = array(
               		'comment' => $blog_comment,
               		'blog_id' => $blog_id,
               		'username'=>$username
               	);

		$this->db->insert('blog_comment',$data);


		$this->db->where('blog_id',$blog_id);
		$this->db->select('id');
		$query2 = $this->db->get('blog_comment');
		$total_comment = $query2->num_rows();
		return $total_comment;

	}


	function see_more($offset,$blog_id)
	{
		$comment = array();
		$this->db->where('blog_id',$blog_id);
		$this->db->order_by('id','desc');
		$this->db->limit(10,$offset);
		$this->db->select('*');
		$query1 = $this->db->get('blog_comment');
		foreach ($query1->result() as $row2)
			{
					$comment_array = array();
					$comment_text = $row2->comment;
					$username = $row2->username;
					$comment_array['text'] = $comment_text;
					$comment_array['username'] = $username;
					array_push($comment,$comment_array);
			}
		return $comment;	
	}
}