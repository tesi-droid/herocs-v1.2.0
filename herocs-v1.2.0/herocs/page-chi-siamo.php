<?php
/**
 * Template Name: Chi Siamo
 * Template Post Type: page
 * 
 * Pagina Chi Siamo con sezioni: Intro, Team, Valori
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();
?>

<main id="primary" class="site-main page-chi-siamo">
    
    <!-- ========================================================================== -->
    <!-- HERO HEADER -->
    <!-- ========================================================================== -->
    <section class="chi-siamo-hero">
        <div class="hero-gradient-bg"></div>
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <div class="hero-container">
                <span class="hero-badge">Chi Siamo</span>
                <h1 class="hero-title">Costruiamo relazioni attraverso la comunicazione</h1>
                <p class="hero-subtitle">Un team di professionisti appassionati che trasforma idee in strategie vincenti</p>
            </div>
        </div>
        <!-- Scroll indicator -->
        <div class="hero-scroll">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- INTRO / MISSION SECTION -->
    <!-- ========================================================================== -->
    <section class="chi-siamo-intro">
        <div class="intro-container">
            
            <div class="intro-grid">
                
                <!-- Colonna Sinistra: Testo principale -->
                <div class="intro-content">
                    <span class="section-badge">La Nostra Storia</span>
                    <h2 class="section-title">Un'agenzia nata dalla passione per la comunicazione</h2>
                    
                    <div class="intro-text">
                        <p>
                            Siamo un'agenzia di comunicazione specializzata in comunicazione politica, 
                            istituzionale e sociale. Da oltre un decennio aiutiamo i nostri clienti a 
                            raggiungere i loro obiettivi attraverso strategie innovative e risultati misurabili.
                        </p>
                        <p>
                            La nostra forza risiede nella capacita di ascoltare, comprendere e tradurre 
                            le esigenze dei nostri clienti in campagne di comunicazione efficaci e memorabili.
                            Ogni progetto e unico, ogni storia merita di essere raccontata nel modo giusto.
                        </p>
                    </div>
                    
                    <!-- Stats -->
                    <div class="intro-stats">
                        <div class="stat-item">
                            <span class="stat-number">15+</span>
                            <span class="stat-label">Anni di Esperienza</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">200+</span>
                            <span class="stat-label">Progetti Completati</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Clienti Soddisfatti</span>
                        </div>
                    </div>
                </div>
                
                <!-- Colonna Destra: Immagine/Decorazione -->
                <div class="intro-visual">
                    <div class="visual-card">
                        <div class="visual-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                        <h3>La Nostra Mission</h3>
                        <p>Creare connessioni autentiche tra brand e persone, attraverso strategie di comunicazione che lasciano il segno.</p>
                    </div>
                    <div class="visual-decoration"></div>
                </div>
                
            </div>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- I NOSTRI VALORI -->
    <!-- ========================================================================== -->
    <section class="chi-siamo-valori">
        <div class="valori-container">
            
            <div class="section-header">
                <span class="section-badge">Cosa ci guida</span>
                <h2 class="section-title">I Nostri Valori</h2>
                <p class="section-description">I principi fondamentali che guidano ogni nostra azione e decisione</p>
            </div>
            
            <div class="valori-grid">
                
                <!-- Valore 1: Creativita -->
                <div class="valore-card">
                    <div class="valore-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/>
                        </svg>
                    </div>
                    <h3 class="valore-title">Creativita</h3>
                    <p class="valore-text">
                        Pensiamo fuori dagli schemi. Ogni progetto e un'opportunita per innovare 
                        e sorprendere con soluzioni originali e memorabili.
                    </p>
                </div>
                
                <!-- Valore 2: Trasparenza -->
                <div class="valore-card">
                    <div class="valore-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="16" x2="12" y2="12"/>
                            <line x1="12" y1="8" x2="12.01" y2="8"/>
                        </svg>
                    </div>
                    <h3 class="valore-title">Trasparenza</h3>
                    <p class="valore-text">
                        Comunichiamo in modo chiaro e onesto. Crediamo che la fiducia sia 
                        la base di ogni collaborazione di successo.
                    </p>
                </div>
                
                <!-- Valore 3: Risultati -->
                <div class="valore-card">
                    <div class="valore-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
                            <polyline points="16 7 22 7 22 13"/>
                        </svg>
                    </div>
                    <h3 class="valore-title">Risultati</h3>
                    <p class="valore-text">
                        Misuriamo il nostro successo attraverso i risultati concreti dei nostri clienti. 
                        Obiettivi chiari, strategie efficaci.
                    </p>
                </div>
                
                <!-- Valore 4: Collaborazione -->
                <div class="valore-card">
                    <div class="valore-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3 class="valore-title">Collaborazione</h3>
                    <p class="valore-text">
                        Lavoriamo insieme ai nostri clienti come partner. Il vostro successo 
                        e il nostro successo, cresciamo insieme.
                    </p>
                </div>
                
                <!-- Valore 5: Innovazione -->
                <div class="valore-card">
                    <div class="valore-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="valore-title">Innovazione</h3>
                    <p class="valore-text">
                        Restiamo sempre aggiornati sulle ultime tendenze e tecnologie 
                        per offrire soluzioni all'avanguardia.
                    </p>
                </div>
                
                <!-- Valore 6: Passione -->
                <div class="valore-card">
                    <div class="valore-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </div>
                    <h3 class="valore-title">Passione</h3>
                    <p class="valore-text">
                        Amiamo quello che facciamo. La passione per la comunicazione 
                        si riflette in ogni progetto che realizziamo.
                    </p>
                </div>
                
            </div>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- IL NOSTRO TEAM -->
    <!-- ========================================================================== -->
    <section class="chi-siamo-team">
        <div class="team-container">
            
            <div class="section-header">
                <span class="section-badge">Le persone</span>
                <h2 class="section-title">Il Nostro Team</h2>
                <p class="section-description">Professionisti appassionati pronti a trasformare le tue idee in realta</p>
            </div>
            
            <?php
            // Query Team Members
            $team_query = new WP_Query(array(
                'post_type' => 'team',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ));

            if ($team_query->have_posts()) :
                // Carica il template grid
                get_template_part('templates/team', 'grid', array(
                    'query' => $team_query,
                    'columns' => 3
                ));
                wp_reset_postdata();
            else :
            ?>
                <!-- Empty State -->
                <div class="team-empty-state">
                    <div class="empty-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3>Il team sta arrivando!</h3>
                    <p>Stiamo preparando i profili del nostro fantastico team.</p>
                    <?php if (current_user_can('edit_posts')) : ?>
                        <a href="<?php echo admin_url('post-new.php?post_type=team'); ?>" class="admin-link">
                            + Aggiungi il primo membro del team
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- CTA SECTION -->
    <!-- ========================================================================== -->
    <section class="chi-siamo-cta">
        <div class="cta-container">
            <div class="cta-content">
                <h2>Vuoi far parte del nostro team?</h2>
                <p>Siamo sempre alla ricerca di talenti appassionati e creativi</p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cta-btn cta-btn-primary">
                        Lavora con Noi
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>" class="cta-btn cta-btn-secondary">
                        Scopri i nostri servizi
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
/* ========================================================================== */
/* PAGE CHI SIAMO - Complete Styles */
/* ========================================================================== */

