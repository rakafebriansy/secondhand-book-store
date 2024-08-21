@extends('layout.main')
@section('main')
@include('admin.partials.sidebar')
<div class="wrapper relative">
    @yield("wrapper")
</div>
@endsection