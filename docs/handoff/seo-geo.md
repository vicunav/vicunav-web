# Plan SEO y GEO

Title, meta description, slug, schema y palabras clave por plantilla. Listos
para implementar. Los slugs son propuesta.

## 1. Alcance geográfico

Prioridad declarada por Mario, en orden:

1. Santa Bárbara del Zulia, Venezuela. Base de operaciones, atención presencial.
2. San Carlos del Zulia, Venezuela. Presencial y remoto.
3. Resto del Zulia, incluyendo Maracaibo.
4. Venezuela, remoto.
5. LatAm.
6. Clientes internacionales, en inglés.

Las páginas locales trabajan zona. Las de servicio remoto trabajan especialidad.
No se crean páginas por ciudad vacías de contenido.

## 2. Tabla por página

### Verticales

| Campo | Restaurantes |
| --- | --- |
| Slug | `/restaurantes/` |
| Title | Sistemas de pedidos para restaurantes y pizzerías, Zulia |
| Meta | Sistema de pedidos online propio, constructor de platillos personalizados, menú digital con QR y reservas. Para restaurantes en Santa Bárbara del Zulia, San Carlos del Zulia y toda Venezuela. |
| Schema | `LocalBusiness`, `Service`, `FAQPage` |
| Palabras clave | sistema de pedidos para restaurantes, constructor de platillos personalizados, menú digital QR restaurante Zulia |

| Campo | Hoteles y posadas |
| --- | --- |
| Slug | `/hoteles/` |
| Title | Motor de reservas directas para hoteles y posadas, Zulia |
| Meta | Reservas directas sin comisión de portales, disponibilidad sincronizada y confirmaciones automáticas. Para hoteles y posadas en el Zulia, Venezuela y LatAm. |
| Schema | `LocalBusiness`, `Service`, `FAQPage` |
| Palabras clave | motor de reservas para hoteles, reservas directas posada, sistema de reservas hotel Venezuela |

| Campo | Bienestar |
| --- | --- |
| Slug | `/bienestar/` |
| Title | Agenda en línea para terapeutas, yoga y pilates |
| Meta | Reservas de sesiones y clases, recordatorios automáticos, paquetes y control de cupos. Para terapeutas y estudios en el Zulia, Venezuela y en línea. |
| Schema | `LocalBusiness`, `Service`, `FAQPage` |
| Palabras clave | agenda en línea para terapeutas, sistema de reservas pilates, software para estudio de yoga |

### Servicios

| Campo | Sistemas a medida |
| --- | --- |
| Slug | `/servicios/sistemas-a-medida/` |
| Title | Sistemas y software a medida para negocios, Vicunav |
| Meta | Reservas, pedidos y herramientas hechas a la medida de tu operación. Desarrollo a medida en Zulia, Venezuela y remoto para LatAm. |
| Schema | `Service`, `FAQPage` |
| Palabras clave | software a medida para negocios, sistema de reservas personalizado, desarrollo a medida Venezuela |

| Campo | Automatización |
| --- | --- |
| Slug | `/servicios/automatizacion-whatsapp/` |
| Title | Automatización con WhatsApp y chatbots para negocios |
| Meta | Respuestas automáticas, chatbots con tu información, recordatorios de citas y captación de leads. Implementación remota en toda LatAm. |
| Schema | `Service`, `FAQPage` |
| Palabras clave | automatizar WhatsApp negocio, chatbot para empresas, recordatorios de citas automáticos |

| Campo | Sitios web |
| --- | --- |
| Slug | `/servicios/sitios-web/` |
| Title | Sitios web para negocios de servicios, rápidos y editables |
| Meta | Diseño propio, Core Web Vitals, contenido claro y WordPress que puedes editar. Sitios web en Santa Bárbara del Zulia y remoto. |
| Schema | `Service`, `FAQPage` |
| Palabras clave | diseño web para negocios, sitio web WordPress rápido, páginas web Zulia |

| Campo | Visibilidad |
| --- | --- |
| Slug | `/servicios/seo-google-business/` |
| Title | SEO local y perfil de Google para negocios |
| Meta | SEO técnico, contenido por servicio y zona, perfil de Google y reseñas. Para negocios locales del Zulia y servicios en LatAm. |
| Schema | `Service`, `FAQPage` |
| Palabras clave | SEO local Zulia, Google Business Profile negocio, posicionamiento web Venezuela |

### Artículos y perfil

| Campo | Listado de artículos |
| --- | --- |
| Slug | `/articulos/` |
| Title | Artículos: tecnología que le ahorra tiempo a tu negocio |
| Meta | Notas prácticas sobre pedidos en línea, automatización, sitios web y visibilidad local, escritas desde proyectos reales, no desde teoría. |
| Schema | `Blog`, `CollectionPage` |
| Palabras clave | artículos tecnología para negocios, guías pedidos online, blog desarrollo web Venezuela |

| Campo | Artículo de ejemplo |
| --- | --- |
| Slug | `/articulos/sistema-de-pedidos-restaurante/` |
| Title | Cómo montar el sistema de pedidos de tu restaurante |
| Meta | Guía paso a paso: menú que dice la verdad, armado guiado de platillos, cobro con confirmación y un pedido que entra directo a la cocina. |
| Schema | `Article`, `FAQPage`, `BreadcrumbList` |
| Palabras clave | sistema de pedidos restaurante, pedidos en línea restaurante, menú digital y comandas |

| Campo | Mario, reclutadores |
| --- | --- |
| Slug | `/mario/` |
| Title | Mario Vicuna, Full Stack Developer, WordPress specialist |
| Meta | Full stack developer with 10+ years building performance focused websites and custom systems. Remote from Venezuela, open to full time roles. |
| Schema | `Person`, `ProfilePage` |
| Palabras clave | full stack developer hire, WordPress developer remote, React PHP developer Venezuela |

Esta página va en inglés, incluidos title y meta. Es deliberado: su público son
reclutadores internacionales. Confirmado por el SSOT, sección 10.

## 3. Requisitos técnicos transversales

- Un solo `h1` por página.
- Jerarquía de encabezados sin saltos.
- `BreadcrumbList` en verticales, servicios y artículos. Las migas ya están
  diseñadas en los prototipos.
- `LocalBusiness` con dirección, zona de servicio y horario, consistente con el
  perfil de Google. Los datos deben coincidir carácter por carácter.
- `FAQPage` alimentado por las FAQ reales de cada página, no duplicadas.
- Enlaces internos cruzados entre servicios y verticales, ya diseñados en la
  sección "Seguir explorando".
- Canónicas absolutas y `og:locale` correcto.

**Corregir el bug conocido:** el SSOT registra en su sección 11 que `og:locale`
está mal configurado en vicunav.com y en los tres sitios de clientes auditados,
y que probablemente viene de un default del stack base. Al ser un theme nuevo,
es el momento de resolverlo de raíz y no arrastrarlo.

## 4. GEO, búsqueda generativa

Para que los asistentes citen bien el negocio:

- Datos de contacto idénticos en sitio, perfil de Google y redes.
- Respuestas de FAQ autosuficientes, que se entiendan fuera de contexto.
- Datos estructurados válidos y completos.
- Nada de precios, coherente con la política del SSOT.
