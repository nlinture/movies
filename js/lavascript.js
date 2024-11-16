let currentIndex = 0;
let moveBy = 480;
const totalSlides = document.querySelectorAll('.slide').length;
const slider = document.querySelector('.slider');
function slideRight() {
    const sliderWidth = slider.offsetWidth;
    const maxMove = (totalSlides * moveBy) - sliderWidth;
    // Move to the next slide
    if (currentIndex * moveBy < maxMove) { // Prevent scrolling beyond last image
        currentIndex++;
    } else {
        currentIndex = 0; // Optional: loop back to start
    }

    // Shift the slider to the left
    updateSliderPosition();
}

function slideLeft() {

    // Move to the previous slide
    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = totalSlides - 1;  // Optional: wrap to end
    }

    // Shift the slider to the right
    updateSliderPosition();
}
function updateSliderPosition() {
    const shiftValue = -(currentIndex * moveBy); // Move by a fixed number of pixels
    slider.style.transform = `translateX(${shiftValue}px)`;
}

document.querySelector('.slider-container').addEventListener('wheel', (event) => {
    const slides = document.querySelectorAll('.slide');
    // Prevent the default scroll behavior
    event.preventDefault();

    // Scroll down = next slide (move left)
    if (event.deltaY > 0) {
        currentIndex++;
    }
    // Scroll up = previous slide (move right)
    else {
        currentIndex--;
    }

    // Loop back to the first/last set of images
    if (currentIndex > totalSlides - 2) {
        currentIndex = 0;
    } else if (currentIndex < 0) {
        currentIndex = totalSlides - 2; // Show last set of images
    }

    // Move the slider
    const shiftValue = -(currentIndex * 20);  // Shift by 1/3 of the viewport width (33.33vw)
    slider.style.transform = `translateX(${shiftValue}vw)`;
});
window.addEventListener("resize", () => {
    updateSliderPosition(); // Re-adjust position on resize
});