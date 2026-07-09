@extends('admin.layouts.app')

@section('title', 'Actualités')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Actualités & Événements</h1>
        <p>{{ $news->count() }} publication(s)</p>
    </div>
    <a href="{{ route('admin.actualites.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Publier une actualité</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($news->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Portée</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr>
                <td><strong>{{ $item->title }}</strong></td>
                <td>{{ $item->course->name ?? 'Générale' }}</td>
                <td>{{ $item->published_at->format('d/m/Y') }}</td>
                <td>
                    <span class="admin-badge-status {{ $item->active ? 'validated' : 'rejected' }}">
                        {{ $item->active ? 'Publiée' : 'Masquée' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.actualites.edit', $item->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.actualites.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Supprimer cette actualité ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune actualité publiée.</div>
    @endif
</div>
@endsection
