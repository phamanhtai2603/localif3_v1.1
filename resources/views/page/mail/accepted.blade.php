<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    Your booking tour in our website has been <b>ACCEPTED</b> by the host!
    The host will contact to you for moredetail! <br>
    <h3>It is your order</h3>
    <i>
    You have book tour <b>{{ $bookedtour->tour->name }}</b>. <br>
    Size: {{ $bookedtour->size }} people. <br>
    From: {{ substr($bookedtour->date, 0, 10) }} to {{ substr($bookedtour->date, -12, -2) }} <br>
    Total: {{ $bookedtour->total_price }} VND <br>
    Checkout at <a href="{{ route('customerbooked.index') }}">CLICK HERE</a> <br>
    </i>
    Check out the other tours at <a href="{{ route('get-page-view') }}">HERE</a><br>
    Enjoy your trip! Thank for using our service!
</body>
</html>
