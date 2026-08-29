# vicunav-web

Propósito: baseline estático (HTML, CSS y JavaScript sin build) de las quince
plantillas del sitio de Vicunav, refinado en Claude Code a partir del diseño
aprobado, y congelado como fuente inmutable para la migración a Gutenberg FSE
mediante `transform-claude-to-gutenberg`.

## Reglas aplicables

Las reglas transversales del repositorio están en [`docs/standards/`](docs/standards/).
Consúltalas antes de realizar cambios, en especial `naming.md`,
`visual-fidelity.md`, `accessibility.md`, `documentation-language.md` y `git.md`.

No repitas esas reglas aquí; este archivo solo contiene el contexto específico
del repositorio.

## Qué es este repositorio

Este NO es el theme final de WordPress. Es el paso intermedio entre Claude
Design y Codex: quince páginas HTML reales, navegables entre sí, con CSS
externo basado en custom properties y JavaScript mínimo, sin React, sin
Tailwind y sin CDN. El contexto completo del encargo está en
[`docs/handoff/`](docs/handoff/), copiado del paquete de diseño original.

- `docs/handoff/contrato-fuente.md`: inventario de las 15 páginas, condiciones
  de captura y comportamiento responsive. Es el contrato que rige la paridad
  visual de este baseline.
- `docs/handoff/tokens.md` y `docs/handoff/tokens-fuente/`: valores exactos de
  los design tokens. `assets/css/tokens.css` los traduce a custom properties.
- `docs/handoff/inventario-assets.md`: qué placeholders son sustitución
  aprobada y cuáles son faltantes reales (logotipo, favicon, imagen Open
  Graph, PDF de CV).
- [ADR 0012 de `vicunav-hub`](https://github.com/vicunav/vicunav-hub/blob/main/docs/adr/0012-sitio-propio-vicunav-web.md):
  decisión de crear este repositorio y arquitectura de contenido confirmada.
- [`docs/claude-design-full/`](docs/claude-design-full/): export completo del
  proyecto de Claude Design (no solo el handoff curado). Acá viven los
  componentes reales que el zip de handoff no incluía:
  `Mockup.dc.html` (paneles de interfaz decorativos: dashboard, reserva,
  chat, navegador, SEO) y `Cover.dc.html` (las 4 portadas de proyecto). Si
  falta reproducir algo 1 a 1 y no está en `docs/handoff/`, revisar acá
  antes de aproximar nada.

## Estructura

```text
index.html, servicios.html, portafolio.html, contacto.html, nosotros.html
restaurantes.html, hoteles.html, bienestar.html      Verticales
sistemas.html, automatizacion.html, sitios.html,
visibilidad.html                                     Servicios
articulos.html, articulo.html                        Blog
cv.html                                               Landing de reclutadores (inglés)

assets/css/tokens.css        Custom properties: color, tipografía, espaciado, radios, sombras
assets/css/base.css          Reset, foco visible, prefers-reduced-motion
assets/css/layout.css        Header, footer, botón flotante de WhatsApp
assets/css/components.css    Componentes compartidos entre páginas
assets/css/pages/*.css       Geometría local de cada plantilla
assets/js/nav.js             Menú móvil
assets/js/article-filter.js  Filtro de categoría en articulos.html
assets/fonts/                Plus Jakarta Sans, servida localmente (SIL OFL)
```

Los iconos son SVG inline: cada página define un bloque `<svg class="icon-defs">`
con solo los `<symbol>` que usa, referenciados con `<use>`. Nunca se carga
Lucide ni ningún sprite por CDN.

## Decisiones tomadas durante el refinamiento

- Los paneles "Mockup" (dashboard, reserva, chat, navegador, SEO) y las
  portadas de proyecto "Cover" (4 variantes geométricas) se transcribieron
  literal desde los componentes reales del proyecto de Claude Design
  (`docs/claude-design-full/Mockup.dc.html` y `Cover.dc.html`, provistos por
  Mario después del zip inicial del handoff, que no los incluía). No son una
  aproximación: mismo markup, mismo texto donde lo hay ("Panel de reservas",
  "Confirmada", el diálogo del chat), convertido de estilos inline a clases
  en `assets/css/components.css`. El widget de "arma tu platillo / reserva"
  en cada vertical (`restaurantes.html`, etc.) es un componente distinto,
  con su propio copy real ya migrado desde antes.
- El retrato de Mario en Home y Nosotros (A01, A02) no era un placeholder: el
  prototipo ya referenciaba una foto real y publicada en
  `vicunav.com/wp-content/uploads/2026/03/mario-vicuna-vicunav.jpg`. Se
  descargó a `assets/img/mario-vicuna-vicunav.jpg` y se usa tal cual.
- El PDF de CV (`assets/cv/mario-vicuna-resume.pdf`, enlazado desde
  `cv.html`) tampoco era un faltante real: es el mismo archivo, verificado
  por checksum MD5, que ya estaba subido al proyecto de Claude Design en
  `uploads/cv_files-1787863696971-ejq5.pdf`. Solo faltaba en el zip curado
  del handoff inicial, igual que Mockup y Cover.
- `docs/handoff/inventario-assets.md` declara slots (A03, A06, A09, A10) que
  no existen en ningún archivo fuente disponible (ni los dos prototipos
  grandes, ni `Cover.dc.html`, ni `Mockup.dc.html`): retrato de perfil en
  `cv.html`, caso "Nelson Look Flash" en portafolio, imagen de cabecera de
  artículo y miniaturas del listado. No se agregaron al baseline por no
  estar en ningún HTML fuente; quedan anotados en ese documento como diseño
  pendiente, no como placeholder que falte colocar.
- Los formularios (`contacto.html`) son visuales, sin envío real: es una
  desviación funcional aceptada en `docs/handoff/contrato-fuente.md`,
  sección 6. El botón de envío es `type="button"`, no `submit`, para no
  disparar una recarga sin backend real.
- El acordeón de preguntas frecuentes usa `<details>` nativo con atributo
  `name` compartido por grupo, para que solo un ítem quede abierto a la vez
  sin JavaScript.

## Validación

No hay build ni dependencias que instalar. Para revisar cambios:

```sh
python3 -m http.server 8080
```

Luego, para cada página tocada:

- Verificar en 390px, 834px y 1440px de ancho: sin scroll horizontal
  (`document.documentElement.scrollWidth` no debe superar el ancho de la
  ventana).
- Navegar solo con teclado: el foco debe ser visible y seguir un orden lógico.
- Contraste de texto: ninguna combinación de color de texto y fondo puede
  quedar por debajo de los mínimos de `docs/standards/docs/accessibility.md`.
- Revisar que cada `<use href="#ico-*">` tenga su `<symbol>` correspondiente
  en el bloque `icon-defs` de esa misma página.
- `prefers-reduced-motion: reduce` debe anular las transiciones.

Ejecuta esta validación antes de entregar cualquier cambio.
