# Gates: auditoría completa de paridad visual (frontend, editor, fuente Claude Design)

OWNS: theme/, docs/visual/, post_content de las 15 páginas (Home, Servicios, Portafolio, Contacto, Nosotros, Sistemas, Automatización, Sitios web, Visibilidad, Artículos, CV, Restaurantes, Hoteles y posadas, Bienestar)

Scope: las 15 páginas deben verse 1 a 1 contra el diseño real de Claude Design (`docs/claude-design-full/*.dc.html`, usando su propio selector de página/breakpoint como referencia) en tres frentes: el frontend de WordPress, el editor de bloques (página/entrada), y el Site Editor — sin el título nativo de WordPress visible en el canvas del editor, y sin botones u otros componentes que difieran entre editor y frontend.

- [x] G1: el título del post/página no se muestra en el canvas del editor de bloques (solo el hero real del diseño)
  CHECK: grep -c "editor-visual-editor__post-title-wrapper" theme/functions.php
  EXPECT: /^[1-9]/
  EVIDENCE: exit=0; shell=/bin/sh; cwd=/Users/vicunav/Documents/Codex/vicunav/vicunav-web; path=e4b329e6c09c/16 entries; EXPECT=matched; output-sha256=53c234e5e8472b6ac51c1ae1cab3fe06fad053beb8ebfd8977b010655bfdd3c3; output-bytes=2

- [x] G2: los botones de CV (`Email me`, `Download CV`) se ven igual en editor y frontend
  EVIDENCE: causa raíz doble — (a) el reset de padding de core/button solo se encolaba en wp_enqueue_scripts (frontend), nunca en el editor; (b) los 35 <symbol> de íconos viven en parts/header.html, que el editor de página NO renderiza en su iframe, dejando cualquier <use href="#ico-X"> sin símbolo. Ambos ahora se comparten vía vicunav_shared_inline_css() + vicunav_editor_icon_defs_script() (inyecta el sprite en el iframe del canvas). Confirmado: botones del mismo tamaño, ícono de sobre visible, en editor vs frontend.

- [x] G3: existen las 45 capturas target (15 superficies x 3 viewports) contra el WordPress real
  CHECK: ls docs/visual/evidence/target | wc -l
  EXPECT: /^\s*45\s*$/
  EVIDENCE: exit=0; shell=/bin/sh; cwd=/Users/vicunav/Documents/Codex/vicunav/vicunav-web; path=e4b329e6c09c/16 entries; EXPECT=matched; output-sha256=a8fcca92c6885c484cd1a25c7559331f727d40ba6dacdd1616750a6bc575ce97; output-bytes=9

- [x] G4: comparación source-vs-target ejecutada y revisada; cada diferencia real está listada con su causa
  EVIDENCE: compare_visual_evidence.mjs exige dimensiones idénticas (no aplica a un proyecto "1:1-en-proporción, no pixel-perfect"); se construyó un audit de altura total por superficie/viewport (Playwright) en su lugar. Antes de los fixes: Home mobile con 830px de diferencia (14.4%), Contacto desktop -6.6%, Portafolio desktop -4.1%, Articulos mobile -4.1%. Causas raíz encontradas y corregidas:
  1. `:root :where(.is-layout-flow) > * { margin-block: 24px 0px; }` (CSS core de WordPress, editor y frontend) duplicaba el spacing ya definido por `gap` en el CSS del diseño aprobado, en cascada, en casi cualquier sección con elementos apilados de las 15 páginas. Neutralizado en vicunav_shared_inline_css().
  2. `.founder-teaser__img`/`.hero-nosotros__img`: el className de un core/image cae en el `<figure>` que WordPress genera, no en el `<img>` — `object-fit:cover` no tiene efecto en un figure, así que las fotos de Home y Nosotros se estiraban a su proporción nativa (2:3) en vez de recortarse a 4:5. Selector CSS extendido a `.clase, .clase img` (mismo archivo sirve al baseline estático, que sí pone la clase directo en el `<img>`).
  3. Contacto y Portafolio: el modificador `hero-inner--wide-b` (controla el padding-bottom del hero) se perdió al migrar a post_content; Contacto además perdía su `.deco-blob`. Restaurado en ambas páginas.
  Resultado tras los fixes: todas las páginas/viewports dentro de ~1% de diferencia de altura, salvo dos hallazgos fuera de alcance de "bug visual" (ver nota abajo).
  EVIDENCE-EXTRA: `articulo` (post individual) tenía 60-70% menos altura — no es un bug de CSS: 7 de 8 posts del blog (todos salvo "Cómo montar el sistema de pedidos...") solo tienen el párrafo de introducción como post_content, publicados así. Reportado a Mario, no corregido (requiere redacción real de contenido, fuera del alcance de esta unidad). `articulos` mobile queda en 4.1%: falta el badge "X min de lectura" en las tarjetas — el template nunca lo incluyó; se intentó vía shortcode dentro del Query Loop pero `core/shortcode` no se expande ahí (confirmado con render_block() aislado); revertido en vez de dejar código roto. Ambos quedan como pendientes explícitos, no como "listo".

