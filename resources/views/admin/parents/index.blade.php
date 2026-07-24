@extends('admin.layouts.app')

@section('title', 'Parents')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Parents</h1>
        <p>{{ $parents->count() }} parent(s)</p>
    </div>
    <a href="{{ route('admin.parents.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter un parent</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($parents->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Enfant(s)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parents as $parentUser)
            <tr>
                <td><strong>{{ $parentUser->name }}</strong></td>
                <td>{{ $parentUser->email }}</td>
                <td>{{ $parentUser->phone ?? '—' }}</td>
                <td>{{ $parentUser->children->pluck('first_name')->implode(', ') ?: '—' }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.parents.edit', $parentUser->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.parents.destroy', $parentUser->id) }}" method="POST" onsubmit="return confirm('Supprimer ce parent ?');">
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
    <div class="admin-empty-row">Aucun parent enregistré.</div>
    @endif
</div>
@endsection
