@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $improvement->titre }}</h2>
    <p><strong>Description :</strong> {{ $improvement->description }}</p>
    <p><strong>État :</strong> {{ $improvement->state }}</p>
    <p><strong>Créé par l'utilisateur :</strong> {{ $improvement->creator->name ?? 'Inconnu' }}</p>

    <h4>Commentaires</h4>
    <ul>
        @foreach($improvement->comments as $comment)
            <li>{{ $comment->content }} <small>(par utilisateur {{ $comment->user_id }})</small></li>
        @endforeach
    </ul>
</div>
@endsection
