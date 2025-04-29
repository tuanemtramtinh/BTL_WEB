<?php
$user = $data['customer'];
$img = $user['Avatar'] ? json_decode($user['Avatar'])[0] : 'public/images/tt-placeholder-avatar.jpg';
?>
<div class="user-profile__section1">
    <div class="container">
        <div class="section1__wrapper">
            <a class="section1__avatar" href="user/avatar">
                <img src="<?= $img ?>" alt="user avatar" class="avatar__user-image">
                <img src="public/images/tt-avatar-2.png" alt="user avatar decorator" class="avatar__decorator">
            </a>
            <div class="section1__info">
                <h3 class="section1__info-name"><?= $user['LastName'] . ' ' . $user['FirstName'] ?></h3>
                <p class="section1__info-status">Premium Member since 2023</p>
            </div>
        </div>
    </div>
</div>

<div class="user-profile__section2">
    <div class="container">
        <div class="section2__wrapper">
            <div class="section2__left-section">
                <a href="user/profile" class="left-section__option active__option">
                    <img src="public/images/tt-option-1.png" alt="user icon" class="option__icon">
                    <p class="option__text">Personal Information</p>
                </a>
                <a href="user/history" class="left-section__option">
                    <img src="public/images/tt-option-2.png" alt="history icon" class="option__icon">
                    <p class="option__text">Order History</p>
                </a>
                <a href="user/password" class="left-section__option">
                    <img src="public/images/tt-option-3.png" alt="password icon" class="option__icon">
                    <p class="option__text">Change Password</p>
                </a>
            </div>
            <div class="section2__right-section">
                <div class="right-section__info-section">
                    <h4 class="section__title">
                        Personal Information
                    </h4>
                    <form action="user/editUser?id=<?= $user['ID'] ?>" class="info-section__form" method="POST" id="user-info">
                        <div class="info-section__form-group">
                            <label for="fname" class="form-group__label">First name</label> <br>
                            <input type="text" name="fname" id="fname" class="form-group__input" value="<?= $user['FirstName'] ?>" />
                        </div>
                        <div class="info-section__form-group">
                            <label for="lname" class="form-group__label">Last name</label> <br>
                            <input type="text" name="lname" id="lname" class="form-group__input" value="<?= $user['LastName'] ?>" />
                        </div>
                        <div class="info-section__form-group">
                            <label for="email" class="form-group__label">Email</label> <br>
                            <input type="email" name="email" id="email" class="form-group__input" value="<?= $user['Email'] ?>" />
                        </div>
                        <div class="info-section__form-group">
                            <label for="phone" class="form-group__label">Phone</label> <br>
                            <input type="phone" name="phone" id="phone" class="form-group__input" value="<?= $user['Phone'] ? $user['Phone'] : "Chưa có số điện thoại" ?>" />
                        </div>
                        <div class="info-section__form-group">
                            <label for="address" class="form-group__label">Address</label><br>
                            <input type="text" name="address" id="address" class="form-group__input" value="<?= $user['Address'] ? $user['Address'] : "Chưa có địa chỉ" ?>">
                        </div>
                    </form>
                    <button class="form-submit__btn" type="submit" form="user-info">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>