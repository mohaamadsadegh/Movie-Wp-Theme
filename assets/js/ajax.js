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
            } else {
                $('#movie-results').html('<p class="text-white">موردی یافت نشد.</p>');
            }
        });
    });

    let currentStep = 1;

    function showStep(step) {
        $('.step').addClass('hidden');
        $('.step[data-step="' + step + '"]').removeClass('hidden');
        currentStep = step;
    }

    $('.next-step').on('click', function () {
        showStep(currentStep + 1);
    });

    $('.prev-step').on('click', function () {
        showStep(currentStep - 1);
    });

    // ارسال کد تایید
    $('#sendRegisterCode').on('click', function () {
        const phone = $('input[name="register_phone"]').val();

        $.post(ajax_data.ajax_url, {
            action: 'register_send_code',
            nonce: ajax_data.nonces['register_send_code'],
            phone: phone
        }, function (response) {
            if (response.success) {
                showStep(3);
            } else {
                alert(response.data.message);
            }
        });
    });

    // ثبت‌نام نهایی
    $('#registerForm').on('submit', function (e) {
        e.preventDefault();

        const data = $(this).serializeArray();
        data.push({
            name: 'action',
            value: 'register_user'
        }, {
            name: 'nonce',
            value: ajax_data.nonces['register_user']
        });

        $.post(ajax_data.ajax_url, data, function (response) {
            if (response.success) {
                alert("ثبت‌نام با موفقیت انجام شد!");
                location.reload();
            } else {
                alert(response.data.message || 'خطا در ثبت‌نام');
            }
        });
    });
});
