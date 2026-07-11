@extends('admin.layouts.app')

@section('title', 'Classes / Cursus scolaire')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Classes / Cursus scolaire</h1>
        <p>{{ $classes->count() }} classe(s)</p>
    </div>
    <a href="{{ route('admin.classes.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter une classe</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($classes->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Niveau</th>
                <th>Frais</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $classe)
            <tr>
                <td><strong>{{ $classe->name }}</strong></td>
                <td>{{ $classe->level }}</td>
                <td>{{ number_format($classe->fee, 0, ',', ' ') }} FCFA</td>
                <td>
                    <span class="admin-badge-status {{ $classe->active ? 'validated' : 'rejected' }}">
                        {{ $classe->active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.classes.edit', $classe->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.classes.destroy', $classe->id) }}" method="POST" onsubmit="return confirm('Supprimer cette classe ?');">
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
    <div class="admin-empty-row">Aucune classe enregistrée.</div>
    @endif
</div>
@endsection
