<?php
$type = $data["TypeData"];
?>
<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="admin/question/editQuestionType?id=<?= $type['ID'] ?>" method="POST">
                <div class="form-group">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="<?= $type["Name"] ?>" value="<?= $type["Name"] ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</section>