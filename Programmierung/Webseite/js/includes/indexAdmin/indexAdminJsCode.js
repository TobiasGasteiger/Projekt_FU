$(document).ready(function(){
	$('input.typeahead1').typeahead({
		name: 'klassesearch',
		remote:'php/updateKlassen/search.php?key=%QUERY',
		limit : 10
	});
});
			
$(document).ready(function(){
	$('input.typeahead2').typeahead({
		name: 'lehrerdel',
		remote:'php/updateLehrer/search.php?key=%QUERY',
		limit : 10
	});
});