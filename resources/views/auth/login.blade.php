@php

/** @var ?string $flashMessage */
/** @var string  $pageTitle */

@endphp
@extends('layout.main')
@section('content')
    <x-nav-list/>

    <!-- form--invalid -->
    <form
        class="form container"
        action="{{ route('auth.log') }}"
        method="post"
        enctype="application/x-www-form-urlencoded"
        autocomplete="off"
        novalidate
    >
        @csrf
        <h2>Вход</h2>

        @isset($flashMessage)
            <div>{{ $flashMessage }}</div>
        @endisset

        <!-- form__item--invalid -->
        <div class="form__item @error('email') form__item--invalid @enderror">
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Введите e-mail">
            @error('email')
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__item form__item--last @error('password') form__item--invalid @enderror">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" value="{{ old('email') }}" placeholder="Введите пароль">
            @error('password')
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="button">Войти</button>
    </form>
@endsection
