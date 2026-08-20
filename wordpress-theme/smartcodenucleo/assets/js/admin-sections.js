(function ($) {
  "use strict";

  var state = {
    sections: [],
    types: {},
    defaults: {},
    i18n: {},
    booted: false,
  };

  function uid() {
    return "s_" + Math.random().toString(36).slice(2, 10);
  }

  function cfg() {
    return window.SCN_SECTIONS || {};
  }

  function defaultSection(type) {
    var d = state.defaults || {};
    var base = { id: uid(), type: type };
    switch (type) {
      case "hero":
        return Object.assign(base, {
          title: d.hero_title || "Nuevo hero",
          video: d.hero_video || "",
          poster: d.hero_poster || "",
          cta1_label: "About Us",
          cta1_url: "/about-us/",
          cta2_label: "Contact",
          cta2_url: "/contact/",
        });
      case "text_media":
        return Object.assign(base, {
          title: d.home_section_title || "Titulo",
          lead: d.home_lead || "",
          text: [d.home_p1, d.home_p2, d.home_p3].filter(Boolean).join("\n\n"),
          image: d.home_side_image || "",
          button_label: "Contact",
          button_url: "/contact/",
        });
      case "cards":
        return Object.assign(base, {
          title: d.solutions_title || "About Us",
          subtitle: d.solutions_subtitle || "",
          items: [
            { title: "Tarjeta 1", text: "Describe esta tarjeta", image: "" },
            { title: "Tarjeta 2", text: "Describe esta tarjeta", image: "" },
            { title: "Tarjeta 3", text: "Describe esta tarjeta", image: "" },
          ],
        });
      case "about":
        return Object.assign(base, {
          title: d.who_title || "Who We Are",
          subtitle: d.who_subtitle || "",
          image: d.who_image || "",
          text: [d.who_p1, d.who_p2].filter(Boolean).join("\n\n"),
          vision: d.who_vision || "",
          mission: d.who_mission || "",
        });
      case "partners":
        return Object.assign(base, {
          title: d.partners_title || "Partners",
          subtitle: d.partners_subtitle || "",
          cta: d.partners_cta || "",
          image1: d.partner_1_image || "",
          image2: d.partner_2_image || "",
          image3: d.partner_3_image || "",
        });
      case "news":
        return Object.assign(base, {
          title: d.news_title || "News",
          subtitle: d.news_subtitle || "",
          items: [
            { title: "Noticia 1", text: "", date: "", image: "" },
            { title: "Noticia 2", text: "", date: "", image: "" },
          ],
        });
      case "tech":
        return Object.assign(base, {
          title: d.tech_title || "Our Technology",
          subtitle: d.tech_subtitle || "",
          lead: d.tech_lead || "",
          items: [
            { title: "Punto 1", text: "" },
            { title: "Punto 2", text: "" },
            { title: "Punto 3", text: "" },
          ],
        });
      case "contact":
        return Object.assign(base, {
          title: d.connect_title || "Contact",
          subtitle: d.connect_subtitle || "",
          text: d.connect_text || "",
          email: d.connect_email || "",
          button_label: "Connect",
        });
      case "richtext":
      default:
        return Object.assign(base, {
          type: "richtext",
          title: "Nueva seccion",
          text: "Escribe aqui tu contenido...",
        });
    }
  }

  function escapeHtml(str) {
    return String(str == null ? "" : str)
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;");
  }

  function escapeAttr(str) {
    return String(str == null ? "" : str)
      .replace(/&/g, "&amp;")
      .replace(/"/g, "&quot;")
      .replace(/</g, "&lt;");
  }

  function field(label, key, value, type) {
    type = type || "text";
    if (type === "textarea") {
      return (
        '<label class="scn-field"><span>' +
        escapeHtml(label) +
        '</span><textarea data-key="' +
        escapeAttr(key) +
        '" rows="4">' +
        escapeHtml(value || "") +
        "</textarea></label>"
      );
    }
    if (type === "image") {
      return (
        '<label class="scn-field scn-field-image"><span>' +
        escapeHtml(label) +
        '</span><div class="scn-image-row"><input type="url" data-key="' +
        escapeAttr(key) +
        '" value="' +
        escapeAttr(value || "") +
        '" /><button type="button" class="button scn-pick-image">Elegir imagen</button></div>' +
        (value
          ? '<img class="scn-thumb" src="' + escapeAttr(value) + '" alt="" />'
          : "") +
        "</label>"
      );
    }
    return (
      '<label class="scn-field"><span>' +
      escapeHtml(label) +
      '</span><input type="' +
      escapeAttr(type) +
      '" data-key="' +
      escapeAttr(key) +
      '" value="' +
      escapeAttr(value || "") +
      '" /></label>'
    );
  }

  function itemFields(prefix, item, index, kind) {
    var html = '<div class="scn-item" data-index="' + index + '">';
    html += "<h4>Item " + (index + 1) + "</h4>";
    html += field("Titulo", prefix + ".title", item.title);
    html += field("Texto", prefix + ".text", item.text, "textarea");
    if (kind === "news") html += field("Fecha", prefix + ".date", item.date);
    if (kind !== "tech") html += field("Imagen", prefix + ".image", item.image, "image");
    html +=
      '<button type="button" class="button-link-delete scn-remove-item">Eliminar item</button>';
    html += "</div>";
    return html;
  }

  function renderSection(section) {
    var title = state.types[section.type] || section.type;
    var html =
      '<div class="scn-section-card" data-id="' + escapeAttr(section.id) + '">';
    html += '<div class="scn-section-card__head">';
    html += "<strong>" + escapeHtml(title) + "</strong>";
    html += '<div class="scn-section-card__actions">';
    html +=
      '<button type="button" class="button scn-up">↑</button> <button type="button" class="button scn-down">↓</button> ';
    html += '<button type="button" class="button scn-toggle">Editar</button> ';
    html +=
      '<button type="button" class="button button-link-delete scn-remove">Eliminar</button>';
    html += "</div></div><div class="scn-section-card__body">";

    switch (section.type) {
      case "hero":
        html += field("Titulo", "title", section.title, "textarea");
        html += field("Video (URL)", "video", section.video);
        html += field("Poster / imagen", "poster", section.poster, "image");
        html += field("Boton 1 - texto", "cta1_label", section.cta1_label);
        html += field("Boton 1 - enlace", "cta1_url", section.cta1_url);
        html += field("Boton 2 - texto", "cta2_label", section.cta2_label);
        html += field("Boton 2 - enlace", "cta2_url", section.cta2_url);
        break;
      case "text_media":
        html += field("Titulo", "title", section.title);
        html += field("Lead", "lead", section.lead, "textarea");
        html += field("Texto", "text", section.text, "textarea");
        html += field("Imagen", "image", section.image, "image");
        html += field("Boton - texto", "button_label", section.button_label);
        html += field("Boton - enlace", "button_url", section.button_url);
        break;
      case "cards":
        html += field("Titulo", "title", section.title);
        html += field("Subtitulo", "subtitle", section.subtitle, "textarea");
        html += '<div class="scn-items" data-kind="cards">';
        (section.items || []).forEach(function (item, i) {
          html += itemFields("items." + i, item, i, "cards");
        });
        html += "</div>";
        html +=
          '<button type="button" class="button scn-add-item" data-kind="cards">+ Agregar tarjeta</button>';
        break;
      case "about":
        html += field("Titulo", "title", section.title);
        html += field("Subtitulo", "subtitle", section.subtitle, "textarea");
        html += field("Imagen", "image", section.image, "image");
        html += field("Texto", "text", section.text, "textarea");
        html += field("Vision", "vision", section.vision, "textarea");
        html += field("Mission", "mission", section.mission, "textarea");
        break;
      case "partners":
        html += field("Titulo", "title", section.title);
        html += field("Subtitulo", "subtitle", section.subtitle, "textarea");
        html += field("CTA", "cta", section.cta);
        html += field("Imagen 1", "image1", section.image1, "image");
        html += field("Imagen 2", "image2", section.image2, "image");
        html += field("Imagen 3", "image3", section.image3, "image");
        break;
      case "news":
        html += field("Titulo", "title", section.title);
        html += field("Subtitulo", "subtitle", section.subtitle, "textarea");
        html += '<div class="scn-items" data-kind="news">';
        (section.items || []).forEach(function (item, i) {
          html += itemFields("items." + i, item, i, "news");
        });
        html += "</div>";
        html +=
          '<button type="button" class="button scn-add-item" data-kind="news">+ Agregar noticia</button>';
        break;
      case "tech":
        html += field("Titulo", "title", section.title);
        html += field("Subtitulo", "subtitle", section.subtitle);
        html += field("Lead", "lead", section.lead, "textarea");
        html += '<div class="scn-items" data-kind="tech">';
        (section.items || []).forEach(function (item, i) {
          html += itemFields("items." + i, item, i, "tech");
        });
        html += "</div>";
        html +=
          '<button type="button" class="button scn-add-item" data-kind="tech">+ Agregar punto</button>';
        break;
      case "contact":
        html += field("Titulo", "title", section.title);
        html += field("Subtitulo", "subtitle", section.subtitle);
        html += field("Texto", "text", section.text, "textarea");
        html += field("Email", "email", section.email, "email");
        html += field("Texto del boton", "button_label", section.button_label);
        break;
      case "richtext":
      default:
        html += field("Titulo", "title", section.title);
        html += field("Texto", "text", section.text, "textarea");
        break;
    }

    html += "</div></div>";
    return html;
  }

  function status(msg) {
    var el = document.getElementById("scn-sections-status");
    if (el) el.textContent = msg || "";
  }

  function sync() {
    var box = document.getElementById("scn_sections_json");
    if (box) box.value = JSON.stringify(state.sections || []);
  }

  function paint(openLast) {
    var list = document.getElementById("scn-sections-list");
    if (!list) return;
    list.innerHTML = (state.sections || [])
      .map(function (s) {
        return renderSection(s);
      })
      .join("");
    sync();
    if (openLast) {
      var cards = list.querySelectorAll(".scn-section-card__body");
      if (cards.length) {
        cards[cards.length - 1].scrollIntoView({ behavior: "smooth", block: "center" });
      }
    }
  }

  function findIndex(id) {
    return state.sections.findIndex(function (s) {
      return String(s.id) === String(id);
    });
  }

  function addSection() {
    var select = document.getElementById("scn-add-type");
    var type = select ? select.value : "richtext";
    state.sections.push(defaultSection(type));
    paint(true);
    status(state.i18n.added || "Seccion agregada.");
  }

  function bindOnce() {
    if (state.booted) return true;
    var app = document.getElementById("scn-sections-app");
    if (!app) return false;

    var data = cfg();
    state.sections = Array.isArray(data.sections) ? data.sections.slice() : [];
    state.types = data.types || {};
    state.defaults = data.defaults || {};
    state.i18n = data.i18n || {};

    // Prefer textarea content if already present.
    var box = document.getElementById("scn_sections_json");
    if (box && box.value) {
      try {
        var parsed = JSON.parse(box.value);
        if (Array.isArray(parsed)) state.sections = parsed;
      } catch (e) {}
    }

    document.addEventListener("click", function (e) {
      var t = e.target;
      if (!t || !t.closest) return;

      if (t.id === "scn-add-section" || t.closest("#scn-add-section")) {
        e.preventDefault();
        e.stopPropagation();
        addSection();
        return;
      }

      var card = t.closest(".scn-section-card");
      if (!card) return;
      var id = card.getAttribute("data-id");
      var i = findIndex(id);

      if (t.classList.contains("scn-toggle") || t.closest(".scn-toggle")) {
        var body = card.querySelector(".scn-section-card__body");
        if (body) body.hidden = !body.hidden;
        return;
      }

      if (t.classList.contains("scn-remove") || t.closest(".scn-remove")) {
        if (!window.confirm(state.i18n.confirm || "Eliminar?")) return;
        state.sections = state.sections.filter(function (s) {
          return String(s.id) !== String(id);
        });
        paint();
        status(state.i18n.removed || "Seccion eliminada.");
        return;
      }

      if (t.classList.contains("scn-up") || t.closest(".scn-up")) {
        if (i > 0) {
          var tmp = state.sections[i - 1];
          state.sections[i - 1] = state.sections[i];
          state.sections[i] = tmp;
          paint();
        }
        return;
      }

      if (t.classList.contains("scn-down") || t.closest(".scn-down")) {
        if (i > -1 && i < state.sections.length - 1) {
          var tmp2 = state.sections[i + 1];
          state.sections[i + 1] = state.sections[i];
          state.sections[i] = tmp2;
          paint();
        }
        return;
      }

      if (t.classList.contains("scn-add-item") || t.closest(".scn-add-item")) {
        var btn = t.classList.contains("scn-add-item") ? t : t.closest(".scn-add-item");
        var kind = btn.getAttribute("data-kind");
        if (i < 0) return;
        state.sections[i].items = state.sections[i].items || [];
        var blank = { title: "Nuevo", text: "" };
        if (kind === "news") blank.date = "";
        if (kind !== "tech") blank.image = "";
        state.sections[i].items.push(blank);
        paint();
        return;
      }

      if (t.classList.contains("scn-remove-item") || t.closest(".scn-remove-item")) {
        var item = t.closest(".scn-item");
        if (!item || i < 0) return;
        var idx = parseInt(item.getAttribute("data-index"), 10);
        state.sections[i].items.splice(idx, 1);
        paint();
        return;
      }

      if (t.classList.contains("scn-pick-image") || t.closest(".scn-pick-image")) {
        e.preventDefault();
        var input = t.closest(".scn-image-row").querySelector("input");
        if (!input || typeof wp === "undefined" || !wp.media) return;
        var frame = wp.media({
          title: "Elegir imagen",
          button: { text: "Usar esta imagen" },
          multiple: false,
        });
        frame.on("select", function () {
          var url = frame.state().get("selection").first().toJSON().url;
          input.value = url;
          input.dispatchEvent(new Event("input", { bubbles: true }));
        });
        frame.open();
      }
    });

    document.addEventListener("input", function (e) {
      var t = e.target;
      if (!t || !t.getAttribute) return;
      var key = t.getAttribute("data-key");
      if (!key) return;
      var card = t.closest(".scn-section-card");
      if (!card) return;
      var i = findIndex(card.getAttribute("data-id"));
      if (i < 0) return;
      var val = t.value;
      if (String(key).indexOf("items.") === 0) {
        var parts = String(key).split(".");
        var idx = parseInt(parts[1], 10);
        var fieldKey = parts[2];
        state.sections[i].items = state.sections[i].items || [];
        state.sections[i].items[idx] = state.sections[i].items[idx] || {};
        state.sections[i].items[idx][fieldKey] = val;
      } else {
        state.sections[i][key] = val;
      }
      sync();
    });

    paint(false);
    status(state.i18n.ready || "Editor de secciones listo.");
    state.booted = true;
    return true;
  }

  function boot() {
    if (bindOnce()) return;
    var tries = 0;
    var timer = setInterval(function () {
      tries += 1;
      if (bindOnce() || tries > 60) clearInterval(timer);
    }, 250);
  }

  $(boot);
  if (window.wp && wp.domReady) wp.domReady(boot);
  document.addEventListener("DOMContentLoaded", boot);
})(jQuery);
