



// Super Wheel Script
jQuery(document).ready(function($){
	
	
	
	
	$('.wheel-standard').superWheel({
		slices: [
			{
				text: '<img src="image/pin.jpg"/>',
				value: 1,
				message: "Pin",
				background: "#1abc9c",
				color: "#fff",
				image: 'image/pin.jpg'
			},
			{
				text: '<img src="image/voucher.jpg"/>',
				value: 1,
				message: "Voucher",
				background: "#6aabd5",
				color: "#fff",
				image: 'image/voucher.jpg'
			},
			{
				text: '<img src="image/mockhoa.jpg"/>',
				value: 1,
				message: "Móc Khóa",
				background: "#e67e22",
				color: "#fff",
				image: 'image/mockhoa.jpg'
			},
			{
				text: '<img src="image/sticker.jpg"/>',
				value: "Sticker",
				message: "Sticker",
				background: "#9b59b6",
				color: "#fff",
				image: 'image/sticker.jpg'
			}
		],
	text : {
		color: '#CFD8DC',
	},
	line: {
		width: 10,
		color: "#78909C"
	},
	outer: {
		width: 14,
		color: "#78909C"
	},
	inner: {
		width: 15,
		color: "#78909C"
	},
	marker: {
		background: "#00BCD4",
		animate: 1
	},
	
	selector: "value",
	
	
	
	});
	
	
	
	var tick = new Audio('media/tick.mp3');
	
	$(document).on('click','.wheel-standard-spin-button',function(e){
		
		$('.wheel-standard').superWheel('start','value',Math.floor(Math.random() * 4));
		$(this).prop('disabled',true);
	});
	
	
	$('.wheel-standard').superWheel('onStart',function(results){
		
		
		$('.wheel-standard-spin-button').text('Spinning...');
		
	});
	$('.wheel-standard').superWheel('onStep',function(results){
		
		if (typeof tick.currentTime !== 'undefined')
			tick.currentTime = 0;
        
		tick.play();
		
	});
	
	
	$('.wheel-standard').superWheel('onComplete',function(results){
		//console.log(results.value);
		if(results.value === 1){
			
			swal({
				type: 'success',
				title: "Congratulations!", 
				html: results.message+' <br><br><b><img src="'+ results.image+'""/></b>'
			});
			
		}else{
			swal("Oops!", results.message, "error");
		}
		
		
		$('.wheel-standard-spin-button:disabled').prop('disabled',false).text('Spin');
		
	});
	
	
	
	
	
});