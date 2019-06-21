@extends('layouts.app')

@section('content')

    <div>
        <div>{{$message}}</div>
        @if($success)<div>The gate is open.</div>@endif
    </div>
@stop