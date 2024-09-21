
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.simple-logo-slider-container');
    const items = document.querySelectorAll('.simple-logo-slider-item');
    const prevBtn = document.querySelector('.slider-control-left');
    const nextBtn = document.querySelector('.slider-control-right');

    // Calculate the width of simple-logo-slider-wrapper
    const sliderWrapper = document.querySelector('.simple-logo-slider-wrapper');
    const sliderWrapperWidth = sliderWrapper.offsetWidth;
    console.log('sliderWrapperWidth', sliderWrapperWidth);
    // slider.style.width = `${sliderWrapperWidth}px`;

    let currentIndex = 0;
    const itemWidth = items[0].offsetWidth + 16; // Including the gap (16px)

    // Clone first and last items for infinite effect
    const firstClone = items[0].cloneNode(true);
    const lastClone = items[items.length - 1].cloneNode(true);
    slider.appendChild(firstClone);
    slider.insertBefore(lastClone, items[0]);

    // Adjust the transform to show the first real item
    slider.style.transform = `translateX(${-itemWidth}px)`;

    // Move to the next slide
    const nextSlide = () => {
        currentIndex++;
        slider.style.transition = 'transform .5s ease';
        slider.style.transform = `translateX(${-itemWidth * (currentIndex + 1)}px)`;

        // Check if we've reached the end of the slides
        if (currentIndex >= items.length) {
            setTimeout(() => {
                slider.style.transition = 'none';
                slider.style.transform = `translateX(${-itemWidth}px)`;
                currentIndex = 0;
            }, 1000);
        }
    };

    // Move to the previous slide
    const prevSlide = () => {
        currentIndex--;
        slider.style.transition = 'transform .5s ease';
        slider.style.transform = `translateX(${-itemWidth * (currentIndex + 1)}px)`;

        // Check if we've reached the start of the slides
        if (currentIndex < 0) {
            setTimeout(() => {
                slider.style.transition = 'none';
                slider.style.transform = `translateX(${-itemWidth * items.length}px)`;
                currentIndex = items.length - 1;
            }, 1000);
        }
    };

    // Event listeners for the controls
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    // Infinite loop effect
    slider.addEventListener('transitionend', () => {
        if (currentIndex === items.length) {
            slider.style.transition = 'none';
            slider.style.transform = `translateX(${-itemWidth}px)`;
            currentIndex = 0;
        }
        if (currentIndex === -1) {
            slider.style.transition = 'none';
            slider.style.transform = `translateX(${-itemWidth * items.length}px)`;
            currentIndex = items.length - 1;
        }
    });

    // Auto-slide every 3 seconds
    const autoSlide = setInterval(nextSlide, 3000); // 3000 ms = 3 seconds

    // Optional: Pause auto-slide on hover and resume when not hovering
    // const sliderWrapper = document.querySelector('.simple-logo-slider-wrapper');
    // sliderWrapper.addEventListener('mouseover', () => {
    //     clearInterval(autoSlide); // Stop auto-slide on hover
    // });
    // sliderWrapper.addEventListener('mouseout', () => {
    //     setInterval(nextSlide, 3000); // Resume auto-slide when not hovering
    // });
});
