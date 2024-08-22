@extends('layout.main')
@section('main')
@include('user.partials.sidebar')
<div class="wrapper relative">
    @yield("wrapper")
</div>
@endsection