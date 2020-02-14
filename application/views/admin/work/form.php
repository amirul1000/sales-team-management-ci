<a  href="<?php echo site_url('admin/work/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Work'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/work/save/'.$work['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="Users" class="col-md-4 control-label">Users</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Users_model'); 
             $dataArr = $this->CI->Users_model->get_all_users(); 
          ?> 
          <select name="users_id"  id="users_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($work['users_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['email']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                       <label for="Work Date" class="col-md-4 control-label">Work Date</label> 
            <div class="col-md-8"> 
           <input type="text" name="work_date"  id="work_date"  value="<?php echo ($this->input->post('work_date') ? $this->input->post('work_date') : $work['work_date']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
          <label for="Business Name" class="col-md-4 control-label">Business Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="Business_name" value="<?php echo ($this->input->post('Business_name') ? $this->input->post('Business_name') : $work['Business_name']); ?>" class="form-control" id="Business_name" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Business Type" class="col-md-4 control-label">Business Type</label> 
          <div class="col-md-8"> 
           <input type="text" name="Business_Type" value="<?php echo ($this->input->post('Business_Type') ? $this->input->post('Business_Type') : $work['Business_Type']); ?>" class="form-control" id="Business_Type" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Website" class="col-md-4 control-label">Website</label> 
          <div class="col-md-8"> 
           <input type="text" name="Website" value="<?php echo ($this->input->post('Website') ? $this->input->post('Website') : $work['Website']); ?>" class="form-control" id="Website" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Business Facebook" class="col-md-4 control-label">Business Facebook</label> 
          <div class="col-md-8"> 
           <input type="text" name="Business_Facebook" value="<?php echo ($this->input->post('Business_Facebook') ? $this->input->post('Business_Facebook') : $work['Business_Facebook']); ?>" class="form-control" id="Business_Facebook" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Email Address" class="col-md-4 control-label">Email Address</label> 
          <div class="col-md-8"> 
           <input type="text" name="Email_address" value="<?php echo ($this->input->post('Email_address') ? $this->input->post('Email_address') : $work['Email_address']); ?>" class="form-control" id="Email_address" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Contact Number" class="col-md-4 control-label">Contact Number</label> 
          <div class="col-md-8"> 
           <input type="text" name="Contact_number" value="<?php echo ($this->input->post('Contact_number') ? $this->input->post('Contact_number') : $work['Contact_number']); ?>" class="form-control" id="Contact_number" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Contact Person" class="col-md-4 control-label">Contact Person</label> 
          <div class="col-md-8"> 
           <input type="text" name="Contact_person" value="<?php echo ($this->input->post('Contact_person') ? $this->input->post('Contact_person') : $work['Contact_person']); ?>" class="form-control" id="Contact_person" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Country" class="col-md-4 control-label">Country</label> 
          <div class="col-md-8"> 
           <input type="text" name="Country" value="<?php echo ($this->input->post('Country') ? $this->input->post('Country') : $work['Country']); ?>" class="form-control" id="Country" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Remarks" class="col-md-4 control-label">Remarks</label> 
          <div class="col-md-8"> 
           <textarea  name="Remarks"  id="Remarks"  class="form-control" rows="4"/><?php echo ($this->input->post('Remarks') ? $this->input->post('Remarks') : $work['Remarks']); ?></textarea> 
          </div> 
           </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($work['id'])){?>Save<?php }else{?>Update<?php } ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->	
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>  			