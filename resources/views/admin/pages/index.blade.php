@extends('admin.layouts.app')

@section('title', 'Pages de contenu')

@section('content')
<div class="admin-topbar">
    <div>
        <h1>Pages de contenu</h1>
        <p>Dossier établissement, historique, vision/mission, règlement intérieur</p>
    </div>
</div>

@if(session('success'))
<div class="admin-alert">✅ {{ session('success') }}</div>
@endif

<div class="admin-panel">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Identifiant</th>
                <th>Dernière modification</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td><strong>{{ $page->title }}</strong></td>
                <td style="font-size:0.8rem;color:var(--grey-mid);">{{ $page->slug }}</td>
                <td>{{ $page->updated_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="admin-row-btn admin-row-btn-green">Modifier</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
