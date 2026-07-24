@extends('parent.layout')

@section('title', 'Mes demandes')
@section('page-title', 'Mes demandes')
@section('page-subtitle', "Contacter l'administration")

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

<div class="ea-widget" style="margin-bottom:20px;max-width:600px;">
    <div class="ea-widget-header"><h3><i class="bi bi-pencil-square"></i> Nouvelle demande</h3></div>
    <div class="ea-widget-body">
        <form action="{{ route('parent.requests.store') }}" method="POST">
            @csrf
            <div class="admin-form-group">
                <label class="admin-form-label">Sujet</label>
                <input type="text" name="subject" class="admin-form-input" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Message</label>
                <textarea name="message" class="admin-form-input" rows="4" required></textarea>
            </div>
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Envoyer la demande</button>
        </form>
    </div>
</div>

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-chat-left-text"></i> Historique de mes demandes</h3></div>
    @if($requests->count())
    <table class="admin-table">
        <thead><tr><th>Sujet</th><th>Message</th><th>Statut</th><th>Date</th></tr></thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td><strong>{{ $request->subject }}</strong></td>
                <td style="max-width:280px;font-size:0.85rem;color:var(--grey-mid);">{{ \Illuminate\Support\Str::limit($request->message, 80) }}</td>
                <td>
                    <span class="admin-badge-status {{ $request->status == 'traitee' ? 'validated' : 'pending' }}">
                        {{ ucfirst(str_replace('_',' ',$request->status)) }}
                    </span>
                </td>
                <td>{{ $request->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucune demande envoyée.</div>
    @endif
</div>

@endsection
