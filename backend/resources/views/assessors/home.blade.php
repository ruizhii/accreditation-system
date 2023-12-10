@extends('assessors/layouts/app')

@section('title', 'Assessor Register Page')

@section('content')
    @include('assessors/layouts/nav')

    <div class="container">
        {{-- {!! nl2br("-asafadsafb\n -asdfasdf \n") !!}
        {!! nl2br(e("<ul><li>asdf</li>\n<li>ss</li></ul>")) !!}
        {!! nl2br(e(auth('assessors')->user()->name)) !!} --}}
    </div>
