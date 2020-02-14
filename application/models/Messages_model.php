<?php

/**
 * Author: Amirul Momenin
 * Desc:Messages Model
 */
class Messages_model extends CI_Model
{
	protected $messages = 'messages';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get messages by id
	 *@param $id - primary key to get record
	 *
     */
    function get_messages($id){
        $result = $this->db->get_where('messages',array('id'=>$id))->row_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all messages
	 *
     */
    function get_all_messages(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('messages')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit messages
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_messages($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('messages')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count messages rows
	 *
     */
	function get_count_messages(){
       $result = $this->db->from("messages")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new messages
	 *@param $params - data set to add record
	 *
     */
    function add_messages($params){
        $this->db->insert('messages',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update messages
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_messages($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('messages',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete messages
	 *@param $id - primary key to delete record
	 *
     */
    function delete_messages($id){
        $status = $this->db->delete('messages',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}
