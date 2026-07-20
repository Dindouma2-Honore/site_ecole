@extends('admin.layouts.app')

@section('title', 'Inscriptions')

@section('content')

<div class="admin-topbar">
    <div>
        <h1>Inscriptions</h1>
        <p>{{ $registrations->total() }} dossier(s) au total</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    <div class="admin-panel-header">
        <h3>Liste des inscriptions</h3>
    </div>

    @if($registrations->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Élève</th>
                <th>Contact</th>
                <th>Formation</th>
                <th>Date de naissance</th>
                <th>Statut</th>
                <th>Reçu le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
            <tr>
                <td>
                    <strong style="color:var(--royal-blue);">{{ $registration->first_name }} {{ $registration->last_name }}</strong>
                </td>
                <td>
                    {{ $registration->email }}<br>
                    <span style="color:var(--grey-mid);font-size:0.8rem;">{{ $registration->phone }}</span>
                </td>
                <td>{{ $registration->course->name ?? 'Non défini' }}</td>
                <td>{{ \Illuminate\Support\Carbon::parse($registration->birth_date)->format('d/m/Y') }}</td>
                <td>
                    <span class="admin-badge-status {{ $registration->status }}">
                        @if($registration->status == 'pending') En attente
                        @elseif($registration->status == 'validated') Validée
                        @else Rejetée
                        @endif
                    </span>
                </td>
                <td>{{ $registration->created_at->format('d/m/Y') }}</td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        @if($registration->status !== 'validated')
                        <form action="{{ route('admin.validate', $registration->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="admin-row-btn admin-row-btn-green" title="Valider"><i class="bi bi-check-lg"></i> Valider</button>
                        </form>
                        @endif

                        @if($registration->status !== 'rejected')
                        <form action="{{ route('admin.reject', $registration->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="admin-row-btn admin-row-btn-orange" title="Rejeter"><i class="bi bi-x-lg"></i> Rejeter</button>
                        </form>
                        @endif

                        <form action="{{ route('admin.delete', $registration->id) }}" method="POST"
                              onsubmit="return confirm('Supprimer définitivement ce dossier ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-row-btn admin-row-btn-red" title="Supprimer"><i class="bi bi-trash"></i> Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="padding:20px 24px;">
        {{ $registrations->links() }}
    </div>
    @else
    <div class="admin-empty-row">Aucune inscription pour le moment.</div>
    @endif
</div>

@endsection
