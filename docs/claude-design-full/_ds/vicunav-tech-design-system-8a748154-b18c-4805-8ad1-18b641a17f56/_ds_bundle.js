/* @ds-bundle: {"format":4,"namespace":"VicunavTechDesignSystem_8a7481","components":[{"name":"Kicker","sourcePath":"components/badges/Kicker.jsx"},{"name":"Button","sourcePath":"components/buttons/Button.jsx"},{"name":"PillarCard","sourcePath":"components/cards/pillar/PillarCard.jsx"},{"name":"ProjectCard","sourcePath":"components/cards/project/ProjectCard.jsx"},{"name":"Input","sourcePath":"components/forms/Input.jsx"},{"name":"Icon","sourcePath":"components/icon/Icon.jsx"}],"sourceHashes":{"components/badges/Kicker.jsx":"65f8cd6551e1","components/buttons/Button.jsx":"d1b9366241e1","components/cards/pillar/PillarCard.jsx":"ca9f219c9b62","components/cards/project/ProjectCard.jsx":"09a40432a506","components/forms/Input.jsx":"dd59cdc8aee1","components/icon/Icon.jsx":"71ff0fa7fa92","ui_kits/website/ContactSection.jsx":"504fc3855248","ui_kits/website/Footer.jsx":"fb12ddd4a559","ui_kits/website/Header.jsx":"d37b5e9f47ac","ui_kits/website/Hero.jsx":"642862a3e14d","ui_kits/website/PillarsSection.jsx":"79ee8cb7bf13","ui_kits/website/PortfolioSection.jsx":"b9278127e36d"},"inlinedExternals":[],"unexposedExports":[]} */

