# Tokens de diseño

Los valores exactos están en `tokens-fuente/`, copiados del design system que
generó los prototipos. **Esos archivos mandan sobre cualquier valor transcrito
aquí.**

## 1. Advertencia sobre los valores derivados

La paleta base son cuatro colores. Todo lo demás son mezclas `color-mix(in oklch, ...)`.
`theme.json` no evalúa `color-mix`, así que cada preset necesita un hex resuelto.

**No transcribas los hex de memoria ni los calcules a mano.** Por
`visual-fidelity.md`, sección "Verificar la configuración efectiva", hay que
leer el **valor calculado en el elemento renderizado** del prototipo y usar ese.
Procedimiento: abrir el prototipo en Chromium, inspeccionar un elemento que use
el token y copiar el valor resuelto de `getComputedStyle`.

## 2. Paleta base

| Token | Hex | Uso |
| --- | --- | --- |
| `--color-dark` | `#2B2825` | Grafito cálido. Superficie oscura, hero, CTA |
| `--color-light` | `#F4EFE6` | Crema. Superficie de contenido |
| `--color-accent` | `#E8873A` | Ámbar. Único acento: CTA y enlaces destacados |
| `--color-secondary` | `#B7AE9F` | Taupe cálido. Texto de apoyo y bordes |
| `--color-white` | `#FFFFFF` | Tarjetas sobre crema |

Regla del design system: el taupe se usa **siempre sólido, nunca con opacidad
reducida**. Máximo dos colores de fondo por pantalla.

## 3. Derivados en uso

Definidos en `tokens-fuente/colors.css` y en el bloque `:root` de los prototipos.

| Token | Fórmula | Dónde aparece |
| --- | --- | --- |
| `--color-accent-hover` | ámbar 88% + negro | Hover de botón primario |
| `--color-accent-press` | ámbar 76% + negro | Press de botón |
| `--color-accent-tint` | ámbar 14% + crema | Fondo de tarjeta de CTA, chips |
| `--color-border` | taupe 35% + crema | Borde de tarjeta sobre crema |
| `--color-border-dark` | taupe 28% + grafito | Borde sobre oscuro |
| `--text-muted` | grafito 82% + taupe | Cuerpo secundario sobre crema |
| `--accent-ink` | ámbar 48% + grafito | Ámbar oscurecido para texto e iconos sobre crema |

`--text-muted` y `--accent-ink` los definen los prototipos, no el design system.
Existen por contraste: el ámbar puro sobre crema no alcanza 4.5:1 para texto.
**No los sustituyas por `--color-accent`.**

## 4. Tipografía

Una sola familia. La jerarquía la carga el peso, no solo el tamaño.

| Rol | Tamaño 1440 | 834 | 390 | Peso | Line height | Tracking |
| --- | --- | --- | --- | --- | --- | --- |
| H1 vertical | 88px | 60px | 40px | 800 | 0.96 a 1.04 | -0.035em |
| H1 servicio | 72px | 48px | 34px | 800 | 0.96 a 1.04 | -0.035em |
| H1 artículo | 60px | 44px | 32px | 800 | 1.04 | -0.035em |
| H2 grande | 56px | 42px | 30px | 700 | 1.05 | -0.03em |
| H2 sección | 42px | 34px | 27px | 700 | 1.08 | -0.03em |
| H3 | 26px | 22px | 20px | 700 | 1.15 a 1.25 | -0.02em |
| Cuerpo grande | 20px | 18px | 17px | 400 a 500 | 1.55 a 1.65 | 0 |
| Cuerpo | 16px | 16px | 16px | 400 | 1.6 | 0 |
| Cuerpo artículo | 17px | 17px | 17px | 400 | 1.75 | 0 |
| Etiqueta kicker | 12px | 12px | 12px | 700 | 1.3 | 0.14em, mayúsculas |

Familia: `Plus Jakarta Sans`, pesos 400, 500, 600, 700. Servida localmente
mediante `@font-face` en el theme, nunca desde Google Fonts en producción.

Los H1 llevan `margin-left: -0.05em` para alinear ópticamente la primera letra.
Es intencional y forma parte de la paridad.

## 5. Espaciado

Escala estricta derivada de 8px: 2, 4, 8, 16, 24, 32, 48, 64.

Los valores responsive por breakpoint están en `contrato-fuente.md`, sección 5.

## 6. Radios

| Token | Valor | Uso |
| --- | --- | --- |
| `--radius-sm` | 8px | Inputs, chips pequeños |
| `--radius-md` | 12px | Tiles de icono |
| `--radius-lg` | 20px | Tarjetas |
| `--radius-pill` | 999px | Botones y badges |

Los prototipos usan además 14px, 16px, 18px y 24px en tarjetas concretas. Están
fuera de la escala del design system y deben migrarse tal cual para conservar
paridad, declarados como presets adicionales en `theme.json`.

## 7. Sombras

Cálidas, mezclas del grafito a baja opacidad. Nunca negro neutro.

| Nombre | Uso |
| --- | --- |
| `--shadow-lift` | Tarjeta blanca sobre crema, reposo |
| `--shadow-float` | Tarjeta destacada y botón flotante de WhatsApp |
| `--shadow-hover` | Tarjeta en hover |

Valores completos en el bloque `:root` de `diseno/Vicunav Landings SEO.dc.html`.

## 8. Textura

Existe un `--grain`: un SVG de ruido fractal embebido como data URI, aplicado
sobre superficies oscuras con `opacity` entre 0.055 y 0.07 y
`mix-blend-mode: overlay`.

**Nota de conflicto:** la guía del design system dice "sin texturas ni patrones".
Los prototipos aprobados sí lo usan, de forma muy sutil, en cada hero oscuro.
Como el contrato es paridad 1:1 contra los prototipos, **el grano se migra**. Si
Mario prefiere quitarlo, es un cambio de diseño previo al congelado del baseline,
no una decisión del agente migrador.

## 9. Movimiento

- Transiciones de 150ms a 200ms, `ease`, solo en color, borde, transform y sombra.
- Hover de tarjeta: `translateY(-3px)` o `-4px`, más cambio de sombra.
- Hover de botón primario: `translateY(-2px)` más ámbar oscurecido.
- Sin rebotes ni animaciones elaboradas.
- Todo lo anterior se desactiva bajo `prefers-reduced-motion: reduce`.

## 10. Foco

Cada control interactivo tiene foco visible. Los prototipos usan
`outline: 2px` o `3px solid` en ámbar o grafito, con `outline-offset` de 2px a
3px según el fondo. Nunca se elimina el outline sin reemplazo perceptible.
