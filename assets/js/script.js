// ============================
// 🌙 DARK MODE FIX FINAL
// ============================

const toggle = document.getElementById('toggleDark');
const body = document.body;

// SET AWAL
function setTheme(theme) {
  if (theme === "dark") {
    body.classList.add("dark-mode");
    if (toggle) toggle.innerHTML = '<i class="bi bi-sun"></i>';
  } else {
    body.classList.remove("dark-mode");
    if (toggle) toggle.innerHTML = '<i class="bi bi-moon"></i>';
  }
}

// LOAD SAAT AWAL
let savedTheme = localStorage.getItem("theme") || "light";
setTheme(savedTheme);

// CLICK TOGGLE
if (toggle) {
  toggle.addEventListener("click", function () {

    let isDark = body.classList.contains("dark-mode");

    if (isDark) {
      setTheme("light");
      localStorage.setItem("theme", "light");
    } else {
      setTheme("dark");
      localStorage.setItem("theme", "dark");
    }

  });
}