.page-chi-siamo {
    background: #f8fafc;
}

/* ========================================================================== */
/* HERO SECTION */
/* ========================================================================== */

.chi-siamo-hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.hero-gradient-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
}

.hero-pattern {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 0 24px;
}

.hero-container {
    max-width: 900px;
    margin: 0 auto;
}

.hero-badge {
    display: inline-block;
    padding: 8px 20px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 24px;
}

.hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 700;
    color: white;
    line-height: 1.15;
    margin: 0 0 24px 0;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
}

.hero-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.1rem, 2vw, 1.35rem);
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    margin: 0;
    max-width: 700px;
    margin: 0 auto;
}

.hero-scroll {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    opacity: 0.7;
    animation: bounceDown 2s ease-in-out infinite;
}

@keyframes bounceDown {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(10px); }
}

/* ========================================================================== */
/* INTRO SECTION */
/* ========================================================================== */

.chi-siamo-intro {
    padding: 100px 0;
    background: white;
}

.intro-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.intro-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 80px;
    align-items: start;
}

.section-badge {
    display: inline-block;
    padding: 6px 16px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 50px;
    color: #7c3aed;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 16px;
}

.section-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 700;
    color: #1e293b;
    line-height: 1.2;
    margin: 0 0 24px 0;
}

.intro-text {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #475569;
}

.intro-text p {
    margin-bottom: 1.5em;
}

.intro-text p:last-child {
    margin-bottom: 0;
}

/* Stats */
.intro-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 48px;
    padding-top: 48px;
    border-top: 1px solid #e2e8f0;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-family: 'Poppins', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 0.9rem;
    color: #64748b;
    font-weight: 500;
}

/* Visual Column */
.intro-visual {
    position: relative;
}

.visual-card {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    border-radius: 20px;
    padding: 40px;
    color: white;
    position: relative;
    z-index: 2;
}

