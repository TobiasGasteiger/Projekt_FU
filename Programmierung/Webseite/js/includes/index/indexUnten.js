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
		  
$('.datepicker').pickadate({
	selectMonths: true,
	selectYears: 15,
	format: 'yyyy-mm-dd',
	labelMonthNext: 'Nächster Monat',
	labelMonthPrev: 'Letzter Monat',
	labelMonthSelect: 'Monat auswählen',
	labelYearSelect: 'Jahr auswählen',
	monthsFull: [ 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' ],
	monthsShort: [ 'Jan', 'Feb', 'Mär', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez' ],
	weekdaysFull: [ 'Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag' ],
	weekdaysShort: [ 'Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam' ],
	weekdaysLetter: [ 'S', 'M', 'D', 'M', 'D', 'F', 'S' ],
	today: 'Heute',
	clear: 'Löschen',
	close: 'OK'
});