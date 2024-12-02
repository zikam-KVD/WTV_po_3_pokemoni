<x-guest-layout>
       <main id="detail">
            <div class="karta">
                <h2>{{ $poke->nazev }}</h2>
                <img
                    src="{{ asset('img/' . $poke->id . '.png') }}"
                    alt="{{ $poke->nazev }}"
                >
                <div class="typy">
                    <a href="{{ route('podleTypu', ['typ' => $poke->druh]) }}">
                    <span style="background: {{ $poke->typ->barva }}">
                        {{ $poke->typ->nazev }}
                    </span>
                    </a>
                </div>
                <p>
                    {{ $poke->popis }}
                </p>

                <a href="{{ route('index') }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
            </div>
       </main>
</x-guest-layout>
