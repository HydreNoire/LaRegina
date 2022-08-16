// ==========> FUNCTION FOR HORIZONTAL SCROLL
const scrollContainer = document.querySelector('.scrollable-div');
const card = document.querySelector(".card");

// scrollContainer.addEventListener('wheel', (evt) => {
//     evt.preventDefault();

//     let scroll = getComputedStyle(scrollContainer).getPropertyValue("scroll-behavior");
//     scroll = "auto";
//     scrollContainer.scrollLeft += evt.deltaY;
//     scroll = "smooth";
// });

// ==========> FUNCTION FOR CUSTOM CURSOR 
const cursor = document.querySelector('.cursor');

document.addEventListener('mousemove', e => {
    cursor.setAttribute("style", "top: " + (e.pageY - 15) + "px; left: " + (e.pageX - 15) + "px;");
})

document.addEventListener('click', animOnClick);

function animOnClick() {
    cursor.classList.add('onClick');

    setTimeout(() => {
        cursor.classList.remove('onClick');
    }, 250)
}

// ==========> FuNCTION FOR BUTTON SLIDE AND ANIMATION
// const nextSlide = document.querySelector(".btn-card-next");
// const prevSlide = document.querySelector(".btn-card-prev");

// nextSlide.addEventListener("click", () => {
//     const slideWidth = card.clientWidth;
//     scrollContainer.scrollLeft += slideWidth;
// });

// prevSlide.addEventListener("click", () => {
//     const slideWidth = card.clientWidth;
//     scrollContainer.scrollLeft -= slideWidth;
// });