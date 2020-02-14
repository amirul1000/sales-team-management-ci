<a  href="<?php echo site_url('admin/messages/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Messages'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/messages/save/'.$messages['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
                                    <label for="From Users" class="col-md-4 control-label">From Users</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Users_model'); 
             $dataArr = $this->CI->Users_model->get_all_users(); 
          ?> 
          <select name="from_users_id"  id="from_users_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($messages['from_users_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['email']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
                                    <label for="To Users" class="col-md-4 control-label">To Users</label> 
         <div class="col-md-8"> 
          <?php 
             $this->CI =& get_instance(); 
             $this->CI->load->database();  
             $this->CI->load->model('Users_model'); 
             $dataArr = $this->CI->Users_model->get_all_users(); 
          ?> 
          <select name="to_users_id"  id="to_users_id"  class="form-control"/> 
            <option value="">--Select--</option> 
            <?php 
             for($i=0;$i<count($dataArr);$i++) 
             {  
            ?> 
            <option value="<?=$dataArr[$i]['id']?>" <?php if($messages['to_users_id']==$dataArr[$i]['id']){ echo "selected";} ?>><?=$dataArr[$i]['email']?></option> 
            <?php 
             } 
            ?> 
          </select> 
         </div> 
           </div>
<div class="form-group"> 
          <label for="Subject" class="col-md-4 control-label">Subject</label> 
          <div class="col-md-8"> 
           <input type="text" name="subject" value="<?php echo ($this->input->post('subject') ? $this->input->post('subject') : $messages['subject']); ?>" class="form-control" id="subject" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Message" class="col-md-4 control-label">Message</label> 
          <div class="col-md-8"> 
           <textarea  name="message"  id="message"  class="form-control" rows="4"/><?php echo ($this->input->post('message') ? $this->input->post('message') : $messages['message']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Read Status" class="col-md-4 control-label">Read Status</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('messages','read_status'); 
           ?> 
           <select name="read_status"  id="read_status"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($messages['read_status']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php 
              } 
             ?> 
           </select> 
          </div> 
            </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($messages['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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