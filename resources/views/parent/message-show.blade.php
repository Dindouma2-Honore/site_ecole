@extends('parent.layout')

@section('title', $message->subject)
@section('page-title', $message->subject)

@section('content')

<div class="ea-widget" style="max-width:700px;">
    <div class="ea-widget-header">
        <h3><i class="bi bi-envelope-open"></i> {{ $message->subject }}</h3>
        <span style="font-size:0.75rem;color:var(--grey-mid);">{{ $message->created_at->format('d/m/Y H:i') }}</span>
    </div>
    <div class="ea-widget-body">
        <p style="font-size:0.82rem;color:var(--grey-mid);margin-bottom:14px;">
            De <strong>{{ $message->sender->name ?? '—' }}</strong> à <strong>{{ $message->recipient->name ?? '—' }}</strong>
        </p>
        <p style="font-size:0.9rem;color:var(--text-body);line-height:1.7;">{{ $message->body }}</p>

        <a href="{{ route('parent.messages.index') }}" class="admin-row-btn" style="background:var(--grey-light);margin-top:20px;display:inline-block;">← Retour à la messagerie</a>
    </div>
</div>

@endsection
