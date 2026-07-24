@extends('layouts.app')

@section('title', 'Actualités & Événements')

@section('content')
    {{-- @if ($featured && !request('course_id'))
       
        <div style="background:yellow;padding:10px;margin:10px 0;border:2px solid red;">
            <p><strong>DEBUG FEATURED</strong></p>
            <p>Image path: {{ $featured->image }}</p>
            <p>Asset URL: {{ asset('storage/' . $featured->image) }}</p>
            @if ($featured->image)
                <p>
                    File exists:
                    {{ Storage::disk('public')->exists($featured->image) ? 'YES' : 'NO' }}
                </p>
            @else
                <p>File exists: NO IMAGE</p>
            @endif
        </div>

        <div class="news-featured">
            <!-- ... votre code existant ... -->
        </div>
    @endif --}}
    <section class="subpage-hero"
        style="background-image:url('/images/18.jpg'), linear-gradient(135deg, var(--royal-blue), var(--royal-blue-light));background-size:cover;background-position:center;position:relative;">
        <div style="position:absolute;inset:0;background:linear-gradient(135deg, rgba(6,18,60,0.85), rgba(10,36,99,0.55));">
        </div>
        <div class="container" style="position:relative;">
            <div class="section-tag" style="color:var(--gold);">Actualités & Événements</div>
            <h1>Vivre, apprendre, <span style="color:var(--gold-light);">réussir ensemble</span></h1>
            <p>Restez informés des dernières actualités, événements et réalisations qui rythment la vie de la communauté
                Ambassadors.</p>
        </div>
    </section>

    <section class="content-block" style="background:var(--off-white);">
        <div class="container">
            <div class="news-filter-bar">
                <a href="{{ route('public.news.index') }}"
                    class="gallery-tab @if (!request('course_id')) active @endif">Toutes</a>
                <a href="{{ route('public.news.index', ['course_id' => 'generale']) }}"
                    class="gallery-tab @if (request('course_id') == 'generale') active @endif">Générale</a>
                @foreach ($courses as $course)
                    <a href="{{ route('public.news.index', ['course_id' => $course->id]) }}"
                        class="gallery-tab @if ((string) request('course_id') === (string) $course->id) active @endif">{{ $course->name }}</a>
                @endforeach
            </div>

            <div class="news-layout">
                <!-- Colonne principale -->
                <div>
                    @if ($featured && !request('course_id'))
                        <div class="news-featured">
                            @if ($featured->image)
                                <img src="{{ asset('storage/' . $featured->image) }}" alt="{{ $featured->title }}"
                                    style="width:100%;height:300px;object-fit:cover;display:block;border-radius:12px 12px 0 0;">
                            @else
                                <div class="news-featured-img"
                                    style="background:#f0f0f0;display:flex;align-items:center;justify-content:center;height:300px;">
                                    <i class="bi bi-image" style="font-size:3rem;color:#ccc;"></i>
                                </div>
                            @endif
                            <div class="news-featured-body">
                                <span class="news-featured-badge">À la une</span>
                                <div class="news-featured-title">{{ $featured->title }}</div>
                                <p style="color:var(--grey-mid);font-size:0.9rem;margin-bottom:12px;">
                                    {{ \Illuminate\Support\Str::limit($featured->content, 200) }}</p>
                                <a href="{{ route('public.news.show', $featured->id) }}"
                                    style="color:var(--royal-blue);font-weight:700;font-size:0.85rem;text-decoration:none;">Lire
                                    la suite <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endif

                    <h3 style="font-family:var(--font-display);color:var(--royal-blue);margin-bottom:18px;">Dernières
                        actualités</h3>

                    @if ($news->count())
                        <div class="news-grid">
                            @foreach ($news as $item)
                                @if ($item->id !== optional($featured)->id || request('course_id'))
                                    <div class="news-card">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                                style="width:100%;height:200px;object-fit:cover;display:block;border-radius:12px 12px 0 0;">
                                        @else
                                            <div class="news-image-placeholder"
                                                style="width:100%;height:200px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">
                                                <i class="bi bi-newspaper" style="font-size:2rem;color:#ccc;"></i>
                                            </div>
                                        @endif
                                        <div class="news-body">
                                            <span class="news-tag">{{ $item->course->name ?? 'Actualité générale' }}</span>
                                            <div class="news-title">{{ $item->title }}</div>
                                            <p class="news-excerpt">
                                                {{ \Illuminate\Support\Str::limit($item->content, 110) }}</p>
                                            <div class="news-date"><i class="bi bi-calendar3"></i>
                                                {{ $item->published_at->format('d/m/Y') }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div style="margin-top:30px;">
                            {{ $news->links() }}
                        </div>
                    @else
                        <p style="text-align:center;color:var(--grey-mid);">Aucune actualité pour le moment.</p>
                    @endif
                </div>

                <!-- Sidebar -->
                <div>
                    <div class="news-sidebar-widget">
                        <div class="news-sidebar-header"><i class="bi bi-calendar-event"></i> Événements à venir</div>
                        @forelse($events as $evenement)
                            <div class="event-mini"
                                style="display:flex;align-items:center;gap:12px;padding:12px 0;border-bottom:1px solid #eef2f6;">
                                <!-- Image de l'événement -->
                                @if ($evenement->image)
                                    <!-- Date de l'événement -->
                                    <div
                                        style="
                                            width:55px;
                                            height:55px;
                                            border-radius:15px;
                                            flex-shrink:0;
                                            background:var(--royal-blue-light);
                                            border:2px solid var(--royal-blue);
                                            display:flex;
                                            flex-direction:column;
                                            align-items:center;
                                            justify-content:center;
                                            color:#fff;
                                            font-weight:700;
                                        ">
                                        <span style="font-size:1.2rem;line-height:1;">
                                            {{ \Carbon\Carbon::parse($evenement->start_date)->format('d') }}
                                        </span>
                                        <span style="font-size:0.65rem;text-transform:uppercase;">
                                            {{ \Carbon\Carbon::parse($evenement->start_date)->translatedFormat('M') }}
                                        </span>
                                    </div>
                                @else
                                    <div
                                        style="width:55px;height:55px;border-radius:50%;background:var(--royal-blue-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--royal-blue);">
                                        <i class="bi bi-calendar-event" style="font-size:1.5rem;"></i>
                                    </div>
                                @endif

                                <!-- Informations -->
                                <div class="event-mini-info" style="flex:1;min-width:0;">
                                    <strong
                                        style="display:block;font-size:0.9rem;color:var(--royal-blue);margin-bottom:2px;">
                                        @if ($evenement->icon)
                                            {{ $evenement->icon }}
                                        @endif
                                        {{ $evenement->title }}
                                    </strong>
                                    <span style="font-size:0.8rem;color:var(--grey-mid);display:block;">
                                        <i class="bi bi-clock" style="font-size:0.7rem;"></i>
                                        @if ($evenement->event_time)
                                            {{ \Carbon\Carbon::parse($evenement->event_time)->format('H:i') }}
                                        @elseif($evenement->start_date)
                                            {{ \Carbon\Carbon::parse($evenement->start_date)->format('H:i') }}
                                        @endif
                                        @if ($evenement->location)
                                            <i class="bi bi-geo-alt" style="font-size:0.7rem;margin-left:8px;"></i>
                                            {{ \Str::limit($evenement->location, 15) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div style="padding:16px 20px;color:var(--grey-mid);font-size:0.82rem;text-align:center;">
                                <i class="bi bi-calendar-x"
                                    style="display:block;font-size:2rem;margin-bottom:8px;color:#ddd;"></i>
                                Aucun événement programmé.
                            </div>
                        @endforelse
                    </div>

                    <div class="news-sidebar-widget">
                        <div class="mini-calendar">
                            <div class="mini-calendar-head">
                                {{ \Illuminate\Support\Carbon::now()->translatedFormat('F Y') }}</div>
                            <div class="mini-calendar-grid">
                                @foreach (['L', 'M', 'M', 'J', 'V', 'S', 'D'] as $d)
                                    <span class="dow">{{ $d }}</span>
                                @endforeach
                                @php
                                    $today = \Illuminate\Support\Carbon::now();
                                    $firstDay = $today->copy()->startOfMonth();
                                    $daysInMonth = $today->daysInMonth;
                                    $startOffset = $firstDay->dayOfWeekIso - 1;
                                @endphp
                                @for ($i = 0; $i < $startOffset; $i++)
                                    <span class="muted">&nbsp;</span>
                                @endfor
                                @for ($d = 1; $d <= $daysInMonth; $d++)
                                    <span class="{{ $d == $today->day ? 'today' : '' }}">{{ $d }}</span>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="news-share-cta">
                        <i class="bi bi-megaphone-fill"></i>
                        <p>Vous avez un événement à partager ? Faites-nous parvenir les détails et nous le publierons.</p>
                        <a href="{{ route('public.contact.index') }}" class="btn btn-primary"
                            style="width:100%;display:block;">Nous
                            contacter <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter band -->
    <section class="news-newsletter-band">
        <div class="container news-newsletter-inner">
            <div class="news-newsletter-text">
                <i class="bi bi-envelope-paper-fill"></i>
                <div>
                    <strong>Ne manquez aucune actualité !</strong>
                    <span>Abonnez-vous à notre newsletter et recevez toutes les nouveautés d'Ambassadors.</span>
                </div>
            </div>
            <div class="newsletter-input-wrap">
                <input type="email" class="newsletter-input" placeholder="Votre adresse e-mail">
                <button class="newsletter-btn">S'abonner</button>
            </div>
        </div>
    </section>
@endsection
