<div class="user-profile__section1">
    <div class="container">
        <div class="section1__wrapper">
            <div class="section1__avatar">
                <img src="public/images/tt-avatar-1.png" alt="user avatar" style="width: 225px; height:225px;border-radius: 50%;border:5px solid rgba(171, 87, 45, 1)">
                <img src="public/images/tt-avatar-2.png" alt="user avatar decorator" style="position:absolute;left:150px;top:160px">
            </div>
            <div class="section1__info">
                <h3 class="section1__info-name">Ngô Ngọc Triệu Mẫn</h3>
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
                    <img src="public/images/tt-option-2.png" alt="user icon" class="option__icon">
                    <p class="option__text">Order History</p>
                </a>
                <a href="user/password" class="left-section__option">
                    <img src="public/images/tt-option-3.png" alt="user icon" class="option__icon">
                    <p class="option__text">Change Password</p>
                </a>
            </div>
            <div class="section2__right-section">
                <div class="right-section__user-details">
                    <h4 class="section__title">
                        Personal Information
                    </h4>
                    <form action="" class="info-section__form">
                        <div class="info-section__form-group">
                            <label for="name" class="form-group__label">First name</label> <br>
                            <input type="text" name="name" id="name" class="form-group__input" value="Man" />
                        </div>
                        <div class="info-section__form-group">
                            <label for="name" class="form-group__label">Last name</label> <br>
                            <input type="text" name="name" id="name" class="form-group__input" value="Ngo Ngoc Trieu" />
                        </div>
                        <div class="info-section__form-group">
                            <label for="email" class="form-group__label">Email</label> <br>
                            <input type="email" name="email" id="email" class="form-group__input" value="Man2705@gmail.com" />
                        </div>
                        <div class="info-section__form-group">
                            <label for="phone" class="form-group__label">Phone</label> <br>
                            <input type="phone" name="phone" id="phone" class="form-group__input" value="04930493599" />
                        </div>
                        <div class="info-section__form-group" style="grid-column: 1 /span 2;">
                            <label for="address" class="form-group__label">Address</label><br>
                            <input type="text" name="address" id="address" class="form-group__input" value="Vinh Hoa, Vinh Kim, Chau Thanh" style="width:835px">
                        </div>
                    </form>
                    <button class="form-submit__btn">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>