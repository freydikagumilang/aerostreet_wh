<?php

class Products_model extends CI_model
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
		// $this->db->limit(100,0);
		if(!empty($order_by))
		{
			foreach($order_by as $key=>$value)
			{
				$this->db->order_by($key,$value);
			}
		}
		$this->db->select("*",false);
		$query=$this->db->get('kode_so');
		return $query;
	}
    function save_so($set_array=array())
	{
		$this->db->set($set_array);
		$this->db->insert('stock_opname');
		return $this->db->insert_id();
	}
}