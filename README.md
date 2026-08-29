# Vicunav Web

Vicunav's own site: a from-scratch Gutenberg Full Site Editing block theme.

This repository currently holds the static HTML, CSS and JavaScript baseline
refined in Claude Code from the approved Claude Design prototypes. It is the
intermediate step between design and the native block theme: fifteen real,
navigable pages with no React, no Tailwind, no build step and no CDN
dependencies. This baseline is what
[`transform-claude-to-gutenberg`](https://github.com/vicunav/vicunav-transform-claude-to-gutenberg)
will translate into the actual WordPress theme under a `paridad-1-1` contract.

Vicunav's brand tokens live in this repository's own `theme.json` once the
Gutenberg theme lands here; they are not shared with
[`vicunav-theme-core`](https://github.com/vicunav/vicunav-theme-core). See
[ADR 0012](https://github.com/vicunav/vicunav-hub/blob/main/docs/adr/0012-sitio-propio-vicunav-web.md)
in `vicunav-hub` for the decision and its consequences. This repository runs
in parallel with [`vicunav-gutenberg`](https://github.com/vicunav/vicunav-gutenberg),
the site's previous version, without a dependency relationship between the
two.

## Pages

| # | Page | File |
| --- | --- | --- |
| 01 | Home | `index.html` |
| 02 | Services (index) | `servicios.html` |
| 03 | Portfolio | `portafolio.html` |
| 04 | Contact | `contacto.html` |
| 05 | About | `nosotros.html` |
| 06 | Vertical: Restaurants | `restaurantes.html` |
| 07 | Vertical: Hotels and inns | `hoteles.html` |
| 08 | Vertical: Wellness | `bienestar.html` |
| 09 | Service: Custom systems | `sistemas.html` |
| 10 | Service: Automation | `automatizacion.html` |
| 11 | Service: Websites | `sitios.html` |
| 12 | Service: Visibility | `visibilidad.html` |
| 13 | Articles (listing) | `articulos.html` |
| 14 | Article (single) | `articulo.html` |
| 15 | Mario, recruiter landing (English) | `cv.html` |

## Running locally

No build, no dependencies. Serve the directory with any static file server:

```bash
python3 -m http.server 8080
```

Then open `http://localhost:8080/index.html`.

## Structure

```text
*.html                        The 15 templates, at the repository root
assets/css/tokens.css         Design tokens as CSS custom properties
assets/css/base.css           Reset, visible focus, prefers-reduced-motion
assets/css/layout.css         Header, footer, WhatsApp floating button
assets/css/components.css     Components shared across templates
assets/css/pages/*.css        Local geometry per template
assets/js/                    Mobile nav toggle, article category filter
assets/fonts/                 Plus Jakarta Sans, self-hosted (SIL OFL)
docs/standards/               Shared Vicunav ecosystem standards (submodule)
docs/handoff/                 Design handoff package this baseline was built from
```

See [AGENTS.md](AGENTS.md) for the decisions made while refining this
baseline and the manual QA checklist.

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for the atomic issue and squash-merge
workflow used across the Vicunav ecosystem.
