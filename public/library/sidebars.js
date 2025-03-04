const hamBurger = document.querySelector(".toggle-btn");
const sidebar = $('#sidebar');
const main = $('.main');

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
  if ($('#sidebar').hasClass('expand')) {
      main.css('margin-left', '260px');
  } else {
      main.css('margin-left', '70px');
  }
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
