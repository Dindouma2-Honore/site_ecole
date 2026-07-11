@extends('admin.layouts.app')

@section('title', 'Soumissions')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Soumissions</h1>
        <p>{{ $devoir->titre }} — {{ $devoir->course->name ?? '' }}</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($soumissions->count())
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
            @foreach($soumissions as $soumission)
            <tr>
                <td><strong>{{ $soumission->apprenant->first_name ?? '' }} {{ $soumission->apprenant->last_name ?? '' }}</strong></td>
                <td>{{ $soumission->date_soumission->format('d/m/Y H:i') }}</td>
                <td><a href="{{ Storage::url($soumission->fichier_joint) }}" target="_blank">Télécharger</a></td>
                <td>
                    <span class="admin-badge-status {{ $soumission->statut == 'en_retard' ? 'rejected' : 'validated' }}">
                        {{ $soumission->statut == 'en_retard' ? 'En retard' : ($soumission->statut == 'note' ? 'Noté' : 'À temps') }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('admin.soumissions.noter', $soumission->id) }}" method="POST" style="display:flex;gap:6px;">
                        @csrf @method('PUT')
                        <input type="number" step="0.25" min="0" max="20" name="note" value="{{ $soumission->note }}" class="admin-form-input" style="width:70px;">
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
