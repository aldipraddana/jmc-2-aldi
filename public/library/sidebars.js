const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

$('.js--trigger-logout').on('click', function () {
  $('.js--logout').trigger('submit');
});

function formatCurrency(value) {
  let numericValue = value.replace(/[^0-9]/g, '');
  return new Intl.NumberFormat('id-ID').format(numericValue);
}

function formatNumberInput(inputSelector) {
  $(inputSelector).on('input', function() {
    formattedValue = formatCurrency($(this).val());
    $(this).val(formattedValue);
  });
}

$(document).ready(function () {
  formatNumberInput('.js--money');
  
  $('.toggle-btn').trigger('click');
});
