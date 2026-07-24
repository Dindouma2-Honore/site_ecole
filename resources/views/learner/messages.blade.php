@extends('learner.layout')

@section('title', 'Messages')
@section('page-title', 'Messages')
@section('page-subtitle', "Communication avec l'administration")

@section('content')

@if(session('success'))
<div class="admin-alert" style="margin-bottom:20px;">✅ {{ session('success') }}</div>
@endif

<div class="ea-widget" style="margin-bottom:20px;">
    <div class="ea-widget-header"><h3><i class="bi bi-pencil-square"></i> Nouveau message</h3></div>
    <div class="ea-widget-body">
        <form action="{{ route('learner.messages.store') }}" method="POST">
            @csrf
            <div class="admin-form-group">
                <label class="admin-form-label">Destinataire</label>
                <select name="recipient_id" class="admin-form-input" required>
                    <option value="">Choisir...</option>
                    @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Sujet</label>
                <input type="text" name="subject" class="admin-form-input" required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label">Message</label>
                <textarea name="body" class="admin-form-input" rows="4" required></textarea>
            </div>
            <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Envoyer</button>
        </form>
    </div>
</div>

<div class="ea-widget">
    <div class="ea-widget-header"><h3><i class="bi bi-envelope"></i> Ma messagerie</h3></div>
    @if($messages->count())
    <table class="admin-table">
        <thead><tr><th>Sujet</th><th>De / À</th><th>Date</th><th>Statut</th><th></th></tr></thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td><strong>{{ $message->subject }}</strong></td>
                <td>
                    @if($message->sender_id === auth()->id())
                    À : {{ $message->recipient->name ?? '—' }}
                    @else
                    De : {{ $message->sender->name ?? '—' }}
                    @endif
                </td>
                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($message->recipient_id === auth()->id() && !$message->read_at)
                    <span class="ea-tag-pill new">Nouveau</span>
                    @else
                    <span style="color:var(--grey-mid);font-size:0.75rem;">Lu</span>
                    @endif
                </td>
                <td><a href="{{ route('learner.messages.show', $message->id) }}" class="admin-row-btn admin-row-btn-green">Ouvrir</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="admin-empty-row">Aucun message pour le moment.</div>
    @endif
</div>

@endsection
