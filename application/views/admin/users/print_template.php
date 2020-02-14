<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Users'); ?></h3>
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
<!--Data display of users-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>Representative</th>
<th>Email</th>
<th>Password</th>
<th>Title</th>
<th>First Name</th>
<th>Last Name</th>
<th>Company</th>
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
<th>Country</th>
<th>Type</th>
<th>Status</th>

    </tr>
	<?php foreach($users as $c){ ?>
    <tr>
		<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Representative_model');
									   $dataArr = $this->CI->Representative_model->get_representative($c['representative_id']);
									   echo $dataArr['Full_Name'];?>
									</td>
<td><?php echo $c['email']; ?></td>
<td><?php echo $c['password']; ?></td>
<td><?php echo $c['title']; ?></td>
<td><?php echo $c['first_name']; ?></td>
<td><?php echo $c['last_name']; ?></td>
<td><?php echo $c['company']; ?></td>
<td><?php echo $c['address']; ?></td>
<td><?php echo $c['city']; ?></td>
<td><?php echo $c['state']; ?></td>
<td><?php echo $c['zip']; ?></td>
<td><?php
									   $this->CI =& get_instance();
									   $this->CI->load->database();	
									   $this->CI->load->model('Country_model');
									   $dataArr = $this->CI->Country_model->get_country($c['country_id']);
									   echo $dataArr['country'];?>
									</td>
<td><?php echo $c['type']; ?></td>
<td><?php echo $c['status']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of users//--> 