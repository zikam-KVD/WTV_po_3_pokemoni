<x-guest-layout>
       <main>
            @foreach ($pokemonos as $poke)
            <div class="karta">
                <img
                    src="{{ asset('img/' . $poke->id . '.png') }}"
                    alt="{{ $poke->nazev }}"
                >
                <a href="{{ route('detail', ["id" => $poke->id]) }}">
                    <i class="fa-solid fa-eye"></i>
                </a>
            </div>
            @endforeach
       </main>
</x-guest-layout>
