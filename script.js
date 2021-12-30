"use strict";

const modalBackground = document.querySelector(".modal-background");
const overlay = document.querySelector(".overlay");
const btnCloseModal = document.querySelector(".close-modal");
const btnsOpenModal = document.querySelectorAll(".show-modal");
console.log(btnsOpenModal);

console.log(btnsOpenModal);

const openModal = function () {
  modalBackground.classList.add("bg-active");
};

const closeModal = function () {
  modalBackground.classList.remove("bg-active");
};

for (let i of btnsOpenModal) {
  i.addEventListener("click", openModal);
}

modalBackground.addEventListener("click", closeModal);
// for (let i of btnsCloseModal) {
//   i.addEventListener("click", closeModal);
// }
