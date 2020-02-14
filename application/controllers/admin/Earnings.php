<?php

 /**
 * Author: Amirul Momenin
 * Desc:Earnings Controller
 *
 */
class Earnings extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Earnings_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of earnings table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['earnings'] = $this->Earnings_model->get_limit_earnings($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/earnings/index');
		$config['total_rows'] = $this->Earnings_model->get_count_earnings();
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
		
        $data['_view'] = 'admin/earnings/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save earnings
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		$date_created = "";

		if($id<=0){
															 $date_created = date("Y-m-d H:i:s");
														 }

		$params = array(
					 'users_id' => html_escape($this->input->post('users_id')),
'debit' => html_escape($this->input->post('debit')),
'credit' => html_escape($this->input->post('credit')),
'date_created' =>$date_created,

				);
		 
		if($id>0){
							                        unset($params['date_created']);
						                          } 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['earnings'] = $this->Earnings_model->get_earnings($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Earnings_model->update_earnings($id,$params);
                redirect('admin/earnings/index');
            }else{
                $data['_view'] = 'admin/earnings/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $earnings_id = $this->Earnings_model->add_earnings($params);
                redirect('admin/earnings/index');
            }else{  
			    $data['earnings'] = $this->Earnings_model->get_earnings(0);
                $data['_view'] = 'admin/earnings/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details earnings
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['earnings'] = $this->Earnings_model->get_earnings($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/earnings/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting earnings
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $earnings = $this->Earnings_model->get_earnings($id);

        // check if the earnings exists before trying to delete it
        if(isset($earnings['id'])){
            $this->Earnings_model->delete_earnings($id);
            redirect('admin/earnings/index');
        }
        else
            show_error('The earnings you are trying to delete does not exist.');
    }
	
	/**
     * Search earnings
	 * @param $start - Starting of earnings table's index to get query
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
$this->db->or_like('debit', $key, 'both');
$this->db->or_like('credit', $key, 'both');
$this->db->or_like('date_created', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['earnings'] = $this->db->get('earnings')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/earnings/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('users_id', $key, 'both');
$this->db->or_like('debit', $key, 'both');
$this->db->or_like('credit', $key, 'both');
$this->db->or_like('date_created', $key, 'both');

		$config['total_rows'] = $this->db->from("earnings")->count_all_results();
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
		$data['_view'] = 'admin/earnings/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export earnings
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'earnings_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $earningsData = $this->Earnings_model->get_all_earnings();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Users Id","Debit","Credit","Date Created"); 
		   fputcsv($file, $header);
		   foreach ($earningsData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $earnings = $this->db->get('earnings')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/earnings/print_template.php');
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
//End of Earnings controller