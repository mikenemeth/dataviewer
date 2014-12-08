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