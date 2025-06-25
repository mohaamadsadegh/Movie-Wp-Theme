<?php

function search_template()
{
    echo "sdcscdsc";
    ?>

        <!-- Search -->
        <div class="relative">
            <input class="bg-gray-700 text-sm rounded-full pl-10 pr-4 py-1 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                   placeholder="جستجو..."
                   type="text"/>
            <svg class="w-4 h-4 text-gray-400 absolute top-2.5 right-3" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"/>
            </svg>
        </div>
<?php
}
add_shortcode('search-s', 'search_template');