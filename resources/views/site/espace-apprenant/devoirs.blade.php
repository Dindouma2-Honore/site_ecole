@extends('site.espace-apprenant.layout')

@section('title', 'Devoirs & Ressources')
@section('page-title', 'Devoirs & Ressources')
@section('page-subtitle', $apprenant->course->name ?? '')

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

@if($devoirs->count())
    @foreach($devoirs as $devoir)
    @php $soumission = $devoir->soumissions->first(); @endphp
    <div class="ea-widget" style="margin-bottom:18px;">
        <div class="ea-widget-header">
            <h3><i class="bi bi-journal-text"></i> {{ $devoir->titre }}</h3>
            <span style="font-size:0.75rem;color:var(--grey-mid);">{{ $devoir->discipline->name ?? '' }}</span>
        </div>
        <div class="ea-widget-body">
            <p style="font-size:0.88rem;color:var(--text-body);margin-bottom:10px;">{{ $devoir->description }}</p>
            <p style="font-size:0.8rem;color:var(--grey-mid);margin-bottom:14px;">
                <i class="bi bi-calendar3"></i> Publié le {{ $devoir->date_publication->format('d/m/Y') }} ·
                À rendre avant le <strong>{{ $devoir->date_limite->format('d/m/Y') }}</strong>
                @if($devoir->fichier_joint)
                · <a href="{{ Storage::url($devoir->fichier_joint) }}" target="_blank">Télécharger le sujet</a>
                @endif
            </p>

            @if($soumission)
                <div class="ea-finance-badge" style="background:rgba(46,204,113,0.1);color:#1e8449;">
                    <i class="bi bi-check-circle-fill"></i>
                    Devoir soumis le {{ $soumission->date_soumission->format('d/m/Y H:i') }}
                    @if($soumission->note !== null) — Note obtenue : <strong>{{ $soumission->note }}/20</strong> @endif
                </div>
            @elseif(now()->gt($devoir->date_limite))
                <div class="ea-finance-badge" style="background:rgba(231,76,60,0.1);color:#c0392b;">
                    <i class="bi bi-x-circle-fill"></i> Date limite dépassée — vous pouvez encore soumettre en retard
                </div>
            @endif

            <form action="{{ route('espace-apprenant.devoirs.soumettre', $devoir->id) }}" method="POST" enctype="multipart/form-data" style="margin-top:10px;display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;">
                @csrf
                <div style="flex:1;min-width:200px;">
                    <label class="admin-form-label">{{ $soumission ? 'Remplacer mon fichier' : 'Déposer mon fichier' }}</label>
                    <input type="file" name="fichier" required>
                </div>
                <button type="submit" class="ea-action-btn" style="width:auto;padding:10px 18px;flex-direction:row;background:var(--royal-blue);color:var(--white);"><i class="bi bi-upload"></i> Soumettre</button>
            </form>
        </div>
    </div>
    @endforeach
@else
<div class="ea-widget"><div class="admin-empty-row">Aucun devoir publié pour votre classe pour le moment.</div></div>
@endif

@endsection
