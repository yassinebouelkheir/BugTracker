@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $projet->name }}</h2>
    <p>{{ $projet->description }}</p>
    <p><strong>Avancement :</strong> {{ $projet->avancement }}%</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <h4>Problèmes ouverts</h4>
            <ul>
                @foreach($projet->issues->where('state', 'Ouvert') as $issue)
                    <li><a href="{{ route('issues.show', $issue->id) }}">{{ $issue->titre }}</a></li>
                @endforeach
            </ul>

            <h4>Problèmes fermés</h4>
            <ul>
                @foreach($projet->issues->where('state', 'Fermé') as $issue)
                    <li><a href="{{ route('issues.show', $issue->id) }}">{{ $issue->titre }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-4">
            <h4>Améliorations en attente</h4>
            <ul>
                @foreach($projet->improvements->where('state', 'En attente') as $imp)
                    <li><a href="{{ route('improvements.show', $imp->id) }}">{{ $imp->titre }}</a></li>
                @endforeach
            </ul>

            <h4>Améliorations acceptées</h4>
            <ul>
                @foreach($projet->improvements->where('state', 'Accepté') as $imp)
                    <li><a href="{{ route('improvements.show', $imp->id) }}">{{ $imp->titre }}</a></li>
                @endforeach
            </ul>

            <h4>Améliorations refusées</h4>
            <ul>
                @foreach($projet->improvements->where('state', 'Refusé') as $imp)
                    <li><a href="{{ route('improvements.show', $imp->id) }}">{{ $imp->titre }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-4">
            <h4>Ajouter un commentaire</h4>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="commentable_type" value="App\Models\Projet">
                <input type="hidden" name="commentable_id" value="{{ $projet->id }}">
                <div class="mb-2">
                    <textarea name="content" class="form-control" placeholder="Votre commentaire..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publier</button>
            </form>

            <h4 class="mt-4">Commentaires</h4>
            <ul>
                @foreach($projet->comments as $comment)
                    <li>{{ $comment->content }} <small>(par {{ $comment->user->name ?? 'utilisateur inconnu' }})</small></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
