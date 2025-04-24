<section class="secion">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">List User</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($data['users'])) foreach ($data['users'] as $user) {
                        $userAvatar = $user['Avatar'] ? json_decode($user['Avatar'])[0] : 'public/images/tt-placeholder-avatar.jpg';
                    ?>
                        <tr>
                            <td><?= $user['ID'] ?></td>
                            <td><img style="aspect-ratio: 1/1; object-fit: contain; width: 100px;" src="<?= $userAvatar ?>" alt=""></td>
                            <td><?= $user['FirstName'] ?></td>
                            <td><?= $user['LastName'] ?></td>
                            <td><?= $user['Email'] ?></td>
                            <td><?= $user['Phone'] ?></td>
                            <td><?= $user['Address'] ?></td>
                            <td>
                                <a class="btn btn-sm btn-info " href="admin/user/viewUserInfo?id=<?= $user['ID'] ?>">Info Detail</a>
                                <a class="btn btn-sm btn-primary  ml-1" href="admin/user/viewUserOrders?id=<?= $user['ID'] ?>">Info Order</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<script src="public/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="public/assets/static/js/pages/simple-datatables.js"></script>