@php

    /** @var Category   $category */
    /** @var Collection $lots */
    /** @var string     $pageTitle */
    /** @var string     $query */

use App\Models\Lot;
use Illuminate\Database\Eloquent\Collection;

@endphp
@extends('layout.main')
@section('content')

    <div class="container">
        <section class="lots">
            <h2>Все лоты по запросу <span>«{{ $query }}»</span></h2>
            <ul class="lots__list">

                {{-- TODO: Create Component --}}
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

        {{--        <ul class="pagination-list">--}}
        {{--            <li class="pagination-item pagination-item-prev"><a>Назад</a></li>--}}
        {{--            <li class="pagination-item pagination-item-active"><a>1</a></li>--}}
        {{--            <li class="pagination-item"><a href="#">2</a></li>--}}
        {{--            <li class="pagination-item"><a href="#">3</a></li>--}}
        {{--            <li class="pagination-item"><a href="#">4</a></li>--}}
        {{--            <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>--}}
        {{--        </ul>--}}
    </div>

@endsection
