# Arquitectura WordPress propuesta

**Estado: propuesta pendiente de confirmación por Mario.** En el formulario
quedaron marcadas las dos opciones de cada par, así que aquí decido y justifico.

Cumple `vicunav-standards/docs/naming.md`, ADR 0001 (separación theme y plugins)
y ADR 0005 (ACF genuino solo para campos).

## 1. Repositorio y theme

| Elemento | Valor |
| --- | --- |
| Repositorio | `vicunav-web` |
| Theme slug | `vicunav-web` |
| Text domain | `vicunav-web` |
| Namespace PHP | `Vicu\\Web` |
| Prefijo de identificadores | `vicu_` |
| Base | Block theme FSE propio, desde cero |
| Builder | Gutenberg FSE. Elementor no participa. |

Mario eligió theme propio desde cero en lugar de partir de `vicunav-theme-core`.
Consecuencia a registrar en el ADR: los tokens de marca de Vicunav viven en el
`theme.json` de `vicunav-web`, no en el theme core. Si más adelante se quiere
compartir, se promueve con reutilización demostrada, nunca copiando estilos.

## 2. Modelo de contenido

### Decisión propuesta

| Contenido | Tipo | Clave | Por qué |
| --- | --- | --- | --- |
| Home, Contacto, Nosotros, Servicios índice | Páginas | nativo | Únicas, sin repetición estructural |
| Los 4 servicios | Páginas hijas de `/servicios/` | nativo | Solo cuatro, copy único por SEO, sin campos repetidos que justifiquen un CPT |
| Verticales o nichos | CPT | `vicu_vertical` | El SSOT lista 6 nichos y crecerán. Necesitan archivo, plantilla común y URL propia |
| Artículos | Posts nativos | `post` | Feeds, archivos, categorías y SEO ya resueltos por core. Se renombran las etiquetas a "Artículos" |
| Casos de portafolio | CPT | `vicu_project` | Repetición estructural real y reutilización en varias páginas |
| Landing de Mario | Página única | nativo | Una sola, contenido irrepetible |

### Verificación de nombres

Regla: `vicu_{entidad}`, inglés, singular, `snake_case`, 20 caracteres o menos.

| Clave | Longitud | Válida |
| --- | ---: | --- |
| `vicu_vertical` | 13 | Sí |
| `vicu_project` | 12 | Sí |

Ambas deben añadirse al registro vivo de CPTs de
`vicunav-standards/docs/naming.md` **en el mismo cambio que las registra**.

### Dónde se registran

Por ADR 0001, la lógica no vive en el theme. Los dos CPTs se registran en código
propio mediante la clase abstracta de `vicunav-plugin-core`, no con ACF y no en
`functions.php`.

Pregunta abierta: ¿`vicunav-web` depende de `vicunav-plugin-core`, o se crea un
plugin `vicunav-web-content` para este sitio? Recomiendo lo primero, es lo que
ya existe.

### Taxonomías

| Taxonomía | Aplica a | Nativa |
| --- | --- | --- |
| `category` | `post` | Sí. Valores: Restaurantes, Sistemas, Automatización, Sitios web, Visibilidad, Bienestar |
| `post_tag` | `post` | Sí, opcional |

Los verticales no necesitan taxonomía propia: son pocos y cada uno es una entrada.

### Campos ACF

Por ADR 0005, solo ACF gratuito y solo para campos que edita el dueño del
negocio. Sin Repeater ni Flexible Content.

En este sitio, la composición se hace con bloques nativos, así que **ACF es
prácticamente innecesario**. Único uso candidato: metadatos SEO por entrada, si
no se usa un plugin de SEO. Decidir antes de instalarlo, no por costumbre.

## 3. Construcción de secciones

Decisión de Mario: **bloques nativos más `theme.json`**.

| Mecanismo | Uso |
| --- | --- |
| `theme.json` | Única fuente de verdad de tokens compartidos: paleta, tipografía, escala de espaciado, radios, anchos |
| Bloques core | Toda la composición. Sin `core/html` como atajo para conservar el HTML del prototipo |
| Templates | Estructura global por tipo de contenido |
| Template parts | Header y footer, compartidos por todas las plantillas |
| Patterns del theme | Secciones que se repiten entre páginas, compuestas solo con bloques core |
| Bloques custom | Solo si una interacción no se puede expresar de forma mantenible con core |

Los patterns no contradicen "bloques nativos": un pattern es una composición de
bloques core. Son el mecanismo de reutilización del theme, y sin ellos las
secciones compartidas entre las tres verticales se duplicarían a mano.

### Templates

| Template | Cubre |
| --- | --- |
| `index.html` | Respaldo obligatorio |
| `front-page.html` | Home |
| `page.html` | Páginas genéricas |
| `page-contacto.html` | Contacto, si el formulario lo exige |
| `single-vicu_vertical.html` | Verticales 06 a 08 |
| `single-vicu_project.html` | Caso de portafolio |
| `archive-vicu_project.html` | Portafolio |
| `home.html` | Listado de artículos |
| `single.html` | Artículo |
| `404.html` | Obligatorio |
| `search.html` | Obligatorio |

### Template parts

`header.html` y `footer.html`. El header cambia el enlace activo por contexto;
el footer es idéntico en todo el sitio.

Nota de navegación: Mario pidió servicios en submenú y **la landing de Mario
fuera del menú público**. Sigue siendo indexable y enlazada desde el artículo y
desde LinkedIn, pero no aparece en la navegación principal.

### Patterns propuestos

Nombres con prefijo del theme, en `patterns/`.

| Pattern | Reutilizado en |
| --- | --- |
| `vicunav-web/hero-vertical` | 06, 07, 08 |
| `vicunav-web/hero-servicio` | 09 a 12 |
| `vicunav-web/nucleo-tres-tarjetas` | 06 a 08 |
| `vicunav-web/grid-features` | 06 a 12 |
| `vicunav-web/pasos-proceso` | 06 a 12 |
| `vicunav-web/zonas-geo` | 06 a 12 |
| `vicunav-web/faq` | 06 a 12 |
| `vicunav-web/cta-cierre` | 06 a 12 |
| `vicunav-web/tarjetas-casos` | 06 a 08 |

Las FAQ usan `details` y `summary` nativos o un bloque core equivalente, con
teclado y foco visible. No se introduce React ni el runtime del prototipo.

## 4. Mapa de propiedad

Requerido por el gate 2 de ADR 0010.

| Responsabilidad | Propietario |
| --- | --- |
| Paleta, tipografía, escala, anchos, espaciados, radios, sombras | `vicunav-web/theme.json` |
| Templates, parts, patterns, estilos editoriales | `vicunav-web` |
| Registro de `vicu_vertical` y `vicu_project` | `vicunav-plugin-core`, por confirmar |
| Copy, media, composición de páginas | Contenido en base de datos, editable |
| Reglas compartidas y evidencia visual | `vicunav-standards`, `vicunav-transform-claude-to-gutenberg` |

## 5. Restricciones no negociables

- Sin `core/html` para conservar HTML del prototipo.
- Sin React, Tailwind ni el runtime del prototipo en el frontend.
- Fuentes e imágenes servidas localmente, con licencia, procedencia y `alt`.
- Frontend y Site Editor son superficies obligatorias de validación.
- WCAG 2.1 AA según `vicunav-standards/docs/accessibility.md`.
- `prefers-reduced-motion` respetado.
- Lógica de negocio fuera del theme.
