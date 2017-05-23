$(document).ready(function(){
	$('input.typeahead').typeahead({
		name: 'typeahead',
		remote:'php/updateLehrer/search.php?key=%QUERY',
		limit : 10
	});
});