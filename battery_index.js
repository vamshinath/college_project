function batteryUpdate(battery, fill = null, max = null) {
  var max  = $(battery).attr('data-max');
  var fill = $(battery).attr('data-fill');

	if(fill>=70){
		$(battery).children().css('background-color','red');
	}
	else if (fill>=50 && fill<70)
		$(battery).children().css('background-color','orange');
  // if no max, default to percent of 100
  var perc = (max) ? fill / max * 100 : fill;

  if (!isNaN(fill)) {
    $(battery).children().css('height', perc + '%').text(fill+'%');
  }
  
}

$('.battery').each(function(i, elem) {
  batteryUpdate(elem);
});
