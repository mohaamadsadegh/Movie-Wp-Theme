<?php
// avatar-upload.php
?>
<h2 class="text-xl font-bold mb-4">آپلود آواتار</h2>
<form id="avatar-form" enctype="multipart/form-data">
    <input type="file" name="avatar" class="input-style" accept="image/*" required>
    <button type="submit" class="btn-blue">آپلود</button>
    <img id="avatar-preview" class="w-24 h-24 mt-4 rounded-full" src="" hidden />
    <div class="msg text-sm text-red-500"></div>
</form>