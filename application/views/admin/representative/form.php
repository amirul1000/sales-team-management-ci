<a  href="<?php echo site_url('admin/representative/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Representative'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/representative/save/'.$representative['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
          <label for="Full Name" class="col-md-4 control-label">Full Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="Full_Name" value="<?php echo ($this->input->post('Full_Name') ? $this->input->post('Full_Name') : $representative['Full_Name']); ?>" class="form-control" id="Full_Name" /> 
          </div> 
           </div>
<div class="form-group"> 
                                       <label for="Date Of Birth" class="col-md-4 control-label">Date Of Birth</label> 
            <div class="col-md-8"> 
           <input type="text" name="Date_of_birth"  id="Date_of_birth"  value="<?php echo ($this->input->post('Date_of_birth') ? $this->input->post('Date_of_birth') : $representative['Date_of_birth']); ?>" class="form-control-static datepicker"/> 
            </div> 
           </div>
<div class="form-group"> 
          <label for="Email Address" class="col-md-4 control-label">Email Address</label> 
          <div class="col-md-8"> 
           <input type="text" name="Email_address" value="<?php echo ($this->input->post('Email_address') ? $this->input->post('Email_address') : $representative['Email_address']); ?>" class="form-control" id="Email_address" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Telephone Number" class="col-md-4 control-label">Telephone Number</label> 
          <div class="col-md-8"> 
           <input type="text" name="Telephone_number" value="<?php echo ($this->input->post('Telephone_number') ? $this->input->post('Telephone_number') : $representative['Telephone_number']); ?>" class="form-control" id="Telephone_number" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Facebook URL" class="col-md-4 control-label">Facebook URL</label> 
          <div class="col-md-8"> 
           <input type="text" name="Facebook_URL" value="<?php echo ($this->input->post('Facebook_URL') ? $this->input->post('Facebook_URL') : $representative['Facebook_URL']); ?>" class="form-control" id="Facebook_URL" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Country You Currently Live" class="col-md-4 control-label">Country You Currently Live</label> 
          <div class="col-md-8"> 
           <input type="text" name="Country_you_currently_live" value="<?php echo ($this->input->post('Country_you_currently_live') ? $this->input->post('Country_you_currently_live') : $representative['Country_you_currently_live']); ?>" class="form-control" id="Country_you_currently_live" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Any Languages You Speak" class="col-md-4 control-label">Any Languages You Speak</label> 
          <div class="col-md-8"> 
           <input type="text" name="Any_languages_you_speak" value="<?php echo ($this->input->post('Any_languages_you_speak') ? $this->input->post('Any_languages_you_speak') : $representative['Any_languages_you_speak']); ?>" class="form-control" id="Any_languages_you_speak" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Preferred Payment Method" class="col-md-4 control-label">Preferred Payment Method</label> 
          <div class="col-md-8"> 
           <input type="text" name="Preferred_payment_method" value="<?php echo ($this->input->post('Preferred_payment_method') ? $this->input->post('Preferred_payment_method') : $representative['Preferred_payment_method']); ?>" class="form-control" id="Preferred_payment_method" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Why To Join" class="col-md-4 control-label">Why To Join</label> 
          <div class="col-md-8"> 
           <textarea  name="why_to_join"  id="why_to_join"  class="form-control" rows="4"/><?php echo ($this->input->post('why_to_join') ? $this->input->post('why_to_join') : $representative['why_to_join']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Why Choose" class="col-md-4 control-label">Why Choose</label> 
          <div class="col-md-8"> 
           <textarea  name="why_choose"  id="why_choose"  class="form-control" rows="4"/><?php echo ($this->input->post('why_choose') ? $this->input->post('why_choose') : $representative['why_choose']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Skill" class="col-md-4 control-label">Skill</label> 
          <div class="col-md-8"> 
           <textarea  name="skill"  id="skill"  class="form-control" rows="4"/><?php echo ($this->input->post('skill') ? $this->input->post('skill') : $representative['skill']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Referred By" class="col-md-4 control-label">Referred By</label> 
          <div class="col-md-8"> 
           <input type="text" name="referred_by" value="<?php echo ($this->input->post('referred_by') ? $this->input->post('referred_by') : $representative['referred_by']); ?>" class="form-control" id="referred_by" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Apply Status" class="col-md-4 control-label">Apply Status</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('representative','apply_status'); 
           ?> 
           <select name="apply_status"  id="apply_status"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($representative['apply_status']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php 
              } 
             ?> 
           </select> 
          </div> 
            </div>
<div class="form-group"> 
                                        <label for="Status" class="col-md-4 control-label">Status</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('representative','status'); 
           ?> 
           <select name="status"  id="status"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($representative['status']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
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
        <button type="submit" class="btn btn-success"><?php if(empty($representative['id'])){?>Save<?php }else{?>Update<?php } ?></button>
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