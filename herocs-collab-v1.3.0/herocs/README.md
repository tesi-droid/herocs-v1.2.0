# HeroCS Theme - Tema WordPress per CS Communication Agency

**Versione:** 1.2.0  
**Richiede WordPress:** 6.0+  
**Richiede PHP:** 7.4+  
**Testato fino a:** WordPress 6.4  
**Text Domain:** herocs

## 📋 Descrizione

HeroCS è un tema WordPress moderno e professionale progettato per CS Communication Agency, un'agenzia di comunicazione specializzata in comunicazione politica, istituzionale e sociale.

### Palette Colori Brand
- **Viola (Primary):** #7c3aed
- **Fucsia (Secondary):** #ec4899
- **Blu (Accent):** #3b82f6

> ⚠️ **IMPORTANTE:** Il tema NON utilizza il colore verde. Tutti i componenti rispettano la palette brand.

## 🚀 Installazione

### Metodo 1: Upload ZIP (Consigliato)
1. Accedi al pannello WordPress Admin
2. Vai su **Aspetto → Temi → Aggiungi nuovo**
3. Clicca **Carica tema**
4. Seleziona il file `herocs5finalissima.zip`
5. Clicca **Installa ora**
6. Attiva il tema

### Metodo 2: FTP/File Manager
1. Estrai il contenuto del file ZIP
2. Carica la cartella `herocs` in `/wp-content/themes/`
3. Vai su **Aspetto → Temi**
4. Attiva il tema HeroCS

## 📁 Struttura File

```
herocs/
├── style.css                 # Stili principali + header tema
├── functions.php             # Funzioni tema
├── header.php                # Header con navbar e dark mode
├── footer.php                # Footer 4 colonne + newsletter
├── index.php                 # Template principale
├── front-page.php            # Homepage con sliders
├── single.php                # Singolo articolo
├── 404.php                   # Pagina errore
├── screenshot.png            # Preview tema
├── theme.json                # Configurazione FSE
│
├── assets/
│   ├── css/
│   │   ├── dark-mode.css     # Stili dark mode
│   │   ├── editor-style.css  # Stili editor Gutenberg
│   │   ├── palette-integration.css
│   │   └── responsive.css    # Media queries
│   └── js/
│       ├── main.js           # Script principale + Swiper
│       ├── animations.js     # Animazioni scroll
│       └── customizer.js     # Preview customizer
│
├── inc/
│   ├── custom-post-types.php # CPT: team, portfolio, press, service, collaborazioni
│   ├── custom-fields.php     # Meta boxes per CPT
│   ├── theme-options.php     # Opzioni customizer
│   ├── helpers.php           # Funzioni utility
│   └── color-helpers.php     # Helper colori
│
├── template-parts/
│   ├── hero-section.php      # Hero statico
│   ├── hero-slider.php       # Hero slider Swiper
│   ├── team-grid.php         # Griglia team
│   ├── portfolio-grid.php    # Griglia portfolio
│   ├── press-grid.php        # Griglia rassegna stampa
│   ├── services-block.php    # Blocco servizi
│   ├── collaborazioni-grid.php
│   ├── content.php
│   ├── content-none.php
│   └── content-search.php
│
└── page-*.php                # Template pagine specifiche
    ├── page-chi-siamo.php
    ├── page-cosa-facciamo.php
    ├── page-collaborazioni.php
    └── page-press.php
```

## ⚙️ Configurazione Post-Installazione

### 1. Impostare Homepage
1. Vai su **Impostazioni → Lettura**
2. Seleziona "Una pagina statica"
3. Homepage: seleziona la pagina creata con template "Homepage"

### 2. Configurare Menu
1. Vai su **Aspetto → Menu**
2. Crea menu per:
   - Primary Menu (navbar principale)
   - Footer Links
   - Footer Services

### 3. Configurare Logo e Colori
1. Vai su **Aspetto → Personalizza**
2. **Identità del sito:** carica logo
3. **Opzioni Tema:** configura social media, contatti, ecc.

### 4. Creare Contenuti
Aggiungi contenuti ai Custom Post Types:
- **Team:** Aspetto → Team → Aggiungi nuovo
- **Portfolio:** Aspetto → Portfolio → Aggiungi nuovo
- **Servizi:** Aspetto → Servizi → Aggiungi nuovo
- **Press:** Aspetto → Press → Aggiungi nuovo
- **Collaborazioni:** Aspetto → Collaborazioni → Aggiungi nuovo

## 🎨 Features

### Homepage
- **Hero Slider:** Supporta immagini, video MP4, YouTube, Vimeo
- **Team Slider:** Carousel con Swiper.js (6→2→1 colonne responsive)
- **Collaborazioni Slider:** Infinite scroll con loghi clienti
- **Servizi Grid:** 3→2→1 colonne responsive
- **Press Preview:** Ultime 3 news

### Dark Mode
- Toggle nel header
- Persistenza via localStorage
- Supporto completo in tutti i componenti

### Accessibilità (WCAG AA)
- Font minimo 16px
- Contrasto ≥ 4.5:1
- Focus states visibili
- Navigazione da tastiera
- ARIA labels

### Responsive
- Desktop: 1536px+
- Laptop: 1280px
- Tablet: 768px
- Mobile: 480px
- Small: 320px

## 🔧 Customizer Options

### Identità Sito
- Logo
- Titolo sito
- Descrizione

### Opzioni Tema
- Hero Slider settings
- Social media URLs
- Footer description
- Newsletter settings
- Dark mode toggle

### Colori
- Primary color
- Secondary color
- Accent color

## 📦 Dipendenze Esterne

Il tema carica automaticamente:
- **Google Fonts:** Inter, Poppins, Fahkwang
- **Swiper.js 10.x:** Per sliders

## 🔄 Changelog

### v1.2.0 (Dicembre 2024)
- ✅ Miglioramenti homepage sliders
- ✅ Footer ristrutturato 4 colonne
- ✅ Social icons ottimizzati (24px)
- ✅ Newsletter con consent checkbox
- ✅ Loading states per sliders
- ✅ Empty states migliorati
- ✅ Fix encoding UTF-8 completo
- ✅ Dominio aggiornato a cscommunicationagency.it
- ✅ WCAG AA compliance per servizi

### v1.1.0
- Hero slider multimediale
- Dark mode completo
- Custom Post Types

### v1.0.0
- Release iniziale

## 🐛 Troubleshooting

### Slider non funzionano
1. Verifica che Swiper.js sia caricato (console browser)
2. Controlla che ci siano abbastanza slide (minimo 4 per loop)

### Dark mode non persiste
1. Verifica che localStorage sia abilitato
2. Controlla la console per errori JS

### Immagini non responsive
1. Rigenera thumbnails con plugin "Regenerate Thumbnails"
2. Verifica che le immagini siano caricate correttamente

## 📞 Supporto

Per supporto tecnico:
- **Email:** info@cscommunicationagency.it
- **Sito:** https://cscommunicationagency.it

## 📄 Licenza

GNU General Public License v2 or later

---

**© 2024 HeroCS Theme - Sviluppato per CS Communication Agency**
