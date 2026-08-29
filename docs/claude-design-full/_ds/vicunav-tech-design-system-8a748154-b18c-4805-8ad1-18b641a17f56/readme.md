# Vicunav Tech — Design System

## Overview & sources

Vicunav Tech is framed here as a warm, human technology studio/consultancy: the kind of company that organizes its work into a small set of service **pillars** and shows a **portfolio** of projects, with a direct "let's talk" call to action. This system was built **from a written brand brief only** — no codebase, Figma file, or slide deck was attached to this project. The brief supplied:

- Four brand colors (dark graphite, cream, amber accent, warm-taupe secondary) with explicit usage notes.
- The typeface name (Plus Jakarta Sans) and a weight system per text role.
- An 8px spacing scale.
- A minimal, explicit component list: primary button, secondary/ghost button, pillar card, portfolio project card, form input, badge/kicker.
- An icon-style spec (outline, 2px stroke, no fill, rounded corners, 64px base, 2–3 shapes max).

No logo, product screenshots, or existing UI were provided. Everything beyond the brief's explicit values (layout, copy, the website UI kit, derived color states, the type scale, radii, shadows) is this system's own reasonable extrapolation — **flag anything that doesn't match your real brand and I'll correct it.**

If a Figma file, codebase, or deck exists for Vicunav Tech, attach it and I'll reconcile this system against the real source.

## Content fundamentals

- **Language:** Spanish (LatAm), informal "tú" register — matches the brief's own Spanish terminology ("Pilar 1", "Boton primario").
- **Tone:** warm, direct, confident without corporate jargon. Short sentences. No emoji, no exclamation-heavy copy.
- **Voice pattern:** company as "we" (construimos, diseñamos, trabajamos), speaking to the reader as "tú/tu equipo" — collaborative, not salesy.
- **Example headline:** "Construimos tecnología con calidez humana."
- **Example body:** "Diseño y desarrollo de producto para equipos que quieren moverse rápido sin perder calidez ni claridad."
- **Labels:** short, numbered when listing pillars ("Pilar 01", "Pilar 02"), always uppercase via the Kicker component, never sentence case.
- **CTAs:** verb-first and low-friction — "Hablemos", "Empieza un proyecto" — never "Submit" or "Learn more" style genericism.

## Visual foundations

- **Color:** four values only — graphite `#2B2825` (dark, primary hero/CTA surface), cream `#F4EFE6` (light, primary content surface), amber `#E8873A` (the single accent — CTAs and highlighted links), warm-taupe `#B7AE9F` (secondary — supporting text and borders, always used solid, never at reduced opacity). All derived states (hover, press, tints, card surfaces, borders) are `color-mix(in oklch, …)` blends of these four — no invented hues. Max two background colors per screen (dark or cream), consistent with "avoid AI slop" guidance.
- **Type:** one family, Plus Jakarta Sans, for everything — headlines, body, UI labels. Weight carries the hierarchy (700/600/500/400), not size alone. See `guidelines/type-scale.card.html`.
- **Spacing:** strict 8px-derived scale (2/4/8/16/24/32/48/64px). Card padding is 32px; internal stack gaps are 16px.
- **Backgrounds:** flat color only. No gradients, no photography-heavy hero, no textures or patterns, no grain. Warm solid graphite or cream fields, sometimes with a single amber accent shape (button, kicker) — never a gradient wash.
- **Radii:** moderate rounding, not pill-everything: 8px (inputs, small chips), 12px (icon tiles), 20px (cards), fully round only for buttons/badges (pill). Cards are NOT the "rounded box with a colored left border" pattern — avoid that entirely.
- **Shadows:** soft and warm-tinted — `color-mix` blends of the graphite dark color at low opacity, never neutral/cool black. Used sparingly, mostly to lift white cards off a cream section.
- **Borders:** 1px, warm-taupe-derived, low contrast — a quiet separator, not a design feature.
- **Animation:** minimal — 150ms ease color/opacity transitions on hover, a 0.97 scale "press" on buttons. No bounces, no elaborate motion; this is a calm, confident brand, not a playful one.
- **Hover states:** color shifts (darker amber on primary buttons, a darker taupe on ghost/secondary text) — never opacity-based per the brief's explicit "sin opacity extra" rule for the secondary button.
- **Press states:** a small 0.97 scale-down on buttons, paired with the darkest derived accent tone.
- **Imagery:** none supplied. Portfolio project cards ship with a labeled placeholder area ("Imagen del proyecto") — replace with real project photography once available. No stock photos or illustrations were invented for this system.
- **Layout:** simple stacked full-width sections, generous horizontal padding (64px), content max-widths on hero copy — no fixed/sticky chrome beyond a standard top header.
- **Transparency/blur:** not used — the brief's flat, confident palette doesn't call for glass/blur effects.