(() => {

const __ds_ns = (window.VicunavTechDesignSystem_8a7481 = window.VicunavTechDesignSystem_8a7481 || {});

const __ds_scope = {};

(__ds_ns.__errors = __ds_ns.__errors || []);

// components/badges/Kicker.jsx
try { (() => {
function Kicker({
  children,
  tone = 'accent',
  style
}) {
  const tones = {
    accent: {
      backgroundColor: 'var(--color-accent-tint)',
      color: 'var(--color-accent)'
    },
    'on-dark': {
      backgroundColor: 'color-mix(in oklch, var(--color-accent) 20%, transparent)',
      color: 'var(--color-accent)'
    }
  };
  return /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      fontFamily: 'var(--font-family-base)',
      fontSize: 'var(--text-label-size)',
      fontWeight: 'var(--text-label-weight)',
      letterSpacing: 'var(--text-label-tracking)',
      textTransform: 'uppercase',
      padding: '6px 14px',
      borderRadius: 'var(--radius-pill)',
      ...tones[tone],
      ...style
    }
  }, children);
}
Object.assign(__ds_scope, { Kicker });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/badges/Kicker.jsx", error: String((e && e.message) || e) }); }

// components/buttons/Button.jsx
try { (() => {
const sizes = {
  sm: {
    padding: '8px 18px',
    fontSize: 14
  },
  md: {
    padding: '12px 24px',
    fontSize: 16
  },
  lg: {
    padding: '16px 32px',
    fontSize: 18
  }
};
function Button({
  variant = 'primary',
  size = 'md',
  disabled = false,
  type = 'button',
  onClick,
  children,
  style
}) {
  const [hover, setHover] = React.useState(false);
  const [pressed, setPressed] = React.useState(false);
  const base = {
    fontFamily: 'var(--font-family-base)',
    fontWeight: 'var(--weight-semibold)',
    lineHeight: 1,
    border: 'none',
    cursor: disabled ? 'not-allowed' : 'pointer',
    opacity: disabled ? 0.45 : 1,
    display: 'inline-flex',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 8,
    transition: 'background-color .15s ease, color .15s ease, transform .1s ease',
    transform: pressed && !disabled ? 'scale(0.97)' : 'scale(1)',
    ...sizes[size]
  };
  const variants = {
    primary: {
      borderRadius: 'var(--radius-pill)',
      backgroundColor: hover && !disabled ? 'var(--color-accent-hover)' : 'var(--color-accent)',
      color: 'var(--color-dark)'
    },
    secondary: {
      borderRadius: 'var(--radius-pill)',
      backgroundColor: 'transparent',
      padding: 0,
      color: hover && !disabled ? 'var(--color-secondary-hover)' : 'var(--color-secondary)'
    }
  };
  return /*#__PURE__*/React.createElement("button", {
    type: type,
    disabled: disabled,
    onClick: onClick,
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => {
      setHover(false);
      setPressed(false);
    },
    onMouseDown: () => setPressed(true),
    onMouseUp: () => setPressed(false),
    style: {
      ...base,
      ...variants[variant],
      ...style
    }
  }, children);
}
Object.assign(__ds_scope, { Button });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/buttons/Button.jsx", error: String((e && e.message) || e) }); }

// components/cards/project/ProjectCard.jsx
try { (() => {
function ProjectCard({
  title,
  category,
  year,
  imageSlot,
  style
}) {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      borderRadius: 'var(--radius-lg)',
      overflow: 'hidden',
      backgroundColor: 'var(--color-white)',
      border: '1px solid var(--border-default)',
      fontFamily: 'var(--font-family-base)',
      ...style
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      aspectRatio: '4 / 3',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      backgroundColor: 'var(--surface-card-light)',
      borderBottom: '1px solid var(--border-default)',
      color: 'var(--text-secondary)',
      fontSize: 'var(--text-body-sm-size)',
      textAlign: 'center',
      padding: 'var(--space-4)'
    }
  }, imageSlot || 'Imagen del proyecto'), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--space-2)',
      padding: 'var(--space-5)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      justifyContent: 'space-between',
      alignItems: 'center',
      fontSize: 'var(--text-label-size)',
      fontWeight: 'var(--text-label-weight)',
      letterSpacing: 'var(--text-label-tracking)',
      textTransform: 'uppercase',
      color: 'var(--color-accent)'
    }
  }, /*#__PURE__*/React.createElement("span", null, category), /*#__PURE__*/React.createElement("span", null, year)), /*#__PURE__*/React.createElement("h3", {
    style: {
      margin: 0,
      fontSize: 'var(--text-h3-size)',
      lineHeight: 'var(--text-h3-line)',
      fontWeight: 'var(--text-h3-weight)',
      color: 'var(--color-dark)'
    }
  }, title)));
}
Object.assign(__ds_scope, { ProjectCard });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/cards/project/ProjectCard.jsx", error: String((e && e.message) || e) }); }

// components/forms/Input.jsx
try { (() => {
function Input({
  label,
  placeholder,
  type = 'text',
  helperText,
  error,
  multiline = false,
  value,
  onChange,
  style
}) {
  const [focused, setFocused] = React.useState(false);
  const fieldStyle = {
    width: '100%',
    fontFamily: 'var(--font-family-base)',
    fontSize: 'var(--text-body-size)',
    color: 'var(--color-dark)',
    backgroundColor: 'var(--color-white)',
    border: `1px solid ${error ? 'var(--color-accent)' : focused ? 'var(--color-dark)' : 'var(--border-default)'}`,
    borderRadius: 'var(--radius-md)',
    padding: '12px 16px',
    outline: 'none',
    boxSizing: 'border-box',
    transition: 'border-color .15s ease'
  };
  const Tag = multiline ? 'textarea' : 'input';
  return /*#__PURE__*/React.createElement("label", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 8,
      fontFamily: 'var(--font-family-base)',
      ...style
    }
  }, label && /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 'var(--text-label-size)',
      fontWeight: 'var(--text-label-weight)',
      letterSpacing: 'var(--text-label-tracking)',
      textTransform: 'uppercase',
      color: 'var(--color-dark)'
    }
  }, label), /*#__PURE__*/React.createElement(Tag, {
    type: multiline ? undefined : type,
    placeholder: placeholder,
    value: value,
    onChange: onChange,
    rows: multiline ? 4 : undefined,
    onFocus: () => setFocused(true),
    onBlur: () => setFocused(false),
    style: fieldStyle
  }), (helperText || error) && /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: 'var(--text-body-sm-size)',
      color: error ? 'var(--color-accent)' : 'var(--text-secondary)'
    }
  }, error || helperText));
}
Object.assign(__ds_scope, { Input });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Input.jsx", error: String((e && e.message) || e) }); }

