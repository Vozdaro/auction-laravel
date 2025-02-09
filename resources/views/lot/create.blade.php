@php

/** @var MessageBag $errors */
/** @var string     $pageTitle */
/** @var Collection $categories */

use App\Enum\FormEnctypeEnum;
use App\Enum\HttpMethodEnum;
use App\Enum\InputTypeEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\MessageBag;

@endphp
@extends('layout.main')
@section('content')
    <x-nav-list
        :categories="$categories"
    />

    <form
        class="form form--add-lot container{{ $errors->any() ? ' form--invalid' : '' }}"
        action="{{ route('lot.store') }}"
        method="{{ HttpMethodEnum::Post->value }}"
        enctype="{{ FormEnctypeEnum::Multipart->value }}"
        autocomplete="off"
        novalidate
    >
        @csrf
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            @php $key = 'title'; @endphp
            <div class="form__item @error($key) form__item--invalid @enderror">
                <label for="{{ $key }}">Наименование <sup>*</sup></label>
                <input
                    id="{{ $key }}"
                    type="{{ InputTypeEnum::Text->value }}"
                    name="{{ $key }}"
                    placeholder="Введите наименование лота"
                    value="{{ old($key) }}"
                >

                @error($key)
                    <span class="form__error">{{ $message }}</span>
                @enderror
            </div>

            @php $key = 'category_id'; @endphp
            <div class="form__item @error($key) form__item--invalid @enderror">
                <label for="{{ $key }}">Категория <sup>*</sup></label>
                <select
                    id="{{ $key }}"
                    name="{{ $key }}"
                >
                    <option>Выберите категорию</option>

                    @foreach($categories as $category)
                        @php /** @var Category $category */ @endphp
                        <option
                            value="{{ $category->id }}"
                            @selected(intval(old($key)) === $category->id)
                        >{{ $category->name }}</option>
                    @endforeach
                </select>

                @error($key)
                    <span class="form__error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @php $key = 'description'; @endphp
        <div class="form__item form__item--wide @error($key) form__item--invalid @enderror">
            <label for="{{ $key }}">Описание <sup>*</sup></label>
            <textarea
                id="{{ $key }}"
                name="{{ $key }}"
                placeholder="Напишите описание лота"
            >{{ old($key) }}</textarea>

            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        @php $key = 'image'; @endphp
        <div class="form__item form__item--file @error($key) form__item--invalid @enderror">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input
                    id="{{ $key }}"
                    class="visually-hidden"
                    type="{{ InputTypeEnum::File->value }}"
                    name="{{ $key }}"
                    value=""
                >
                <label for="{{ $key }}">Добавить</label>
            </div>

            @error($key)
                <span class="form__error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form__container-three">
            @php $key = 'start_price'; @endphp
            <div class="form__item form__item--small @error($key) form__item--invalid @enderror">
                <label for="{{ $key }}">Начальная цена <sup>*</sup></label>
                <input
                    id="{{ $key }}"
                    type="{{ InputTypeEnum::Number->value }}"
                    name="{{ $key }}"
                    placeholder="0"
                    value="{{ old($key) }}"
                >

                @error($key)
                    <span class="form__error">{{ $message }}</span>
                @enderror
            </div>

            @php $key = 'bet_step'; @endphp
            <div class="form__item form__item--small @error($key) form__item--invalid @enderror">
                <label for="{{ $key }}">Шаг ставки <sup>*</sup></label>
                <input
                    id="{{ $key }}"
                    type="{{ InputTypeEnum::Number->value }}"
                    name="{{ $key }}"
                    placeholder="0"
                    value="{{ old($key) }}"
                >

                @error($key)
                    <span class="form__error">{{ $message }}</span>
                @enderror
            </div>

            @php $key = 'deadline'; @endphp
            <div class="form__item @error($key) form__item--invalid @enderror">
                <label for="{{ $key }}">Дата окончания торгов <sup>*</sup></label>
                <input
                    id="{{ $key }}"
                    class="form__input-date"
                    type="{{ InputTypeEnum::Date->value }}"
                    name="{{ $key }}"
                    placeholder="Введите дату в формате ГГГГ-ММ-ДД"
                    value="{{ old($key) }}"
                    style="background-image: none"
                >
                @error($key)
                    <span class="form__error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if($errors->any())
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        @endif

        <button type="{{ InputTypeEnum::Submit->value }}" class="button">Добавить лот</button>
    </form>
@endsection
