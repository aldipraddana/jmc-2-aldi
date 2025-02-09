$(document).ready(function() {
    let userManagementDatatable = $('.js--table-category').DataTable();
    if ($('.dt-length').length) {
        $('.dt-length').remove();
    }

    $('.js--filter-role').on('change', function() {
        let role = $(this).val();
        userManagementDatatable.column(5).search(role).draw();
    });
});

$('.js--form-user-management').on('submit', function(e) {
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

$('.js--form-user-management-edit').on('submit', function(e) {
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

$('.js--edit-data-user-management').on('click', function() {
    let id = $(this).data('id');
    let role = $(this).attr('data-role');
    let username = $(this).attr('data-username');
    let name = $(this).attr('data-name');
    let email = $(this).attr('data-email');
    let url = $(this).attr('data-action');
    
    $('.js--form-user-management-edit').attr('action', url);
    $('#modal--edit-user').find('input[name="id"]').val(id);
    $('#modal--edit-user').find('select[name="role"]').val(role);
    $('#modal--edit-user').find('input[name="username"]').val(username);
    $('#modal--edit-user').find('input[name="name"]').val(name);
    $('#modal--edit-user').find('input[name="email"]').val(email);
});

