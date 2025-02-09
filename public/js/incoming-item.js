function formatNumberInput(inputSelector) {
    $(inputSelector).on('input', function() {
        let value = $(this).val();
        let numericValue = value.replace(/[^0-9]/g, '');
        let formattedValue = new Intl.NumberFormat('id-ID').format(numericValue);
        $(this).val(formattedValue);
    });
}

$(document).ready(function() {
    formatNumberInput('.js--money');
});

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
});