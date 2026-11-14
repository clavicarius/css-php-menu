document.querySelectorAll(".site-nav").forEach((navigation) => {
  const toggle = navigation.querySelector(".site-nav__toggle");
  const panel = navigation.querySelector(".site-nav__panel");

  navigation.addEventListener("keydown", (event) => {
    if (event.key !== "Escape") {
      return;
    }

    const submenu = event.target instanceof Element
      ? event.target.closest("details[open]")
      : null;
    if (!submenu) {
      return;
    }

    const summary = submenu.querySelector(":scope > summary");
    if (summary) {
      event.preventDefault();
      submenu.open = false;
      summary.focus({ preventScroll: true });
    }
  });

  if (!toggle || !panel || typeof panel.hidePopover !== "function") {
    return;
  }

  let lastFocused;
  navigation.addEventListener("focusin", (event) => {
    lastFocused = event.target;
  });

  navigation.addEventListener("click", (event) => {
    if (event.target.closest(".site-nav__panel a") && panel.matches(":popover-open")) {
      panel.hidePopover();
    }
  });

  const updatePanelSize = () => {
    if (panel.matches(":popover-open")) {
      const top = Math.max(0, Math.min(window.innerHeight, navigation.getBoundingClientRect().bottom));
      const availableHeight = window.innerHeight - top;
      panel.style.setProperty("--site-nav-panel-top", `${top}px`);
      panel.style.maxBlockSize = `${Math.max(0, availableHeight)}px`;
    } else {
      panel.style.removeProperty("--site-nav-panel-top");
      panel.style.removeProperty("max-block-size");
    }
  };

  const updateExpanded = () => {
    toggle.setAttribute("aria-expanded", String(panel.matches(":popover-open")));
  };
  updateExpanded();

  panel.addEventListener("toggle", () => {
    updateExpanded();
    updatePanelSize();
    if (
      !panel.matches(":popover-open")
      && panel.contains(document.activeElement)
      && getComputedStyle(toggle).display !== "none"
    ) {
      toggle.focus();
    }
  });

  window.addEventListener("resize", updatePanelSize);
  window.addEventListener("scroll", updatePanelSize, true);

  const desktop = window.matchMedia("(min-width: 40.0625rem)");
  desktop.addEventListener("change", () => {
    if (desktop.matches && panel.matches(":popover-open")) {
      const restoreNavigationFocus = document.activeElement === toggle || lastFocused === toggle;
      panel.hidePopover();
      if (restoreNavigationFocus) {
        window.requestAnimationFrame(() => panel.querySelector("a, summary")?.focus({ preventScroll: true }));
      }
    } else if (
      !desktop.matches
      && !panel.matches(":popover-open")
      && (
        panel.contains(document.activeElement)
        || (document.activeElement === document.body && panel.contains(lastFocused))
      )
    ) {
      toggle.focus({ preventScroll: true });
    }
  });
});
