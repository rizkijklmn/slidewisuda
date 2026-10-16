const slides = document.querySelectorAll(".slide");
const auto = false; // Auto scroll
const intervalTime = 5000;
let slideInterval;

// Preload cache set to avoid duplicate image requests
const preloadedUrls = new Set();

const preloadImage = (imgElement) => {
    if (!imgElement || !imgElement.src) return;
    const url = imgElement.src;
    if (preloadedUrls.has(url)) return;
    preloadedUrls.add(url);
    const img = new Image();
    img.src = url;
};

// Preload images around target index (8 slides ahead and 2 slides behind)
const preloadImagesAround = (targetIndex) => {
    if (!slides || slides.length === 0) return;
    for (let offset = -2; offset <= 8; offset++) {
        const idx = (targetIndex + offset + slides.length) % slides.length;
        const img = slides[idx]?.querySelector("img");
        preloadImage(img);
    }
};

const getCurrentIndex = () => {
    const current = document.querySelector(".current");
    return Array.from(slides).indexOf(current);
};

const goToSlide = (newIndex) => {
    if (!slides || slides.length === 0 || newIndex < 0 || newIndex >= slides.length) return;
    const current = document.querySelector(".current");
    if (current) {
        current.classList.remove("current");
    }
    const target = slides[newIndex];
    if (target) {
        target.classList.add("current");
        preloadImagesAround(newIndex);
    }
};

const nextSlide = () => {
    const currentIndex = getCurrentIndex();
    const nextIndex = (currentIndex + 1) % slides.length;
    goToSlide(nextIndex);
};

const prevSlide = () => {
    const currentIndex = getCurrentIndex();
    const prevIndex = (currentIndex - 1 + slides.length) % slides.length;
    goToSlide(prevIndex);
};

// Jump to a slide by nomor urut or slide index
const jumpToNumber = (num) => {
    const targetNum = Number.parseInt(num, 10);
    if (isNaN(targetNum)) return;

    // 1. Coba cari berdasarkan nomor urut wisudawan (data-urut)
    const byUrutIndex = Array.from(slides).findIndex(
        (s) => s.dataset.urut && Number.parseInt(s.dataset.urut, 10) === targetNum
    );

    if (byUrutIndex !== -1) {
        console.log(`Lompat ke wisudawan dengan nomor urut: ${targetNum} (slide ke-${byUrutIndex + 1})`);
        goToSlide(byUrutIndex);
        return;
    }

    // 2. Jika tidak ditemukan nomor urut, cari berdasarkan urutan slide (1-based index)
    if (targetNum >= 1 && targetNum <= slides.length) {
        console.log(`Lompat ke urutan slide ke-${targetNum}`);
        goToSlide(targetNum - 1);
        return;
    }

    console.warn(`Nomor ${targetNum} tidak ditemukan. Total slide yang dimuat: ${slides.length}`);
};

// Preload initial batch on load
if (slides.length > 0) {
    const initialIndex = getCurrentIndex() >= 0 ? getCurrentIndex() : 0;
    preloadImagesAround(initialIndex);
}

// Keyboard controls
document.addEventListener("keydown", function (e) {
    // Abaikan jika user sedang mengetik di input form
    if (["INPUT", "TEXTAREA", "SELECT"].includes(document.activeElement?.tagName)) {
        return;
    }

    switch (e.key) {
        case "ArrowLeft":
            prevSlide();
            if (auto) {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, intervalTime);
            }
            break;
        case "ArrowRight":
            nextSlide();
            if (auto) {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, intervalTime);
            }
            break;
    }
});

var timeout = null;
var inputVal = "";

document.addEventListener("keydown", function (event) {
    // Abaikan jika fokus di input field form
    if (["INPUT", "TEXTAREA", "SELECT"].includes(document.activeElement?.tagName)) {
        return;
    }

    // Jika user menekan Enter untuk langsung lompat tanpa menunggu timeout
    if (event.key === "Enter" && inputVal.length > 0) {
        clearTimeout(timeout);
        jumpToNumber(inputVal);
        inputVal = "";
        return;
    }

    // Jika user menekan Backspace untuk membatalkan digit terakhir
    if (event.key === "Backspace" && inputVal.length > 0) {
        clearTimeout(timeout);
        inputVal = inputVal.slice(0, -1);
        return;
    }

    // Tangkap hanya karakter angka 0-9
    if (event.key >= "0" && event.key <= "9") {
        clearTimeout(timeout);
        inputVal += event.key;

        timeout = setTimeout(function () {
            jumpToNumber(inputVal);
            inputVal = "";
        }, 1000); // 1000ms memberi waktu yang cukup untuk mengetik nomor 3-4 digit
    }
});

