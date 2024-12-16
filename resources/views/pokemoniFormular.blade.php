<x-app-layout>
    @if(Session::has('message'))
        <p>{{ Session::get("message") }}</p>
    @endif
    <section class="section--flex">
        <form
            action="{{ route('vlozPokemona') }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <div>
                <x-label for="nazev" value="Název pokémona" />
                <x-input name="pokemon-nazev" id="nazev" />
                <x-input-error for="pokemon-nazev" />
            </div>
            <div>
                <x-label for="typ" value="Typ pokémona" />
                <select name="pokemon-typ" id="typ">
                    @foreach ($typy as $typ)
                        <option value="{{ $typ->id }}">{{ $typ->nazev }}</option>
                    @endforeach
                </select>
                <x-input-error for="pokemon-typ" />
            </div>
            <div>
                <x-label for="obrazek" value="Obrázek pokémona" />
                <x-input type="file" name="pokemon-obrazek" id="obrazek" />
                <x-input-error for="pokemon-obrazek" />
            </div>
            <div class="mt-2">
                <x-button>Vlož pokemona</x-button>
            </div>
        </form>
    </section>
</x-app-layout>
