@extends('layouts.app')

@section('title', $item->title)

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">{{ $item->course->name ?? 'Actualité générale' }}</div>
        <h1>{{ $item->title }}</h1>
        <p>Publié le {{ $item->published_at->format('d/m/Y') }}</p>
    </div>
</section>

<section class="content-block">
    <div class="container">
        <div class="content-inner">
            @if($item->image)
            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" style="width:100%;border-radius:var(--radius-md);margin-bottom:24px;">
            @endif
            <p>{{ $item->content }}</p>
            <div style="margin-top:30px;">
                <a href="{{ route('actualites.index') }}" class="btn-secondary" style="margin-top:0;">← Retour aux actualités</a>
            </div>
        </div>
    </div>
</section>
@endsection
