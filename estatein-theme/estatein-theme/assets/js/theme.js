document.addEventListener("DOMContentLoaded", () => {
  const topbar = document.getElementById("topbar");
  const closeBtn = document.getElementById("topbarClose");

  if (topbar && closeBtn) {
    closeBtn.addEventListener("click", () => {
      topbar.style.display = "none";
    });
  }
});
