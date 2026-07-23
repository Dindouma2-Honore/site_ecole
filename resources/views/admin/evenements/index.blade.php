@extends('admin.layouts.app')

@section('title', 'Événements')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Événements à venir</h1>
        <p>{{ $evenement->count() }} événement(s)</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($evenement->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Lieu</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evenement as $event)
            <tr>
                <td><strong>{{ $event->icon }}  {{ $event->title }}</strong></td>
                <td>{{ $event->event_date}}</td>
                <td>{{ $event->event_time }}</td>
                <td>{{ $event->location }}</td>
                <td>
                    <span class="admin-badge-status {{ $event->active ? 'validated' : 'rejected' }}">
                        {{ $event->active ? 'Visible' : 'Masqué' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Supprimer cet événement ?');">
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
    <div class="admin-empty-row">Aucun événement enregistré.</div>
    @endif
</div>
@endsection
