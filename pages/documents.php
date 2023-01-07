<?php require_once('../system/api/inc/config.php'); ?>
<style>
</style>


<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
<div class="container-fluid">
	<div class="col-xl-12 col-lg-12 col-md-12">
		 <div class="card">
			<!--
			<div class="card-header">
			   <h6 class="card-title m-0">Medications</h6>
			</div> -->
			<div class="card-body">
			   <table id="myDataTable" class="table card-table table-hover align-middle mb-0">
				<thead>
					<tr>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 330px;">Date</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 533px;">Entered By</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">File Name</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">File Action</th>
					</tr>
				</thead>
				<tbody>
				  <tr class="odd">
					<td class="dtr-control" tabindex="0">08 Aug 2021 09:06</td>
					<td>Laurene Rimando</td>
					<td style="display: none;">Foundation Stadium</td>
					<td style="display: none;">
					  <a href="http:\\172.21.10.67\sc_data\Export_20220509_QFS001\QFS Attachments\Attachments\1\Attachment_Qatar Foundation Stadium_669_20210808090603_1148c00000000000_1_0.jpg" class="btn btn-sm btn-primary" target="_blank" style="margin-right: 10px;">
						<i class="fa fa-file-image-o"></i> View </a>
					  <a href="http:\\172.21.10.67\sc_data\Export_20220509_QFS001\QFS Attachments\Attachments\1\Attachment_Qatar Foundation Stadium_669_20210808090603_1148c00000000000_1_0.jpg" class="btn btn-sm btn-primary" target="_blank" download="">
						<i class="fa fa-download"></i>
					  </a>
					</td>
				  </tr>
				  <tr class="even">
					<td class="dtr-control" tabindex="0">27 Sep 2021 09:51</td>
					<td>Abdul Salam</td>
					<td style="display: none;">Qatar Medical Center</td>
					<td style="display: none;">
					  <a href="http:\\172.21.10.67\sc_data\Export_20211021_KIMSALWAKRA\KIMS_Attachments\Attachments\1\Attachment_Kims Qatar Medical Center, Al Wakra_669_20210927095135_8bb9d00000000000_1_0.pdf" class="btn btn-sm btn-primary" target="_blank" style="margin-right: 10px;">
						<i class="fa fa-file-image-o"></i> View </a>
					  <a href="http:\\172.21.10.67\sc_data\Export_20211021_KIMSALWAKRA\KIMS_Attachments\Attachments\1\Attachment_Kims Qatar Medical Center, Al Wakra_669_20210927095135_8bb9d00000000000_1_0.pdf" class="btn btn-sm btn-primary" target="_blank" download="">
						<i class="fa fa-download"></i>
					  </a>
					</td>
				  </tr>
				  <tr class="odd">
					<td class="dtr-control" tabindex="0">30 Jan 2022 08:54</td>
					<td>Mr Frenard Bascoguin</td>
					<td style="display: none;">Crescent Mesaimeer</td>
					<td style="display: none;">
					  <a href="http:\\172.21.10.67\sc_data\Export_20220509_QRC\QRCSMES Attachments\Attachments\1\Attachment_Red Crescent Mesaimeer_669_20220130085416_f7d8e00000000000_1_0.pdf" class="btn btn-sm btn-primary" target="_blank" style="margin-right: 10px;">
						<i class="fa fa-file-image-o"></i> View </a>
					  <a href="http:\\172.21.10.67\sc_data\Export_20220509_QRC\QRCSMES Attachments\Attachments\1\Attachment_Red Crescent Mesaimeer_669_20220130085416_f7d8e00000000000_1_0.pdf" class="btn btn-sm btn-primary" target="_blank" download="">
						<i class="fa fa-download"></i>
					  </a>
					</td>
				  </tr>
				</tbody>
			  </table>
			</div>
		 </div>
	</div>
</div>
</div>

<script src="./assets/js/mainMenu.js?ver<?=strtotime("now");?>"></script>
<script>
// project data table
$('#myDataTable').dataTable({
	responsive: true,
	searching: true, 
	paging: true, 
	info: true,
	sorting: true,
	lengthChange: false
});

</script>