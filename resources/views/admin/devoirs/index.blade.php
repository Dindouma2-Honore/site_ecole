@extends('admin.layouts.app')

@section('title', 'Devoirs')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Devoirs</h1>
        <p>{{ $devoirs->count() }} devoir(s)</p>
    </div>
    <a href="{{ route('admin.devoirs.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Publier un devoir</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($devoirs->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Classe</th>
                <th>Matière</th>
                <th>Échéance</th>
                <th>Soumissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devoirs as $devoir)
            <tr>
                <td><strong>{{ $devoir->titre }}</strong></td>
                <td>{{ $devoir->course->name ?? '—' }}</td>
                <td>{{ $devoir->discipline->name ?? '—' }}</td>
                <td>{{ $devoir->date_limite->format('d/m/Y') }}</td>
                <td>{{ $devoir->soumissions->count() }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.devoirs.soumissions', $devoir->id) }}" class="admin-row-btn admin-row-btn-green">Soumissions</a>
                        <a href="{{ route('admin.devoirs.edit', $devoir->id) }}" class="admin-row-btn admin-row-btn-orange">Modifier</a>
                        <form action="{{ route('admin.devoirs.destroy', $devoir->id) }}" method="POST" onsubmit="return confirm('Supprimer ce devoir ?');">
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
    <div class="admin-empty-row">Aucun devoir publié.</div>
    @endif
</div>
@endsection
