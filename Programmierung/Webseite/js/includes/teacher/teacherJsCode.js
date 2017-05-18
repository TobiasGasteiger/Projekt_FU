$(document).ready(function(){
	$('input.typeahead').typeahead({
		name: 'typeahead',
		remote:'php/searchLehrer/search.php?key=%QUERY',
		limit : 10
	});
});