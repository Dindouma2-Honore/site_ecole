@extends('admin.layouts.app')

@section('title', 'Années scolaires')

@section('content')
<div class="admin-topbar"><div><h1>Années scolaires</h1></div></div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel" style="margin-bottom:20px;max-width:500px;">
    <div class="admin-panel-header"><h3>Ajouter une année scolaire</h3></div>
    <div style="padding:20px;">
        <form action="{{ route('admin.academic-years.store') }}" method="POST">
            @csrf
            <div class="admin-form-group">
                <label class="admin-form-label">Libellé</label>
                <input type="text" name="label" class="admin-form-input" placeholder="2026-2027" required>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                <div class="admin-form-group">
                    <label class="admin-form-label">Début</label>
                    <input type="date" name="start_date" class="admin-form-input" required>
                </div>
                <div class="admin-form-group">
                    <label class="admin-form-label">Fin</label>
                    <input type="date" name="end_date" class="admin-form-input" required>
                </div>
            </div>
            <div class="admin-form-group" style="display:flex;align-items:center;gap:8px;">
                <input type="checkbox" name="is_current" value="1" id="is_current">
                <label for="is_current" style="margin:0;">Définir comme année courante</label>
            </div>
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Ajouter</button>
        </form>
    </div>
</div>

<div class="admin-panel">
    <table class="admin-table">
        <thead><tr><th>Libellé</th><th>Période</th><th>Statut</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($academicYears as $year)
            <tr>
                <td><strong>{{ $year->label }}</strong></td>
                <td>{{ $year->start_date->format('d/m/Y') }} - {{ $year->end_date->format('d/m/Y') }}</td>
                <td>
                    @if($year->is_current)
                    <span class="admin-badge-status validated">Année courante</span>
                    @else
                    <span style="color:var(--grey-mid);font-size:0.8rem;">—</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        @if(!$year->is_current)
                        <form action="{{ route('admin.academic-years.current', $year->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button type="submit" class="admin-row-btn admin-row-btn-green">Définir courante</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.academic-years.destroy', $year->id) }}" method="POST" onsubmit="return confirm('Supprimer cette année scolaire ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
