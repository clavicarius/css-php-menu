document.querySelectorAll(".site-nav").forEach((navigation) => {
  const toggle = navigation.querySelector(".site-nav__toggle");
  const panel = navigation.querySelector(".site-nav__panel");

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
      const availableHeight = window.innerHeight - navigation.getBoundingClientRect().bottom;
      panel.style.maxBlockSize = `${Math.max(0, availableHeight)}px`;
    } else {
      panel.style.removeProperty("max-block-size");
    }
  };

  panel.addEventListener("toggle", () => {
    toggle.setAttribute("aria-expanded", String(panel.matches(":popover-open")));
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
