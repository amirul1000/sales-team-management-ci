<?php

 /**
 * Author: Amirul Momenin
 * Desc:Messages Controller
 *
 */
class Messages extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Messages_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of messages table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['messages'] = $this->Messages_model->get_limit_messages($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/messages/index');
		$config['total_rows'] = $this->Messages_model->get_count_messages();
		$config['per_page'] = 10;
		//Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';		
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
        $data['_view'] = 'admin/messages/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save messages
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		$date_created = "";

		if($id<=0){
															 $date_created = date("Y-m-d H:i:s");
														 }

		$params = array(
					 'from_users_id' => html_escape($this->input->post('from_users_id')),
'to_users_id' => html_escape($this->input->post('to_users_id')),
'subject' => html_escape($this->input->post('subject')),
'message' => html_escape($this->input->post('message')),
'date_created' =>$date_created,
'read_status' => html_escape($this->input->post('read_status')),

				);
		 
		if($id>0){
							                        unset($params['date_created']);
						                          } 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['messages'] = $this->Messages_model->get_messages($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Messages_model->update_messages($id,$params);
                redirect('admin/messages/index');
            }else{
                $data['_view'] = 'admin/messages/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $messages_id = $this->Messages_model->add_messages($params);
                redirect('admin/messages/index');
            }else{  
			    $data['messages'] = $this->Messages_model->get_messages(0);
                $data['_view'] = 'admin/messages/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details messages
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['messages'] = $this->Messages_model->get_messages($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/messages/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting messages
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $messages = $this->Messages_model->get_messages($id);

        // check if the messages exists before trying to delete it
        if(isset($messages['id'])){
            $this->Messages_model->delete_messages($id);
            redirect('admin/messages/index');
        }
        else
            show_error('The messages you are trying to delete does not exist.');
    }
	
	/**
     * Search messages
	 * @param $start - Starting of messages table's index to get query
     */
	function search($start=0){
		if(!empty($this->input->post('key'))){
			$key =$this->input->post('key');
			$_SESSION['key'] = $key;
		}else{
			$key = $_SESSION['key'];
		}
		
		$limit = 10;		
		$this->db->like('id', $key, 'both');
$this->db->or_like('from_users_id', $key, 'both');
$this->db->or_like('to_users_id', $key, 'both');
$this->db->or_like('subject', $key, 'both');
$this->db->or_like('message', $key, 'both');
$this->db->or_like('date_created', $key, 'both');
$this->db->or_like('read_status', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['messages'] = $this->db->get('messages')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/messages/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('from_users_id', $key, 'both');
$this->db->or_like('to_users_id', $key, 'both');
$this->db->or_like('subject', $key, 'both');
$this->db->or_like('message', $key, 'both');
$this->db->or_like('date_created', $key, 'both');
$this->db->or_like('read_status', $key, 'both');

		$config['total_rows'] = $this->db->from("messages")->count_all_results();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$config['per_page'] = 10;
		// Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
		$data['key'] = $key;
		$data['_view'] = 'admin/messages/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export messages
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'messages_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $messagesData = $this->Messages_model->get_all_messages();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","From Users Id","To Users Id","Subject","Message","Date Created","Read Status"); 
		   fputcsv($file, $header);
		   foreach ($messagesData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $messages = $this->db->get('messages')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/messages/print_template.php');
			$html = ob_get_clean();
			include(APPPATH."third_party/mpdf60/mpdf.php");					
			$mpdf=new mPDF('','A4'); 
			//$mpdf=new mPDF('c','A4','','',32,25,27,25,16,13); 
			//$mpdf->mirrorMargins = true;
		    $mpdf->SetDisplayMode('fullpage');
			//==============================================================
			$mpdf->autoScriptToLang = true;
			$mpdf->baseScript = 1;	// Use values in classes/ucdn.php  1 = LATIN
			$mpdf->autoVietnamese = true;
			$mpdf->autoArabic = true;
			$mpdf->autoLangToFont = true;
			$mpdf->setAutoBottomMargin = 'stretch';
			$stylesheet = file_get_contents(APPPATH."third_party/mpdf60/lang2fonts.css");
			$mpdf->WriteHTML($stylesheet,1);
			$mpdf->WriteHTML($html);
			//$mpdf->AddPage();
			$mpdf->Output($filePath);
			$mpdf->Output();
			//$mpdf->Output( $filePath,'S');
			exit;	
	  }
	   
	}
}
//End of Messages controller