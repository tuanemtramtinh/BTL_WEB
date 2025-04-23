<div class="password__section1">
    <div class="container">
        <div class="section1__wrapper">
            <div class="section1__avatar">
                <img src="public/images/tt-avatar-1.png" alt="user avatar" class="avatar__user-image">
                <img src="public/images/tt-avatar-2.png" alt="user avatar decorator" class="avatar__decorator">
            </div>
            <div class="section1__info">
                <h3 class="section1__info-name">Ngô Ngọc Triệu Mẫn</h3>
                <p class="section1__info-status">Premium Member since 2023</p>
            </div>
        </div>
    </div>
</div>

<div class="password__section2">
    <div class="container">
        <div class="section2__wrapper">
            <div class="section2__left-section">
                <a href="user/profile" class="left-section__option">
                    <img src="public/images/tt-option-1.png" alt="user icon" class="option__icon">
                    <p class="option__text">Personal Information</p>
                </a>
                <a href="user/history" class="left-section__option">
                    <img src="public/images/tt-option-2.png" alt="history icon" class="option__icon">
                    <p class="option__text">Order History</p>
                </a>
                <a href="user/password" class="left-section__option active__option">
                    <img src="public/images/tt-option-3.png" alt="password icon" class="option__icon">
                    <p class="option__text">Change Password</p>
                </a>
            </div>
            <div class="section2__right-section">
                <div class="right-section__password-section" style="margin-top: 0;">
                    <h4 class="section__title">
                        Change Password
                    </h4>
                    <form action="" class="info-section__form" style="grid-template-columns: 1fr">
                        <div class="password-section__form-group">
                            <label for="curPass" class="form-group__label">Current Password</label> <br>
                            <input type="text" name="currPass" id="currPass" value="" class="form-group__input" />
                        </div>
                        <div class="password-section__form-group">
                            <label for="new_password" class="form-group__label">New Password</label><br>
                            <input type="text" name="new_password" id="new_password" class="form-group__input" value="" style="width:100%">
                        </div>
                        <div class="password-section__form-group">
                            <label for="confirm_password" class="form-group__label">Confirm New Password</label><br>
                            <input type="text" name="confirm_new_password" id="confirm_new_password" class="form-group__input" value="" style="width:100%">
                        </div>
                    </form>
                    <button class="form-submit__btn">
                        Update Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>