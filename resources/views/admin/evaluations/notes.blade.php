@extends('admin.layouts.app')

@section('title', 'Saisie des notes')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Saisie des notes</h1>
        <p>{{ $evaluation->titre }} — {{ $evaluation->course->name ?? '' }} — {{ $evaluation->discipline->name ?? '' }} (sur {{ $evaluation->bareme }})</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    <form action="{{ route('admin.evaluations.notes.save', $evaluation->id) }}" method="POST">
        @csrf
        @if($apprenants->count())
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Élève</th>
                    <th>Matricule</th>
                    <th>Note (/ {{ $evaluation->bareme }})</th>
                    <th>Appréciation (optionnel)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apprenants as $apprenant)
                <tr>
                    <td><strong>{{ $apprenant->first_name }} {{ $apprenant->last_name }}</strong></td>
                    <td>{{ $apprenant->matricule }}</td>
                    <td>
                        <input type="number" step="0.25" min="0" max="{{ $evaluation->bareme }}"
                               name="notes[{{ $apprenant->id }}]" class="admin-form-input"
                               value="{{ old('notes.' . $apprenant->id, $notes[$apprenant->id]->valeur ?? '') }}">
                    </td>
                    <td>
                        <input type="text" name="appreciations[{{ $apprenant->id }}]" class="admin-form-input"
                               value="{{ old('appreciations.' . $apprenant->id, $notes[$apprenant->id]->appreciation ?? '') }}" placeholder="Très bien, Peut mieux faire...">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding:20px 24px;display:flex;gap:12px;">
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Enregistrer les notes</button>
            <a href="{{ route('admin.evaluations.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Retour</a>
        </div>
        @else
        <div class="admin-empty-row">Aucun élève dans cette classe.</div>
        @endif
    </form>
</div>
@endsection
