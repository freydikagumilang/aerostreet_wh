<?php

class Channel_model extends CI_model
{

	function get_all($where_array=array(),$limit=0,$start=0,$order_by=array())
	{
		if(!empty($where_array))
		{
			$this->db->where($where_array);
		}
		if($limit>0)
		{
			$this->db->limit($limit,$start);
		}
		if(!empty($order_by))
		{
			foreach($order_by as $key=>$value)
			{
				$this->db->order_by($key,$value);
			}
		}
		
		
		$query=$this->db->get('channel');
		return $query;
	}

	function save_new($set_array=array())
	{
		$this->db->set($set_array);
		$this->db->insert('channel');
		return $this->db->insert_id();
	}

	function update($set_array=array(),$where_array=array())
	{
		$this->db->set($set_array);
		if(!empty($where_array))
		{
			$this->db->where($where_array);
		}
		$this->db->update('channel');
	}

	

}