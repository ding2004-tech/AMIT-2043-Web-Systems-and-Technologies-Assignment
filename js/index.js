function updateCountdown() {
    var conferenceStartDate = new Date(Date.UTC(2024, 5, 5));
    var now = new Date();
    var timeRemaining = conferenceStartDate - now;
    var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
    document.getElementById('countdown').innerHTML =  days + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + hours + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + minutes + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + seconds;
}

updateCountdown();
setInterval(updateCountdown, 1000);

const slider = document.querySelector('.slider');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');
const cardWidth = document.querySelector('.card').offsetWidth;
const cardsLength = document.querySelectorAll('.card').length;
let index = 0;

prevBtn.addEventListener('click', () => {
    index = Math.max(index - 1, 0);
    slider.style.transform = `translateX(-${index * (cardWidth + 30)}px)`;
});

nextBtn.addEventListener('click', () => {
    index = Math.min(index + 1, cardsLength - 3);
    slider.style.transform = `translateX(-${index * (cardWidth + 30)}px)`;
});

let currentSlide = 0;
const slides = document.querySelectorAll('.photo-container');
const numSlides = slides.length;
const slidesPerRow = 3;
let currentRow = 0;

function showSlide(n) {
    slides.forEach(slide => {
        slide.style.display = 'none';
    });
    const startIndex = n * slidesPerRow;
    const endIndex = Math.min(startIndex + slidesPerRow, numSlides);
    for (let i = startIndex; i < endIndex; i++) {
        slides[i].style.display = 'block';
    }
}

function nextSlide() {
    currentRow = (currentRow + 1) % Math.ceil(numSlides / slidesPerRow);
    showSlide(currentRow);
}

function prevSlide() {
    currentRow = (currentRow - 1 + Math.ceil(numSlides / slidesPerRow)) % Math.ceil(numSlides / slidesPerRow);
    showSlide(currentRow);
}

showSlide(currentRow);
setInterval(nextSlide, 5000);

function click() {
    window.location.href = "ticket.php?event_id=25";
}
