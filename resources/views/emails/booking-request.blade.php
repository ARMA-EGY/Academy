<h2>Hi,</h2>
<br>

<b>New student made a course request</b>
<br>
<b>Kindly take an action on this request</b>
<br>
<br>
<br>
<b>booking details:</b>
<br>

<b></b>{{$mt->name}}
<br>


@if($mt->type == 'Class Room')
<b>Where: Classroom</b>
<br>
@else
<b>Where: Online Training (Virtual Through Zoom )</b>
<br>
@endif


<b>Price: </b>{{$mt->price}} @if($mt->lang == 'eg') L.E @else $ @endif
<br>

<b>Start Date: </b>{{$mt->start_date}} 
<br>


Student Information
<br>
<b>Full Name: </b>{{$customer->name}}
<br>

<b>Email: </b>{{$customer->email}}
<br>

<b>Phone Number: </b>{{$customer->phone}}
<br>

<b>Position: </b>{{$customer->position}}
<br>

<b>Company: </b>{{$customer->company}}
<br>
<br>
<br>

Thank You