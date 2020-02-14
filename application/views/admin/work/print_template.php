<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Work'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of work-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
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

    </tr>
	<?php } ?>
</table>
<!--End of Data display of work//--> 