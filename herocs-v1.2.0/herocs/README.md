# HeroCS - WordPress Theme

**Versione**: 1.2.0  
**Autore**: grimike  
**Author URI**: https://archeoclubcaltagirone.it  
**Tema per**: https://www.cscommunicationagency.it/  
**Text Domain**: herocs

---

## Descrizione

HeroCS è un tema WordPress moderno e responsivo progettato specificamente per agenzie di comunicazione. Include supporto completo per post type personalizzati, integrazione ACF, sliders animati con Swiper.js, dark mode e molto altro.

### Caratteristiche Principali

- ✅ **Responsive Design** - Mobile-first, ottimizzato per tutti i dispositivi
- ✅ **Dark Mode** - Tema scuro attivabile con toggle
- ✅ **Hero Slider** - Slider multimediale con supporto immagini e video (YouTube, Vimeo, MP4)
- ✅ **Custom Post Types** - Team, Portfolio, Servizi, Collaborazioni, Press
- ✅ **ACF Integration** - Campi personalizzati per ogni CPT
- ✅ **Swiper.js** - Slider fluidi e performanti
- ✅ **Gradient Hero** - Header con gradiente viola-fucsia-blu
- ✅ **Palette Coerente** - Sistema di colori coordinato
- ✅ **Google Fonts** - Poppins, Inter, Fahkwang
- ✅ **Accessibilità** - WCAG AA compliant
- ✅ **SEO Friendly** - Markup semantico e strutturato

---

## Installazione

### Metodo 1: Upload da WordPress Admin
1. Scarica il file `herocs.zip`
2. Vai in WordPress > Aspetto > Temi > Aggiungi nuovo
3. Clicca "Carica tema"
4. Seleziona `herocs.zip` e clicca "Installa ora"
5. Attiva il tema

### Metodo 2: Via FTP
1. Estrai `herocs.zip`
2. Carica la cartella `herocs/` in `/wp-content/themes/`
3. Vai in WordPress > Aspetto > Temi
4. Attiva HeroCS

---

## Requisiti

| Requisito | Versione |
|-----------|----------|
| WordPress | 6.0+ |
| PHP | 7.4+ |
| MySQL | 5.7+ |

### Plugin Consigliati
- **Advanced Custom Fields (ACF)** - Per campi personalizzati
- **Classic Editor** - Per compatibilità editor classico
- **Yoast SEO** - Per ottimizzazione SEO

---

## Struttura File

```
herocs/
├── inc/
│   ├── custom-post-types.php    # Registrazione CPT
│   ├── custom-fields.php        # Meta boxes e ACF fields
│   ├── theme-options.php        # Opzioni customizer
│   ├── helpers.php              # Funzioni helper
│   └── color-helpers.php        # Gestione colori
├── template-parts/
│   ├── hero-section.php         # Sezione hero
│   ├── hero-slider.php          # Slider hero
│   ├── collaborazioni-grid.php  # Griglia collaborazioni
│   ├── team-grid.php            # Griglia team
│   ├── press-grid.php           # Griglia press
│   ├── services-block.php       # Blocco servizi
│   ├── portfolio-grid.php       # Griglia portfolio
│   ├── content.php              # Content standard
│   ├── content-none.php         # Nessun contenuto
│   └── content-search.php       # Risultati ricerca
├── 404.php
├── archive-collaborazioni.php   # Archivio collaborazioni
├── archive-press.php            # Archivio press
├── footer.php
├── front-page.php               # Homepage
├── functions.php
├── header.php
├── index.php
├── page-chi-siamo.php
├── page-collaborazioni.php
├── page-cosa-facciamo.php
├── page-press.php
├── single.php
├── single-collaborazioni.php    # Singola collaborazione
├── single-portfolio.php
├── single-press.php
├── single-service.php
├── single-team.php
├── style.css
├── dark-mode.css
├── editor-style.css
├── palette-integration.css
├── responsive.css
├── main.js
├── animations.js
├── customizer.js
├── theme.json
├── screenshot.png
└── README.md
```

---

## Custom Post Types

### 1. Team (`team`)
- **Uso**: Membri del team/staff
- **Campi**: Posizione, Bio, Email, Telefono, LinkedIn, Twitter
- **Template**: `single-team.php`

### 2. Portfolio (`portfolio`)
- **Uso**: Progetti e case study
- **Campi**: Cliente, Anno, Servizi, Risultati, Gallery
- **Template**: `single-portfolio.php`

### 3. Servizi (`service`)
- **Uso**: Servizi offerti
- **Campi**: Icona, Descrizione breve, Features
- **Template**: `single-service.php`

### 4. Collaborazioni (`collaborazioni`)
- **Uso**: Clienti, partner, collaboratori
- **Campi**: Logo, Website, Anno, Settore, Servizi, Risultati
- **Template**: `single-collaborazioni.php`, `archive-collaborazioni.php`
- **Taxonomy**: `tipologia_cliente` (Clienti, Partner, Fornitori)

### 5. Press (`press`)
- **Uso**: Articoli stampa e news
- **Campi**: Fonte, Data pubblicazione, Link esterno
- **Template**: `single-press.php`, `archive-press.php`

