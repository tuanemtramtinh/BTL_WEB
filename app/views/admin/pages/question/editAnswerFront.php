<?php
$Types = $data["Types"];
$Question = $data['Question'];
?>
<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="admin/question/editAnswerFront?id=<?= $data['id'] ?>" method="POST">
                <div class="form-group">
                    <label for="question" class="form-label">Question:</label>
                    <input type="text" name="question" id="question" class="form-control" placeholder="<?= $Question["Question"] ?>" value="<?= $Question["Question"] ?>">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" value="Sản phẩm" class="form-select">
                        <?php foreach ($Types as $Type) { ?>
                            <option value="<?= $Type['Name'] ?>"><?= $Type['Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="answer" class="form-label">Answer:</label>
                    <textarea type="text" name="answer" id="answer" class="form-control" placeholder="<?= $Question["Answer"] ?>" value="<?= $Question["Answer"] ?>"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</section>