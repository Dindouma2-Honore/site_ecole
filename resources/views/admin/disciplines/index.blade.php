@extends('admin.layouts.app')

@section('title', 'Disciplines')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Disciplines enseignées</h1>
        <p>{{ $disciplines->count() }} discipline(s)</p>
    </div>
    <a href="{{ route('admin.disciplines.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($disciplines->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Icône</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disciplines as $discipline)
            <tr>
                <td style="font-size:1.3rem;color:var(--royal-blue);"><i class="bi {{ $discipline->icon ?: 'bi-book' }}"></i></td>
                <td><strong>{{ $discipline->name }}</strong></td>
                <td style="font-size:0.85rem;color:var(--grey-mid);">{{ \Illuminate\Support\Str::limit($discipline->description, 60) }}</td>
                <td>
                    <span class="admin-badge-status {{ $discipline->active ? 'validated' : 'rejected' }}">
                        {{ $discipline->active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.disciplines.edit', $discipline->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.disciplines.destroy', $discipline->id) }}" method="POST" onsubmit="return confirm('Supprimer cette discipline ?');">
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
    <div class="admin-empty-row">Aucune discipline enregistrée.</div>
    @endif
</div>
@endsection
