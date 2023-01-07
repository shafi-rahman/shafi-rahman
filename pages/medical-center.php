<?php require_once('../system/api/inc/config.php'); ?>
<style>
@media (max-width: 575.98px) {
	.dash-tbl1 {
		//display: none;
	}
	ul.dtr-details {
		padding-left: 0rem !important;
	}
	.dtr-title{
		font-weight: bold !important;
	}
}
.fill-muted {
    fill: #c9c9c9 !important;
}
.fill-secondary {
    fill: #ffd5c4 !important;
}


</style>

<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
<div class="container-fluid">
	
   <div class="row g-3 row-deck">
		<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
			<div class="card">
				<div class="card-body">
					<a href="javascript:void();" alt="get direction"><i class="fa fa-map-marker fa-lg position-absolute top-0 end-0 p-3"></i></a>
					<div>Hemaila <span class="h7"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <span class="small text-muted"> 24 X 7 </span></div>
					<small class="text-muted">Service1 | Service2 | Service3 | Service4 | Service5</small>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
			<div class="card">
				<div class="card-body">
					<a href="javascript:void();" alt="get direction"><i class="fa fa-map-marker fa-lg position-absolute top-0 end-0 p-3"></i></a>
					<div>Freej Abdulaziz <span class="h7"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <span class="small text-muted"> 24 X 7 </span></div>
					<small class="text-muted">Service1 | Service2 | Service3 | Service4 | Service5</small>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
			<div class="card">
				<div class="card-body">
					<a href="javascript:void();" alt="get direction"><i class="fa fa-map-marker fa-lg position-absolute top-0 end-0 p-3"></i></a>
					<div>Mesaimer <span class="h7"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <span class="small text-muted"> 24 X 7 </span></div>
					<small class="text-muted">Service1 | Service2 | Service3 | Service4 | Service5</small>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
			<div class="card">
				<div class="card-body">
					<a href="javascript:void();" alt="get direction"><i class="fa fa-map-marker fa-lg position-absolute top-0 end-0 p-3"></i></a>
					<div>Zekret <span class="h7"><i class="fa fa-clock-o" aria-hidden="true"></i></span> <span class="small text-muted"> 24 X 7 </span></div>
					<small class="text-muted">Service1 | Service2 | Service3 | Service4 | Service5 | Service5</small>
				</div>
			</div>
		</div>
	</div>	
 
	<div class="col-xl-12 col-lg-12 col-md-12 mt-3">
		 <div class="card">
			<div class="card-header">
			   <h6 class="card-title m-0">Special Events</h6>
			   <div class="dropdown morphing scale-left">
				  <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
				  <ul class="dropdown-menu shadow border-0 p-2">
					 <li><a class="dropdown-item" href="#">File Info</a></li>
					 <li><a class="dropdown-item" href="#">Copy to</a></li>
					 <li><a class="dropdown-item" href="#">Move to</a></li>
					 <li><a class="dropdown-item" href="#">Rename</a></li>
					 <li><a class="dropdown-item" href="#">Block</a></li>
					 <li><a class="dropdown-item" href="#">Delete</a></li>
				  </ul>
			   </div>
			</div>
			<div class="card-body">
			   <table id="dashboard-myDataTable1" class="table card-table table-hover align-middle mb-0">
				  <thead>
					 <tr>
						<th class="dash-tbl1">Event</th>
						<th>Medical Center</th>
						<th>Date</th>
						<th>Time</th>
						<th>Status</th>
					 </tr>
				  </thead>
				  <tbody>
					 <tr>
						<td>Full Body Checkup 60% Off</td>
						<td>Mesaimer</td>
						<td>Dec 16, 2022</td>
						<td>7 AM to 1 PM</td>
						<td><span class="badge bg-info">Upcoming</span></td>
					 </tr>
					 <tr>
						<td>Eyes Test</td>
						<td>Mesaimer</td>
						<td>Dec 16, 2022</td>
						<td>7 AM to 1 PM</td>
						<td><span class="badge bg-info">Upcoming</span></td>
					 </tr>
				  </tbody>
			   </table>
			</div>
		 </div>
	</div>
	
</div>
</div>
<script src="<?=BASEURL?>assets/js/mainMenu.js?ver<?=strtotime("now");?>"></script>

<script>
// project data table
$('#dashboard-myDataTable1').addClass('nowrap').dataTable({
	responsive: true,
	searching: false, 
	paging: false, 
	info: false,
	sorting: false
});
</script>