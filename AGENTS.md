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

- Los paneles "Mockup" del design system (dashboard, chat, SEO, navegador) no
  están en el inventario de assets: son ilustración de interfaz sin
  especificación propia. Se resolvieron como bloques de color intencional con
  la misma geometría, siguiendo la regla de placeholder de
  `docs/handoff/inventario-assets.md` sección 2, no como contenido inventado.
- El widget de "arma tu platillo / reserva" en cada vertical sí tiene copy
  real del diseño aprobado y se migró literal, a diferencia de los Mockup
  anteriores.
- El PDF de CV (`uploads/cv_files-1787863696971-ejq5.pdf`, enlazado desde
  `cv.html`) no estaba en el paquete de diseño. El enlace se conserva con la
  ruta literal del prototipo; el archivo es un faltante real, del mismo tipo
  que el logotipo o el favicon, pendiente de que Mario lo provea.
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
