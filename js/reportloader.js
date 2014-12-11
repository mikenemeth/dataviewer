function reportLoad(page) {
	
	$('#ajaxLoading').show();
	$('#content').hide();
	
	$.ajax({
		type: 'GET', 
		url: page, 
		success: function(page) {
			$('#content').html(page);
			$('#ajaxLoading').hide();
			$('#content').show();
		}
	});

}

function reportGet(report, store) {
	
	$('#ajaxLoading').show();
	$('#reportContainer').hide();
	
    $.ajax({
      type: "GET",
	  url: report, 
      data: ({'store' :store}),
      success: function(data) {
        $('#reportContainer').html(data);
		$('#ajaxLoading').hide();
		$('#reportContainer').show();
      }
    });
}

function getSalesReport(report) {
	var data = $("form").serialize();
		$('#ajaxLoading').show();
		$('#reportContainer').hide();
		
		$.ajax({
		  type: "POST",
		  url: report, 
		  data: data,
		  success: function(data) {
			$('#reportContainer').html(data);
			$('#ajaxLoading').hide();
			$('#reportContainer').show();
		  }
		});
}
