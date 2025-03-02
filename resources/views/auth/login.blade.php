@php

/** @var ?string $flashMessage */
/** @var string  $pageTitle */

use App\Enum\InputTypeEnum;

@endphp
@extends('layout.main')
@section('content')
    <x-nav-list/>

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

        @php $key = 'email'; @endphp
        <div class="form__item @error($key) form__item--invalid @enderror">
            <label for="{{ $key }}">E-mail <sup>*</sup></label>
            <input
                id="{{ $key }}"
                type="{{ InputTypeEnum::Text->value }}"
                name="{{ $key }}"
                value="{{ old('email') }}"
                placeholder="Введите e-mail"
            >
            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        @php $key = 'passwordFlash'; @endphp
        <div class="form__item form__item--last @error($key) form__item--invalid @enderror">
            <label for="{{ $key }}">Пароль <sup>*</sup></label>
            <input
                id="{{ $key }}"
                type="{{ InputTypeEnum::Password->value }}"
                name="{{ $key }}"
                value="{{ old($key) }}"
                placeholder="Введите пароль"
                readonly
                onfocus="this.removeAttribute('readonly')"
            >
            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <button type="{{ InputTypeEnum::Submit->value }}" class="button">Войти</button>
    </form>
@endsection
