<?php
$user = $data['user'];
$img = $user['Avatar'] ? json_decode($user['Avatar'])[0] : 'public/images/tt-placeholder-avatar.jpg';
?>
<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-2xl">
                            <img src="<?= $img ?>" alt="Avatar" style="width: 150px; height: 150px;">
                        </div>

                        <h3 class="mt-3"><?= $user['FirstName'] . ' ' . $user['LastName'] ?></h3>
                        <p class="text-small">Customer</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-5">
                        <div class="card shadow-sm rounded-4">
                            <div class="card-header bg-primary text-white rounded-top-4">
                                <h4 class="mb-0">User Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">ID:</div>
                                    <div class="col-sm-8"><?= $user['ID'] ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">First Name:</div>
                                    <div class="col-sm-8"><?= $user['FirstName'] ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Last Name:</div>
                                    <div class="col-sm-8"><?= $user['LastName'] ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Email:</div>
                                    <div class="col-sm-8"><?= $user['Email'] ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Phone:</div>
                                    <div class="col-sm-8"><?= $user['Phone'] ?></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Address:</div>
                                    <div class="col-sm-8"><?= $user['Address'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>