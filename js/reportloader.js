function reportLoad(page) {

	var contentDiv = document.getElementById("content");
	var client = new XMLHttpRequest();
	
	client.open("GET", page);
	client.onreadystatechange = function() {
	
		if(this.readyState == 4 && this.status == 200) {
		
			if(this.response != null) {
			
				contentDiv.innerHTML = this.response;
				
			}
		}
	}
	
	client.send();
}

function reportGet(report) {

	var reportDiv = document.getElementById("reportContainer");
	var client = new XMLHttpRequest();
	
	client.open("GET", report);
	client.onreadystatechange = function() {
	
		if(this.readyState == 4 && this.status == 200) {
		
			if(this.response != null) {
			
				reportDiv.innerHTML = this.response;
				
			}
		}
	}
	
	client.send();
}

function reportGet(report, store) {
    $.ajax({
      type: "GET",
	  url: report, 
      data: ({'store' :store}),
      success: function(data) {
        $('#reportContainer').html(data);
      }
    });
}