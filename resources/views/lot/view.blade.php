@php

/** @var MessageBag $errors */
/** @var Lot        $lot */
/** @var string     $pageTitle */

use App\Models\Lot;
use App\Enum\FormEnctypeEnum;
use App\Enum\HttpMethodEnum;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

@endphp
@extends('layout.main')
@section('content')
    <section class="lot-item container">
        <h2>{{ $lot->title }}</h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img
                        src="{{ asset('storage/' . $lot->image_path) }}"
                        width="730"
                        height="548"
                        alt="{{ $lot->title }}"
                        style="object-fit: contain; object-position: center;"
                    >
                </div>
                <p class="lot-item__category">Категория: <span>{{ $lot->category->name }}</span></p>
                <p class="lot-item__description">{{ $lot->description }}</p>
            </div>
            <div class="lot-item__right">
                <div class="lot-item__state">
                    <div class="lot-item__timer timer" style="width: fit-content;">{{ $lot->deadline }}</div>
                    <div class="lot-item__cost-state">
                        <div class="lot-item__rate">
                            <span class="lot-item__amount">Текущая цена</span>
                            <span class="lot-item__cost">{{ $lot->start_price }}</span>
                        </div>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span>{{ $lot->bet_step }} р</span>
                        </div>
                    </div>

                    @if(Auth::check() && !$lot->isOwnerCurrentUser());
                        <form
                            class="lot-item__form {{ $errors->any() ? ' form--invalid' : '' }}"
                            action="{{ route('bet.store') }}"
                            method="{{ HttpMethodEnum::Post->value }}"
                            enctype="{{ FormEnctypeEnum::UrlEncoded->value }}"
                            autocomplete="off"
                            novalidate
                        >
                            @csrf
                            @php $key = 'amount'; @endphp
                            <p class="lot-item__form-item form__item @error($key) form__item--invalid @enderror">
                                <label for="{{ $key }}">Ваша ставка</label>
                                <input
                                    id="{{ $key }}"
                                    type="text"
                                    name="{{ $key }}"
                                    placeholder="12 000"
                                    value="{{ old($key) }}"
                                >
                                @error($key)
                                    <span class="form__error">{{ $message }}</span>
                                @enderror
                            </p>
                            <input type="hidden" name="lot_id" value="{{ $lot->id }}">
                            <button
                                type="submit"
                                class="button"
                                style="align-self: flex-start; margin-top: 24px; cursor: pointer;"
                            >Сделать ставку</button>
                        </form>
                    @endif

                </div>
                <div class="history">
                    <h3>История ставок (<span>{{ $lot->bets->count() }}</span>)</h3>
                    <table class="history__list">

                        @foreach($lot->bets as $bet)
                            <tr class="history__item">
                                <td class="history__name">{{ $bet->user->name }}</td>
                                <td class="history__price">{{ $bet->amount }} р</td>
                                <td class="history__time">{{ date('d-m-Y', strtotime($bet->created_at)) }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
