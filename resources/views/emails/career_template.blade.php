<h2>Hello ,</h2>
You received a new career request from : {{ $details['name'] }}
<br>
Here are the details:
<br>
<b>Name:</b> {{ $details['name']}}
<br>
<b>Email:</b> {{ $details['email'] }}
<br>
<b>Phone:</b> {{ $details['phone'] }}
<br>
<b>Available Date:</b> {{ $details['available_date'] }}
<br>
<b>Position:</b> {{ $details['position'] }}
<br>
<b>CV:</b> <a href="{{ asset('storage/app/public/'.$details['cv']) }}" target="_blank"> View</a>
<br>
Thank You