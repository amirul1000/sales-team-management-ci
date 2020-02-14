<a  href="<?php echo site_url('admin/earnings/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Earnings'); ?></h5>
<!--Data display of earnings with id--> 
<?php
	$c = $earnings;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Users</td><td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
									   echo $dataArr['email'];?>
									</td></tr>

<tr><td>Debit</td><td><?php echo $c['debit']; ?></td></tr>

<tr><td>Credit</td><td><?php echo $c['credit']; ?></td></tr>

<tr><td>Date Created</td><td><?php echo $c['date_created']; ?></td></tr>


</table>
<!--End of Data display of earnings with id//--> 