
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="/assets/css/dp.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>
<body>

<div class="page">

	<div class="demo">
		<h3>Demo</h3>

		<div class="demo__item">
			<div class="demo__input" id="">
				<input type="text" id="input" value="">
			</div>
		</div>
	</div>

</div>

	
</body>
<script src="/assets/js/hotel-datepicker.min.js"></script>
<script src="/assets/js/fecha.min.js"></script>
<script>
    var input = document.getElementById('input');
	var datepicker = new HotelDatepicker(input, {
    	format: 'DD-MM-YYYY'
	});
</script>
</html>
