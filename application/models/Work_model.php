<?php

/**
 * Author: Amirul Momenin
 * Desc:Work Model
 */
class Work_model extends CI_Model
{
	protected $work = 'work';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get work by id
	 *@param $id - primary key to get record
	 *
     */
    function get_work($id){
        $result = $this->db->get_where('work',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all work
	 *
     */
    function get_all_work(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('work')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit work
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_work($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('work')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count work rows
	 *
     */
	function get_count_work(){
       $result = $this->db->from("work")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new work
	 *@param $params - data set to add record
	 *
     */
    function add_work($params){
        $this->db->insert('work',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update work
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_work($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('work',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete work
	 *@param $id - primary key to delete record
	 *
     */
    function delete_work($id){
        $status = $this->db->delete('work',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
