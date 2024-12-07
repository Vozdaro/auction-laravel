@php

/** @var string $pageTitle */

@endphp
@extends('layout.main')
@section('content')
<nav class="nav">
    <ul class="nav__list container">
        <li class="nav__item">
            <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Разное</a>
        </li>
    </ul>
</nav>

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
