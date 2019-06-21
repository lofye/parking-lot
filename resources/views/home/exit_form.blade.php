@extends('layouts.app')

@section('content')

    <div>
        {{$message}}<br>
        <form action="/exit/{{$ticket_number}}" method="POST">
            @csrf
            <div>Credit Card Number: <input type="text" name="cc_number" /></div>
            <div>Test Succeed Payment: <input type="radio" name="succeed" value="1" />  Fail Payment: <input type="radio" name="succeed" value="0" /></div>
            <input type="submit" value="submit" />
        </form>
    </div>
@stop