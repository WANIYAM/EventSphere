@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <!-- Your page content here -->
</div>
@endsection

@section('scripts')
    @include('parts.mobile-nav')
    @include('parts.search')
    @include('parts.back-to-top')
    @include('parts.script')
@endsection