// components/icon/Icon.jsx
try { (() => {
function Icon({
  name,
  size = 24,
  style
}) {
  const ref = React.useRef(null);
  React.useEffect(() => {
    if (window.lucide && ref.current) window.lucide.createIcons({
      nodes: [ref.current]
    });
  }, [name]);
  return React.createElement('i', {
    ref,
    'data-lucide': name,
    style: {
      width: size,
      height: size,
      display: 'inline-flex',
      color: 'inherit',
      ...style
    }
  });
}
Object.assign(__ds_scope, { Icon });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/icon/Icon.jsx", error: String((e && e.message) || e) }); }

// components/cards/pillar/PillarCard.jsx
try { (() => {
function PillarCard({
  icon,
  title,
  description,
  style
}) {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--space-4)',
      padding: 'var(--space-6)',
      backgroundColor: 'var(--surface-card-light)',
      border: '1px solid var(--border-default)',
      borderRadius: 'var(--radius-lg)',
      fontFamily: 'var(--font-family-base)',
      ...style
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      width: 48,
      height: 48,
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 'var(--radius-md)',
      backgroundColor: 'var(--surface-accent-tint)',
      color: 'var(--color-accent)'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 24
  })), /*#__PURE__*/React.createElement("h3", {
    style: {
      margin: 0,
      fontSize: 'var(--text-h3-size)',
      lineHeight: 'var(--text-h3-line)',
      fontWeight: 'var(--text-h3-weight)',
      color: 'var(--color-dark)'
    }
  }, title), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      fontSize: 'var(--text-body-size)',
      lineHeight: 'var(--text-body-line)',
      color: 'var(--text-secondary)'
    }
  }, description));
}
Object.assign(__ds_scope, { PillarCard });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/cards/pillar/PillarCard.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/ContactSection.jsx
try { (() => {
function ContactSection() {
  const {
    Kicker,
    Input,
    Button
  } = window.VicunavTechDesignSystem_8a7481;
  const [sent, setSent] = React.useState(false);
  const [form, setForm] = React.useState({
    nombre: '',
    correo: '',
    mensaje: ''
  });
  const update = k => e => setForm(f => ({
    ...f,
    [k]: e.target.value
  }));
  const submit = e => {
    e.preventDefault();
    setSent(true);
  };
  return /*#__PURE__*/React.createElement("section", {
    id: "contacto",
    style: {
      backgroundColor: 'var(--color-dark)',
      color: 'var(--color-light)',
      padding: '80px 64px',
      display: 'flex',
      flexDirection: 'column',
      gap: 40
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement(Kicker, {
    tone: "on-dark"
  }, "Contacto"), /*#__PURE__*/React.createElement("h2", {
    style: {
      margin: 0,
      fontFamily: 'var(--font-family-base)',
      fontSize: 'var(--text-h2-size)',
      fontWeight: 'var(--text-h2-weight)',
      color: 'var(--color-light)'
    }
  }, "Hablemos de tu proyecto")), sent ? /*#__PURE__*/React.createElement("p", {
    style: {
      fontFamily: 'var(--font-family-base)',
      fontSize: 18,
      color: 'var(--color-accent)'
    }
  }, "\xA1Gracias", form.nombre ? `, ${form.nombre}` : '', "! Te contactaremos pronto.") : /*#__PURE__*/React.createElement("form", {
    onSubmit: submit,
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 20,
      maxWidth: 480
    }
  }, /*#__PURE__*/React.createElement(Input, {
    label: "Nombre",
    placeholder: "Tu nombre",
    value: form.nombre,
    onChange: update('nombre'),
    style: {
      color: 'var(--color-light)'
    }
  }), /*#__PURE__*/React.createElement(Input, {
    label: "Correo",
    type: "email",
    placeholder: "t\xFA@empresa.com",
    value: form.correo,
    onChange: update('correo'),
    style: {
      color: 'var(--color-light)'
    }
  }), /*#__PURE__*/React.createElement(Input, {
    label: "Mensaje",
    multiline: true,
    placeholder: "Cu\xE9ntanos sobre tu proyecto",
    value: form.mensaje,
    onChange: update('mensaje'),
    style: {
      color: 'var(--color-light)'
    }
  }), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    type: "submit",
    style: {
      alignSelf: 'flex-start'
    }
  }, "Enviar mensaje")));
}
window.ContactSection = ContactSection;
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/ContactSection.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/Footer.jsx
try { (() => {
function Footer() {
  return /*#__PURE__*/React.createElement("footer", {
    style: {
      backgroundColor: 'var(--color-light-2)',
      padding: '32px 64px',
      display: 'flex',
      justifyContent: 'space-between',
      alignItems: 'center',
      fontFamily: 'var(--font-family-base)',
      fontSize: 14,
      color: 'var(--text-secondary)'
    }
  }, /*#__PURE__*/React.createElement("span", null, "Vicunav Tech"), /*#__PURE__*/React.createElement("span", null, "\xA9 2026 Vicunav Tech. Todos los derechos reservados."));
}
window.Footer = Footer;
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/Footer.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/Header.jsx
try { (() => {
function Header({
  onNavClick
}) {
  const {
    Button
  } = window.VicunavTechDesignSystem_8a7481;
  const links = ['Servicios', 'Portafolio', 'Nosotros', 'Contacto'];
  return /*#__PURE__*/React.createElement("header", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      padding: '20px 64px',
      backgroundColor: 'var(--color-dark)'
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: 'var(--font-family-base)',
      fontWeight: 700,
      fontSize: 20,
      color: 'var(--color-light)'
    }
  }, "Vicunav Tech"), /*#__PURE__*/React.createElement("nav", {
    style: {
      display: 'flex',
      gap: 32
    }
  }, links.map(l => /*#__PURE__*/React.createElement("a", {
    key: l,
    href: `#${l.toLowerCase()}`,
    onClick: e => {
      e.preventDefault();
      onNavClick(l.toLowerCase());
    },
    style: {
      fontFamily: 'var(--font-family-base)',
      fontSize: 15,
      fontWeight: 500,
      color: 'var(--color-light)',
      textDecoration: 'none',
      opacity: 0.85
    }
  }, l))), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    size: "sm",
    onClick: () => onNavClick('contacto')
  }, "Hablemos"));
}
window.Header = Header;
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/Header.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/Hero.jsx
try { (() => {
function Hero({
  onCta
}) {
  const {
    Button,
    Kicker
  } = window.VicunavTechDesignSystem_8a7481;
  return /*#__PURE__*/React.createElement("section", {
    id: "inicio",
    style: {
      backgroundColor: 'var(--color-dark)',
      color: 'var(--color-light)',
      padding: '96px 64px 112px',
      display: 'flex',
      flexDirection: 'column',
      gap: 24,
      alignItems: 'flex-start'
    }
  }, /*#__PURE__*/React.createElement(Kicker, {
    tone: "on-dark"
  }, "Estudio de tecnolog\xEDa"), /*#__PURE__*/React.createElement("h1", {
    style: {
      margin: 0,
      maxWidth: 720,
      fontFamily: 'var(--font-family-base)',
      fontSize: 'var(--text-h1-size)',
      lineHeight: 'var(--text-h1-line)',
      fontWeight: 'var(--text-h1-weight)',
      letterSpacing: 'var(--text-h1-tracking)'
    }
  }, "Construimos tecnolog\xEDa con calidez humana."), /*#__PURE__*/React.createElement("p", {
    style: {
      margin: 0,
      maxWidth: 560,
      fontFamily: 'var(--font-family-base)',
      fontSize: 'var(--text-body-lg-size)',
      lineHeight: 1.6,
      color: 'var(--color-secondary)'
    }
  }, "Dise\xF1o y desarrollo de producto para equipos que quieren moverse r\xE1pido sin perder calidez ni claridad."), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 32,
      alignItems: 'center',
      marginTop: 8
    }
  }, /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    size: "lg",
    onClick: onCta
  }, "Empieza un proyecto"), /*#__PURE__*/React.createElement(Button, {
    variant: "secondary",
    size: "lg",
    style: {
      color: 'var(--color-light)'
    }
  }, "Ver portafolio")));
}
window.Hero = Hero;
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/Hero.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/PillarsSection.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function PillarsSection() {
  const {
    Kicker,
    PillarCard
  } = window.VicunavTechDesignSystem_8a7481;
  const pillars = [{
    icon: 'compass',
    title: 'Estrategia',
    description: 'Definimos el rumbo técnico antes de escribir una sola línea de código.'
  }, {
    icon: 'layers',
    title: 'Producto',
    description: 'Diseñamos y construimos sistemas que tu equipo puede mantener.'
  }, {
    icon: 'zap',
    title: 'Velocidad',
    description: 'Iteramos rápido sin sacrificar la calidad del código.'
  }, {
    icon: 'users',
    title: 'Acompañamiento',
    description: 'Trabajamos codo a codo con tu equipo, no como una caja negra.'
  }];
  return /*#__PURE__*/React.createElement("section", {
    id: "servicios",
    style: {
      backgroundColor: 'var(--color-light)',
      padding: '80px 64px',
      display: 'flex',
      flexDirection: 'column',
      gap: 40
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement(Kicker, null, "C\xF3mo trabajamos"), /*#__PURE__*/React.createElement("h2", {
    style: {
      margin: 0,
      fontFamily: 'var(--font-family-base)',
      fontSize: 'var(--text-h2-size)',
      fontWeight: 'var(--text-h2-weight)',
      color: 'var(--color-dark)'
    }
  }, "Nuestros pilares")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: 'repeat(4, 1fr)',
      gap: 24
    }
  }, pillars.map((p, i) => /*#__PURE__*/React.createElement(PillarCard, _extends({
    key: i
  }, p)))));
}
window.PillarsSection = PillarsSection;
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/PillarsSection.jsx", error: String((e && e.message) || e) }); }

