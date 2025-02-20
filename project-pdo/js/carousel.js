let list = document.querySelector(".slider .slider-list"),
  items = document.querySelectorAll(".slider .slider-list .slider-item"),
  dots = document.querySelectorAll(".slider .dots li"),
  prev = document.getElementById("prev"),
  next = document.getElementById("next");

let active = 0,
  itemsLength = items.length - 1;

next.onclick = function () {
  if (active + 1 > itemsLength) {
    active = 0;
  } else {
    active += 1;
  }
  reloadSlider();
};

prev.onclick = function () {
  if (active - 1 < 0) {
    active = items.length;
  } else {
    active -= 1;
  }
  reloadSlider();
};

// 定時器，因為會一直滑動，所以我暫時把它註解
 let refreshSlider = setInterval(() => {
   next.click();
 }, 6000);

function reloadSlider() {
  let checkLeft = items[active].offsetLeft;
  list.style.left = -checkLeft + "px";

  let lastActiveDot = document.querySelector(".slider .dots li.active");
  lastActiveDot.classList.remove("active");
  dots[active].classList.add("active");
  // clearInterval(refreshSlider);
  // refreshSlider = setInterval(() => {next.click()}, 6000);
}

dots.forEach((li, key) => {
  li.addEventListener("click", function () {
    active = key;
    reloadSlider();
  });
});
