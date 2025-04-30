<?php
$user = $data['customer'];
$img = $user['Avatar'] ? json_decode($user['Avatar'])[0] : 'public/images/tt-placeholder-avatar.jpg';
$orders = $data['orders'];
?>
<div class="history__section1">
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

<div class="history__section2">
    <div class="container">
        <div class="section2__wrapper">
            <div class="section2__left-section">
                <a href="user/profile" class="left-section__option">
                    <img src="public/images/tt-option-1.png" alt="user icon" class="option__icon">
                    <p class="option__text">Personal Information</p>
                </a>
                <a href="user/history" class="left-section__option active__option">
                    <img src="public/images/tt-option-2.png" alt="history icon" class="option__icon">
                    <p class="option__text">Order History</p>
                </a>
                <a href="user/password" class="left-section__option" style="margin: 0;">
                    <img src="public/images/tt-option-3.png" alt="password icon" class="option__icon">
                    <p class="option__text">Change Password</p>
                </a>
            </div>
            <div class="section2__right-section">
                <div class="right-section__order-section" style="margin: 0;">
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
                                    <td>$<?= number_format($order['total'], 2) ?></td>
                                    <td><a href="#">see details</a></td>
                                </tr>
                            <?php endforeach; ?>
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