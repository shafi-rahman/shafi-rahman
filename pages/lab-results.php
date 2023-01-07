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
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 156px;">Date</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 261px;">Entered By</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 80px;">Test Code</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 300px;">Test</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">Numeric Value</th>
						<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">Template Label</th>
					</tr>
				</thead>
				<tbody>
					  <tr class="odd">
						<td class="dtr-control" tabindex="0">08 Aug 2021 09:46</td>
						<td>Mrs Smitha Thottumkal Sivankuty</td>
						<td>X774f</td>
						<td>Respiratory rate</td>
						<td style="display: none;">18.0 breaths/min</td>
						<td style="display: none;">Respiratory rate</td>
					  </tr>
					  <tr class="even">
						<td class="dtr-control" tabindex="0">29 Sep 2018 06:15</td>
						<td>Mr Arun Das</td>
						<td>2469.</td>
						<td>O/E - Systolic BP reading</td>
						<td style="display: none;">138.0 mmHg</td>
						<td style="display: none;">-</td>
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