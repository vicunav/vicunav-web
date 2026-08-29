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

**Este tratamiento genérico ya no se usa en el baseline actual.** Se aplicó
en una primera pasada mientras el paquete de diseño completo (carpeta `_ds/`
y los componentes `Mockup.dc.html`/`Cover.dc.html`) no estaba disponible.
Cuando Mario proveyó el proyecto completo de Claude Design, A01, A02 y A04 a
A08 dejaron de ser placeholders genéricos: son ahora la reproducción exacta
del componente real (ver sección 3). La regla de esta sección se conserva
como referencia, por si aparece un slot nuevo sin fuente real disponible.

## 3. Inventario

| # | Slot | Página | Ratio | Estado | Texto alternativo |
| --- | --- | --- | --- | --- | --- |
| A01 | Retrato de Mario, sección fundador | Home | 4:5 | **Asset real aplicado** | Mario Vicuña, fundador de Vicunav |
| A02 | Retrato de Mario, hero | Nosotros | 4:5 | **Asset real aplicado** | Mario Vicuña en su espacio de trabajo |
| A03 | Retrato de Mario, perfil | Mario, reclutadores | 1:1 | Sin slot en el prototipo aprobado, ver nota | No aplica, no es una fotografía |
| A04 | Portada de caso, TatiPilates | Portafolio | Variable según breakpoint | **Componente Cover real, variante A** | No aplica, decorativo (ver nota) |
| A05 | Portada de caso, Bhoga Yoga | Portafolio | Variable según breakpoint | **Componente Cover real, variante B** | No aplica, decorativo (ver nota) |
| A06 | Portada de caso, Nelson Look Flash | Portafolio | — | Sin slot en el prototipo aprobado, ver nota | No aplica |
| A07 | Portada de caso, Clearpath Therapy | Portafolio | Variable según breakpoint | **Componente Cover real, variante C** | No aplica, decorativo (ver nota) |
| A08 | Portada de caso, Eleanor Wilde | Portafolio | Variable según breakpoint | **Componente Cover real, variante D** | No aplica, decorativo (ver nota) |
| A09 | Imagen de cabecera del artículo | Artículo | 16:9 | Sin slot en el prototipo aprobado, ver nota | Cocina de restaurante en hora de servicio |
| A10 | Miniatura por artículo del listado | Artículos | 3:2 | Sin slot en el prototipo aprobado, ver nota, 7 slots | Según el tema de cada artículo |
| A11 | Logotipo de Vicunav | Header y footer | Por definir | Sustitución aprobada (opción 2, ver sección 4) | Vicunav |
| A12 | Favicon y app icon | Global | 1:1 | **Faltante real** | No aplica |
| A13 | Imagen de Open Graph por plantilla | Global | 1200x630 | **Faltante real** | No aplica |

**Nota sobre A01 y A02:** el prototipo (`diseno/Vicunav Sitio Web v2.dc.html`) ya
referenciaba una foto real y publicada de Mario
(`https://vicunav.com/wp-content/uploads/2026/03/mario-vicuna-vicunav.jpg`), no
un placeholder. Se descargó y quedó en
`assets/img/mario-vicuna-vicunav.jpg`, usada en Home y Nosotros con el alt
definitivo de esta tabla.

**Nota sobre A04, A05, A07 y A08 — corrección importante:** esta tabla los
declaraba originalmente como slots de fotografía pendientes de reemplazo.
Eso era un error: al revisar `Cover.dc.html` (el componente real del
proyecto de Claude Design, en `docs/claude-design-full/Cover.dc.html`), la
portada de cada proyecto **no es una captura de pantalla**, es un patrón
geométrico de marca, decorativo, con 4 variantes fijas (A, B, C, D) que el
propio componente fuente marca `aria-hidden="true"` sin texto alternativo.
No hay foto que sustituir. Implementado 1 a 1 como `.ui-cover--a/b/c/d` en
`assets/css/components.css`, usado en `index.html` (teaser de portafolio) y
`portafolio.html`. Estos cuatro slots quedan **completos**, no pendientes.

**Nota sobre A03, A06, A09 y A10:** estos sí siguen sin slot en ninguno de
los dos prototipos aprobados (`Vicunav Sitio Web v2.dc.html`,
`Vicunav Landings SEO.dc.html`) ni en los componentes reales revisados
(`Cover.dc.html`, `Mockup.dc.html`). El retrato de perfil en `cv.html`, el
caso de Nelson Look Flash en el portafolio, la imagen de cabecera del
artículo y las miniaturas del listado de artículos no existen en ningún
archivo fuente disponible: son contenido planeado en este documento que no
llegó a implementarse en el diseño. No se agregaron al baseline para no
inventar markup fuera del contrato de fuente. Si siguen vigentes, son una
unidad de diseño pendiente antes de poder migrarlos, no un placeholder que
falte colocar.

**Los paneles "Mockup" (dashboard, reserva, chat, navegador, SEO)** tampoco
eran ilustración inventada desde el momento en que se tuvo acceso a
`Mockup.dc.html` (en `docs/claude-design-full/`): son la transcripción
exacta de ese componente, incluido su texto real ("Panel de reservas",
"Confirmada", "En espera", el diálogo del chat, el diagrama SEO). No están
en esta tabla de assets porque el propio componente los marca decorativos
(`aria-hidden="true"`), igual que Cover.

**PDF de CV:** tampoco era un faltante real. El export completo del proyecto
de Claude Design incluye `uploads/cv_files-1787863696971-ejq5.pdf`, la misma
ruta a la que apuntaba el enlace original del prototipo. Se verificó por
checksum (MD5) que es el archivo **idéntico, byte a byte**, al que Mario
proveyó directamente. Queda en `assets/cv/mario-vicuna-resume.pdf` con un
nombre de archivo legible en vez del nombre de subida autogenerado; puede
reemplazarse más adelante por una versión actualizada del CV.

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
