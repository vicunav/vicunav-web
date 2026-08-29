# Inventario de assets

Documento **bloqueante**. `vicunav-standards/docs/visual-fidelity.md` impide
fusionar cuando *"un asset original falta y no existe una sustitución aprobada"*,
y el ADR 0010 añade que los faltantes *"no se ocultan mediante placeholders"*.

Mario confirmó que las imágenes reales se colocan cuando el WordPress esté
funcional. Por lo tanto, cada slot de esta tabla se declara **sustitución
deliberada y aprobada**, no un faltante oculto. Esa aprobación es lo que permite
cerrar el gate visual sobre el placeholder.

## 1. Regla de sustitución aprobada

Un placeholder cumple el estándar solo si:

1. Aparece en esta tabla con su slot, ratio, tratamiento y texto alternativo.
2. Ocupa exactamente la misma geometría que ocupará el asset final. El ratio y
   las dimensiones no cambian al sustituirlo.
3. No contiene texto simulado, marcas de agua ni "lorem".
4. Su texto alternativo es el definitivo, escrito para el asset real.
5. Queda registrado en el manifiesto de migración como diferencia aceptada, con
   fecha y aprobación de Mario.

Cuando llegue el asset real se abre **una unidad de trabajo por slot**, con issue,
rama, PR y su propia evidencia visual. Ninguna página con un slot pendiente se
declara completa como producto integrado.

## 2. Tratamiento visual del placeholder

Superficie `--color-accent-tint` sobre crema, o `--color-dark-2` sobre oscuro,
con el radio que corresponde a su contenedor y sin borde adicional. Sin icono de
cámara, sin texto dentro. Debe leerse como un bloque de color intencional, no
como un error de carga.

## 3. Inventario

| # | Slot | Página | Ratio | Estado | Texto alternativo |
| --- | --- | --- | --- | --- | --- |
| A01 | Retrato de Mario, sección fundador | Home | 4:5 | Sustitución aprobada | Mario Vicuña, fundador de Vicunav |
| A02 | Retrato de Mario, hero | Nosotros | 4:5 | Sustitución aprobada | Mario Vicuña en su espacio de trabajo |
| A03 | Retrato de Mario, perfil | Mario, reclutadores | 1:1 | Sustitución aprobada | Mario Vicuna, Full Stack Developer |
| A04 | Portada de caso, TatiPilates | Portafolio | 3:2 | Sustitución aprobada | Sitio de TatiPilates en escritorio y móvil |
| A05 | Portada de caso, Bhoga Yoga | Portafolio | 3:2 | Sustitución aprobada | Sitio de Bhoga Yoga en escritorio y móvil |
| A06 | Portada de caso, Nelson Look Flash | Portafolio | 3:2 | Sustitución aprobada | Sitio de Nelson Look Flash en escritorio y móvil |
| A07 | Portada de caso, Clearpath Therapy | Portafolio | 3:2 | Sustitución aprobada, proyecto concepto | Proyecto concepto Clearpath Therapy |
| A08 | Portada de caso, Eleanor Wilde | Portafolio | 3:2 | Sustitución aprobada, proyecto concepto | Proyecto concepto Eleanor Wilde |
| A09 | Imagen de cabecera del artículo | Artículo | 16:9 | Sustitución aprobada | Cocina de restaurante en hora de servicio |
| A10 | Miniatura por artículo del listado | Artículos | 3:2 | Sustitución aprobada, 7 slots | Según el tema de cada artículo |
| A11 | Logotipo de Vicunav | Header y footer | Por definir | **Faltante real** | Vicunav |
| A12 | Favicon y app icon | Global | 1:1 | **Faltante real** | No aplica |
| A13 | Imagen de Open Graph por plantilla | Global | 1200x630 | **Faltante real** | No aplica |

## 4. Faltantes reales, distintos de un placeholder

A11, A12 y A13 no son slots de fotografía: son identidad de marca.

El SSOT lo dice explícitamente: **no existe logotipo**. Todos los prototipos usan
"Vicunav" compuesto en Plus Jakarta Sans, como wordmark tipográfico.

Decisión que necesita Mario:

- **Opción 1.** El wordmark tipográfico es el logotipo definitivo. Se migra tal
  cual, sin slot de imagen, y A11 deja de ser un faltante.
- **Opción 2.** Habrá logotipo más adelante. Entonces A11 se trata como
  sustitución aprobada con la geometría del wordmark actual.

Recomiendo la opción 1: es lo que ya está diseñado y aprobado, y evita un
rediseño del header cuando aparezca el archivo.

A13 puede generarse a partir del diseño de cada plantilla una vez migrada, no
necesita fotografía.

## 5. Iconos

No son un faltante. Los prototipos incluyen un set propio de 37 glifos SVG
inline en `diseno/Ico.dc.html`: trazo de 2px, sin relleno, uniones y remates
redondeados, `viewBox` de 24.

En WordPress se sirven localmente, como SVG inline en los patterns o como sprite.
**No se carga Lucide ni ninguna librería por CDN**, aunque la guía del design
system la mencione como sustitución: los prototipos aprobados ya no la usan.

## 6. Fuentes

Plus Jakarta Sans, pesos 400, 500, 600, 700. Licencia SIL Open Font License.
Se descargan y se sirven desde el theme mediante `@font-face`. No se cargan
desde Google Fonts ni desde un CDN en producción.
