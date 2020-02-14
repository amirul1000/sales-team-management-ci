<?php

/**
 * Author: Amirul Momenin
 * Desc:Earnings Model
 */
class Earnings_model extends CI_Model
{
	protected $earnings = 'earnings';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get earnings by id
	 *@param $id - primary key to get record
	 *
     */
    function get_earnings($id){
        $result = $this->db->get_where('earnings',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all earnings
	 *
     */
    function get_all_earnings(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('earnings')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit earnings
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_earnings($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('earnings')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count earnings rows
	 *
     */
	function get_count_earnings(){
       $result = $this->db->from("earnings")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new earnings
	 *@param $params - data set to add record
	 *
     */
    function add_earnings($params){
        $this->db->insert('earnings',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update earnings
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_earnings($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('earnings',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete earnings
	 *@param $id - primary key to delete record
	 *
     */
    function delete_earnings($id){
        $status = $this->db->delete('earnings',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
