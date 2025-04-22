<?php
$Types = $data['Types'];
?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Add Question Client
            </h4>
        </div>
        <div class="card-body">
            <form action="admin/question/addQuestiontoFront" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Question:</label>
                    <input type="text" class="form-control" id="question" name="question" placeholder="Enter question">
                </div>
                <div class="mb-3">
                    <label for="type">Type</label>
                    <select name="type" id="type" value="Sản phẩm" class="form-select">
                        <?php foreach ($Types as $Type) { ?>
                            <option value="<?= $Type['Name'] ?>"><?= $Type['Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="answer" class="form-label">Answer:</label>
                    <textarea type="text" class="form-control" id="answer" name="answer" placeholder="Enter answer"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Add to Client</button>
            </form>
        </div>
    </div>
</section>