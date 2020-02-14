<a  href="<?php echo site_url('admin/messages/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Messages'); ?></h5>
<!--Data display of messages with id--> 
<?php
	$c = $messages;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>From Users</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['from_users_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>To Users</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['to_users_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>Subject</td><td><?php echo $c['subject']; ?></td></tr>

<tr><td>Message</td><td><?php echo $c['message']; ?></td></tr>

<tr><td>Date Created</td><td><?php echo $c['date_created']; ?></td></tr>

<tr><td>Read Status</td><td><?php echo $c['read_status']; ?></td></tr>


</table>
<!--End of Data display of messages with id//--> 