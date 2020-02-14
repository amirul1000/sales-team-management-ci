<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Representative'); ?></h5>
<!--Action-->
<div>
	<div class="float_left padding_10">
		<a href="<?php echo site_url('admin/representative/save'); ?>"
			class="btn btn-success">Add</a>
	</div>
	<div class="float_left padding_10">
		<i class="fa fa-download"></i> Export <select name="xeport_type" class="select"
			onChange="window.location='<?php echo site_url('admin/representative/export'); ?>/'+this.value">
			<option>Select..</option>
			<option>Pdf</option>
			<option>CSV</option>
		</select>
	</div>
	<div  class="float_right padding_10">
		<ul class="left-side-navbar d-flex align-items-center">
			<li class="hide-phone app-search mr-15">
                <?php echo form_open_multipart('admin/representative/search/',array("class"=>"form-horizontal")); ?>
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
   
<!--Data display of representative-->       
<table class="table table-striped table-bordered">
    <tr>
		<th>Full Name</th>
<th>Date Of Birth</th>
<th>Email Address</th>
<th>Telephone Number</th>
<th>Facebook URL</th>
<th>Country You Currently Live</th>
<th>Any Languages You Speak</th>
<th>Preferred Payment Method</th>
<th>Why To Join</th>
<th>Why Choose</th>
<th>Skill</th>
<th>Referred By</th>
<th>Apply Status</th>
<th>Status</th>

		<th>Actions</th>
    </tr>
	<?php foreach($representative as $c){ ?>
    <tr>
		<td><?php echo $c['Full_Name']; ?></td>
<td><?php echo $c['Date_of_birth']; ?></td>
<td><?php echo $c['Email_address']; ?></td>
<td><?php echo $c['Telephone_number']; ?></td>
<td><?php echo $c['Facebook_URL']; ?></td>
<td><?php echo $c['Country_you_currently_live']; ?></td>
<td><?php echo $c['Any_languages_you_speak']; ?></td>
<td><?php echo $c['Preferred_payment_method']; ?></td>
<td><?php echo $c['why_to_join']; ?></td>
<td><?php echo $c['why_choose']; ?></td>
<td><?php echo $c['skill']; ?></td>
<td><?php echo $c['referred_by']; ?></td>
<td><?php echo $c['apply_status']; ?></td>
<td><?php echo $c['status']; ?></td>

		<td>
            <a href="<?php echo site_url('admin/representative/details/'.$c['id']); ?>"  class="action-icon"> <i class="zmdi zmdi-eye"></i></a>
            <a href="<?php echo site_url('admin/representative/save/'.$c['id']); ?>" class="action-icon"> <i class="zmdi zmdi-edit"></i></a>
            <a href="<?php echo site_url('admin/representative/remove/'.$c['id']); ?>" onClick="return confirm('Are you sure to delete this item?');" class="action-icon"> <i class="zmdi zmdi-delete"></i></a>
        </td>
    </tr>
	<?php } ?>
</table>
<!--End of Data display of representative//--> 

<!--No data-->
<?php
	if(count($representative)==0){
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
