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
	labelMonthNext: 'N�chster Monat',
	labelMonthPrev: 'Letzter Monat',
	labelMonthSelect: 'Monat ausw�hlen',
	labelYearSelect: 'Jahr ausw�hlen',
	monthsFull: [ 'Januar', 'Februar', 'M�rz', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' ],
	monthsShort: [ 'Jan', 'Feb', 'M�r', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez' ],
	weekdaysFull: [ 'Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag' ],
	weekdaysShort: [ 'Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam' ],
	weekdaysLetter: [ 'S', 'M', 'D', 'M', 'D', 'F', 'S' ],
	today: 'Heute',
	clear: 'L�schen',
	close: 'OK'
});