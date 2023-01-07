<?php require_once('../system/api/inc/config.php'); ?>
<style>
@media (max-width: 575.98px) {
	#dashboard-myDataTable1_info{
		text-align: left !important;
	}
	#dashboard-myDataTable1_paginate ul.pagination{
		text-align: right !important;
		justify-content: right !important;
	}
	#dashboard-myDataTable1_filter label {
		float: right !important;
	}
	table#dashboard-myDataTable1 tbody tr td ul.dtr-details{
		padding-left: 0rem !important;
	}
	.Pfieldset {
		padding: 1rem 0rem 0rem 0rem !important;
		}
	.dtr-title{
		font-weight: bolder !important;
	}
}
.daterangepicker .calendar-time {
    padding: 5px 0px;
    background-color: #a5a5a5;
}
.daterangepicker select.hourselect, .daterangepicker select.minuteselect, .daterangepicker select.secondselect, .daterangepicker select.ampmselect {
    width: 60px;
    padding: 4px;
    font-size: 15px;
    border-radius: 3px;
}
</style>



<?php if(!isset($_GET['action'])){ ?>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
<div class="container-fluid">
	<div class="col-xl-12 col-lg-12 col-md-12">
		 <div class="card">
			<div class="card-header">
			   <h6 class="card-title m-0">My Appointments</h6>
			   <div class="dropdown morphing scale-left">
				  <a class="btn btn-primary mb-2 m-link" href="<?=SITEURL."appointments?action=".encode('add');?>"><i class="fa fa-clock-o" aria-hidden="true"></i> Book Appointment</a>
			   </div>
			</div>
			<div class="card-body">
			   <table id="dashboard-myDataTable1" class="table card-table table-hover align-middle mb-0">
				  <thead>
					<tr>
						<th>Date Time</th>
						<th>Hospital</th>
						<th>Service</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				  </thead>
				  <tbody>
					 <tr>
						<td>Nov 25 2022, 11:10AM</td>
						<td>Hemaila</td>
						<td>Dental</td>
						<td>Upcoming</td>
						<td>
							<a href="<?=SITEURL."appointments.php?action=".encode('add').'&a='.encode('1');?>" class="btn btn-sm bg-success text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Manage"><i class="fa fa-gear"></i></a>
							<button type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"><i class="fa fa-trash"></i></button>
						</td>
					 </tr>
					 <tr>
						<td>Nov 15 2022, 09:40AM</td>
						<td>Hemaila</td>
						<td>OPD</td>
						<td>Done</td>
						<td>
							<a href="<?=SITEURL."appointments.php?action=".encode('add').'&a='.encode('2');?>" class="btn btn-sm bg-success text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Manage"><i class="fa fa-gear"></i></a>
							<button type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"><i class="fa fa-trash"></i></button>
						</td>
					 </tr>
					 <tr>
						<td>Nov 10 2022, 06:40AM</td>
						<td>Mesaimer</td>
						<td>OPD</td>
						<td>Done</td>
						<td>
							<a href="<?=SITEURL."appointments.php?action=".encode('add').'&a='.encode('3');?>" class="btn btn-sm bg-success text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Manage"><i class="fa fa-gear"></i></a>
							<button type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"><i class="fa fa-trash"></i></button>
						</td>
					 </tr>
					 <tr>
						<td>Nov 09 2022, 07:00AM</td>
						<td>Freej Abdulaziz</td>
						<td>OPD</td>
						<td>Cancle</td>
						<td>
							<a href="<?=SITEURL."appointments.php?action=".encode('add').'&a='.encode('4');?>" class="btn btn-sm bg-success text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Manage"><i class="fa fa-gear"></i></a>
							<button type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"><i class="fa fa-trash"></i></button>
						</td>
					 </tr>
				  </tbody>
			   </table>
			</div>
		 </div>
	</div>
</div>
</div>
<?php } else if(isset($_GET['action'])&&decode($_GET['action'])!=''&&decode($_GET['action'])=='add'){ ?>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
<div class="container-fluid">
	<div class="row g-3 row-deck">
		<div id="list-item-1" class="Pfieldset card fieldset border border-muted mt-0">
			<span class="fieldset-tile text-muted bg-body">Appointment Information</span>
			<div class="card">
				<div class="card-body">
					<form>
						<div class="row mb-3">
							<label class="col-md-3 col-sm-4 col-form-label">Date Time *</label>
							<div class="col-md-5 col-sm-4">
								<input type="datetime" name="appointmentDateTime" class="form-control form-control-lg" value="">
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-md-3 col-sm-4 col-form-label">Hospital *</label>
							<div class="col-md-9 col-sm-8">
								<select class="form-control form-control-lg">
									<option value="">Select a Hospital</option>
									<option value="Hemaila">Hemaila</option>
									<option value="Freej Abdulaziz">Freej Abdulaziz</option>
									<option value="Mesaimer">Mesaimer</option>
									<option value="Zekret">Zekret</option>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-md-3 col-sm-4 col-form-label">Services *</label>
							<div class="col-md-9 col-sm-8">
								<select class="form-control form-control-lg">
									<option value="">Select a Service</option>
									<option value="Hemaila">blood services</option>
									<option value="Freej Abdulaziz">x ray/radiology services</option>
									<option value="Mesaimer">physical therapy</option>
									<option value="Zekret">dental services</option>
								</select>
							</div>
						</div>
						
						<!--
						<div class="row mb-3">
							<label class="col-md-3 col-sm-4 col-form-label">Communication *</label>
							<div class="col-md-9 col-sm-8">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="s_Phone" value="option1">
									<label class="form-check-label" for="s_Phone">Phone</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="s_Email" value="option2">
									<label class="form-check-label" for="s_Email">Email</label>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-md-3 col-sm-4 col-form-label">Available for freelance?</label>
							<div class="col-md-9 col-sm-8">
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" role="switch" id="freelance">
									<label class="form-check-label" for="freelance">Yes, advertise my availability on my profile page</label>
								</div>
							</div>
						</div>
						-->
						
					</form>
				</div>
				<div class="card-footer text-end">
					<a class="btn btn-lg btn-light me-2 m-link" href="<?=SITEURL."appointments"?>">Discard</a>
					<button class="btn btn-lg btn-primary" type="submit">Save Changes</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>





<?php } ?>

    <script src="<?=BASEURL?>assets/js/mainMenu.js?ver<?=strtotime("now");?>"></script>

<script>
// project data table
$('#dashboard-myDataTable1').addClass('nowrap').dataTable({
	responsive: true,
	searching: true, 
	paging: true, 
	info: true,
	sorting: true,
	lengthChange: false
});

$(function() {
	$('input[name="appointmentDateTime"]').daterangepicker({
    timePicker: true,
    singleDatePicker: true,
    autoApply: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'DD-M-Y  hh:mm A'
    }
  });
});
</script>