@extends('admin.layouts.app')

@section('title', 'Équipe administrative')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Équipe administrative</h1>
        <p>{{ $membres->count() }} membre(s)</p>
    </div>
    <a href="{{ route('admin.equipe.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter un membre</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($membres->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Rôle</th>
                <th>Contact</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($membres as $membre)
            <tr>
                <td>
                    @if($membre->photo)
                    <img src="{{ Storage::url($membre->photo) }}" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;">
                    @else
                    <span style="font-size:1.5rem;">👤</span>
                    @endif
                </td>
                <td><strong>{{ $membre->name }}</strong></td>
                <td>{{ $membre->role }}</td>
                <td style="font-size:0.8rem;color:var(--grey-mid);">{{ $membre->email }}<br>{{ $membre->phone }}</td>
                <td>
                    <span class="admin-badge-status {{ $membre->active ? 'validated' : 'rejected' }}">
                        {{ $membre->active ? 'Actif' : 'Inactif' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.equipe.edit', $membre->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.equipe.destroy', $membre->id) }}" method="POST" onsubmit="return confirm('Supprimer ce membre ?');">
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
    <div class="admin-empty-row">Aucun membre enregistré.</div>
    @endif
</div>
@endsection
