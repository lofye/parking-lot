@extends('layouts.app')

@section('content')

    <div>
        <form action="/exit" method="GET">
            @csrf
            Enter Ticket Number: <input type="text" name="ticket_number" />
            <input type="submit" value="submit" />
        </form>
    </div>
@stop