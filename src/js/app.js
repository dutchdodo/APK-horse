// Navigation toggle
window.addEventListener("DOMContentLoaded", () => {
  const body = document.body;
  const button = document.querySelector("#primary-menu-toggle");

  let lastFocusedElement = null;

  function openMenu() {
    lastFocusedElement = document.activeElement;

    body.classList.add("menuopen");
    button.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  }

  function closeMenu() {
    body.classList.remove("menuopen");
    button.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";

    if (lastFocusedElement) lastFocusedElement.focus();
  }

  function toggleMenu() {
    const isOpen = button.getAttribute("aria-expanded") === "true";
    isOpen ? closeMenu() : openMenu();
  }

  button.addEventListener("click", toggleMenu);

  // ESC sluit menu
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeMenu();
  });

  // 🔒 Focus trap (belangrijk voor WCAG)
  document.addEventListener("keydown", (e) => {
    if (button.getAttribute("aria-expanded") !== "true") return;
    if (e.key !== "Tab") return;

    const menu = document.querySelector("#main-menu");
    const focusables = menu.querySelectorAll(
      'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'
    );

    if (!focusables.length) return;

    const first = focusables[0];
    const last = focusables[focusables.length - 1];

    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault();
      last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault();
      first.focus();
    }
  });
});