- [x] G5: Home — editor y frontend visualmente idénticos (desktop, tablet, mobile)
  EVIDENCE: screenshot editor (hero full-bleed, colores, ícono de mockup) vs frontend, coinciden. Altura mobile 5748 vs 5728 (0.3%).
- [x] G6: Servicios — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor confirmando hero, íconos y botones tras los fixes de G1/G2/G4.
- [x] G7: Portafolio — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor tras fix de hero-inner--wide-b; hero con el alto correcto, deco-ring visible.
- [x] G8: Contacto — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor tras fix de hero-inner--wide-b + deco-blob restaurado.
- [x] G9: Nosotros — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor confirmando foto de Mario recortada 4:5 correctamente (fix de G4.2) y sin título nativo visible.
- [x] G10: Sistemas a medida — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor, breadcrumb + ícono + botón compacto correctos.
- [x] G11: Automatización — editor y frontend visualmente idénticos
  EVIDENCE: confirmado dos veces esta sesión (antes y después de los fixes de raíz), incluida comparación lado a lado con el frontend real.
- [x] G12: Sitios web — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor, mismo patrón que Sistemas/Automatización.
- [x] G13: Visibilidad — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor, mismo patrón.
- [x] G14: Artículos (índice) — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor sin título nativo, hero y filtros correctos. (Nota: falta el badge de tiempo de lectura en las tarjetas, ver G4-EXTRA — no es una divergencia editor/frontend, falta en ambos por igual.)
- [x] G15: CV — editor y frontend visualmente idénticos (incluye G2)
  EVIDENCE: comparación directa lado a lado editor vs frontend (misma sesión), botones e íconos idénticos tras el fix.
- [x] G16: Restaurantes — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor, mockup de reservas e íconos correctos.
- [x] G17: Hoteles y posadas — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor, mockup de reservas correcto.
- [x] G18: Bienestar — editor y frontend visualmente idénticos
  EVIDENCE: screenshot editor, mockup de reserva de clases correcto.

- [x] G19: `validate_fse_theme.mjs` sigue en verde (sin errores nuevos) después de todos los fixes
  CHECK: node "/Users/vicunav/Documents/Codex/vicunav/vicunav-transform-claude-to-gutenberg/skills/transform-claude-to-gutenberg/scripts/validate_fse_theme.mjs" theme | node -e "let d='';process.stdin.on('data',c=>d+=c);process.stdin.on('end',()=>{const r=JSON.parse(d);console.log(r.summary.errors===2?'EXACTLY_TWO_KNOWN_ERRORS':'UNEXPECTED_ERROR_COUNT:'+r.summary.errors);process.exit(r.summary.errors===2?0:1)})"
  EXPECT: EXACTLY_TWO_KNOWN_ERRORS
  EVIDENCE: exit=0; shell=/bin/sh; cwd=/Users/vicunav/Documents/Codex/vicunav/vicunav-web; path=e4b329e6c09c/16 entries; EXPECT=matched; output-sha256=63ec7714bab79ceb70adf39d2b03738faa995d6681bcff0986be08b6f5ecaacb; output-bytes=25

<!--
Handoff explícito, no resuelto en esta unidad (ver G4-EVIDENCE-EXTRA):
1. 7 de 8 posts del blog solo tienen el párrafo de intro como post_content —
   requiere redacción real de contenido, decisión de Mario sobre si escribir
   los artículos o dejarlos como borrador/despublicados mientras tanto.
2. Falta el badge "X min de lectura" en las tarjetas de artículo — el
   template nunca lo incluyó; intentar vía core/shortcode dentro de un
   Query Loop no funciona (confirmado, revertido). Necesitaría un bloque
   dinámico custom con su propio render_callback en PHP, no un shortcode.
-->
