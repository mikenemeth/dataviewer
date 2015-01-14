function autocomplet() {
	var min_length = 1; // min caracters to display the autocomplete
	var keyword = $('#searchid').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#result').show();
				$('#result').html(data);
			}
		});
	} else {
		$('#result').hide();
	}
}
 
// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#searchid').val(item);
	// hide proposition list
	$('#result').hide();
}