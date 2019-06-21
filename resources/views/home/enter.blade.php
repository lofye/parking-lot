@extends('layouts.app')

@section('content')
    <div>
        <div>{{$message}}</div>
        @if($ticket_number)<a href="/exit/{{$ticket_number}}">Pay & Exit</a>@endif
    </div>
@stop