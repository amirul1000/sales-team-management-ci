<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Representative'); ?></h3>
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
<!--Data display of representative-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
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

    </tr>
	<?php } ?>
</table>
<!--End of Data display of representative//--> 