<?php

class Video_model extends CI_Model
{
	function submit_video($video_pay_type,$video_amount,$video_name,$video_discription,$video_link,$videoimg_link,$videothumbnail_link,$youtube_key,$lang_type,$catid,$date,$parrentcatid)
	{

		
		
		if($video_pay_type == '1')
		{
			$data = array(
               		'pay_type' => $video_pay_type,
               		'pay_amount' => $video_amount,
               		'video_link' => $video_link,
               		'video_name' => $video_name,
               		'video_discription' => $video_discription,
                    'image'=>$videoimg_link,
                    'thumbnail'=>$videothumbnail_link,
                    'langid'=>$lang_type,
                    'catid'=>$catid,
                    'datetime'=>$date,
                    'parrentcatid'=>$parrentcatid

            	 );
		}
		else
		{
			$data = array(
               		'pay_type' => $video_pay_type,
               		'video_link' => $video_link,
               		'video_name' => $video_name,
               		'video_discription' => $video_discription,
                    'image'=>$videoimg_link,
                    'thumbnail'=>$videothumbnail_link,
                    'youtube_key'=>$youtube_key,
                    'langid'=>$lang_type,
                    'catid'=>$catid,
                    'datetime'=>$date,
                    'parrentcatid'=>$parrentcatid
            	 );
		}


		if($this->db->insert('video',$data))
		{
			return json_encode('success');
		}
		else
		{
			return json_encode('not success');
		}




	}



