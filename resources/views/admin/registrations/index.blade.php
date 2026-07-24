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

<div class="admin-panel" style="margin-bottom:20px;">
    <div style="padding:16px 20px;display:flex;gap:8px;flex-wrap:wrap;">
        <a href="{{ route('admin.registrations.index') }}" class="admin-row-btn {{ !$status ? 'admin-row-btn-green' : '' }}" style="{{ !$status ? '' : 'background:var(--grey-light);' }}">Toutes</a>
        @foreach(['nouvelle' => 'Nouvelles', 'en_examen' => 'En examen', 'validee' => 'Validées', 'liste_attente' => "Liste d'attente", 'rejetee' => 'Rejetées'] as $value => $label)
        <a href="{{ route('admin.registrations.index', ['status' => $value]) }}" class="admin-row-btn {{ $status == $value ? 'admin-row-btn-green' : '' }}" style="{{ $status == $value ? '' : 'background:var(--grey-light);' }}">{{ $label }}</a>
        @endforeach
    </div>
</div>

<div class="admin-panel">
    @if($registrations->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Élève</th>
                <th>Parent / tuteur</th>
                <th>Classe souhaitée</th>
                <th>Statut</th>
                <th>Reçu le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
            <tr>
                <td><strong style="color:var(--royal-blue);">{{ $registration->first_name }} {{ $registration->last_name }}</strong></td>
                <td>
                    {{ $registration->parent_name }}<br>
                    <span style="color:var(--grey-mid);font-size:0.8rem;">{{ $registration->parent_email }}</span>
                </td>
                <td>{{ $registration->classeSouhaitee->name ?? 'Non défini' }}</td>
                <td>
                    <span class="admin-badge-status {{ $registration->status == 'validee' ? 'validated' : ($registration->status == 'rejetee' ? 'rejected' : 'pending') }}">
                        {{ ucfirst(str_replace('_', ' ', $registration->status)) }}
                    </span>
                </td>
                <td>{{ $registration->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.registrations.show', $registration->id) }}" class="admin-row-btn admin-row-btn-green">Examiner le dossier</a>
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
