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
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 131px;">Date</th>
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 226px;">Entered By</th>
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 396px;">Drug Name</th>
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 122px;">Dosage</th>
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">Duration</th>
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">Refill</th>
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">Issue Status</th>
					  <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px; display: none;">PrescriptionStatus</th>
					</tr>
				  </thead>
				  <tbody>
					<tr class="odd">
					  <td class="dtr-control" tabindex="0">29 Sep 2018 06:15</td>
					  <td>Mr Arun Das</td>
					  <td>Rantac 150mg</td>
					  <td>1 tab BBF</td>
					  <td style="display: none;">29 Sep 2018 to 31 Dec 9999</td>
					  <td style="display: none;">UNKNOWN</td>
					  <td style="display: none;">InformationOnly</td>
					  <td style="display: none;">NotActive</td>
					</tr>
					<tr class="even">
					  <td class="dtr-control" tabindex="0">11 Aug 2021 07:52</td>
					  <td>Ms Rose Mar Abuyabor</td>
					  <td>VIT D3 50~000 IU/CAP~ 1 CAP PER WEEK FOR 8 WEEKS</td>
					  <td>NA</td>
					  <td style="display: none;">11 Aug 2021 to 31 Dec 9999</td>
					  <td style="display: none;">UNKNOWN</td>
					  <td style="display: none;">InformationOnly</td>
					  <td style="display: none;">NotActive</td>
					</tr>
					<tr class="odd">
					  <td class="dtr-control" tabindex="0">17 Aug 2021 08:28</td>
					  <td>Jeffrey Barbas</td>
					  <td>MULTIVITAMINS 1TAB OD - RX</td>
					  <td>NA</td>
					  <td style="display: none;">17 Aug 2021 to 31 Dec 9999</td>
					  <td style="display: none;">UNKNOWN</td>
					  <td style="display: none;">InformationOnly</td>
					  <td style="display: none;">NotActive</td>
					</tr>
					<tr class="even">
					  <td class="dtr-control" tabindex="0">16 Mar 2022 18:19</td>
					  <td>Mr Frenard Bascoguin</td>
					  <td>PANADOL 1 TAB BID - 2</td>
					  <td>NA</td>
					  <td style="display: none;">16 Mar 2022 to 31 Dec 9999</td>
					  <td style="display: none;">UNKNOWN</td>
					  <td style="display: none;">InformationOnly</td>
					  <td style="display: none;">NotActive</td>
					</tr>
					<tr class="odd">
					  <td class="dtr-control" tabindex="0">01 Dec 2018 07:09</td>
					  <td>Mr Jobish Jose</td>
					  <td>Allerfin 4mg</td>
					  <td>1 tab HS</td>
					  <td style="display: none;">01 Dec 2018 to 31 Dec 9999</td>
					  <td style="display: none;">UNKNOWN</td>
					  <td style="display: none;">InformationOnly</td>
					  <td style="display: none;">NotActive</td>
					</tr>
					<tr class="even">
					  <td class="dtr-control" tabindex="0">03 Mar 2019 13:57</td>
					  <td>Mr Jobish Jose</td>
					  <td>advilcold</td>
					  <td>1 tab bid</td>
					  <td style="display: none;">03 Mar 2019 to 31 Dec 9999</td>
					  <td style="display: none;">UNKNOWN</td>
					  <td style="display: none;">InformationOnly</td>
					  <td style="display: none;">NotActive</td>
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