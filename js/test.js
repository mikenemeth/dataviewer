function autocomplete() {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#searchid').val();
	if (keyword.length >= min_length) {
			$('#result').html('<p>It works.</p>');
	}
}