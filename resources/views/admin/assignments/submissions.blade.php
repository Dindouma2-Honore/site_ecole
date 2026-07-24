@extends('admin.layouts.app')

@section('title', 'Soumissions')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Soumissions</h1>
        <p>{{ $assignment->title }} — {{ $assignment->course->schoolClass->name ?? '' }}</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($submissions->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Élève</th>
                <th>Date de soumission</th>
                <th>Fichier</th>
                <th>Statut</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($submissions as $submission)
            <tr>
                <td><strong>{{ $submission->learner->first_name ?? '' }} {{ $submission->learner->last_name ?? '' }}</strong></td>
                <td>{{ $submission->submitted_at->format('d/m/Y H:i') }}</td>
                <td><a href="{{ Storage::url($submission->file_path) }}" target="_blank">Télécharger</a></td>
                <td>
                    <span class="admin-badge-status {{ $submission->status == 'en_retard' ? 'rejected' : 'validated' }}">
                        {{ $submission->status == 'en_retard' ? 'En retard' : ($submission->status == 'note' ? 'Noté' : 'À temps') }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('admin.assignment-submissions.grade', $submission->id) }}" method="POST" style="display:flex;gap:6px;">
                        @csrf @method('PUT')
                        <input type="number" step="0.25" min="0" max="20" name="grade" value="{{ $submission->grade }}" class="admin-form-input" style="width:70px;">
                        <button type="submit" class="admin-row-btn admin-row-btn-green">Noter</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune soumission reçue pour l'instant.</div>
    @endif
</div>
@endsection
