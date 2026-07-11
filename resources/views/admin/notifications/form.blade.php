@extends('admin.layouts.app')

@section('title', 'Envoyer une notification')

@section('content')
<div class="admin-topbar"><div><h1>Envoyer une notification</h1></div></div>

<div class="admin-panel" style="max-width:650px;">
    <div style="padding:28px;">
        <form action="{{ route('admin.notifications.store') }}" method="POST" id="notifForm">
            @csrf

            <div class="admin-form-group">
                <label class="admin-form-label">Destinataires</label>
                <select name="scope" id="scopeSelect" class="admin-form-input" onchange="toggleScope()">
                    <option value="tous">Tous les apprenants</option>
                    <option value="classe">Une classe précise</option>
                    <option value="individuel">Un apprenant précis</option>
                </select>
            </div>

            <div class="admin-form-group" id="classeField" style="display:none;">
                <label class="admin-form-label">Classe</label>
                <select name="course_id" class="admin-form-input">
                    <option value="">Choisir...</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group" id="apprenantField" style="display:none;">
                <label class="admin-form-label">Apprenant</label>
                <select name="apprenant_id" class="admin-form-input">
                    <option value="">Choisir...</option>
                    @foreach($apprenants as $apprenant)
                    <option value="{{ $apprenant->id }}">{{ $apprenant->first_name }} {{ $apprenant->last_name }} ({{ $apprenant->matricule }})</option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Type</label>
                <select name="type" class="admin-form-input">
                    <option value="info">Info</option>
                    <option value="alerte">Alerte</option>
                    <option value="annonce">Annonce</option>
                </select>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Titre</label>
                <input type="text" name="titre" class="admin-form-input" required>
            </div>

            <div class="admin-form-group">
                <label class="admin-form-label">Message</label>
                <textarea name="message" class="admin-form-input" rows="4" required></textarea>
            </div>

            <div style="display:flex;gap:12px;margin-top:20px;">
                <button type="submit" class="admin-login-btn" style="width:auto;padding:10px 24px;">Envoyer</button>
                <a href="{{ route('admin.notifications.index') }}" class="admin-row-btn" style="padding:10px 24px;background:var(--grey-light);">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleScope() {
        const scope = document.getElementById('scopeSelect').value;
        document.getElementById('classeField').style.display = scope === 'classe' ? 'block' : 'none';
        document.getElementById('apprenantField').style.display = scope === 'individuel' ? 'block' : 'none';
    }
</script>
@endsection
