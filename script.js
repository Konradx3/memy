"use strict";

// DECLARATION
const modalBackground = document.querySelector(".modal-background");
const overlay = document.querySelector(".overlay");
const btnCloseModal = document.querySelector(".login-modal__btn--exit");
const btnsOpenModal = document.querySelectorAll(".show-modal");

// FUNCTIONS
const openModal = function () {
  modalBackground.classList.add("bg-active");
};

const closeModal = function (e) {
  if (e.target === e.currentTarget)
    modalBackground.classList.remove("bg-active");
};

// EVENT LISTENERS

for (let i of btnsOpenModal) {
  i.addEventListener("click", openModal);
}

modalBackground.addEventListener("click", closeModal);
btnCloseModal.addEventListener("click", function () {
  modalBackground.classList.remove("bg-active");
});
