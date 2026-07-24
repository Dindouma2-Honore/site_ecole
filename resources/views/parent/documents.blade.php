@extends('parent.layout')

@section('title', 'Documents')
@section('page-title', 'Documents')
@section('page-subtitle', 'Bulletins et certificats de vos enfants')

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-file-earmark-text"></i> Documents disponibles</h3></div>
    @if($documents->count())
    <table class="admin-table">
        <thead><tr><th>Enfant</th><th>Titre</th><th>Catégorie</th><th>Date</th><th></th></tr></thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->learner->first_name }} {{ $document->learner->last_name }}</td>
                <td>{{ $document->title }}</td>
                <td>{{ ucfirst($document->category) }}</td>
                <td>{{ $document->created_at->format('d/m/Y') }}</td>
                <td><a href="{{ Storage::url($document->file_path) }}" target="_blank" class="admin-row-btn admin-row-btn-green">Télécharger</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucun document disponible pour le moment.</div>
    @endif
</div>

@endsection
