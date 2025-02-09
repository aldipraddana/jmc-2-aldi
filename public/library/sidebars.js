const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

$('.js--trigger-logout').on('click', function () {
  $('.js--logout').trigger('submit');
});
