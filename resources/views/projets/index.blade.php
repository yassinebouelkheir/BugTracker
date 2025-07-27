@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mes Projets</h2>

    @foreach($projects as $projet)
        <div class="card mb-4">
            <div class="card-header">
                <h4><a href="{{ route('projets.show', $projet->id) }}">{{ $projet->name }}</a></h4>
                <p>{{ $projet->description }}</p>
            </div>
            <div class="card-body">
                <p><strong>Avancement :</strong> {{ $projet->avancement }}%</p>
                <p><strong>Priorité :</strong>
                    @if($projet->priority == 3)
                        Haute
                    @elseif($projet->priority == 2)
                        Moyenne
                    @else
                        Normale
                    @endif
                </p>
                <p><strong>Nombre de problèmes :</strong> {{ $projet->issues->count() }}</p>
                <p><strong>Nombre d'améliorations :</strong> {{ $projet->improvements->count() }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