	function get_all_video($type,$userid,$lang_type,$price_type,$catid,$parrentcatid,$page)
	{
			$a = sizeof($lang_type);
    		$b = sizeof($price_type);
    		$where = "";
    		$where1 = "";
    		for($i=0;$i < $a;$i++)
    		{
    			if($i == 0)
    			{
    				if($lang_type[$i] == "")
    				{
    					$where = $where.'(';
    				}
    				else
    				{
    					$where = $where.'(video.langid="'.$lang_type[$i].'"';	
    				}
    				
    			}
    			else if($i == ($a-1))
    			{
    				if($lang_type[$i] == "")
    				{
    					$where =$where.')';	
    				}
    				else
    				{
    					if($lang_type[$i-1] == "" && $where == '(')
    					{
    						$where =$where.' video.langid = "'.$lang_type[$i].'")';		
    					}
    					else
    					{
    						$where =$where.' or video.langid = "'.$lang_type[$i].'")';		
    					}
    						
    				}
    				
    			}
    			else
    			{
    				if($lang_type[$i] == "")
    				{
    					
    				}
    				else
    				{
    					if($lang_type[$i-1] == "" && $where == '(')
    					{
    						$where =$where.' video.langid = "'.$lang_type[$i].'"';	
    					}
    					else
    					{
    						$where =$where.' or video.langid = "'.$lang_type[$i].'"';		
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
    					$where1 = $where1.'video.pay_type="'.$price_type[$j].'"';

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
    					 	$where1 =$where1.' video.pay_type = "'.$price_type[$j].'")';	
						}
						else
						{
							$where1 =$where1.' or video.pay_type = "'.$price_type[$j].'")';	
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
    						
    						$where1 =$where1.' video.pay_type = "'.$price_type[$j].'"';		
    					}
    					else
    					{
    						$where1 =$where1.' or video.pay_type = "'.$price_type[$j].'"';
    					}
    					
    				}
    			}
    		}

		$array =array();
			$this->db->order_by('video.datetime', 'DESC');
			if($where !== '()')
			{
				$this->db->where($where);
			}
			if($where1 !== '()')
			{
				$this->db->where($where1);
			}
           if($parrentcatid==0) 
           {
               if($catid!=0)
               {
                 $this->db->where('catid',$catid);
               }
           }else if ($parrentcatid!=0) 
           {
              $this->db->where('parrentcatid',$parrentcatid);
           }
            
            if($page==false && $page==0){
                $page = 1;
            }
            
			//$this->db->where('set_type',$type);
            $this->db->limit(50,($page-1)*50);
			$this->db->join("user_setpurchage_mapping","video.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type = '".$type."' and userid = '".$userid."'",'left');
			$this->db->select('video.id as video_item_id, video.pay_type as pay_type, video.pay_amount as pay_amount,video.video_link as video_link,video.video_name as video_name,video.video_discription as video_discription,video.image,video.youtube_key,video.catid,video.datetime,video.parrentcatid, user_setpurchage_mapping.type as video_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
			$query = $this->db->get('video');
          $rows =   $this->getrowcnt($type,$userid,$lang_type,$price_type,$catid,$parrentcatid,$page);
        
        $page=(int)$page;

              

			foreach ($query->result() as  $row) 
			{
				$array1 = array();
				
				$pay_type = $row->pay_type;
				$pay_amount = $row->pay_amount;
				$video_type = $row->video_type;
				$video_link = $row->video_link;
				$video_item_id = $row->video_item_id;
				$userid =  $row->userid;
                $video_name = $row->video_name;
                $video_discription = $row->video_discription;
                $image = $row->image;
                $youtube_key = $row->youtube_key;
                $item_id = $row->item_id;
                $catid = $row->catid;


			
				$array1['pay_type'] = $pay_type;
				$array1['pay_amount'] = $pay_amount;
				$array1['video_link'] = $video_link;
				$array1['video_type'] = $video_type;
				$array1['video_item_id'] = $video_item_id;
				$array1['userid'] = $userid;
                $array1['video_name'] = $video_name;
                $array1['video_discription'] = $video_discription;
                $array1['image'] = $image;
                $array1['youtube_key'] = $youtube_key;
                $array1['item_id'] = $item_id;
                $array1['catid'] = $catid;
                $array1['rows'] = $rows;
                $array1['page'] = $page;
				array_push($array, $array1);
 			}
 			return $array;
 				//return $this->db->last_query();
	}

  public function getrowcnt($type,$userid,$lang_type,$price_type,$catid,$parrentcatid,$page){
            $a = sizeof($lang_type);
            $b = sizeof($price_type);
            $where = "";
            $where1 = "";
            for($i=0;$i < $a;$i++)
            {
                if($i == 0)
                {
                    if($lang_type[$i] == "")
                    {
                        $where = $where.'(';
                    }
                    else
                    {
                        $where = $where.'(video.langid="'.$lang_type[$i].'"';   
                    }
                    
                }
                else if($i == ($a-1))
                {
                    if($lang_type[$i] == "")
                    {
                        $where =$where.')'; 
                    }
                    else
                    {
                        if($lang_type[$i-1] == "" && $where == '(')
                        {
                            $where =$where.' video.langid = "'.$lang_type[$i].'")';     
                        }
                        else
                        {
                            $where =$where.' or video.langid = "'.$lang_type[$i].'")';      
                        }
                            
                    }
                    
                }
                else
                {
                    if($lang_type[$i] == "")
                    {
                        
                    }
                    else
                    {
                        if($lang_type[$i-1] == "" && $where == '(')
                        {
                            $where =$where.' video.langid = "'.$lang_type[$i].'"';  
                        }
                        else
                        {
                            $where =$where.' or video.langid = "'.$lang_type[$i].'"';       
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
                        $where1 = $where1.'video.pay_type="'.$price_type[$j].'"';

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
                            $where1 =$where1.' video.pay_type = "'.$price_type[$j].'")';    
                        }
                        else
                        {
                            $where1 =$where1.' or video.pay_type = "'.$price_type[$j].'")'; 
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
                            
                            $where1 =$where1.' video.pay_type = "'.$price_type[$j].'"';     
                        }
                        else
                        {
                            $where1 =$where1.' or video.pay_type = "'.$price_type[$j].'"';
                        }
                        
                    }
                }
            }

        $array =array();
            $this->db->order_by('video.datetime', 'DESC');
            if($where !== '()')
            {
                $this->db->where($where);
            }
            if($where1 !== '()')
            {
                $this->db->where($where1);
            }
           if($parrentcatid==0) 
           {
               if($catid!=0)
               {
                 $this->db->where('catid',$catid);
               }
           }else if ($parrentcatid!=0) 
           {
              $this->db->where('parrentcatid',$parrentcatid);
           }
            $this->db->join("user_setpurchage_mapping","video.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type = '".$type."' and userid = '".$userid."'",'left');
            $querycnt = $this->db->get('video');
            $rows = $querycnt->num_rows();
            $a=$rows%50;
        if($a==0)
        {
        $rows=($rows/50);
        }
        else
        {
        $rows=($rows/50)+1;  
        }

            return $rows;
   }

    function show_single_video($userid,$type,$video_item_id,$catid)
    {
            $array =array();
           // $this->db->order_by('video.id', 'asc');
            $this->db->order_by('video.datetime', 'DESC');
            $this->db->where('video.id',$video_item_id);
            
            
            $dateVideo = "";
            //$this->db->where('isactive',1);
            //$this->db->where('set_type',$type);
            $this->db->join("user_setpurchage_mapping","video.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type = '".$type."' and userid = '".$userid."'",'left');
            $this->db->select('video.id as video_item_id, video.pay_type as pay_type, video.pay_amount as pay_amount,video.video_link as video_link,video.video_name as video_name,video.video_discription as video_discription,video.image,video.youtube_key,video.catid,video.datetime,video.parrentcatid, user_setpurchage_mapping.type as video_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
            $query = $this->db->get('video');
            foreach ($query->result() as  $row) 
            {
                $array1 = array();
                $comment = array();
                $pay_type = $row->pay_type;
                $pay_amount = $row->pay_amount;
                $video_type = $row->video_type;
                $video_link = $row->video_link;
                $video_item_id = $row->video_item_id;
                $userid =  $row->userid;
                $video_name = $row->video_name;
                $video_discription = $row->video_discription;
                $image = $row->image;
                $youtube_key = $row->youtube_key;
                $item_id = $row->item_id;
                $catid = $row->catid;
                $dateVideo = $row->datetime;
            

                $this->db->where('video_id',$video_item_id);
                $this->db->select('id');
                $query3 = $this->db->get('video_comment');
                $total_comment = $query3->num_rows();   

                $this->db->where('video_id',$video_item_id);
                $this->db->order_by("id", "desc");
                $this->db->limit(2,0);
                $this->db->select('*');
                $query2 = $this->db->get('video_comment');
                foreach ($query2->result() as $row2)
                {
                        $comment_array = array();
                        $comment_text = $row2->comment;
                        $username = $row2->username;
                        $comment_array['text'] = $comment_text;
                        $comment_array['username'] = $username;
                        array_push($comment,$comment_array);
                }


                $array1['pay_type'] = $pay_type;
                $array1['pay_amount'] = $pay_amount;
                $array1['video_link'] = $video_link;
                $array1['video_type'] = $video_type;
                $array1['video_item_id'] = $video_item_id;
                $array1['userid'] = $userid;
                $array1['video_name'] = $video_name;
                $array1['comment'] = $comment;
                $array1['total_comment'] = $total_comment;
                $array1['video_discription'] = $video_discription;
                $array1['image'] = $image;
                $array1['youtube_key'] = $youtube_key;
                $array1['item_id'] = $item_id;
                $array1['catid'] = $catid;
                array_push($array, $array1);
            }



             $datenext = date('Y-m-d', strtotime($dateVideo .' 7 day'));
             $dateBack = date('Y-m-d', strtotime($dateVideo .' -7 day'));
             $array_all =array();
             
            //$this->db->order_by('video.datetime', 'DESC');
            $this->db->limit(20,0);
            $this->db->where('video.catid',$catid);
           // $this->db->where("video.datetime BETWEEN $datenext AND $dateBack");
            $this->db->where('video.datetime BETWEEN "'. date('Y-m-d', strtotime($dateBack)). '" and "'. date('Y-m-d', strtotime($datenext)).'"');
            /*$this->db->where('video.datetime >=', $dateBack);
            $this->db->where('video.datetime <=', $datenext);*/
            $this->db->where('video.datetime !=', $dateVideo);
           //$this->db->where('isactive',1);
            //$this->db->where('set_type',$type);
            $this->db->join("user_setpurchage_mapping","video.id = user_setpurchage_mapping.item_id and user_setpurchage_mapping.type = '".$type."' and userid = '".$userid."'",'left');
            $this->db->select('video.id as video_item_id, video.pay_type as pay_type, video.pay_amount as pay_amount,video.video_link as video_link,video.video_name as video_name,video.video_discription as video_discription,video.image,video.youtube_key,video.catid,video.parrentcatid,video.datetime, user_setpurchage_mapping.type as video_type, user_setpurchage_mapping.item_id as item_id , user_setpurchage_mapping.userid as userid');
            $query = $this->db->get('video');
            foreach ($query->result() as  $row) 
            {
                $array1 = array();
              
                $pay_type = $row->pay_type;
                $pay_amount = $row->pay_amount;
                $video_type = $row->video_type;
                $video_link = $row->video_link;
                $video_item_id = $row->video_item_id;
                $userid =  $row->userid;
                $video_name = $row->video_name;
                $video_discription = $row->video_discription;
                $image = $row->image;
                $item_id = $row->item_id;
                $catid = $row->catid;

            

               


                $array1['pay_type'] = $pay_type;
                $array1['pay_amount'] = $pay_amount;
                $array1['video_link'] = $video_link;
                $array1['video_type'] = $video_type;
                $array1['video_item_id'] = $video_item_id;
                $array1['userid'] = $userid;
                $array1['video_name'] = $video_name;
                $array1['video_discription'] = $video_discription;
                $array1['image'] = $image;
                $array1['youtube_key'] = $youtube_key;
                $array1['item_id'] = $item_id;
                $array1['catid'] = $catid;
                array_push($array_all, $array1);
            }

             array_push($array, $array_all);
            return $array;
              //  return $this->db->last_query();
    }
    function submit_comment($video_comment,$video_id,$username,$userid)
    {
        
        $data = array(
                    'comment' => $video_comment,
                    'video_id' => $video_id,
                    'username'=>$username,
                    'userid'=>$userid
                );

        $this->db->insert('video_comment',$data);


        $this->db->where('video_id',$video_id);
        $this->db->select('id');
        $query2 = $this->db->get('video_comment');
        $total_comment = $query2->num_rows();
        return $total_comment;

    }
    function see_more($offset,$video_id)
    {
        $comment = array();
        $this->db->where('video_id',$video_id);
        $this->db->order_by('id','desc');
        $this->db->limit(10,$offset);
        $this->db->select('*');
        $query1 = $this->db->get('video_comment');
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