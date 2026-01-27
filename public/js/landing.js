"use strict";

/* =========================
   TOOLTIP & POPOVER
========================= */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
[...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
[...popoverTriggerList].map(el => new bootstrap.Popover(el));

/* =========================
   CHOICES JS
========================= */
document.addEventListener("DOMContentLoaded", () => {
  const genericExamples = document.querySelectorAll("[data-trigger]");
  genericExamples.forEach(element => {
    new Choices(element, {
      allowHTML: true,
      placeholderValue: "This is a placeholder set in the config",
      searchPlaceholderValue: "Search",
    });
  });
});

/* =========================
   SWITCHER INIT
========================= */
let mainContent;

(function () {
  mainContent = document.querySelector(".main-content");
  localStorageBackup();
//   switcherClick();
  checkOptions();
})();

/* =========================
   SWITCHER EVENTS
========================= */
// function switcherClick() {
//   const html = document.documentElement;
//   const lightBtn = document.querySelector("#switcher-light-theme");
//   const darkBtn = document.querySelector("#switcher-dark-theme");

//     lightBtn?.addEventListener("click", () => {
//     lightFn();
//     });

//     darkBtn?.addEventListener("click", () => {
//     darkFn();
//     });
// }

/* =========================
   THEME TOGGLE ADAPTER
========================= */
document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("theme-toggle");
  const label = document.getElementById("theme-toggle-label");

  if (!toggle) return;

  function syncToggle() {
    const isDark = document.documentElement.getAttribute("data-theme-mode") === "dark";
    toggle.checked = isDark;
    label.textContent = isDark ? "Mode Gelap" : "Mode Terang";
  }

  toggle.addEventListener("change", () => {
    toggle.checked ? darkFn() : lightFn();
    syncToggle();
  });

  syncToggle();
});

/* =========================
   THEME FUNCTIONS
========================= */
function lightFn() {
  const html = document.documentElement;
  html.setAttribute("data-theme-mode", "light");
//   document.querySelector("#switcher-light-theme").checked = true;
  localStorage.removeItem("vyzordarktheme");
  updateColors();
  checkOptions();
}

function darkFn() {
  const html = document.documentElement;
  html.setAttribute("data-theme-mode", "dark");
  localStorage.setItem("vyzordarktheme", true);
  updateColors();
  checkOptions();
}

function checkOptions() {
  if (localStorage.getItem("vyzordarktheme")) {
    // document.querySelector("#switcher-dark-theme").checked = true;
  }
}

/* =========================
   COLOR HANDLER
========================= */
let primaryRGB;

function updateColors() {
  primaryRGB = getComputedStyle(document.documentElement)
    .getPropertyValue("--primary-rgb")
    .trim();
}
updateColors();

/* =========================
   LOCAL STORAGE BACKUP
========================= */
function localStorageBackup() {
  const toggle = document.getElementById("theme-toggle");

  if (localStorage.primaryRGB) {
    document.documentElement.style.setProperty(
      "--primary-rgb",
      localStorage.primaryRGB
    );
  }

//   if (localStorage.vyzordarktheme === "true") {
//     document.documentElement.setAttribute("data-theme-mode", "dark");
//     
//     // if (toggle) toggle.checked = true;
//   } else {
//     document.documentElement.setAttribute("data-theme-mode", "light");
//     if (toggle) toggle.checked = false;
//   }

  if (localStorage.vyzordarktheme) {
    document.documentElement.setAttribute("data-theme-mode", "dark");
  }
}

/* =========================
   FOOTER YEAR
========================= */
const yearElement = document.getElementById("year");
if (yearElement) {
  yearElement.innerHTML = new Date().getFullYear();
}

/* =========================
   MENU ACTIVE ON SCROLL
========================= */
function onScroll() {
  const sections = document.querySelectorAll(".side-menu__item");
  const scrollPos = window.pageYOffset || document.documentElement.scrollTop;

  sections.forEach(elem => {
    const target = elem.getAttribute("href");
    if (!target || target === "#" || target === "javascript:void(0);") return;

    const refElement = document.querySelector(target);
    const scrollTopMinus = scrollPos + 73;

    if (
      refElement &&
      refElement.offsetTop <= scrollTopMinus &&
      refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
    ) {
      elem.classList.add("active");
      elem.closest(".child1")?.previousElementSibling?.classList.add("active");
    } else {
      elem.classList.remove("active");
    }
  });
}
document.addEventListener("scroll", onScroll);

/* =========================
   BACK TO TOP
========================= */
const scrollToTop = document.querySelector(".scrollToTop");

window.addEventListener("scroll", () => {
  scrollToTop.style.display = window.scrollY > 100 ? "flex" : "none";
});

scrollToTop?.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

/* =========================
   SWIPERS
========================= */
new Swiper(".trusted-clients", {
  loop: true,
  slidesPerView: 5,
  spaceBetween: 30,
  autoplay: { delay: 1500, disableOnInteraction: false },
  breakpoints: {
    320: { slidesPerView: 1, spaceBetween: 5 },
    640: { slidesPerView: 1, spaceBetween: 5 },
    768: { slidesPerView: 3, spaceBetween: 5 },
    1024: { slidesPerView: 5, spaceBetween: 20 },
  },
});

new Swiper(".testimonialSwiperService", {
  slidesPerView: 2,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
    clickable: true,
  },
  autoplay: { delay: 3000, disableOnInteraction: false },
  breakpoints: {
    320: { slidesPerView: 1, spaceBetween: 10 },
    480: { slidesPerView: 1, spaceBetween: 10 },
    1112: { slidesPerView: 2, spaceBetween: 10 },
    1300: { slidesPerView: 2, spaceBetween: 30 },
  },
});
