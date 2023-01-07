
$('.m-link').click(function(){
	$('#mainMenu').removeClass('open');
	$("div.spanner").addClass("show");
	page_lod($(this).attr('href').split('#')[1]);
});

function getAjaxCall(gaurl) {
	// console.log('getAjaxCall from menu');
	return new Promise(function (resolve, reject) {
		$.get(gaurl, function(data, status){
			resolve(data);
		});
	});
} 

function page_lod(page){
	$("#contents").empty();
	$('.breadcrumb-item').empty().html('<a class="text-secondary"><i class="fa fa-h-square" aria-hidden="true"></i> '+page.split('?')[0][0].toUpperCase() + page.split('?')[0].slice(1)+'</a>');
	if(page=='dashboard'){ $('.dash-top-msg').css('display', 'block'); } else { $('.dash-top-msg').css('display', 'none'); }
	$('div.main-menu ul.menu-list li a').removeClass('active');
	$('div.main-menu ul.menu-list li a').each(function(){
		var $this = $(this);
		if($this.attr('href').indexOf(page) !== -1){
			$this.addClass('active');
		}
	});
	
	var gaurl = "http://172.21.12.73/mPatient/system/api/api.php?action=test_api_call";
  
  	var promise = getAjaxCall(gaurl);  
	promise.then(function (values) {
		// console.log(values);
		var post = $.parseJSON(values);
		$("#contents").load('pages/'+page+'.php', post, function (responseText, textStatus, req) {
			$("div.spanner").removeClass("show");
			if(textStatus == "error") {
				console.log("Error from main menu : "+textStatus);
			}
		});
		
		// console.log('end getAjaxCall from menu');
	});
}

function page404(){
  if($('#contents').is(':empty')){
	  $("#contents").empty().load('pages/404.php');
  }
}