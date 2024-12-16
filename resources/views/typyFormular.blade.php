<x-app-layout>
    @if(Session::has('message'))
        <p>{{ Session::get("message") }}</p>
    @endif
    <section class="section--flex">
        <form action="{{ route('vlozTyp') }}" method="POST">
            @csrf
            <div>
                <label for="typ">Název</label>
                <input type="text" name="typ-nazev" id="typ">
            </div>
            <div>
                <label for="barva">Barva</label>
                <input type="color" name="typ-barva" id="barva">
            </div>
            <div>
                <x-button>Vlož</x-button>
            </div>
        </form>
    </section>

    <section class="section--flex">
        <table>
            <tr>
                <th>Název</th>
                <th>Barva</th>
                <th>Počet pokémonů</th>
                <th></th>
            </tr>
        @foreach ($typy as $typ)
            <tr>
                <td>{{ $typ->nazev}}</td>
                <td style="background:{{ $typ->barva}}">
                    {{ $typ->barva}}
                </td>
                <td>{{ count($typ->pokemons) }}</td>
                <td>
                    <form action="{{ route('smazTyp', ['id' => $typ->id])}}" method="post">
                        @csrf
                        <x-button>SMAŽ</x-button>
                    </form>
                </td>
            </tr>
        @endforeach
        </table>
    </section>
</x-app-layout>
