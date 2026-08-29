repo: vicunav/vicunav-hub
branch: main
path: docs/

## Last sync

date: 2026-08-28T23:17:00Z

### Updated in this project

- Leídos los estándares reales del ecosistema para preparar el handoff a Claude Code.
- Paquete `design_handoff_vicunav_web/` alineado a `naming.md`, `visual-fidelity.md`, `accessibility.md` y `documentation-language.md`.
- Contrato de migración fijado como `paridad-1-1` por ADR 0010 (fidelidad visual bloqueante).
- Borrador de ADR para crear `vicunav-web`, pendiente de abrir como PR en el hub.

## Screen map

| Pantalla o entregable | Archivos del repo que lo fundamentan |
| --- | --- |
| `design_handoff_vicunav_web/README.md` | `docs/gobernanza.md`, `docs/adr/0010-fidelidad-visual-bloqueante.md` |
| `design_handoff_vicunav_web/contrato-fuente.md` | `vicunav-standards/docs/visual-fidelity.md`, `vicunav-transform-claude-to-gutenberg/skills/transform-claude-to-gutenberg/SKILL.md` |
| `design_handoff_vicunav_web/arquitectura-wordpress.md` | `docs/adr/0001-separacion-theme-plugins.md`, `docs/adr/0004-estructura-de-repos.md`, `docs/adr/0005-acf-genuino-solo-campos.md`, `vicunav-standards/docs/naming.md` |
| `design_handoff_vicunav_web/inventario-assets.md` | `vicunav-standards/docs/visual-fidelity.md`, `vicunav-standards/docs/accessibility.md` |
| `design_handoff_vicunav_web/adr-borrador-vicunav-web.md` | `docs/gobernanza.md`, `docs/adr/README.md` |
| `Vicunav Landings SEO.dc.html` | Fuente de diseño, no deriva del repo |
| `Vicunav Sitio Web v2.dc.html` | Fuente de diseño, no deriva del repo |

## Repos consultados

- `vicunav/vicunav-hub` — README, AGENTS, CONTRIBUTING, gobernanza, ADR 0004, 0005, 0008, 0010
- `vicunav/vicunav-standards` — naming, documentation-language, visual-fidelity, accessibility
- `vicunav/vicunav-transform-claude-to-gutenberg` — SKILL.md, README
