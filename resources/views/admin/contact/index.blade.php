@extends('admin.layouts.app')

@section('title', 'Messages de contact')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Messages de contact</h1>
        <p>{{ $messages->total() }} message(s) reçu(s)</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($messages->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Expéditeur</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr>
                <td>
                    <strong>{{ $message->name }}</strong><br>
                    <span style="font-size:0.8rem;color:var(--grey-mid);">{{ $message->email }}@if($message->phone) · {{ $message->phone }} @endif</span>
                </td>
                <td>{{ $message->subject ?: '—' }}</td>
                <td style="max-width:280px;font-size:0.85rem;color:var(--grey-mid);">{{ \Illuminate\Support\Str::limit($message->message, 90) }}</td>
                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <span class="admin-badge-status {{ $message->is_read ? 'validated' : 'pending' }}">
                        {{ $message->is_read ? 'Lu' : 'Non lu' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        @if(!$message->is_read)
                        <form action="{{ route('admin.contact-messages.read', $message->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="admin-row-btn admin-row-btn-green">Marquer lu</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-row-btn admin-row-btn-red">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="padding:20px 24px;">
        {{ $messages->links() }}
    </div>
    @else
    <div class="admin-empty-row">Aucun message reçu.</div>
    @endif
</div>
@endsection
