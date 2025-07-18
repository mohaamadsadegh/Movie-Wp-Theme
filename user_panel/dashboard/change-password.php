<?php

// change-password.php
?>
<h2 class="text-xl font-bold mb-4">تغییر رمز عبور</h2>
<form id="change-password-form" class="space-y-3">
    <input type="password" name="current" placeholder="رمز فعلی" class="input-style" required>
    <input type="password" name="new" placeholder="رمز جدید" class="input-style" required>
    <button type="submit" class="btn-blue">تغییر رمز</button>
    <div class="msg text-sm text-red-500"></div>
</form>
