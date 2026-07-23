@extends('admin.layouts.app')

@section('title', 'Annonces')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Annonces</h1>
        <p>{{ $announcements->count() }} annonce(s) publiée(s)</p>
    </div>
    <a href="{{ route('admin.announcements.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Publier une annonce</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($announcements->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Audience</th>
                <th>Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($announcements as $announcement)
            <tr>
                <td><strong>{{ $announcement->title }}</strong></td>
                <td>{{ ucfirst($announcement->audience) }}</td>
                <td>{{ $announcement->author->name ?? '—' }}</td>
                <td>{{ $announcement->published_at?->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Supprimer cette annonce ?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune annonce publiée.</div>
    @endif
</div>
@endsection
