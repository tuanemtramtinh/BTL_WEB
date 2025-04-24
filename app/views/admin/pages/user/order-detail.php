<?php
$orders = $data['orders'];
?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                User's Orders
            </h4>
        </div>
        <div class="card-body">
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
                                <?php foreach ($order['items'] as $item): ?>
                                    <?= $item['product'] ?> - <?= $item['quantity'] ?>Qty<br>
                                <?php endforeach; ?>
                            </td>
                            <td>$<?= number_format($order['total'], 2) ?></td>
                            <td><a href="admin/order/detail/<?= $orderId ?>">see details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
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
            },
            initComplete: function() {
                $('#question-table').find('td').css({
                    'padding': '10px',
                    'border': '1px solid #ddd',
                    'word-wrap': 'break-word'
                });

                $('.dataTables_paginate').css({
                    'text-align': 'center',
                    'margin-top': '10px'
                });

                $('.dataTables_paginate .paginate_button').css({
                    'padding': '5px 10px',
                    'margin': '0 5px',
                    'border': '1px solid #ccc',
                    'border-radius': '4px',
                    'background-color': '#f8f8f8',
                    'color': '#333',
                    'cursor': 'pointer'
                });

                $('.dataTables_paginate .paginate_button').hover(function() {
                    $(this).css({
                        'background-color': '#007bff',
                        'color': 'white'
                    });
                }, function() {
                    $(this).css({
                        'background-color': '#f8f8f8',
                        'color': '#333'
                    });
                });

                $('.dataTables_filter input').css({
                    'border': '1px solid #ccc',
                    'padding': '5px',
                    'border-radius': '4px',
                    'font-size': '14px'
                });

                $('.dataTables_length select').css({
                    'border': '1px solid #ccc',
                    'padding': '5px',
                    'border-radius': '4px',
                    'font-size': '14px',
                    'background-color': '#fff',
                    'color': '#000',
                    'cursor': 'pointer'
                });
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