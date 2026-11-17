document.querySelectorAll(".site-nav").forEach((navigation) => {
  const toggle = navigation.querySelector(".site-nav__toggle");
  const panel = navigation.querySelector(".site-nav__panel");

  if (!toggle || !panel) {
    return;
  }

  const supportsPopover = typeof panel.hidePopover === "function";
  const desktop = window.matchMedia("(width > 44rem)");
  let lastFocused;

  if (desktop.matches || !supportsPopover) {
    if (supportsPopover && panel.matches(":popover-open")) {
      panel.hidePopover();
    }
    panel.removeAttribute("popover");
  } else {
    panel.setAttribute("popover", "auto");
  }

  const focusPanel = () => {
    const hadTabIndex = panel.hasAttribute("tabindex");
    if (!hadTabIndex) {
      panel.setAttribute("tabindex", "-1");
    }
    panel.focus({ preventScroll: true });
    if (!hadTabIndex) {
      panel.removeAttribute("tabindex");
    }
  };

  const positionSubmenus = () => {
    if (!desktop.matches) {
      return;
    }

    panel.querySelectorAll(".site-nav__links details > ul").forEach((submenu) => {
      if (getComputedStyle(submenu).display === "none") {
        return;
      }

      const details = submenu.parentElement;
      details.classList.remove("is-reversed");
      submenu.style.removeProperty("--site-nav-submenu-shift");

      let rect = submenu.getBoundingClientRect();
      if (rect.width === 0) {
        return;
      }
      const overflow = (bounds) => Math.max(0, -bounds.left) + Math.max(0, bounds.right - window.innerWidth);
      if (overflow(rect) > 0) {
        details.classList.add("is-reversed");
        const reversed = submenu.getBoundingClientRect();
        if (overflow(reversed) < overflow(rect)) {
          rect = reversed;
        } else {
          details.classList.remove("is-reversed");
        }
      }

      const shift = Math.max(0, -rect.left) - Math.max(0, rect.right - window.innerWidth);
      if (shift !== 0) {
        submenu.style.setProperty("--site-nav-submenu-shift", `${shift}px`);
      }
    });
  };

  navigation.addEventListener("pointerover", positionSubmenus);
  navigation.addEventListener("focusin", positionSubmenus);
  navigation.addEventListener("toggle", positionSubmenus, true);
  window.addEventListener("resize", positionSubmenus);
  positionSubmenus();

  desktop.addEventListener("change", () => {
    if (!desktop.matches) {
      return;
    }

    if (panel.querySelector(".site-nav__links")?.contains(document.activeElement)) {
      focusPanel();
    }
    panel.querySelectorAll(".site-nav__links details[open]").forEach((details) => {
      details.open = false;
    });
  });

  if (!supportsPopover) {
    return;
  }

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

  desktop.addEventListener("change", () => {
    if (desktop.matches && panel.matches(":popover-open")) {
      const restoreNavigationFocus = document.activeElement === toggle
        || panel.contains(document.activeElement)
        || lastFocused === toggle;
      panel.hidePopover();
      panel.removeAttribute("popover");
      if (restoreNavigationFocus) {
        window.requestAnimationFrame(focusPanel);
      }
    } else if (desktop.matches) {
      panel.removeAttribute("popover");
    } else {
      panel.setAttribute("popover", "auto");
      if (
        !panel.matches(":popover-open")
        && (
          panel.contains(document.activeElement)
          || (document.activeElement === document.body && panel.contains(lastFocused))
        )
      ) {
        toggle.focus({ preventScroll: true });
      }
    }
  });
});
