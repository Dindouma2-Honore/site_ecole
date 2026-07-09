@extends('admin.layouts.app')

@section('title', 'Galerie')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Galerie Photos / Vidéos</h1>
        <p>{{ $items->count() }} élément(s)</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}" class="admin-logout-btn" style="background:var(--royal-blue);border-color:var(--royal-blue);color:#fff;width:auto;">+ Ajouter</a>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    @if($items->count())
    <table class="admin-table">
        <thead>
            <tr>
                <th>Aperçu</th>
                <th>Titre</th>
                <th>Type</th>
                <th>Catégorie</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>
                    @if($item->type === 'photo' && $item->image)
                    <img src="{{ Storage::url($item->image) }}" style="width:60px;height:44px;object-fit:cover;border-radius:6px;">
                    @else
                    <span style="font-size:1.4rem;">🎬</span>
                    @endif
                </td>
                <td><strong>{{ $item->title }}</strong></td>
                <td>{{ $item->type === 'photo' ? 'Photo' : 'Vidéo' }}</td>
                <td>{{ $item->category ?? '—' }}</td>
                <td>
                    <span class="admin-badge-status {{ $item->active ? 'validated' : 'rejected' }}">
                        {{ $item->active ? 'Visible' : 'Masqué' }}
                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.gallery.edit', $item->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Supprimer cet élément ?');">
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
    @else
    <div class="admin-empty-row">Aucun élément dans la galerie.</div>
    @endif
</div>
@endsection
