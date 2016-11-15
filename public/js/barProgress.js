$(document).ready(function() {
	var progressbar1 = $('#ab');
	var progressbar2 = $('#edu');
	var max1 = progressbar1.width();
	var max2 = progressbar2.width();
	var time = (200 / max1) *3;
	var value1 = 0;
	var value2 = 0;
	
	progressbar1.width(value1);
	progressbar2.width(value2);
	
	var loading1 = function() {
		
		value1 += 1;
		progressbar1.width(value1+'%');
		
		if (value1 === max1) {
			clearInterval(animate);
		}
	};
	
	var loading2 = function() {
		
		value2 += 1;
		progressbar2.width(value2+'%');
		if (value2 == max2) {
			clearInterval(animate);
		}
	};
	
	var animate = setInterval(function() {
			loading1();
			loading2();
		}, time);
});