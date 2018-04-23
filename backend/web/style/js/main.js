$(document).ready(function () {

    $(document).on('click', '.add_field', function (e) {
        e.preventDefault();

        var button = $(this);

        if (parseInt(button.attr('data-state')) === 1) {
            $('.additional_fields').removeClass('hidden');
            button.attr('data-state', 2);
        } else {
            $('.additional_fields').addClass('hidden');
            button.attr('data-state', 1);
        }
    });
});