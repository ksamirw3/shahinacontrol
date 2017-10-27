@extends('emails.provider.layout')
@section('content')
<p>hi, mr/ {{$row['username']}}</p>
<p>you register with us in {{env('SITE_NAME')}} as provider </p>
<p>so to countue your work please confirm you account by click on this link</p>
{{url('/provider/auth/active?u='. strtolower(trim(str_replace(' ', '',$row['username']))).'&c='.$code)}}
@stop