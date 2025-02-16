@php

/** @var Collection $categories */
/** @var string     $pageTitle */

use Illuminate\Database\Eloquent\Collection;
use App\Enum\InputTypeEnum;

@endphp
@extends('layout.main')
@section('content')
    <x-nav-list
        :categories="$categories"
    />

    <form
        class="form container form--invalid"
        action="{{ route('auth.store') }}"
        method="post"
        enctype="application/x-www-form-urlencoded"
        autocomplete="off"
        novalidate
    >
        @csrf
        <h2>Регистрация нового аккаунта</h2>

        @php $key = 'email'; @endphp
        <div class="form__item @error($key) form__item--invalid @enderror">
            <label for="{{ $key }}">E-mail <sup>*</sup></label>
            <input
                id="{{ $key }}"
                type="{{ InputTypeEnum::Email->value }}"
                name="{{ $key }}"
                value="{{ old($key) }}"
                placeholder="Введите e-mail"
            >
            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        @php $key = 'passwordFlash'; @endphp
        <div class="form__item @error($key) form__item--invalid @enderror">
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

        @php $key = 'passwordFlash_confirmation'; @endphp
        <div class="form__item @error($key) form__item--invalid @enderror">
            <label for="{{ $key }}">Подтверждение пароля <sup>*</sup></label>
            <input
                id="{{ $key }}"
                type="{{ InputTypeEnum::Password->value }}"
                name="{{ $key }}"
                value="{{ old($key) }}"
                placeholder="Еще раз введите пароль"
                readonly
                onfocus="this.removeAttribute('readonly')"
            >
            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        @php $key = 'name'; @endphp
        <div class="form__item @error($key) form__item--invalid @enderror">
            <label for="{{ $key }}">Имя <sup>*</sup></label>
            <input
                id="{{ $key }}"
                type="{{ InputTypeEnum::Text->value }}"
                name="{{ $key }}"
                value="{{ old($key) }}"
                placeholder="Введите имя"
            >
            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        @php $key = 'contact_info'; @endphp
        <div class="form__item form__item--last @error($key) form__item--invalid @enderror">
            <label for="{{ $key }}">Контактные данные <sup>*</sup></label>
            <textarea
                id="{{ $key }}"
                name="{{ $key }}"
                placeholder="Напишите как с вами связаться (URL)"
            >{{ old($key) }}</textarea>
            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        @if($errors->any())
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        @endif

        <button type="{{ InputTypeEnum::Submit->value }}" class="button">Зарегистрироваться</button>
        <a class="text-link" href="{{ route('auth.log') }}">Уже есть аккаунт</a>
    </form>
@endsection
