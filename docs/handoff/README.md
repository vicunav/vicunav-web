# Handoff de diseño: Vicunav Web

Paquete de entrega del diseño aprobado en Claude Design para su refinamiento en
Claude Code y su posterior transformación a WordPress Gutenberg FSE mediante
Codex y el skill `transform-claude-to-gutenberg`.

Idioma de este documento: español, por ser documentación interna
(`vicunav-standards/docs/documentation-language.md`).

## 1. Qué contiene este paquete

Los archivos `.dc.html` incluidos son **referencias de diseño en HTML**: prototipos
que muestran la apariencia y el comportamiento previstos, no código de producción
para copiar. Se abren directamente en un navegador y usan `support.js`, incluido.

La tarea NO es pegar este HTML en WordPress. Es recrear estos diseños como un
block theme nativo de Gutenberg, editable desde Full Site Editing, siguiendo el
contrato del skill `transform-claude-to-gutenberg`.

Contenido del paquete:

| Archivo | Para qué sirve |
| --- | --- |
| `README.md` | Este documento. Punto de entrada. |
| `contrato-fuente.md` | Baseline inmutable, páginas, viewports, estados. Gate 1 de ADR 0010. |
| `arquitectura-wordpress.md` | CPTs, taxonomías, templates, parts, patterns y mapa de propiedad. |
| `tokens.md` | Tokens de diseño y su traducción a `theme.json`. |
| `inventario-assets.md` | Cada slot de imagen, su estado y la sustitución aprobada. Bloqueante. |
| `seo-geo.md` | Title, meta, slug, schema y palabras clave por página. |
| `adr-borrador-vicunav-web.md` | Borrador de ADR para el hub. Requerido por `docs/gobernanza.md`. |
| `diseno/` | Los prototipos y el runtime que los ejecuta. |
| `tokens-fuente/` | Los archivos CSS reales de tokens del design system. Valores exactos. |

## 2. Fidelidad

**Alta fidelidad, con contrato `paridad-1-1`** según
`vicunav-standards/docs/visual-fidelity.md`.

Decisión confirmada por Mario: el producto final en WordPress debe ser 1 a 1 con
el diseño de Claude Design. Esto activa el gate bloqueante completo del
[ADR 0010](https://github.com/vicunav/vicunav-hub/blob/main/docs/adr/0010-fidelidad-visual-bloqueante.md):

- baseline con commit inmutable, navegador, viewports, fuentes y locale fijos;
- matriz de evidencia con una fila por página, viewport y estado;
- comparación lado a lado y overlay, no solo diferencia de píxeles;
- verificación de configuración efectiva en el CSS final, no en `theme.json`;
- aprobación humana explícita de cada diferencia visible.

No se acepta como sustituto: rutas 200, HTML válido, ausencia de overflow,
Lighthouse ni auditoría de accesibilidad. Todos esos gates siguen siendo
obligatorios, pero verifican otra dimensión.

## 3. Conflictos y decisiones abiertas

Léelos antes de empezar. Los tres requieren una decisión de Mario, no del agente.

### 3.1 Placeholders contra paridad 1:1 [BLOQUEANTE, resuelto con condición]

`visual-fidelity.md` es explícito: *"un asset original falta y no existe una
sustitución aprobada"* bloquea el merge, y ADR 0010 añade que los faltantes
*"no se ocultan mediante placeholders"*.

Mario confirmó que las imágenes reales se colocan después, cuando el WordPress
esté funcional. La única forma de que eso no rompa el estándar es tratar cada
placeholder como **sustitución deliberada y aprobada**, registrada en
`inventario-assets.md` con su slot, ratio, tratamiento y texto alternativo.

Consecuencia que hay que aceptar por escrito: el gate de paridad visual se cierra
sobre los placeholders aprobados. Cuando lleguen las imágenes reales se abre una
unidad de trabajo nueva por cada slot, con su propia evidencia. Ninguna página con
un slot pendiente se declara completa como producto integrado.

### 3.2 `vicunav-web` contra `vicunav-gutenberg`

Mario eligió un repositorio nuevo, `vicunav-web`, con theme propio desde cero.
El SSOT registra que `vicunav-gutenberg` ya tiene Home, Servicios, Portafolio y
Contacto implementados con QA, en release candidate 0.2.0.

`docs/gobernanza.md` exige un ADR para cualquier cambio de arquitectura o límite
entre paquetes. El borrador está en `adr-borrador-vicunav-web.md` y debe
revisarse, corregirse y abrirse como PR en `vicunav-hub` antes de escribir código.

Pregunta abierta para Mario: ¿`vicunav-gutenberg` se archiva, se congela como
referencia histórica, o sigue vivo en paralelo?

### 3.3 Arquitectura de contenido

En el formulario quedaron marcadas las dos opciones de cada par, así que la
decisión la propongo yo en `arquitectura-wordpress.md` y queda marcada como
**propuesta pendiente de confirmar**. Resumen: servicios como páginas, verticales
y portafolio como CPT, artículos como posts nativos.

## 4. Orden de trabajo sugerido

1. Aprobar o corregir el ADR borrador y abrirlo en `vicunav-hub`.
2. Confirmar la arquitectura de contenido de la sección 3.3.
3. Aprobar el inventario de assets con sus sustituciones.
4. Refinar los prototipos en Claude Code y **congelar el commit** que será el baseline.
5. Recién entonces invocar `$transform-claude-to-gutenberg` en Codex.

El paso 4 es el que hoy no existe: sin commit inmutable no hay baseline, y sin
baseline el skill no puede ejecutar un contrato `paridad-1-1`.

## 5. Fuentes de verdad

- Estándares transversales: `vicunav-standards` (submódulo).
- Arquitectura y decisiones: `vicunav-hub/docs/`.
- Skill de migración: `vicunav-transform-claude-to-gutenberg`.
- Contenido, posicionamiento y límites de marca: SSOT en Notion.
- Tokens visuales: `tokens-fuente/` en este paquete, y a futuro `vicunav-theme-core`.
