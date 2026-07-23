@extends('admin.layouts.app')

@section('title', 'Ressources')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Ressources pédagogiques</h1>
        <p>{{ $resources->count() }} ressource(s)</p>
    </div>
    <a href="{{ route('admin.resources.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter une ressource</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($resources->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Matière</th>
                <th>Classe</th>
                <th>Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resources as $resource)
            <tr>
                <td><strong>{{ $resource->title }}</strong></td>
                <td>{{ $resource->course->name ?? '—' }}</td>
                <td>{{ $resource->course->schoolClass->name ?? '—' }}</td>
                <td>{{ ucfirst($resource->type) }}</td>
                <td>{{ $resource->published_at->format('d/m/Y') }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.resources.edit', $resource->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.resources.destroy', $resource->id) }}" method="POST" onsubmit="return confirm('Supprimer cette ressource ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune ressource enregistrée.</div>
    @endif
</div>
@endsection
