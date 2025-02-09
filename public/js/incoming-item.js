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