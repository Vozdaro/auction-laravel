@php

/** @var ?Collection $categories */
/** @var Collection $lots */
/** @var string     $pageTitle */

use App\Models\Category;
use App\Models\Lot;
use Illuminate\Database\Eloquent\Collection;

@endphp
@extends('layout.main')
@section('content')
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное
            снаряжение.</p>
        <ul class="promo__list">
            @foreach($categories ?? [] as $category)
                @php /** @var Category $category */ @endphp
                <li class="promo__item promo__item--{{ $category->inner_code }}">
                    <a class="promo__link" href="#">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </section>

    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">

            @foreach($lots as $lot)
                @php /** @var Lot $lot */ @endphp
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img
                            src="{{ asset('storage/' . $lot->image_path) }}"
                            width="350"
                            height="260"
                            alt="{{ $lot->title }}"
                            style="object-fit: contain; object-position: center;"
                        >
                    </div>
                    <div class="lot__info">
                        <span class="lot__category">{{ $lot->category->name }}</span>
                        <h3 class="lot__title">
                            <a class="text-link" href="{{ route('lot.view', $lot) }}">{{ $lot->title }}</a>
                        </h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost">{{ $lot->start_price }}<b class="rub">р</b></span>
                            </div>
                            <div class="lot__timer timer">{{ $lot->deadline }}</div>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>
    </section>
@endsection
