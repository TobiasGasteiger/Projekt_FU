$(document).ready(function(){
	$('input.typeahead1').typeahead({
		name: 'klassedel',
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
			
$(document).ready(function(){
	$('input.typeahead3').typeahead({
		name: 'fachdel',
		remote:'php/updateFaecher/search.php?key=%QUERY',
		limit : 10
	});
});



$(document).ready(function(){
	$('.modal').modal();
});
			  
$(document).ready(function(){
	$('.modal').modal();
});
				  
				  
$(document).ready(function() {
	$('select').material_select();
});
				  
$(document).ready(function(){
	$('.tooltipped').tooltip({delay: 50});
});