## Iconography

The brief specifies a precise icon spec (outline, 2px stroke, no fill, rounded joins, 64px base, 2–3 shapes per glyph) but supplied no icon files or library. The closest CDN match — same stroke weight, no fill, rounded caps — is **Lucide** (`https://unpkg.com/lucide@latest`), loaded via CDN and used through the `Icon` component (`components/icon/Icon.jsx`), which renders `<i data-lucide="...">` and calls `lucide.createIcons()`. This is a **substitution**: flag it if Vicunav Tech has its own icon set, and I'll swap it in. No emoji or unicode glyphs are used as icons anywhere in this system.

## Fonts

Plus Jakarta Sans is the real, correctly-specified brand font (no substitution needed) — declared via `@font-face` in `tokens/fonts.css`, sourced from the type foundry's own open-source repository (`tokotype/PlusJakartaSans`, SIL OFL) for weights 400/500/600/700. It is CDN-referenced rather than vendored as binary files in this project; if you'd rather self-host the actual `.woff2` files here, drop them in and I'll rewire the `@font-face` `src` paths.

## Intentional additions

- **`Icon`** (`components/icon/`) — not in the brief's component list, but required to satisfy the brief's own iconography spec (pillar cards need an icon). Thin Lucide wrapper, documented above.

## Index

- `styles.css` — root stylesheet; `@import`s everything below. Link this one file from any consumer.
- `tokens/` — `colors.css`, `typography.css`, `spacing.css`, `radii.css`, `shadows.css`, `fonts.css`.
- `guidelines/` — foundation specimen cards: `colors-primary`, `colors-semantic`, `type-scale`, `type-weights`, `spacing-scale`, `spacing-in-use`, `radii`, `shadows`, `brand-mood`.
- `components/` — reusable primitives, one directory each:
  - `buttons/Button` — primary (amber pill) / secondary (ghost, solid taupe text)
  - `badges/Kicker` — small uppercase pill label ("Pilar 01")
  - `forms/Input` — labeled text field / textarea
  - `cards/pillar/PillarCard` — icon + title + description
  - `cards/project/ProjectCard` — portfolio project card
  - `icon/Icon` — Lucide icon wrapper (intentional addition, see above)
- `ui_kits/website/` — a full one-page marketing site (`index.html`): header, hero, pillars, portfolio, contact form (interactive — try submitting it), footer.
- `SKILL.md` — Claude Code / Agent Skills-compatible entry point for this system.
- `thumbnail.html` — project tile shown on the homepage.

## Caveats — please help me iterate

1. **No logo.** Every wordmark in this system is plain "Vicunav Tech" set in type — I never draw or approximate a logo. If one exists, attach it and I'll wire it into the header, footer, and thumbnail.
2. **No real product source.** This entire system (website structure, copy, the derived color/type/radius/shadow scale) is my extrapolation from a four-color, one-font, one-spacing-scale brief. If Vicunav Tech has an existing site, deck, or Figma file, attach it and I'll rebuild this system against the real thing instead of my interpretation.
3. **Icons are a CDN substitution** (Lucide), not a real Vicunav Tech icon asset — flag if you have your own set.
4. **Fonts are CDN/repo-referenced**, not vendored binaries — send the actual font files if you'd like them self-hosted here.
5. **"Vicunav Tech warm"** was read as company name "Vicunav Tech" + a "warm" brand feeling — correct me if that's not right.
