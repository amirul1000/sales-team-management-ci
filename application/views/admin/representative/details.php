<a  href="<?php echo site_url('admin/representative/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Representative'); ?></h5>
<!--Data display of representative with id--> 
<?php
	$c = $representative;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>Full Name</td><td><?php echo $c['Full_Name']; ?></td></tr>

<tr><td>Date Of Birth</td><td><?php echo $c['Date_of_birth']; ?></td></tr>

<tr><td>Email Address</td><td><?php echo $c['Email_address']; ?></td></tr>

<tr><td>Telephone Number</td><td><?php echo $c['Telephone_number']; ?></td></tr>

<tr><td>Facebook URL</td><td><?php echo $c['Facebook_URL']; ?></td></tr>

<tr><td>Country You Currently Live</td><td><?php echo $c['Country_you_currently_live']; ?></td></tr>

<tr><td>Any Languages You Speak</td><td><?php echo $c['Any_languages_you_speak']; ?></td></tr>

<tr><td>Preferred Payment Method</td><td><?php echo $c['Preferred_payment_method']; ?></td></tr>

<tr><td>Why To Join</td><td><?php echo $c['why_to_join']; ?></td></tr>

<tr><td>Why Choose</td><td><?php echo $c['why_choose']; ?></td></tr>

<tr><td>Skill</td><td><?php echo $c['skill']; ?></td></tr>

<tr><td>Referred By</td><td><?php echo $c['referred_by']; ?></td></tr>

<tr><td>Apply Status</td><td><?php echo $c['apply_status']; ?></td></tr>

<tr><td>Status</td><td><?php echo $c['status']; ?></td></tr>


</table>
<!--End of Data display of representative with id//--> 