// ui_kits/website/PortfolioSection.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function PortfolioSection() {
  const {
    Kicker,
    ProjectCard
  } = window.VicunavTechDesignSystem_8a7481;
  const projects = [{
    category: 'Fintech',
    year: '2025',
    title: 'Rediseño de dashboard para PYMEs'
  }, {
    category: 'Salud',
    year: '2024',
    title: 'App de seguimiento clínico'
  }, {
    category: 'Retail',
    year: '2024',
    title: 'Plataforma de inventario en tiempo real'
  }];
  return /*#__PURE__*/React.createElement("section", {
    id: "portafolio",
    style: {
      backgroundColor: 'var(--color-light-2)',
      padding: '80px 64px',
      display: 'flex',
      flexDirection: 'column',
      gap: 40
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement(Kicker, null, "Portafolio"), /*#__PURE__*/React.createElement("h2", {
    style: {
      margin: 0,
      fontFamily: 'var(--font-family-base)',
      fontSize: 'var(--text-h2-size)',
      fontWeight: 'var(--text-h2-weight)',
      color: 'var(--color-dark)'
    }
  }, "Proyectos recientes")), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: 'repeat(3, 1fr)',
      gap: 24
    }
  }, projects.map((p, i) => /*#__PURE__*/React.createElement(ProjectCard, _extends({
    key: i
  }, p)))));
}
window.PortfolioSection = PortfolioSection;
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/website/PortfolioSection.jsx", error: String((e && e.message) || e) }); }

__ds_ns.Kicker = __ds_scope.Kicker;

__ds_ns.Button = __ds_scope.Button;

__ds_ns.PillarCard = __ds_scope.PillarCard;

__ds_ns.ProjectCard = __ds_scope.ProjectCard;

__ds_ns.Input = __ds_scope.Input;

__ds_ns.Icon = __ds_scope.Icon;

})();
