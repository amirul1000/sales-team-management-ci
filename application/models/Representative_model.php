<?php

/**
 * Author: Amirul Momenin
 * Desc:Representative Model
 */
class Representative_model extends CI_Model
{
	protected $representative = 'representative';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get representative by id
	 *@param $id - primary key to get record
	 *
     */
    function get_representative($id){
        $result = $this->db->get_where('representative',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all representative
	 *
     */
    function get_all_representative(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('representative')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit representative
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_representative($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('representative')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count representative rows
	 *
     */
	function get_count_representative(){
       $result = $this->db->from("representative")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new representative
	 *@param $params - data set to add record
	 *
     */
    function add_representative($params){
        $this->db->insert('representative',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update representative
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_representative($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('representative',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete representative
	 *@param $id - primary key to delete record
	 *
     */
    function delete_representative($id){
        $status = $this->db->delete('representative',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
