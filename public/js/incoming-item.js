function checkLimitHarga() {
    let jsPriceLimit = $('.js--price-limit').val();
    jsPriceLimit = jsPriceLimit.replace(/[^0-9]/g, '');
    jsPriceLimit = Number(jsPriceLimit);

    let price = 0;
    $('.js--total-price').each((index, element) => {
        let totalPrice = $(element).val();
        totalPrice = totalPrice.replace(/[^0-9]/g, '');
        price += Number(totalPrice);
    });
    
    if (price > jsPriceLimit) {
        alert('Total harga melebihi batas harga yang ditentukan, tidak dapat menyimpan data');
        $('.js--submit-form').attr('disabled', true);
        $($('.js--price')[$('.js--price').length-1]).val('');
        $($('.js--quantity')[$('.js--quantity').length-1]).val('');
        $($('.js--total-price')[$('.js--total-price').length-1]).val(0);
    }else {
        $('.js--submit-form').attr('disabled', false);
    }
}

function initializeCounter() {
    $('.js--price').on('input', function() {
        let price = $(this).val();
        price = price.replace(/[^0-9]/g, '');
        let quantity = $(this).closest('tr').find('.js--quantity').val(); 
        $(this).closest('tr').find('.js--total-price').val(formatCurrency(String(price * quantity))).trigger('input');

        checkLimitHarga();
    });
    
    $('.js--quantity').on('input', function() {
        let quantity = $(this).val();
        let price = $(this).closest('tr').find('.js--price').val();
        price = price.replace(/[^0-9]/g, '');
        $(this).closest('tr').find('.js--total-price').val(formatCurrency(String(price * quantity))).trigger('input');

        checkLimitHarga();
    });
}

$('.js--add-item').on('click', function() {
    console.log('add item');
    
    let item = $(this).closest('tr').clone();
    item.find('input').val('');
    item.find('select').val('');
    item.find('.js--incoming-items-action').html(`
        <button type="button" class="btn btn-danger js--destroy-item" style="padding-bottom: 0">
            <i class="lni lni-xmark" style="font-size: 21px;"></i>
        </button>
    `);
    item.appendTo('.js--incoming-items');
    formatNumberInput('.js--money');

    $('.js--destroy-item').on('click', function() {
        $(this).closest('tr').remove();
    });

    initializeCounter();

    $('input[type="text"]').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });
});

$('select[name="category"]').on('change', function() {
    let category = $(this).val();
    let url = $(this).attr('data-url')+`${category}`;
    let htmlOption = '<option value="">Pilih Sub Category</option>';
    $('select[name="sub_category"]').html(`<option value="">Pilih Sub Category</option>`);
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
           data.forEach(element => {
               htmlOption += `<option value="${element.id}" data-price_limit="${element.price_limit}">${element.sub_category_name}</option>`;
           });
           $('select[name="sub_category"]').html(htmlOption);
        }
    });
});

$('select[name="sub_category"]').on('change', function() {
    let priceLimit = $(this).find(':selected').attr('data-price_limit');
    priceLimit = Number(priceLimit);
    $('.js--price-limit').val(formatCurrency(String(priceLimit)));
    checkLimitHarga();
});

$(document).ready(function() {
    $('input[type="text"]').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });
    initializeCounter();
    
    let datatableIncomingItem = $('.js--table-incoming-item').DataTable();
    if ($('.dt-length').length) {
        $('.dt-length').remove();
    }

    $('.js--filter-category').on('change', function() {
        let val = $(this).val();
        datatableIncomingItem.column(12).search(val).draw();
    });
});

$('.js--form-submit').on('submit', function(e) {
    e.preventDefault();
    $('.alert').hide();

    let form = $(this);
    let url = form.attr('action');
    let method = form.attr('method');
    let data = form.serialize();

    $.ajax({
        url: url,
        method: method,
        data: data,
        befofeSend: function() {
            form.find('button[type="submit"]').prop('disabled', true).text('Loading...');
        },
        success: function(response) {
            $('.alert-success').html(response.message).show();
            setTimeout(() => {
                window.location.reload();
            }, 1500);
            form.find('button[type="submit"]').prop('disabled', false).text('Submit');
        },
        error: function(error) {
            console.log(error);
            form.find('button[type="submit"]').prop('disabled', false).text('Submit');
            if (error.responseJSON === undefined) {
                $('.alert-danger').html(error.responseText).show();
                return;
            }
            const errorsArray = $.map(error.responseJSON.errors, function(value) {
                return value;
            });
            let htmlError = '';
            errorsArray.forEach((error) => {
                htmlError += `<p class="mb-1">*${error}</p>`;
            });
            $('.alert-danger').html(htmlError).show();
        }
    });
});