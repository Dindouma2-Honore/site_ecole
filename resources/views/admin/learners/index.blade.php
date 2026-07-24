@extends('admin.layouts.app')

@section('title', 'Apprenants')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Apprenants</h1>
        <p>{{ $learners->count() }} apprenant(s)</p>
    </div>
    <a href="{{ route('admin.learners.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter un apprenant</a>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel" style="margin-bottom:20px;">
    <div style="padding:16px 20px;">
        <form method="GET" style="display:flex;gap:10px;align-items:center;">
            <label class="admin-form-label" style="margin:0;">Filtrer par classe :</label>
            <select name="class_id" class="admin-form-input" style="width:auto;" onchange="this.form.submit()">
                <option value="">Toutes les classes</option>
                @foreach($classes as $classe)
                <option value="{{ $classe->id }}" {{ (string) $classId === (string) $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="admin-panel">
    @if($learners->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Classe</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($learners as $learner)
            <tr>
                <td>{{ $learner->matricule }}</td>
                <td><strong>{{ $learner->first_name }} {{ $learner->last_name }}</strong></td>
                <td>{{ $learner->schoolClass->name ?? '—' }}</td>
                <td>
                    <span class="admin-badge-status {{ $learner->status == 'actif' ? 'validated' : 'pending' }}">
                        {{ ucfirst($learner->status) }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.learners.show', $learner->id) }}" class="admin-row-btn admin-row-btn-green">Voir</a>
                        <a href="{{ route('admin.learners.edit', $learner->id) }}" class="admin-row-btn admin-row-btn-orange">Modifier</a>
                        <form action="{{ route('admin.learners.destroy', $learner->id) }}" method="POST" onsubmit="return confirm('Supprimer cet apprenant ?');">
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
    <div class="admin-empty-row">Aucun apprenant enregistré.</div>
    @endif
</div>
@endsection
