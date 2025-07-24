$(document).ready(function () {
    // ajax filter
    $('form#movie-filter-form').on('submit', function (e) {
        e.preventDefault();

        $('#ajax-loader').removeClass('hidden'); // نمایش متن بارگذاری
        $('#movie-results').html('');

        const formData = {
            action: 'filter_movies',
            nonce: ajax_data.nonces['filter_movies'],
            type: $('#type').val(),
            genre: $('#genre').val(),
            year_from: $('#year_from').val(),
            year_to: $('#year_to').val(),
            rating: $('#rating').val(),
            order: $('#order').val()
        };

        $.post(ajax_data.ajax_url, formData, function (response) {
            $('#ajax-loader').addClass('hidden');
            if (response.success) {
                $('#movie-results').html(response.data.html);
            }
            else {
                $('#movie-results').html('<p class="text-white">موردی یافت نشد.</p>');
            }
        });
    });

});