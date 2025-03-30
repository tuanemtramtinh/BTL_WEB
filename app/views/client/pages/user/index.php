<div class="user-overview__section1">
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

<div class="user-overview__section2">
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
                <a href="user/password" class="left-section__option" style="margin: 0;">
                    <img src="public/images/tt-option-3.png" alt="password icon" class="option__icon">
                    <p class="option__text">Change Password</p>
                </a>
            </div>
            <div class="section2__right-section">
                <div class="right-section__info-section">
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
                        <div class="info-section__form-group">
                            <label for="address" class="form-group__label">Address</label><br>
                            <input type="text" name="address" id="address" class="form-group__input" value="Vinh Hoa, Vinh Kim, Chau Thanh">
                        </div>
                    </form>
                    <button class="form-submit__btn">
                        Save Changes
                    </button>
                </div>
                <div class="right-section__order-section">
                    <h4 class="section__title">
                        Recent Orders
                    </h4>
                    <table class="order-section__table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-2025001</td>
                                <td>Jan 15, 2025</td>
                                <td>
                                    Chanel N5 - 2Qty <br>
                                    Chanel N3 - 31Qty
                                </td>
                                <td>$135.00</td>
                                <td><a href="#">see details</a></td>
                            </tr>
                            <tr>
                                <td>#ORD-2025001</td>
                                <td>Jan 15, 2025</td>
                                <td>
                                    Chanel N5 - 2Qty <br>
                                    Chanel N3 - 31Qty
                                </td>
                                <td>$135.00</td>
                                <td><a href="#">see details</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="order-section__items-reponsive">
                        <div class="order-section__item">
                            <div class="item__basic-info">
                                <p class="item__id">#ORD-2025001</p>
                                <p class="item__date">Jan 15, 2025</p>
                            </div>
                            <div class="item__product">
                                <p class="product__name">
                                    Midnight Rose Parfum - 1Qty
                                </p>
                                <p class="product__name">
                                    Chanel N5 - 2Qty
                                </p>
                            </div>
                            <p class="item__price">
                                $129.99
                            </p>
                        </div>
                        <div class="order-section__item">
                            <div class="item__basic-info">
                                <p class="item__id">#ORD-2025001</p>
                                <p class="item__date">Jan 15, 2025</p>
                            </div>
                            <div class="item__product">
                                <p class="product__name">
                                    Midnight Rose Parfum - 1Qty
                                </p>
                                <p class="product__name">
                                    Chanel N5 - 2Qty
                                </p>
                            </div>
                            <p class="item__price">
                                $129.99
                            </p>
                        </div>
                    </div>
                </div>
                <div class="right-section__password-section">
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