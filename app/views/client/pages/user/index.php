<?php
$user = $data['customer'];
$img = $user['Avatar'] ? json_decode($user['Avatar'])[0] : 'public/images/tt-placeholder-avatar.jpg';
$orders = $data['orders'];
?>
<div class="user-overview__section1">
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
                            <!-- <tr>
                                <td>#ORD-2025001</td>
                                <td>Jan 15, 2025</td>
                                <td>
                                    Chanel N5 - 2Qty <br>
                                    Chanel N3 - 31Qty
                                </td>
                                <td>$135.00</td>
                                <td><a href="#">see details</a></td>
                            </tr> -->
                            <?php foreach ($orders as $orderId => $order): ?>
                                <tr>
                                    <td>#ORD-<?= str_pad($orderId, 7, "0", STR_PAD_LEFT) ?></td>
                                    <td><?= date("M d, Y", strtotime($order['date'])) ?></td>
                                    <td>
                                        <div class="product-scroll">
                                            <?php foreach ($order['items'] as $item): ?>
                                                <?= $item['product'] ?> - <?= $item['quantity'] ?>Qty<br>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                    <td><?= number_format($order['total']) ?>VND</td>
                                    <td><a href="order/history/<?= $orderId ?>">see details</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="order-section__items-reponsive">
                        <?php foreach ($orders as $orderId => $order): ?>
                            <div class="order-section__item">
                                <a href="order/history/<?= $orderId ?>">
                                    <div class="item__basic-info">
                                        <p class="item__id">#ORD-<?= str_pad($orderId, 7, "0", STR_PAD_LEFT) ?></p>
                                        <p class="item__date"><?= date("M d, Y", strtotime($order['date'])) ?></p>
                                    </div>
                                    <div class="item__product">
                                        <?php foreach ($order['items'] as $item): ?>
                                            <p class="product__name">
                                                <?= $item['product'] ?> - <?= $item['quantity'] ?>Qty
                                            </p>
                                        <?php endforeach; ?>
                                        <!-- <p class="product__name">
                                        Chanel N5 - 2Qty
                                    </p> -->
                                    </div>
                                    <p class="item__price">
                                        <?= number_format($order['total']) ?>VND
                                    </p>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        <!-- <div class="order-section__item">
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
                        </div> -->
                    </div>
                </div>
                <div class="right-section__password-section">
                    <h4 class="section__title">
                        Change Password
                    </h4>
                    <form action="user/changePassword?id=<?= $user['ID'] ?>" class="info-section__form" style="grid-template-columns: 1fr" method="POST" id="password-form">
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
                    <button class="form-submit__btn" form="password-form">
                        Update Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('.order-section__table').DataTable({
            responsive: true,
            pageLength: 5,
            order: [
                [1, 'desc']
            ],
            language: {
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ dòng",
                info: "Hiển thị _START_ đến _END_ trong _TOTAL_ dòng",
                paginate: {
                    first: "Đầu",
                    last: "Cuối",
                    next: "→",
                    previous: "←"
                },
                zeroRecords: "Không tìm thấy đơn hàng nào"
            }
        });
    });
    const tableWrapper = document.querySelector('.order-section__table').closest('.your-container-class');

    const observer = new MutationObserver(() => {
        if ($(tableWrapper).is(':visible')) {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust()
                .responsive.recalc();
        }
    });

    observer.observe(tableWrapper, {
        attributes: true,
        attributeFilter: ['style', 'class']
    });
</script>