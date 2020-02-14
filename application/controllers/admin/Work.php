<?php

 /**
 * Author: Amirul Momenin
 * Desc:Work Controller
 *
 */
class Work extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Work_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of work table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['work'] = $this->Work_model->get_limit_work($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/work/index');
		$config['total_rows'] = $this->Work_model->get_count_work();
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
		
        $data['_view'] = 'admin/work/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save work
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'users_id' => html_escape($this->input->post('users_id')),
'work_date' => html_escape($this->input->post('work_date')),
'Business_name' => html_escape($this->input->post('Business_name')),
'Business_Type' => html_escape($this->input->post('Business_Type')),
'Website' => html_escape($this->input->post('Website')),
'Business_Facebook' => html_escape($this->input->post('Business_Facebook')),
'Email_address' => html_escape($this->input->post('Email_address')),
'Contact_number' => html_escape($this->input->post('Contact_number')),
'Contact_person' => html_escape($this->input->post('Contact_person')),
'Country' => html_escape($this->input->post('Country')),
'Remarks' => html_escape($this->input->post('Remarks')),

				);
		 
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['work'] = $this->Work_model->get_work($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Work_model->update_work($id,$params);
                redirect('admin/work/index');
            }else{
                $data['_view'] = 'admin/work/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $work_id = $this->Work_model->add_work($params);
                redirect('admin/work/index');
            }else{  
			    $data['work'] = $this->Work_model->get_work(0);
                $data['_view'] = 'admin/work/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details work
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['work'] = $this->Work_model->get_work($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/work/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting work
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $work = $this->Work_model->get_work($id);

        // check if the work exists before trying to delete it
        if(isset($work['id'])){
            $this->Work_model->delete_work($id);
            redirect('admin/work/index');
        }
        else
            show_error('The work you are trying to delete does not exist.');
    }
	
	/**
     * Search work
	 * @param $start - Starting of work table's index to get query
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
$this->db->or_like('users_id', $key, 'both');
$this->db->or_like('work_date', $key, 'both');
$this->db->or_like('Business_name', $key, 'both');
$this->db->or_like('Business_Type', $key, 'both');
$this->db->or_like('Website', $key, 'both');
$this->db->or_like('Business_Facebook', $key, 'both');
$this->db->or_like('Email_address', $key, 'both');
$this->db->or_like('Contact_number', $key, 'both');
$this->db->or_like('Contact_person', $key, 'both');
$this->db->or_like('Country', $key, 'both');
$this->db->or_like('Remarks', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['work'] = $this->db->get('work')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/work/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('users_id', $key, 'both');
$this->db->or_like('work_date', $key, 'both');
$this->db->or_like('Business_name', $key, 'both');
$this->db->or_like('Business_Type', $key, 'both');
$this->db->or_like('Website', $key, 'both');
$this->db->or_like('Business_Facebook', $key, 'both');
$this->db->or_like('Email_address', $key, 'both');
$this->db->or_like('Contact_number', $key, 'both');
$this->db->or_like('Contact_person', $key, 'both');
$this->db->or_like('Country', $key, 'both');
$this->db->or_like('Remarks', $key, 'both');

		$config['total_rows'] = $this->db->from("work")->count_all_results();
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
		$data['_view'] = 'admin/work/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export work
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'work_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $workData = $this->Work_model->get_all_work();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Users Id","Work Date","Business Name","Business Type","Website","Business Facebook","Email Address","Contact Number","Contact Person","Country","Remarks"); 
		   fputcsv($file, $header);
		   foreach ($workData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $work = $this->db->get('work')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/work/print_template.php');
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
//End of Work controller