<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    You have book tour <b>{{ $bookedtour->tour->name }}</b>. <br>
    Size: {{ $bookedtour->size }} people. <br>
    From: {{ substr($bookedtour->date, 0, 10) }} to {{ substr($bookedtour->date, -12, -2) }} <br>
    Total: {{ $bookedtour->total_price }} VND <br>
    This order didnt checked. Please waiting for the host's response! 
    Checkout at <a href="{{ route('customerbooked.index') }}">CLICK HERE</a> <br>
</body>
</html>
