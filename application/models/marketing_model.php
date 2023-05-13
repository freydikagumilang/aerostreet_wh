<?php

class Marketing_model extends CI_model
{

	function getToken($where_array=array(),$limit=0,$start=0,$order_by=array())
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
		$query=$this->db->get('jubelio_token');
		return $query;
	}
    function setToken($set_array=array())
	{
		$this->db->set($set_array);
		$this->db->insert('jubelio_token');
		return $this->db->insert_id();
	}
	function getCampaign($where_array=array(),$limit=0,$start=0,$order_by=array())
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
		$query=$this->db->get('campaign');
		return $query;
	}
	function registerUndian($set_array=array())
	{
		$this->db->set($set_array);
		$this->db->insert('jubelio_orders');
		return $this->db->insert_id();
	}
	function getUndian($where_array=array(),$limit=0,$start=0,$order_by=array())
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
		$query=$this->db->get('jubelio_orders');
		return $query;
	}
    

}