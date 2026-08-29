# Contrato de fuente

Cumple el gate 1 del ADR 0010 y la sección "Fijar el baseline" de
`vicunav-standards/docs/visual-fidelity.md`.

## 1. Origen

| Campo | Valor |
| --- | --- |
| Herramienta | Claude Design |
| Proyecto | vicunav v2 design |
| Archivos fuente | `diseno/Vicunav Sitio Web v2.dc.html`, `diseno/Vicunav Landings SEO.dc.html` |
| Runtime | `diseno/support.js` |
| Componentes | `SiteHeader.dc.html`, `SiteFooter.dc.html`, `Ico.dc.html` |
| Commit del baseline | [`99c3c2d`](https://github.com/vicunav/vicunav-web/commit/99c3c2da096eda6463e6b0e49ae376109c5f8428) en `main` de `vicunav-web` |

El refinamiento en Claude Code está completo: las 15 plantillas de la
sección 3 existen como HTML, CSS y JavaScript estático en `vicunav-web`,
un commit por plantilla, todos fusionados en `main`. Ese commit,
`99c3c2d`, es el baseline inmutable de este contrato `paridad-1-1` y debe
referenciarse en el manifiesto de migración de Codex.

Decisiones registradas durante el refinamiento, ver `vicunav-web/AGENTS.md`:
los paneles "Mockup" (dashboard, reserva, chat, navegador, SEO) y las portadas
de proyecto "Cover" se transcribieron literal desde los componentes reales del
proyecto de Claude Design, provistos en `docs/claude-design-full/`; el PDF de
CV enlazado desde la plantilla 15 no es un faltante real, es el mismo archivo,
verificado por checksum MD5, que ya estaba subido a ese proyecto.

## 2. Condiciones de captura

Fuente y objetivo se capturan en condiciones equivalentes:

| Condición | Valor |
| --- | --- |
| Navegador | Chromium fijado por la versión de Playwright del skill |
| Viewports | 390 x 844, 834 x 1112, 1440 x 900 |
| Escala y densidad | 1x |
| Locale | `es-VE` |
| Timezone | `America/Caracas` |
| Fuente | Plus Jakarta Sans, pesos 400, 500, 600, 700, servida localmente |
| Movimiento | `prefers-reduced-motion: reduce` para estabilizar transiciones |
| Datos | Deterministas. El contenido está escrito en los prototipos, no se genera. |
| Autenticación | Ninguna. Todas las vistas son públicas. |

Los prototipos exponen un selector de página y de breakpoint en la barra
superior. **Esa barra es andamiaje de diseño y no forma parte del producto.** Se
excluye del encuadre de cada captura y no se migra.

## 3. Inventario de páginas

15 plantillas. Las tres primeras columnas identifican la fila de la matriz de
evidencia.

| # | Página | Fuente | Vista en el prototipo |
| --- | --- | --- | --- |
| 01 | Home | Sitio Web v2 | `home` |
| 02 | Servicios (índice) | Sitio Web v2 | `servicios` |
| 03 | Portafolio | Sitio Web v2 | `portafolio` |
| 04 | Contacto | Sitio Web v2 | `contacto` |
| 05 | Nosotros | Sitio Web v2 | `nosotros` |
| 06 | Vertical: Restaurantes | Landings SEO | `restaurantes` |
| 07 | Vertical: Hoteles y posadas | Landings SEO | `hoteles` |
| 08 | Vertical: Bienestar | Landings SEO | `bienestar` |
| 09 | Servicio: Sistemas a medida | Landings SEO | `sistemas` |
| 10 | Servicio: Automatización | Landings SEO | `automatizacion` |
| 11 | Servicio: Sitios web | Landings SEO | `sitios` |
| 12 | Servicio: Visibilidad | Landings SEO | `visibilidad` |
| 13 | Artículos (listado) | Landings SEO | `articulos` |
| 14 | Artículo (single) | Landings SEO | `articulo` |
| 15 | Mario, landing de reclutadores | Landings SEO | `cv` |

La vista `seo` del prototipo es una **referencia interna de trabajo**, no una
página del sitio. Su contenido está en `seo-geo.md`. No se migra.

## 4. Estados interactivos a capturar

Una captura de la vista inicial no acredita estos estados. Cada uno necesita su
fila en la matriz.

| Estado | Dónde aparece | Páginas |
| --- | --- | --- |
| `hover` en botón primario | CTA ámbar | Todas |
| `hover` en botón secundario | CTA fantasma sobre oscuro | 06 a 12, 15 |
| `focus` visible | Todo control interactivo | Todas |
| `hover` en tarjeta | Elevación y cambio de borde | 06 a 14 |
| FAQ contraída | Estado por defecto, ítem 1 abierto | 06 a 12 |
| FAQ expandida | Un ítem abierto a la vez | 06 a 12 |
| Filtro de categoría activo | Chip oscuro seleccionado | 13 |
| Filtro sin destacado | Categoría distinta de Todos y Restaurantes oculta el destacado | 13 |
| Aside pegajoso | `position: sticky` solo en 1440 | 14 |
| Formulario en reposo | Contacto es visual, sin envío | 04 |

## 5. Comportamiento responsive

Tres breakpoints, sin estados intermedios contratados.

| Token | 390 | 834 | 1440 |
| --- | --- | --- | --- |
| Padding horizontal | 24px | 40px | 80px |
| Gap de rejilla | 16px | 20px | 28px |
| Padding vertical de sección | 56px | 72px | 96px |
| Padding de tarjeta | 24px | 28px | 36px |
| Rejilla de 3 columnas | 1 col | 2 col | 3 col |
| Rejilla de 4 columnas | 2 col | 2 col | 4 col |
| Hero de vertical | 1 col | 1 col | 1.05fr 0.95fr |
| Artículo con aside | 1 col, aside al final | 1 col | 1.55fr 0.45fr, aside sticky |

El lienzo de escritorio fluye al 100% del ancho, sin `min-width`. No debe existir
scroll horizontal en ningún breakpoint.

## 6. Defectos de la fuente a corregir

Registrados como desviaciones deliberadas, permitidas por ADR 0010.

1. La barra selectora de página y breakpoint no se migra.
2. El formulario de contacto es visual en el prototipo. En WordPress necesita
   envío real, validación accesible y mensaje de estado anunciado. Es una
   diferencia funcional aprobada, no visual.
3. Los iconos son SVG inline en el prototipo (`Ico.dc.html`). En WordPress se
   sirven localmente, nunca desde CDN.

## 7. Contenido, tono y límites

El copy de los prototipos es final y está alineado al SSOT. Reglas que el agente
no puede romper al migrarlo:

- **Nunca usar guion largo ni guion medio** en contenido publicable. Solo punto,
  coma o dos puntos.
- **Ningún precio público**, en ninguna página ni canal.
- No inventar casos de clientes ni resultados. Marcas reales: TatiPilates,
  Bhoga Yoga, Nelson Look Flash. El resto son demos o conceptos.
- Los cuatro pilares y su orden son los del SSOT: Sistemas y software
  personalizados, Automatización, Sitios web, Visibilidad.
- Voz: clara, honesta, calmada, no agresiva ni de ventas.
- La landing 15 está en inglés a propósito: su público son reclutadores.
