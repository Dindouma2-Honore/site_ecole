@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="subpage-hero">
    <div class="container">
        <div class="section-tag" style="color:var(--gold);">Nous contacter</div>
        <h1>Contactez <span style="color:var(--gold-light);">notre établissement</span></h1>
        <p>Une question ? Notre équipe est à votre écoute</p>
    </div>
</section>

<section class="content-block" style="background:var(--off-white);">
    <div class="container">

        @if(session('success'))
        <div class="admin-alert" style="max-width:800px;margin:0 auto 30px;">✅ {{ session('success') }}</div>
        @endif

        <div class="contact-layout">
            <div class="contact-info-card">
                <div class="contact-info-item">
                    <span class="contact-info-icon">📍</span>
                    <div><strong>Adresse</strong><span>Yaoundé, Cameroun</span></div>
                </div>
                <div class="contact-info-item">
                    <span class="contact-info-icon">📞</span>
                    <div><strong>Téléphone</strong><span>+237 6XX XXX XXX</span></div>
                </div>
                <div class="contact-info-item">
                    <span class="contact-info-icon">✉️</span>
                    <div><strong>Email</strong><span>contact@ambassadors.school</span></div>
                </div>
                <div class="contact-info-item">
                    <span class="contact-info-icon">🕐</span>
                    <div><strong>Horaires</strong><span>Lundi - Vendredi, 7h30 - 16h30</span></div>
                </div>
            </div>

            <div class="contact-form-card">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="contact-form-row">
                        <div class="admin-form-group">
                            <label class="admin-form-label">Nom complet</label>
                            <input type="text" name="name" class="admin-form-input" value="{{ old('name') }}" required>
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-form-label">Email</label>
                            <input type="email" name="email" class="admin-form-input" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="contact-form-row">
                        <div class="admin-form-group">
                            <label class="admin-form-label">Téléphone</label>
                            <input type="text" name="phone" class="admin-form-input" value="{{ old('phone') }}">
                        </div>
                        <div class="admin-form-group">
                            <label class="admin-form-label">Sujet</label>
                            <input type="text" name="subject" class="admin-form-input" value="{{ old('subject') }}">
                        </div>
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Message</label>
                        <textarea name="message" class="admin-form-input" rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    @if($errors->any())
                    <div class="admin-login-error show" style="position:static;margin-bottom:16px;">{{ $errors->first() }}</div>
                    @endif
                    <button type="submit" class="btn btn-primary" style="border:none;cursor:pointer;">Envoyer le message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
