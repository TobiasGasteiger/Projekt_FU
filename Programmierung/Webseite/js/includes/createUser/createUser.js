$(document).ready(function(){
	$('input.typeahead2').typeahead({
		name: 'lehrerdel',
		remote:'php/updateLehrer/search.php?key=%QUERY',
		limit : 10
	});
});