const toggleBtn = document.getElementById("toggleBtn");
const sidebar = document.getElementById("sidebar");
const sidebarTexts = document.querySelectorAll(".sidebar-text");
const toggleIcon = toggleBtn.querySelector("i");

const reportsBtn = document.getElementById("reportsBtn");
const reportsMenu = document.getElementById("reportsMenu");
const arrowIcon = reportsBtn.querySelector(".fa-regular");

const userMenuBtn = document.getElementById("userMenuBtn");
const userMenu = document.getElementById("userMenu");

// Toggle sidebar expand/collapse
toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("w-58");
    sidebar.classList.toggle("w-18");

    sidebarTexts.forEach(el => {
        el.classList.toggle("hidden");
    });

    if (sidebar.classList.contains("w-18")) {
        toggleIcon.setAttribute("data-lucide", "chevrons-right");
    } else {
    toggleIcon.setAttribute("data-lucide", "chevrons-left");
    }
        lucide.createIcons();
    });

// Toggle submenu
reportsBtn.addEventListener("click", () => {
  reportsMenu.classList.toggle("hidden");

  if (reportsMenu.classList.contains("hidden")) {
    arrowIcon.classList.remove("fa-square-caret-down");
    arrowIcon.classList.add("fa-square-caret-right");
  } else {
    arrowIcon.classList.remove("fa-square-caret-right");
    arrowIcon.classList.add("fa-square-caret-down");
  }
});

// Toggle user menu
userMenuBtn.addEventListener("click", () => {
  userMenu.classList.toggle("hidden");
});

// Cierra el menú al hacer clic fuera
window.addEventListener("click", (e) => {
  if (!userMenuBtn.contains(e.target) && !userMenu.contains(e.target)) {
    userMenu.classList.add("hidden");
  }
});


// Inicializa los íconos
lucide.createIcons();
