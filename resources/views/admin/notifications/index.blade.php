@extends('admin.layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Notifications & Annonces</h1>
        <p>{{ $notifications->count() }} notification(s) envoyée(s)</p>
    </div>
    <a href="{{ route('admin.notifications.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Envoyer une notification</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($notifications->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Portée</th>
                <th>Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
            <tr>
                <td><strong>{{ $notification->titre }}</strong></td>
                <td>
                    @if($notification->apprenant) {{ $notification->apprenant->first_name }} {{ $notification->apprenant->last_name }}
                    @elseif($notification->course) Classe : {{ $notification->course->name }}
                    @else Tous les apprenants
                    @endif
                </td>
                <td>{{ ucfirst($notification->type) }}</td>
                <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" onsubmit="return confirm('Supprimer cette notification ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune notification envoyée.</div>
    @endif
</div>
@endsection
