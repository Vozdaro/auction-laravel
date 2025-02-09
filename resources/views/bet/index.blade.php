@php

/** @var MessageBag $errors */
/** @var Bet        $bet */
/** @var string     $pageTitle */
/** @var Collection $bets */

use App\Models\Bet;
use Illuminate\Support\MessageBag;
use Illuminate\Database\Eloquent\Collection;

@endphp
@extends('layout.main')
@section('content')
    <section class="rates container">
        <h2>Мои ставки</h2>
        <table class="rates__list">

            @foreach($bets as $bet)
                <tr class="rates__item">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img
                                src="{{ asset('storage/' . $bet->lot->image_path) }}"
                                width="54"
                                height="40"
                                alt="{{ $bet->lot->title }}"
                                style="object-fit: contain; object-position: center;"
                            >
                        </div>
                        <h3 class="rates__title"><a href="{{ route('lot.view', $bet->lot) }}">{{ $bet->lot->title }}</a></h3>
                    </td>
                    <td class="rates__category">{{ $bet->lot->category->name }}</td>
                    <td class="rates__timer">
                        <div class="timer" style="width: fit-content;">{{ $bet->lot->deadline }}</div>
                    </td>
                    <td class="rates__price">{{ $bet->amount }} р</td>
                    <td class="rates__time">{{ $bet->created_at }}</td>
                </tr>
            @endforeach

        </table>
    </section>
@endsection
