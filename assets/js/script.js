/*! jQuery v3.7.1 | (c) OpenJS Foundation and other contributors | jquery.org/license */
$(document).ready(function () {
    window.addEventListener('load', function () {
        document.getElementById('site-preloader').style.display = 'none';
    });
    // ajax filter
    $('form#movie-filter-form').on('submit', function(e) {
        e.preventDefault();

        const formData = {
            action: 'filter_movies',
            nonce: movie_filter_ajax.nonce,
            type: $('#type').val(),
            genre: $('#genre').val(),
            year_from: $('#year_from').val(),
            year_to: $('#year_to').val(),
            rating: $('#rating').val(),
            order: $('#order').val()
        };

        $.post(movie_filter_ajax.ajax_url, formData, function(response) {
            $('#movie-results').html(response);
        });
    });

    const toggleBtn = document.getElementById("menu-toggle");
    const menu = document.getElementById("mobile-menu");

    toggleBtn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

    const swiper = new Swiper('.hero-slide', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    const cart_slider = new Swiper(".cart-slider", {
        slidesPerView: 6,
        spaceBetween: 10,
        navigation: {
            nextEl: ".cart-slider-next",
            prevEl: ".cart-slider-prev"
        },
        breakpoints: {
            320: {
                slidesPerView: 1.9,
                spaceBetween: 20
            },
            480: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            640: {
                slidesPerView: 6,
                spaceBetween: 10,
            }
        }
    });
    var info_slider = new Swiper(".info-slider", {
        slidesPerView: 5,
        spaceBetween: 10,
        navigation: {
            nextEl: ".cart-slider-next",
            prevEl: ".cart-slider-prev"
        },
        breakpoints: {
            320: {
                slidesPerView: 1.5,
                spaceBetween: 10
            },

            480: {
                slidesPerView: 3,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 4,
                spaceBetween: 10
            }
        }
    });
    const blog_slider = new Swiper(".blog-slider", {
        slidesPerView: 4,
        spaceBetween: 10,
        navigation: {
            nextEl: ".cart-slider-next",
            prevEl: ".cart-slider-prev"
        },
        breakpoints: {
            320: {
                slidesPerView: 1.3,
                spaceBetween: 20
            },

            480: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            640: {
                slidesPerView: 4,
                spaceBetween: 40
            }
        }
    });

    const topMoviesSwiper = new Swiper(".topMoviesSwiper", {
        slidesPerView: 3,
        grid: {
            rows: 3,
            direction: true,
        },
        spaceBetween: 20,
        breakpoints: {
            320: {
                grid: {
                    rows: 2,
                    direction: true,
                },
                slidesPerView: 1,
                spaceBetween: 10
            },

            480: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 10
            }
        }
    });

    const tabs = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
// حذف active از بقیه
            tabs.forEach(t => t.classList.remove("bg-white", "text-black"));
            contents.forEach(c => c.classList.add("hidden"));

// فعال کردن انتخاب شده
            tab.classList.add("bg-white", "text-black");
            const selected = tab.getAttribute("data-tab");
            document.querySelector(`[data-content="${selected}"]`).classList.remove("hidden");
        });
    });

// فعال‌سازی اولیه اولین تب
    tabs[0].click();

    const cart = new Swiper(".swiper-slides", {
        loop: true,
        effect: 'creative',
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        spaceBetween: 30,

    });
    const sidebar_slider = new Swiper(".sidebar-slider", {
        slidesPerView: 3.5,
        spaceBetween: 10,
    });


// سوئیچ تب‌ها
    $('.tab-btn').click(function () {
        $('.tab-btn').removeClass('border-white text-black').addClass('border-white text-gray-300');
        $(this).removeClass('border-white text-white text-gray-300').addClass('border-white text-black');
    });

// انتخاب ژانر
    $('.genre-item').click(function () {
        $(this).toggleClass('bg-yellow-500 text-black').toggleClass('bg-[#2c2b3b] text-black');
    });

});