<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Work'); ?></h5>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/work/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/work/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/work/search/',array("class"=>"form-horizontal")); ?>
                    <input name="key" type="text"
				value="<?php echo isset($key)?$key:'';?>" placeholder="Search..."
				class="form-control">
				<button type="submit" class="mr-0">
					<i class="fa fa-search"></i>
				</button>
                <?php echo form_close(); ?>
            </li>
		</ul>
	</div>
</div>
<!--End of Action//--> 
   
<!--Data display of work-->       
<table class="table table-striped table-bordered">
    <tr>
		<th>Users</th>
<th>Work Date</th>
<th>Business Name</th>
<th>Business Type</th>
<th>Website</th>
<th>Business Facebook</th>
<th>Email Address</th>
<th>Contact Number</th>
<th>Contact Person</th>
<th>Country</th>
<th>Remarks</th>

		<th>Actions</th>
    </tr>
	<?php foreach($work as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Users_model');
									   $dataArr = $this->CI->Users_model->get_users($c['users_id']);
									   echo $dataArr['email'];?>
									</td>
<td><?php echo $c['work_date']; ?></td>
<td><?php echo $c['Business_name']; ?></td>
<td><?php echo $c['Business_Type']; ?></td>
<td><?php echo $c['Website']; ?></td>
<td><?php echo $c['Business_Facebook']; ?></td>
<td><?php echo $c['Email_address']; ?></td>
<td><?php echo $c['Contact_number']; ?></td>
<td><?php echo $c['Contact_person']; ?></td>
<td><?php echo $c['Country']; ?></td>
<td><?php echo $c['Remarks']; ?></td>

		<td>
            <a href="<?php echo site_url('admin/work/details/'.$c['id']); ?>"  class="action-icon"> <i class="zmdi zmdi-eye"></i></a>
            <a href="<?php echo site_url('admin/work/save/'.$c['id']); ?>" class="action-icon"> <i class="zmdi zmdi-edit"></i></a>
            <a href="<?php echo site_url('admin/work/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="zmdi zmdi-delete"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<!--End of Data display of work//--> 

<!--No data-->
<?php
	if(count($work)==0){
?>
 <div align="center"><h3>Data is not exists</h3></div>
<?php
	}
?>
<!--End of No data//-->

<!--Pagination-->
<?php
	echo $link;
?>
<!--End of Pagination//-->