---

## Colori Principali

| Colore | HEX | Uso |
|--------|-----|-----|
| Viola (Primary) | `#7c3aed` | Colore principale, CTA |
| Fucsia (Secondary) | `#ec4899` | Accenti, hover |
| Blu (Accent) | `#3b82f6` | Link, elementi secondari |
| Dark | `#1e293b` | Testo, dark mode bg |
| Light | `#f1f5f9` | Sfondi chiari |

### Gradienti
```css
/* Gradient principale */
background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);

/* Gradient dark mode */
background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
```

---

## Customizer Options

Vai in **Aspetto > Personalizza** per accedere alle opzioni:

### Identità del Sito
- Logo personalizzato
- Favicon
- Titolo e tagline

### Opzioni Tema
- Abilita/disabilita dark mode toggle
- Colori primari
- Font personalizzati

### Hero Slider
- Abilita/disabilita slider
- Velocità transizione
- Effetto (fade/slide)
- Contenuti slide

### Social Links
- Facebook, Instagram, LinkedIn, Twitter/X, YouTube

### Footer
- Testo copyright
- Link aggiuntivi
- Newsletter (integrazione Mailchimp)

---

## Configurazione Post-Installazione

### 1. Impostare la Homepage
1. Crea una pagina "Home"
2. Vai in **Impostazioni > Lettura**
3. Seleziona "Una pagina statica"
4. Imposta "Home" come pagina iniziale

### 2. Configurare i Menu
1. Vai in **Aspetto > Menu**
2. Crea menu "Primary" e assegnalo a "Menu Principale"
3. Crea menu "Footer Links" e "Footer Services"

### 3. Aggiungere Contenuti
1. Aggiungi membri del Team
2. Aggiungi Servizi
3. Aggiungi Collaborazioni con logo e dettagli
4. Aggiungi progetti Portfolio
5. Aggiungi articoli Press

### 4. Configurare Hero Slider
1. Vai nel Customizer > Hero Slider
2. Abilita lo slider
3. Aggiungi slide con immagini/video
4. Imposta titoli e CTA

---

## Dipendenze Esterne

| Risorsa | Versione | CDN |
|---------|----------|-----|
| Swiper.js | 10.x | jsdelivr |
| Google Fonts | - | fonts.googleapis.com |

### Font Caricati
- **Poppins** - Titoli (600, 700, 800)
- **Inter** - Body text (400, 500, 600)
- **Fahkwang** - Accenti (400, 500)

---

## Dark Mode

Il tema supporta dark mode completo:

1. **Attivazione**: Toggle nell'header (icona luna/sole)
2. **Persistenza**: Salvato in localStorage
3. **Copertura**: Tutti i componenti supportati
4. **Transizione**: Animazione smooth 0.3s

```css
/* Esempio override dark mode */
body.dark-mode .my-element {
    background: #1e293b;
    color: #f1f5f9;
}
```

---

## Sviluppo e Personalizzazione

### Aggiungere CSS Personalizzato
Usa il file `style.css` o aggiungi CSS nel Customizer > CSS Aggiuntivo

### Hooks Disponibili
```php
// Prima del contenuto
do_action('herocs_before_content');

// Dopo il contenuto
do_action('herocs_after_content');

// Nel footer
do_action('herocs_footer_widgets');
```

### Filtri
```php
// Modifica colori palette
add_filter('herocs_color_palette', 'my_custom_colors');

// Modifica breakpoints responsive
add_filter('herocs_breakpoints', 'my_breakpoints');
```

---

## Changelog

### v1.2.0 (Corrente)
- ✅ Aggiunta pagina single-collaborazioni.php
- ✅ Aggiunta pagina archive-collaborazioni.php
- ✅ Fix percorsi hero-slider
- ✅ Miglioramento team slider navigation
- ✅ Fix encoding UTF-8
- ✅ Aggiornamento dominio a cscommunicationagency.it
- ✅ Dark mode migliorato
- ✅ README completo

### v1.1.0
- Hero slider multimediale
- Dark mode completo
- Custom Post Types
- WCAG AA compliance

### v1.0.0
- Release iniziale
- Layout base responsive
- Integrazione ACF
- Swiper.js

---

## Supporto

Per problemi o richieste:

- **Email**: info@cscommunicationagency.it
- **Website**: https://www.cscommunicationagency.it/

### Troubleshooting Comune

**Hero slider non carica**
- Verifica che il percorso in hero-section.php sia corretto
- Controlla che Swiper.js sia caricato

**Dark mode non funziona**
- Verifica localStorage nel browser
- Controlla la console per errori JS

**Immagini non si vedono**
- Verifica i permessi della cartella uploads
- Rigenera le thumbnails

---

## Crediti

- **Icons**: SVG custom inline
- **Slider**: [Swiper.js](https://swiperjs.com/)
- **Fonts**: [Google Fonts](https://fonts.google.com/)
- **Framework**: Vanilla JS + CSS Grid/Flexbox

---

## Licenza

Questo tema è distribuito sotto licenza **GPL v2 o successiva**.

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
```

---

**Sviluppato con ❤️ da grimike per CS Communication Agency**
