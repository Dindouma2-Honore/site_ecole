@extends('admin.layouts.app')

@section('title', "Faire l'appel")

@section('content')
<div class="admin-topbar"><div><h1>Faire l'appel</h1></div></div>

<div class="admin-panel" style="margin-bottom:20px;">
    <div style="padding:20px;">
        <form method="GET" style="display:flex;gap:14px;align-items:end;">
            <div class="admin-form-group" style="margin:0;flex:1;">
                <label class="admin-form-label">Classe</label>
                <select name="class_id" class="admin-form-input" onchange="this.form.submit()">
                    <option value="">Choisir...</option>
                    @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ (string) $classId === (string) $classe->id ? 'selected' : '' }}>{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

@if($classId)
<div class="admin-panel">
    <form action="{{ route('admin.attendances.store') }}" method="POST">
        @csrf
        <input type="hidden" name="class_id" value="{{ $classId }}">

        <div style="padding:20px;max-width:250px;">
            <div class="admin-form-group" style="margin:0;">
                <label class="admin-form-label">Date</label>
                <input type="date" name="date" class="admin-form-input" value="{{ now()->format('Y-m-d') }}" required>
            </div>
        </div>

        @if($learners->count())
        <table class="admin-table">
            <thead><tr><th>Élève</th><th>Statut</th><th>Justifié</th></tr></thead>
            <tbody>
                @foreach($learners as $learner)
                <tr>
                    <td><strong>{{ $learner->first_name }} {{ $learner->last_name }}</strong></td>
                    <td>
                        <select name="statuts[{{ $learner->id }}]" class="admin-form-input">
                            <option value="present">Présent</option>
                            <option value="absent">Absent</option>
                            <option value="retard">Retard</option>
                        </select>
                    </td>
                    <td><input type="checkbox" name="justified[{{ $learner->id }}]" value="1"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:20px;">
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer l'appel</button>
        </div>
        @else
        <div class="admin-empty-row">Aucun élève dans cette classe.</div>
        @endif
    </form>
</div>
@endif
@endsection
