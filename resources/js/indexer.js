const slides = document.querySelectorAll(".slide");

document.addEventListener("keyup", function (event) {
    setTimeout(() => {
        const current = document.querySelector(".current");

        const input = isFinite(event.key);

        if (input) {
            current.classList.remove("current");

            slides[parseInt(event.key)].classList.add("current");
        }
    }, 1000);
});
