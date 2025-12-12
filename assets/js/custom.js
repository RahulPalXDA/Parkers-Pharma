let menu = document.getElementById('topNavBar');
let offset = menu.offsetHeight;
window.onscroll = function () {
  if (window.scrollY > offset - 10) {
    menu.classList.add("sticky");
  } else if (window.scrollY < offset - 20) {
    menu.classList.remove("sticky");
  }
}


// Wait for the DOM (Document Object Model) to be fully loaded
document.addEventListener("DOMContentLoaded", function (event) {
  var navbarToggler = document.querySelectorAll(".navbar-toggler")[0];
  navbarToggler.addEventListener("click", function (e) {
    e.target.children[0].classList.toggle("active");
  });

  var html = document.querySelectorAll("html")[0];

  var themeToggle = document.querySelectorAll("*[data-bs-toggle-theme]")[0];

  html.setAttribute("data-bs-theme", "dark");

  if (themeToggle) {
    themeToggle.addEventListener("click", function (event) {
      event.preventDefault();

      if (html.getAttribute("data-bs-theme") === "dark") { } else {
        html.setAttribute("data-bs-theme", "dark");
      }
    });
  }
});

jQuery(function ($) {
  // client feedback owl slider
  $('.client-quote').owlCarousel({
    nav: true,
    navText: [
      '<button class="owl-prev"><i class="fa-solid fa-arrow-left"></i></button>',
      '<button class="owl-next"><i class="fa-solid fa-arrow-right"></i></button>'
    ],
    dots: true,
    items: 1,
    loop: true,
    margin: 0,
    autoplay: true,
    autoplayTimeout: 9000,
    autoplaySpeed: 9000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 1,
      },
      1000: {
        items: 1,
      },
      1200: {
        items: 1
      }
    }
  });
});

// Load YouTube API

// STEP 1: Convert any YouTube URL to embed + enablejsapi
const iframe = document.getElementById("heroVideo");
const videoURL = iframe.getAttribute("data-video");

// Extract YouTube ID from any URL format
function extractYouTubeID(url) {
  const reg = /(?:youtube\.com.*(?:\/|v=)|youtu\.be\/)([^&?]+)/;
  const match = url.match(reg);
  return match ? match[1] : url; // if only ID entered, use it
}

const videoID = extractYouTubeID(videoURL);

// Create embed URL with API enabled
iframe.src = `https://www.youtube.com/embed/${videoID}?enablejsapi=1&mute=1&controls=0&rel=0&iv_load_policy=3`;


// STEP 2: Load YouTube Video API
let tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
document.body.appendChild(tag);

let player;

function onYouTubeIframeAPIReady() {
  player = new YT.Player('heroVideo');
}


// STEP 3: Play / Pause Button
const videoBtn = document.getElementById("videoPlayBtn");

videoBtn.addEventListener("click", function () {
  videoBtn.classList.toggle("playVideo");
  const heroSection = document.querySelector('.home-hero-banner');

  if (player.getPlayerState() === 1) {
    player.pauseVideo();
    heroSection.classList.remove('video-playing');
  } else {
    player.playVideo();
    heroSection.classList.add('video-playing');
  }
});




// Counter effect

function animateCounter(element, duration = 4000) {
  const finalValue = element.dataset.number;
  const hasPlus = finalValue.includes("+");
  const hasPercent = finalValue.includes("%");

  const pureNumber = parseInt(finalValue.replace(/[^0-9]/g, ""));
  const delay = element.dataset.delay ? parseInt(element.dataset.delay) : 0;
  let startTime = null;

  setTimeout(() => {
    function update(timestamp) {
      if (!startTime) startTime = timestamp;

      const progress = timestamp - startTime;
      const rate = Math.min(progress / duration, 1);
      const current = Math.floor(rate * pureNumber);

      let output = current.toLocaleString('en-US');

      if (hasPercent) output = output + "%";
      if (hasPlus) output = output + "+";

      element.textContent = output;

      if (rate < 1) requestAnimationFrame(update);
    }

    requestAnimationFrame(update);

  }, delay);
}

const counters = document.querySelectorAll(".abt-card h3");

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const el = entry.target;

      if (!el.dataset.started) {
        el.dataset.started = "true";
        animateCounter(el, 1500);
      }
    }
  });
});

counters.forEach((el, index) => {
  el.dataset.number = el.textContent.trim();
  el.dataset.delay = index * 300;
  observer.observe(el);
});

