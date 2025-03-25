@php

/** @var ?Collection $categories */

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

@endphp
<nav class="nav">
    <ul class="nav__list container">

        @foreach($categories ?? [] as $category)
            @php /** @var Category $category */ @endphp
            <li class="nav__item">
                <a href="{{ route('lot.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
            </li>
        @endforeach

    </ul>
</nav>
