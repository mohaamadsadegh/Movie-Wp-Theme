<?php
// layout.php - dashboard tabs structure
?>
<div class="container mx-auto mt-10 p-4  shadow-md rounded-xl">
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Sidebar -->
        <aside class="md:w-1/4 bg-bluet-600 p-3 rounded-[10px]">
            <ul class="space-y-2">
                <li>
                    <button class="tab-btn w-full text-right rounded-[5px]" data-tab="profile">👤 پروفایل</button>
                </li>
                <li>
                    <button class="tab-btn w-full text-right rounded-[5px]" data-tab="password">🔒 تغییر رمز</button>
                </li>
                <li>
                    <button class="tab-btn w-full text-right rounded-[5px]" data-tab="avatar">🖼️ آواتار</button>
                </li>
                <li>
                    <button class="tab-btn w-full text-right rounded-[5px]" data-tab="orders">🧾 سفارشات</button>
                </li>

                <li><a href="<?php echo wp_logout_url(home_url()); ?>" class="text-red-600">🚪 خروج</a></li>
            </ul>
        </aside>

        <!-- Content -->
        <section class="md:w-3/4">
            <div id="tab-profile" class="tab-content"> <?php include 'profile.php'; ?> </div>
            <div id="tab-password" class="tab-content hidden"> <?php include 'change-password.php'; ?> </div>
            <div id="tab-avatar" class="tab-content hidden"> <?php include 'avatar-upload.php'; ?> </div>
            <div id="tab-orders" class="tab-content hidden"> <?php include 'orders.php'; ?> </div>
        </section>
    </div>
</div>

<script>
    document.querySelectorAll(".tab-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".tab-content").forEach(c => c.classList.add("hidden"));
            document.querySelector(`#tab-${btn.dataset.tab}`).classList.remove("hidden");
        });
    });

    // AJAX: Change Password
    // const pwdForm = document.getElementById("change-password-form");
    // if (pwdForm) {
    //     pwdForm.addEventListener("submit", e => {
    //         e.preventDefault();
    //         const data = new FormData(pwdForm);
    //         data.append("action", "change_password");
    //         data.append("nonce", user_panel_ajax_data.nonce);
    //         console.log(user_panel_ajax_data)
    //         fetch(user_panel_ajax_data.ajax_url, {method: "POST", body: data})
    //             .then(res => res.json())
    //             .then(res => {
    //                 pwdForm.querySelector(".msg").innerText = res.data.message;
    //             });
    //     });
    // }

    // AJAX: Upload Avatar
    // const avatarForm = document.getElementById("avatar-form");
    // if (avatarForm) {
    //     avatarForm.addEventListener("submit", e => {
    //         e.preventDefault();
    //         const data = new FormData(avatarForm);
    //         data.append("action", "upload_avatar");
    //         data.append("nonce", user_panel_ajax_data.nonce);
    //
    //         fetch(user_panel_ajax_data.ajax_url, {method: "POST", body: data})
    //             .then(res => res.json())
    //             .then(res => {
    //                 if (res.success) {
    //                     document.getElementById("avatar-preview").src = res.data.url;
    //                     document.getElementById("avatar-preview").hidden = false;
    //                 } else {
    //                     avatarForm.querySelector(".msg").innerText = res.data.message;
    //                 }
    //             });
    //     });
    // }
</script>

