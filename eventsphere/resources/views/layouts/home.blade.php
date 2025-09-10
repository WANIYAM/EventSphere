@extends('layouts.app')

@section('title', $head_title ?? 'Home || envens || envens PHP Template')

@section('content')
    @include('parts.home.banner')
    @include('parts.home.feature')
    @include('parts.home.about')
    @include('parts.home.team')
    @include('parts.home.counter')
    @include('parts.home.events')
    @include('parts.home.sliding-text')
    @include('parts.home.venue')
    @include('parts.home.gallery')
    @include('parts.home.events-category')
    @include('parts.home.contact')
    @include('parts.home.blog')
    @include('parts.home.brand')
@endsection