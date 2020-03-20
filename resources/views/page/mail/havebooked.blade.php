<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    Customer {{ $customer }} has book your tour {{ $bookedtour->name }}. <br>
    Size: {{ $bookedtour->size }} people. <br>
    From: {{ substr($bookedtour->date, 0, 10) }} to {{ substr($bookedtour->date, -12, -2) }} <br>
    Total: {{ $bookedtour->total_price }} VND <br>
    Checkout at <a href="{{ route('tourguidebooked.index') }}">CLICK HERE</a> <br>
</body>
</html>
