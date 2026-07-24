@extends('learner.layout')

@section('title', 'Documents')
@section('page-title', 'Mes documents')
@section('page-subtitle', $learner->schoolClass->name ?? '')

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-file-earmark-text"></i> Documents disponibles</h3></div>
    @if($documents->count())
    <table class="admin-table">
        <thead><tr><th>Titre</th><th>Catégorie</th><th>Date</th><th></th></tr></thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td><strong>{{ $document->title }}</strong></td>
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
