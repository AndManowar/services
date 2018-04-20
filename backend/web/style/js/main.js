$(document).ready(function () {

    $(document).on('click', '.add_new_field', function (e) {
        e.preventDefault();

        $.ajax({
            url: '/dashboard/ajax/add-field',
            type: 'POST',
            success: function (data) {
                $(data).appendTo('.additional');
            }
        });
    });

    $(document).on('click', '.remove_field', function (e) {
        e.preventDefault();
        $(this).closest('.card').remove();

    });

    $(document).on('click', '#npw-map-sidebar-ul', function () {
        $('#orderform-warehouse_name').val($('.npw-details-title').text());
    });

    $(document).on('change', '#npw-cities', function () {
        $('#orderform-city_name').val($(this).val());
    });

});