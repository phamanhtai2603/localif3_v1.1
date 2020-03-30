<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    Your booking tour in our website has been <b>CANCELED</b> by the customer!
    We really sorry about this case. Seem like the customer is not available on these day! Check out the other tours at <a href="{{ route('get-page-view') }}">HERE</a> <br>
    <h3>It is your refused order</h3>
    <i>
    You have book tour <b>{{ $bookedtour->tour->name }}</b>. <br>
    Customer {{ $customer }} has book your tour {{ $bookedtour->tour->name }}. <br>
    Size: {{ $bookedtour->size }} people. <br>
    From: {{ substr($bookedtour->date, 0, 10) }} to {{ substr($bookedtour->date, -12, -2) }} <br>
    Total: {{ $bookedtour->total_price }} VND <br>
    Checkout at <a href="{{ route('tourguidebooked.index') }}">CLICK HERE</a> <br>
    </i>
    Thank for using our service!
</body>
</html>
