$(document).ready(function() {
    $('.js--table-category').DataTable();
    if ($('.dt-length').length) {
        $('.dt-length').remove();
    }
});

$('.js--form-category').on('submit', function(e) {
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

$('.js--edit-data-category').on('click', function() {
    let id = $(this).data('id');
    let categoryCode = $(this).attr('data-category_code');
    let url = $(this).attr('data-action');
    console.log($(this).attr('data-category_code'));
    
    let categoryName = $(this).attr('data-category_name');

    $('#modal--edit-category').find('form').attr('action', url);
    $('#modal--edit-category').find('input[name="id"]').val(id);
    $('#modal--edit-category').find('input[name="category_code"]').val(categoryCode);
    $('#modal--edit-category').find('input[name="category_name"]').val(categoryName);
});

$('.js--edit-data-sub-category').on('click', function() {
    let id = $(this).attr('data-id');
    let category = $(this).attr('data-category');
    let subCategoryName = $(this).attr('data-sub_category_name');
    console.log(subCategoryName);
    
    let priceLimit = $(this).attr('data-price_limit');
    let url = $(this).attr('data-action');

    $('#modal--edit-category').find('form').attr('action', url);
    $('#modal--edit-category').find('input[name="id"]').val(id);
    $('#modal--edit-category').find('select[name="category_id"]').val(category);
    $('#modal--edit-category').find('input[name="sub_category_name"]').val(subCategoryName);
    $('#modal--edit-category').find('input[name="price_limit"]').val(formatCurrency(priceLimit));
});