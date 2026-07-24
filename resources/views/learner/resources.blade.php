@extends('learner.layout')

@section('title', 'Ressources')
@section('page-title', 'Ressources')
@section('page-subtitle', $learner->schoolClass->name ?? '')

@section('content')

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-folder2-open"></i> Ressources pédagogiques</h3></div>
    <div class="ea-widget-body">
        @forelse($resources as $resource)
        <div class="ea-resource-item">
            <div class="ea-resource-icon">
                <i class="bi {{ $resource->type == 'video' ? 'bi-camera-video' : ($resource->type == 'lien' ? 'bi-link-45deg' : 'bi-file-earmark-pdf') }}"></i>
            </div>
            <div class="ea-resource-info" style="flex:1;">
                <strong>{{ $resource->title }}</strong>
                <span>{{ $resource->course->name ?? '' }} · publié le {{ $resource->published_at->format('d/m/Y') }}</span>
            </div>
            @if($resource->type === 'lien' && $resource->link_url)
            <a href="{{ $resource->link_url }}" target="_blank" class="admin-row-btn admin-row-btn-green">Ouvrir</a>
            @elseif($resource->file_path)
            <a href="{{ Storage::url($resource->file_path) }}" target="_blank" class="admin-row-btn admin-row-btn-green">Télécharger</a>
            @endif
        </div>
        @empty
        <div class="admin-empty-row">Aucune ressource disponible pour le moment.</div>
        @endforelse
    </div>
</div>

@endsection
