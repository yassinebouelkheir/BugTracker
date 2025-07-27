@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $issue->titre }}</h2>
    <p><strong>Description :</strong> {{ $issue->description }}</p>
    <p><strong>État :</strong> {{ $issue->state }}</p>
    <p><strong>Priorité :</strong> {{ $issue->priority }}</p>
    <p><strong>Créé par l'utilisateur :</strong> {{ $issue->creator->name ?? 'Inconnu' }}</p>

    <h4>Commentaires</h4>
    <ul>
        @foreach($issue->comments as $comment)
            <li>{{ $comment->content }} <small>(par utilisateur {{ $comment->user_id }})</small></li>
        @endforeach
    </ul>
</div>
@endsection
