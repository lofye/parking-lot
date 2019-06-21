@extends('layouts.app')

@section('content')
<div class="links">
    @if($show_enter)<a href="/enter">Get & Enter</a>@else <a href="/">No Spaces Available</a> @endif
    @if($show_exit)<a href="/exit">Pay & Exit</a>@endif
</div>
@stop