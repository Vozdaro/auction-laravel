@php

/** @var string $pageTitle */

@endphp
@extends('layout.main')
@section('content')
    <x-nav-list/>

    <form
        action="{{ route('auth.store') }}"
        method="post"
        enctype="application/x-www-form-urlencoded"
        autocomplete="off"
        novalidate
    >
        @csrf
        <div>
            <!--suppress HtmlFormInputWithoutLabel -->
            <input
                type="text"
                name="name"
                value="{{ old('title') }}"
            >
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <!--suppress HtmlFormInputWithoutLabel -->
            <input
                type="text"
                name="email"
                value="{{ old('email') }}"
            >
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <!--suppress HtmlFormInputWithoutLabel -->
            <input
                type="text"
                name="password"
                value="{{ old('password') }}"
            >
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <input type="submit">
    </form>
@endsection