.visual-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
}

.visual-card h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0 0 16px 0;
}

.visual-card p {
    font-size: 1rem;
    line-height: 1.7;
    opacity: 0.95;
    margin: 0;
}

.visual-decoration {
    position: absolute;
    bottom: -20px;
    right: -20px;
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(236, 72, 153, 0.2) 100%);
    border-radius: 20px;
    z-index: 1;
}

/* ========================================================================== */
/* VALORI SECTION */
/* ========================================================================== */

.chi-siamo-valori {
    padding: 100px 0;
    background: #f8fafc;
}

.valori-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.section-header {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 60px;
}

.section-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

.valori-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.valore-card {
    background: white;
    border-radius: 16px;
    padding: 36px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid transparent;
}

.valore-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.12);
    border-color: rgba(124, 58, 237, 0.2);
}

.valore-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    color: #7c3aed;
    transition: all 0.3s;
}

.valore-card:hover .valore-icon {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.valore-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 12px 0;
}

.valore-text {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    line-height: 1.7;
    color: #64748b;
    margin: 0;
}

/* ========================================================================== */
/* TEAM SECTION */
/* ========================================================================== */

.chi-siamo-team {
    padding: 100px 0;
    background: white;
}

.team-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Empty State */
.team-empty-state {
    text-align: center;
    padding: 80px 40px;
    background: #f8fafc;
    border-radius: 20px;
    border: 2px dashed #e2e8f0;
}

.empty-icon {
    color: #94a3b8;
    margin-bottom: 24px;
}

.team-empty-state h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    color: #1e293b;
    margin: 0 0 12px 0;
}

.team-empty-state p {
    color: #64748b;
    margin: 0 0 24px 0;
}

.admin-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.admin-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
}

/* ========================================================================== */
/* CTA SECTION */
/* ========================================================================== */

.chi-siamo-cta {
    padding: 100px 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    position: relative;
    overflow: hidden;
}

.chi-siamo-cta::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.cta-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
}

.cta-content {
    text-align: center;
}

.cta-content h2 {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 700;
    color: white;
    margin: 0 0 16px 0;
}

.cta-content p {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 36px 0;
}

.cta-buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s;
}

.cta-btn-primary {
    background: white;
    color: #7c3aed;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.cta-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.cta-btn-primary svg {
    transition: transform 0.3s;
}

.cta-btn-primary:hover svg {
    transform: translateX(5px);
}

.cta-btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.cta-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .intro-grid {
        grid-template-columns: 1fr;
        gap: 60px;
    }
    
    .intro-visual {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .valori-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .chi-siamo-hero {
        min-height: 60vh;
    }
    
    .chi-siamo-intro,
    .chi-siamo-valori,
    .chi-siamo-team,
    .chi-siamo-cta {
        padding: 60px 0;
    }
    
    .intro-stats {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 16px;
        text-align: left;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .valori-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .valore-card {
        padding: 28px;
    }
    
    .section-header {
        margin-bottom: 40px;
    }
    
    .cta-buttons {
        flex-direction: column;
    }
    
    .cta-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .hero-badge {
        font-size: 0.75rem;
        padding: 6px 16px;
    }
    
    .visual-card {
        padding: 30px;
    }
    
    .visual-decoration {
        display: none;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .page-chi-siamo {
    background: #0f172a;
}

body.dark-mode .chi-siamo-intro {
    background: #1e293b;
}

body.dark-mode .section-title {
    color: #f1f5f9;
}

body.dark-mode .intro-text {
    color: #94a3b8;
}

body.dark-mode .intro-stats {
    border-top-color: #334155;
}

body.dark-mode .stat-label {
    color: #94a3b8;
}

body.dark-mode .chi-siamo-valori {
    background: #0f172a;
}

body.dark-mode .section-description {
    color: #94a3b8;
}

body.dark-mode .valore-card {
    background: #1e293b;
}

body.dark-mode .valore-card:hover {
    box-shadow: 0 20px 40px rgba(167, 139, 250, 0.15);
    border-color: rgba(167, 139, 250, 0.3);
}

body.dark-mode .valore-title {
    color: #f1f5f9;
}

body.dark-mode .valore-text {
    color: #94a3b8;
}

body.dark-mode .chi-siamo-team {
    background: #1e293b;
}

body.dark-mode .team-empty-state {
    background: #0f172a;
    border-color: #334155;
}

body.dark-mode .team-empty-state h3 {
    color: #f1f5f9;
}

body.dark-mode .team-empty-state p {
    color: #94a3b8;
}
</style>

<?php get_footer(); ?>
