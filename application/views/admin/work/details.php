<a  href="<?php echo site_url('admin/work/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Work'); ?></h5>
<!--Data display of work with id--> 
<?php
	$c = $work;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Users</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>Work Date</td><td><?php echo $c['work_date']; ?></td></tr>

<tr><td>Business Name</td><td><?php echo $c['Business_name']; ?></td></tr>

<tr><td>Business Type</td><td><?php echo $c['Business_Type']; ?></td></tr>

<tr><td>Website</td><td><?php echo $c['Website']; ?></td></tr>

<tr><td>Business Facebook</td><td><?php echo $c['Business_Facebook']; ?></td></tr>

<tr><td>Email Address</td><td><?php echo $c['Email_address']; ?></td></tr>

<tr><td>Contact Number</td><td><?php echo $c['Contact_number']; ?></td></tr>

<tr><td>Contact Person</td><td><?php echo $c['Contact_person']; ?></td></tr>

<tr><td>Country</td><td><?php echo $c['Country']; ?></td></tr>

<tr><td>Remarks</td><td><?php echo $c['Remarks']; ?></td></tr>


</table>
<!--End of Data display of work with id//--> 