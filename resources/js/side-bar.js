document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const toggleArrow = document.getElementById("toggleArrow");
    const sidebarText = document.querySelectorAll(".sidebar-text");

    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("w-64");
        sidebar.classList.toggle("w-16");

        toggleArrow.classList.toggle("rotate-180");

        sidebarText.forEach((text) => {
            text.classList.toggle("hidden");
        });
    });
});
