document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    if (dropdownButton && dropdownMenu) {
        if (window.innerWidth < 768) {
            dropdownButton.addEventListener("click", () => {
                dropdownMenu.classList.toggle("hidden");
            });
        } else {
            dropdownButton.addEventListener("mouseenter", () => {
                dropdownMenu.classList.remove("hidden");
            });

            dropdownButton.addEventListener("mouseleave", () => {
                setTimeout(() => {
                    if (!dropdownMenu.matches(":hover")) {
                        dropdownMenu.classList.add("hidden");
                    }
                }, 200);
            });

            dropdownMenu.addEventListener("mouseleave", () => {
                dropdownMenu.classList.add("hidden");
            });
        }
    }
});