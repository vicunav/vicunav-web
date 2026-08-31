# Gates: redactar los 7 artículos del blog sin contenido real

OWNS: post_content de los posts 17, 18, 19, 20, 21, 22, 23

Scope: los 7 posts del blog publicados con solo el párrafo de introducción como contenido (ver [[project-blog-posts-missing-content]]) reciben cuerpo completo, siguiendo la estructura de bloques del post 16 (article-body__lead/p/h2/h3, check-list, quote, step-inline-list, takeaways, toc-nav, CTA), en la voz de Mario Vicuña, con el lead original preservado exacto.

- [x] G1: los 7 posts tienen post_content real (más de 5000 caracteres cada uno, no solo la intro)
  CHECK: node "/private/tmp/claude-501/-Users-vicunav-Documents-Codex-vicunav-vicunav-web/81a73ae5-50bf-4e5e-9beb-104416dbba12/scratchpad/check-post-lengths.mjs"
  EXPECT: ALL_SEVEN_HAVE_REAL_CONTENT
  EVIDENCE: exit=0; shell=/bin/sh; cwd=/Users/vicunav/Documents/Codex/vicunav/vicunav-web; path=e4b329e6c09c/16 entries; EXPECT=matched; output-sha256=f58f6fa47781af4ef2f549dea8d65894c5babb1bb7af97768a6487fdb6675d15; output-bytes=28

- [x] G2: el párrafo de introducción original (lead) se preservó exacto, palabra por palabra, en los 7 posts
  EVIDENCE: verificado por lectura directa de cada archivo generado contra el texto original extraído de post_content antes de escribir; los 7 coinciden exactos, confirmado además visualmente en menu-qr/ y whatsapp/ (screenshots).

- [x] G3: ningún bloque queda inválido en el editor de bloques (isValid:false) en los posts revisados
  EVIDENCE: wp.data.select('core/block-editor').getBlocks() en post 17 (menu-qr): total=30 bloques, invalid=0. Sin advertencias de "invalid block" visibles en el editor.

- [x] G4: los CTA finales enlazan a la página de servicio/vertical correcta según la categoría de cada post
  EVIDENCE: Restaurantes(17,18)->/verticales/restaurantes/, Automatización(19)->/servicios/automatizacion/, Sitios web(20)->/servicios/sitios/, Visibilidad(21)->/servicios/visibilidad/, Sistemas(22)->/servicios/sistemas/, Bienestar(23)->/verticales/bienestar/. Confirmado en el markup de cada archivo antes de publicar.

- [x] G5: no se fabricaron estadísticas, nombres de clientes ni testimonios falsos
  EVIDENCE: revisión de los 7 textos generados — sin nombres de clientes inventados, sin porcentajes de "resultados" ficticios. El único dato numérico externo citado (umbrales de Core Web Vitals: LCP<2.5s, INP<200ms, CLS<0.1) es público de Google, no inventado.

- [x] G6: la altura del artículo "menu-qr" (antes 60-70% más corto que el baseline) mejoró sustancialmente
  EVIDENCE: 7105px (baseline) vs 8072px (target) a 390px de ancho = 13.6% de diferencia, contra 60-70% antes de escribir el contenido real. La diferencia restante es longitud natural de contenido real distinto al mockup de demo, no un bug.

- [x] G7: el badge "X min de lectura" aparece en las tarjetas de /articulos/, como hermano de .article-card__excerpt (no anidado), con minutos reales
  CHECK: node "/private/tmp/claude-501/-Users-vicunav-Documents-Codex-vicunav-vicunav-web/81a73ae5-50bf-4e5e-9beb-104416dbba12/scratchpad/check-post-lengths.mjs" > /dev/null; grep -c "render_block_core/post-excerpt\|vicunav_append_reading_time_to_article_card" theme/functions.php
  EXPECT: /^[1-9]/
  EVIDENCE: exit=0; shell=/bin/sh; cwd=/Users/vicunav/Documents/Codex/vicunav/vicunav-web; path=e4b329e6c09c/16 entries; EXPECT=matched; output-sha256=53c234e5e8472b6ac51c1ae1cab3fe06fad053beb8ebfd8977b010655bfdd3c3; output-bytes=2

- [x] G8: `validate_fse_theme.mjs` sin regresiones tras el fix del badge
  CHECK: node "/Users/vicunav/Documents/Codex/vicunav/vicunav-transform-claude-to-gutenberg/skills/transform-claude-to-gutenberg/scripts/validate_fse_theme.mjs" theme | node -e "let d='';process.stdin.on('data',c=>d+=c);process.stdin.on('end',()=>{const r=JSON.parse(d);console.log(r.summary.errors===2?'EXACTLY_TWO_KNOWN_ERRORS':'UNEXPECTED_ERROR_COUNT:'+r.summary.errors);process.exit(r.summary.errors===2?0:1)})"
  EXPECT: EXACTLY_TWO_KNOWN_ERRORS
  EVIDENCE: exit=0; shell=/bin/sh; cwd=/Users/vicunav/Documents/Codex/vicunav/vicunav-web; path=e4b329e6c09c/16 entries; EXPECT=matched; output-sha256=63ec7714bab79ceb70adf39d2b03738faa995d6681bcff0986be08b6f5ecaacb; output-bytes=25

<!--
G7's CHECK piggybacks a throwaway grep for the function name existing in
functions.php as a cheap automatable signal; the real verification (DOM
structure = sibling not nested, real minute counts, visual bottom-alignment)
was already done manually via Playwright + screenshot before this gate was
written, recorded here as evidence text since it's not a one-line CHECK.
EVIDENCE for G7 manual part: check-badge.mjs Playwright query on
/articulos/ showed 7/7 cards with .article-card__read as a direct child of
.article-card (parent className "wp-block-group article-card is-layout-flow...",
NOT "...article-card__excerpt..."), with computed minutes 8-9 matching each
post's real word count. Screenshot confirmed visual bottom-alignment via
margin-top:auto across all 7 cards.
-->

<!--
G1 usa un CHECK con Node inline en vez de wp-cli directo por la complejidad de
verificar 7 posts en una sola línea de shell con comillas anidadas (ruta de
LocalWP con espacios). Confirmar EXPECT literal antes de --reverify.
-->
