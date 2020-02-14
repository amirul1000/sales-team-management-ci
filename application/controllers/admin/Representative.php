<?php

 /**
 * Author: Amirul Momenin
 * Desc:Representative Controller
 *
 */
class Representative extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Representative_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of representative table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['representative'] = $this->Representative_model->get_limit_representative($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/representative/index');
		$config['total_rows'] = $this->Representative_model->get_count_representative();
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
		
        $data['_view'] = 'admin/representative/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save representative
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'Full_Name' => html_escape($this->input->post('Full_Name')),
'Date_of_birth' => html_escape($this->input->post('Date_of_birth')),
'Email_address' => html_escape($this->input->post('Email_address')),
'Telephone_number' => html_escape($this->input->post('Telephone_number')),
'Facebook_URL' => html_escape($this->input->post('Facebook_URL')),
'Country_you_currently_live' => html_escape($this->input->post('Country_you_currently_live')),
'Any_languages_you_speak' => html_escape($this->input->post('Any_languages_you_speak')),
'Preferred_payment_method' => html_escape($this->input->post('Preferred_payment_method')),
'why_to_join' => html_escape($this->input->post('why_to_join')),
'why_choose' => html_escape($this->input->post('why_choose')),
'skill' => html_escape($this->input->post('skill')),
'referred_by' => html_escape($this->input->post('referred_by')),
'apply_status' => html_escape($this->input->post('apply_status')),
'status' => html_escape($this->input->post('status')),

				);
		 
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['representative'] = $this->Representative_model->get_representative($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Representative_model->update_representative($id,$params);
                redirect('admin/representative/index');
            }else{
                $data['_view'] = 'admin/representative/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $representative_id = $this->Representative_model->add_representative($params);
                redirect('admin/representative/index');
            }else{  
			    $data['representative'] = $this->Representative_model->get_representative(0);
                $data['_view'] = 'admin/representative/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details representative
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['representative'] = $this->Representative_model->get_representative($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/representative/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting representative
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $representative = $this->Representative_model->get_representative($id);

        // check if the representative exists before trying to delete it
        if(isset($representative['id'])){
            $this->Representative_model->delete_representative($id);
            redirect('admin/representative/index');
        }
        else
            show_error('The representative you are trying to delete does not exist.');
    }
	
	/**
     * Search representative
	 * @param $start - Starting of representative table's index to get query
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
$this->db->or_like('Full_Name', $key, 'both');
$this->db->or_like('Date_of_birth', $key, 'both');
$this->db->or_like('Email_address', $key, 'both');
$this->db->or_like('Telephone_number', $key, 'both');
$this->db->or_like('Facebook_URL', $key, 'both');
$this->db->or_like('Country_you_currently_live', $key, 'both');
$this->db->or_like('Any_languages_you_speak', $key, 'both');
$this->db->or_like('Preferred_payment_method', $key, 'both');
$this->db->or_like('why_to_join', $key, 'both');
$this->db->or_like('why_choose', $key, 'both');
$this->db->or_like('skill', $key, 'both');
$this->db->or_like('referred_by', $key, 'both');
$this->db->or_like('apply_status', $key, 'both');
$this->db->or_like('status', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['representative'] = $this->db->get('representative')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/representative/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('Full_Name', $key, 'both');
$this->db->or_like('Date_of_birth', $key, 'both');
$this->db->or_like('Email_address', $key, 'both');
$this->db->or_like('Telephone_number', $key, 'both');
$this->db->or_like('Facebook_URL', $key, 'both');
$this->db->or_like('Country_you_currently_live', $key, 'both');
$this->db->or_like('Any_languages_you_speak', $key, 'both');
$this->db->or_like('Preferred_payment_method', $key, 'both');
$this->db->or_like('why_to_join', $key, 'both');
$this->db->or_like('why_choose', $key, 'both');
$this->db->or_like('skill', $key, 'both');
$this->db->or_like('referred_by', $key, 'both');
$this->db->or_like('apply_status', $key, 'both');
$this->db->or_like('status', $key, 'both');

		$config['total_rows'] = $this->db->from("representative")->count_all_results();
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
		$data['_view'] = 'admin/representative/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export representative
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'representative_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $representativeData = $this->Representative_model->get_all_representative();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Full Name","Date Of Birth","Email Address","Telephone Number","Facebook URL","Country You Currently Live","Any Languages You Speak","Preferred Payment Method","Why To Join","Why Choose","Skill","Referred By","Apply Status","Status"); 
		   fputcsv($file, $header);
		   foreach ($representativeData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $representative = $this->db->get('representative')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/representative/print_template.php');
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
//End of Representative controller