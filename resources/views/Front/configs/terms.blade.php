
@extends('Front/layouts/login')
@section('content')
<div class="jumbotron">
    <h4>{{__('admin.Terms & Conditions ')}}</h4>
    <p>        {{$data}}    </p>
</div>
@stop
