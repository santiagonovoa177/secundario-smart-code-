(function () {
  var loader = document.getElementById("scn-loader");
  var hideTimer = null;
  var fading = false;
  var busy = false;
  var cfg = window.SCN || {};
  var warmVideo = null;

  function showLoader() {
    if (!loader) return;
    fading = false;
    if (hideTimer) {
      clearTimeout(hideTimer);
      hideTimer = null;
    }
    loader.style.display = "flex";
    loader.style.removeProperty("opacity");
    loader.classList.remove("is-hidden", "is-fade");
    loader.setAttribute("aria-hidden", "false");
  }

  function hideLoader() {
    if (!loader || fading || loader.classList.contains("is-hidden")) return;
    fading = true;
    loader.style.removeProperty("opacity");
    void loader.offsetWidth;
    loader.classList.add("is-fade");
    hideTimer = window.setTimeout(function () {
      loader.classList.add("is-hidden");
      loader.style.display = "none";
      loader.setAttribute("aria-hidden", "true");
      fading = false;
      hideTimer = null;
    }, 620);
  }

  function warmHomeVideo() {
    var url = cfg.heroVideo;
    if (!url || warmVideo) return;
    warmVideo = document.createElement("video");
    warmVideo.preload = "auto";
    warmVideo.muted = true;
    warmVideo.playsInline = true;
    warmVideo.setAttribute("playsinline", "");
    warmVideo.src = url;
    try {
      warmVideo.load();
    } catch (e) {}
  }

  function waitForHeroVideos(root) {
    if (!root) return Promise.resolve();
    var videos = Array.prototype.slice.call(root.querySelectorAll("video.scn-hero__video"));
    if (!videos.length) return Promise.resolve();

    return Promise.all(
      videos.map(function (video) {
        return new Promise(function (resolve) {
          var settled = false;
          var done = function () {
            if (settled) return;
            settled = true;
            try {
              var p = video.play();
              if (p && typeof p.catch === "function") p.catch(function () {});
            } catch (e) {}
            resolve();
          };

          // Reuse warmed cache when possible
          if (warmVideo && warmVideo.src && !video.currentSrc) {
            try {
              video.src = warmVideo.currentSrc || warmVideo.src;
            } catch (e) {}
          }

          video.muted = true;
          video.playsInline = true;
          video.setAttribute("playsinline", "");
          video.preload = "auto";
          video.removeAttribute("poster");

          if (video.readyState >= 2) {
            done();
            return;
          }

          video.addEventListener("loadeddata", done, { once: true });
          video.addEventListener("canplay", done, { once: true });
          video.addEventListener("error", done, { once: true });
          window.setTimeout(done, 2500);

          try {
            video.load();
          } catch (e) {}
        });
      })
    );
  }

  async function hideWhenReady() {
    warmHomeVideo();
    try {
      await waitForHeroVideos(document);
    } catch (e) {}
    requestAnimationFrame(function () {
      requestAnimationFrame(hideLoader);
    });
  }

  function closeMobileMenu() {
    var burger = document.getElementById("scn-burger");
    var menu = document.getElementById("scn-mobile-menu");
    if (burger) burger.classList.remove("is-open");
    if (menu) menu.setAttribute("hidden", "");
  }

  function updateActiveNav(url) {
    var path;
    try {
      path = new URL(url, window.location.origin).pathname.replace(/\/$/, "") || "/";
    } catch (e) {
      return;
    }
    document.querySelectorAll(".nav-list a, .mobile-nav-list a").forEach(function (a) {
      var li = a.closest("li");
      var href = a.getAttribute("href") || "";
      var aPath;
      try {
        aPath = new URL(href, window.location.origin).pathname.replace(/\/$/, "") || "/";
      } catch (err) {
        return;
      }
      var active = aPath === path;
      a.classList.toggle("is-active", active);
      if (li) {
        li.classList.toggle("current-menu-item", active);
        li.classList.toggle("current_page_item", active);
      }
    });
  }

  function swapPageAssets(doc) {
    document.querySelectorAll('link[id^="elementor-post-"], style[id^="elementor-post-"]').forEach(function (el) {
      el.remove();
    });
    doc.querySelectorAll('link[id^="elementor-post-"], style[id^="elementor-post-"]').forEach(function (el) {
      document.head.appendChild(document.importNode(el, true));
    });
  }

  function waitForImages(root) {
    if (!root) return Promise.resolve();
    var imgs = Array.prototype.slice.call(root.querySelectorAll("img:not(.scn-side-image)"));
    // Side images fade in separately; don't block hero reveal on lazy ball.
    if (!imgs.length) return Promise.resolve();
    return Promise.all(
      imgs.map(function (img) {
        if (img.complete) return Promise.resolve();
        return new Promise(function (resolve) {
          var done = function () {
            resolve();
          };
          img.addEventListener("load", done, { once: true });
          img.addEventListener("error", done, { once: true });
          window.setTimeout(done, 1200);
        });
      })
    );
  }

  function prepareSideImages(root) {
    var scope = root || document;
    scope.querySelectorAll(".scn-side-image").forEach(function (img) {
      if (img.classList.contains("is-ready")) return;
      if (img.complete && img.naturalWidth > 0) {
        img.classList.add("is-ready");
        return;
      }
      img.addEventListener(
        "load",
        function () {
          img.classList.add("is-ready");
        },
        { once: true }
      );
      img.addEventListener(
        "error",
        function () {
          img.classList.add("is-ready");
        },
        { once: true }
      );
    });
  }

  function constrainMedia(root) {
    if (!root) return;
    root.querySelectorAll(".scn-side-image-wrap, .scn-side-image, .scn-hero__video").forEach(function (el) {
      if (el.classList.contains("scn-side-image-wrap")) {
        el.style.maxWidth = "28rem";
        el.style.aspectRatio = "1";
        el.style.overflow = "hidden";
      }
      if (el.classList.contains("scn-side-image")) {
        el.style.maxWidth = "28rem";
        el.style.maxHeight = "28rem";
        el.style.width = "100%";
        el.style.height = "100%";
        el.style.objectFit = "contain";
      }
      if (el.classList.contains("scn-hero__video")) {
        el.style.position = "absolute";
        el.style.inset = "0";
        el.style.width = "100%";
        el.style.height = "100%";
        el.style.objectFit = "cover";
        el.removeAttribute("poster");
      }
    });
  }

  function reinitDynamic(root) {
    try {
      if (window.elementorFrontend && typeof elementorFrontend.init === "function") {
        elementorFrontend.init();
      }
    } catch (e) {}
    if (!root) return;
    prepareSideImages(root);
  }

  async function softNavigate(url, push) {
    if (busy) return;
    busy = true;
    showLoader();
    closeMobileMenu();
    warmHomeVideo();

    try {
      var res = await fetch(url, {
        credentials: "same-origin",
        headers: { "X-Requested-With": "SCN-Nav" },
      });
      if (!res.ok) throw new Error("bad status");
      var html = await res.text();
      var doc = new DOMParser().parseFromString(html, "text/html");
      var newMain = doc.querySelector("main");
      var curMain = document.querySelector("main");
      if (!newMain || !curMain) throw new Error("no main");

      swapPageAssets(doc);
      curMain.replaceWith(document.importNode(newMain, true));

      var newFooter = doc.querySelector(".scn-footer");
      var curFooter = document.querySelector(".scn-footer");
      if (newFooter && curFooter) {
        curFooter.replaceWith(document.importNode(newFooter, true));
      }

      document.title = doc.title || document.title;
      document.body.className = doc.body.className;

      var nextMain = document.querySelector("main");
      // Keep content under the opaque loader (do NOT visibility:hidden — blocks video decode).
      constrainMedia(nextMain);

      updateActiveNav(url);
      if (push !== false) {
        history.pushState({ scnSoft: 1 }, "", url);
      }
      window.scrollTo(0, 0);
      reinitDynamic(nextMain);

      await waitForHeroVideos(nextMain);
      await waitForImages(nextMain);

      await new Promise(function (resolve) {
        requestAnimationFrame(function () {
          requestAnimationFrame(resolve);
        });
      });

      hideLoader();
    } catch (err) {
      window.location.href = url;
      return;
    } finally {
      busy = false;
    }
  }

  function shouldSoftNav(link, e) {
    if (e.defaultPrevented) return false;
    if (link.target === "_blank" || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return false;
    var href = link.getAttribute("href");
    if (!href || href.startsWith("#") || href.startsWith("mailto:") || href.startsWith("tel:")) return false;
    try {
      var url = new URL(href, window.location.origin);
      if (url.origin !== window.location.origin) return false;
      if (url.pathname === window.location.pathname && url.search === window.location.search) return false;
      if (/\/wp-admin|\/wp-login|\/wp-json|\.(pdf|zip|docx?)$/i.test(url.pathname)) return false;
      return url.href;
    } catch (err) {
      return false;
    }
  }

  warmHomeVideo();
  if (document.readyState === "complete") {
    hideWhenReady();
  } else {
    window.addEventListener("load", hideWhenReady, { once: true });
    // Also kick hero wait early on DOM ready
    document.addEventListener("DOMContentLoaded", function () {
      waitForHeroVideos(document);
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    prepareSideImages(document);
    var burger = document.getElementById("scn-burger");
    var menu = document.getElementById("scn-mobile-menu");
    if (burger && menu) {
      burger.addEventListener("click", function () {
        var open = burger.classList.toggle("is-open");
        if (open) menu.removeAttribute("hidden");
        else menu.setAttribute("hidden", "");
      });
    }
  });

  document.addEventListener("click", function (e) {
    var link = e.target.closest && e.target.closest("a[href]");
    if (!link) return;
    var next = shouldSoftNav(link, e);
    if (!next) return;
    e.preventDefault();
    softNavigate(next, true);
  });

  window.addEventListener("popstate", function () {
    softNavigate(window.location.href, false);
  });
})();
