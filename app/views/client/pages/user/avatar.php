<?php
$user = $data['customer'];
$img = $user['Avatar'] ? json_decode($user['Avatar'])[0] : 'public/images/tt-placeholder-avatar.jpg';
?>
<div class="container">
    <div class="avatar-wrapper">
        <h2 class="avatar-title">Your Profile Picture</h2>

        <div class="avatar-container">
            <img src="<?= $img ?>" class="avatar-img" alt="User Avatar">

            <form action="user/uploadAvatar?id=<?= $user['ID'] ?>" method="POST" enctype="multipart/form-data" class="avatar-form">
                <label for="avatar" class="avatar-label">Upload new avatar</label>
                <input type="file" name="images[]" id="images" class="avatar-input" multiple>
                <button type="submit" class="avatar-button">Upload</button>
            </form>
        </div>
    </div>
</div>