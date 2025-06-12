
    document.addEventListener("DOMContentLoaded", () => {
    const menu = document.getElementById("menu");
    const menu1 = document.getElementById("menu1");
    const menu2 = document.getElementById("menu2");
    const menu3 = document.getElementById("menu3");

    const submenu1 = document.getElementById("submenu1");

    const menuIcon = document.getElementById("menuIcon");
    const closeIcon = document.getElementById("closeIcon");

    const button = document.getElementById("CloseOpenButton");

    const mainsection = document.getElementById("mainsection");

    // Fonction pour détecter le type d'appareil
    function detectedDevice() {
      const userAgent = navigator.userAgent || navigator.vendor || window.opera;

      if (/android/i.test(userAgent)) return "Android";
      if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) return "iOS";
      if (/windows phone/i.test(userAgent)) return "Windows Phone";

      return "Desktop";
    }

    // Gestion de l'ouverture/fermeture du menu
    button.addEventListener("click", () => {
    if (menuIcon.classList.contains("hidden")) {
      menuIcon.classList.remove("hidden");
      closeIcon.classList.add("hidden");
    } else {
      menuIcon.classList.add("hidden");
      closeIcon.classList.remove("hidden");
    }

    if (menu.classList.contains("opacity-0")) {
      menu.classList.remove("opacity-0", "invisible");
      menu.classList.add("opacity-100", "visible", "translate-y-0");
    } else {
      menu.classList.add("opacity-0", "invisible");
      menu.classList.remove("opacity-100", "visible", "translate-y-0");
    }
    
  });

  // Gestion des sous-menus
  function setupSubmenuHandlers() {
    const device = detectedDevice();
    console.log("Device detected:", device);

    // Nettoyer les écouteurs précédents
    menu1.replaceWith(menu1.cloneNode(true));
    menu2.replaceWith(menu2.cloneNode(true));
    menu3.replaceWith(menu3.cloneNode(true));
    const newMenu1 = document.getElementById("menu1");
    const newSubmenu1 = document.getElementById("submenu1");
    const newMenu2 = document.getElementById("menu2");
    const newSubmenu2 = document.getElementById("submenu2");
    const newMenu3 = document.getElementById("menu3");
    const newSubmenu3 = document.getElementById("submenu3");
    
    if (device === "Desktop") {
      // Desktop: Utiliser les événements hover
      //--Menu 1
      newMenu1.addEventListener("mouseenter", () => {
            newSubmenu1.classList.remove("hidden");
            newSubmenu2.classList.add("hidden");
            newSubmenu3.classList.add("hidden");
      });
      newSubmenu1.addEventListener("mouseleave", () => {
            newSubmenu1.classList.add("hidden");
      });
      //--Menu 2
      newMenu2.addEventListener("mouseenter", () => {
            newSubmenu2.classList.remove("hidden");
            newSubmenu1.classList.add("hidden");
            newSubmenu3.classList.add("hidden");
      });
      newSubmenu2.addEventListener("mouseleave", () => {
            newSubmenu2.classList.add("hidden");
      });

      //--Menu 3
      newMenu3.addEventListener("mouseenter", () => {
            newSubmenu3.classList.remove("hidden");
            newSubmenu1.classList.add("hidden");
            newSubmenu2.classList.add("hidden");
      });
      newSubmenu3.addEventListener("mouseleave", () => {
            newSubmenu3.classList.add("hidden");
      });
      
    } else {
        // Mobile/Tablet: Utiliser les événements click
        // Menu 1
        newMenu1.addEventListener("click", () => {
            newSubmenu1.classList.toggle("hidden");
            newSubmenu2.classList.add("hidden");
            newSubmenu3.classList.add("hidden");
        });

        // Menu 2
        newMenu2.addEventListener("click", () => {
            newSubmenu2.classList.toggle("hidden");
            newSubmenu1.classList.add("hidden");
            newSubmenu3.classList.add("hidden");
        });

        // Menu 3
        newMenu3.addEventListener("click", () => {
            newSubmenu3.classList.toggle("hidden");
            newSubmenu1.classList.add("hidden");
            newSubmenu2.classList.add("hidden");
        });
    }
  }

  // Gestion du redimensionnement ou changement d'orientation
  function handleResize() {
    setupSubmenuHandlers(); // Réinitialise les écouteurs selon le contexte
  }

  window.addEventListener("resize", handleResize);
  window.addEventListener("orientationchange", handleResize);

  // Initialisation
  handleResize();
});

