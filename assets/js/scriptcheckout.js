
const slidePage = document.querySelector(".slide-pagec");
const nextBtnFirst = document.querySelector(".firstNextc");
const prevBtnSec = document.querySelector(".prev-1c");
const nextBtnSec = document.querySelector(".next-1c");
const prevBtnThird = document.querySelector(".prev-2c");
const nextBtnThird = document.querySelector(".next-2c");
const prevBtnFourth = document.querySelector(".prev-3c");
const submitBtn = document.querySelector(".submitc");
const progressText = document.querySelectorAll(".stepc p");
const progressCheck = document.querySelectorAll(".stepc .checkc");
const bullet = document.querySelectorAll(".stepc .bulletc");
let current = 1;
nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("activec");
  progressCheck[current - 1].classList.add("activec");
  progressText[current - 1].classList.add("activec");
  current += 1;
});
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("activec");
  progressCheck[current - 1].classList.add("activec");
  progressText[current - 1].classList.add("activec");
  current += 1;
});
/*nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});*/
/*submitBtn.addEventListener("click", function(){
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  setTimeout(function(){
    alert("Your Form Successfully Signed up");
    location.reload();
  },800);
});*/
prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("activec");
  progressCheck[current - 2].classList.remove("activec");
  progressText[current - 2].classList.remove("activec");
  current -= 1;
});
prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("activec");
  progressCheck[current - 2].classList.remove("activec");
  progressText[current - 2].classList.remove("activec");
  current -= 1;
});
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("activec");
  progressCheck[current - 2].classList.remove("activec");
  progressText[current - 2].classList.remove("activec");
  current -= 1;
});

function pagePago(){
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("activec");
  progressCheck[current - 1].classList.add("activec");
  progressText[current - 1].classList.add("activec");
  current += 1;
  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("activec");
  progressCheck[current - 1].classList.add("activec");
  progressText[current - 1].classList.add("activec");
  current += 1;
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("activec");
  progressCheck[current - 1].classList.add("activec");
  progressText[current - 1].classList.add("activec");
  current += 1;
}

