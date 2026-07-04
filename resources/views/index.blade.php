<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ambassadors Educational Complex | Premier Bilingual School</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <!-- ============================================
     ADMIN BAR (seulement visible quand un admin est connecté)
     ============================================ -->
    {{-- <div class="admin-bar" id="adminBar">
          @yield('adminbar')
    </div> --}}
    <!-- ============================================
     ADMIN LOGIN MODAL
     ============================================ -->
    {{-- <div class="admin-modal-overlay" id="adminLoginModal">
         @yield('login')
    </div> --}}
    <!-- ============================================
     INDICATEUR DE STATUS API
     ============================================ -->
    {{-- <div class="api-status" id="apiStatus">

    </div> --}}
    <!-- ============================================
     TOP BAR
     ============================================ -->
    <div class="topbar">
        @include('topbar.index')
    </div>
    <!-- ============================================
      BAR D'ANNONCE
     ============================================ -->
     <div class="announce-bar" data-api="/api/announcements">
        @include('annonce.index')
     </div>
     <!-- ============================================
     HEADER
     ============================================ -->
     <header class="header" id="header">
        @include('header.index')
     </header>
     <!-- ============================================
     HERO
     ============================================ -->
     <section class="hero" id="home">
        @include('hero.index')
     </section>
     <!-- ============================================
     STATS BAR
     ============================================ -->
     <section class="stats-section" data-api="/api/stats">
       @include('stats.index')
     </section>
     <!-- ============================================
     WELCOME
     ============================================ -->
     <section class="welcome-section" id="about">
       @include('welcome.index')
     </section>
     <!-- ============================================
     POURQUOI NOUS CHOISIR
     ============================================ -->
     <section class="why-section">
      @include('choose_us.index')
     </section>
     <!-- ============================================
     VIRTUAL TOUR
     ============================================ -->
     <section  class="tour-section" id="tour">
        @include('virtual_tour.index')
     </section>
     <!-- ============================================
     PROGRAMS
     ============================================ -->
     <section class="programs-section" data-api="/api/programs" id="programs">
        @include('programs.index')
     </section>
     <!-- ============================================
     NEWS & EVENTS
     ============================================ -->
     <section class="news-section" data-api="/api/news" id="news">
       @include('new_event.index')
     </section>
     <!-- ============================================
     GALLERY
     ============================================ -->
     <section class="gallery-section" data-api="/api/gallery" id="gallery">
         @include('galerie.index')
     </section>
     <!-- ============================================
     TESTIMONIALS
     ============================================ -->
     <section class="testimonials-section" data-api="/api/testimonials">
       @include('testimonial.index')
     </section>
     <!-- ============================================
     ADMISSIONS
     ============================================ -->
     <section class="admissions-section" id="admissions">
        @include('admission.index')
     </section>
     <!-- ============================================
     HALL OF FAME
     ============================================ -->
     <section class="halloffame-section" data-api="/api/halloffame" id="halloffame">
       @include('hall_fame.index')
     </section>
     <!-- ============================================
     PARTNERS
     ============================================ -->
     <section class="partners-section">
        @include('partner.index')
     </section>
     <!-- ============================================
     CONTACT
     ============================================ -->
     <section class="contact-section" id="contact">
        @include('contact.index')
     </section>
     <!-- ============================================
     FOOTER
     ============================================ -->
     <section class="footer">
       @include('footer.index')
     </section>
     <!-- ============================================
     MODALS
     ============================================ -->
     <section class="modal-overlay" id="programModal" onclick="closeProgramModal(event)">
        @include('modal.index')
     </section> 

<!-- SCROLL TO TOP -->
<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</button>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>