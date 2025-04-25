<?php
$Question = $data['question'];
?>
<section class="section">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <h3 class="card-title">Answer Question Form</h3>
                <h5 class="card-text">
                    Câu hỏi: <?= $Question['Question'] ?>
                </h5>
                <form class="form" method="POST" action="admin/question/sendQuestion?id=<?= $Question['ID'] ?>">
                    <div class="form-body">
                        <div class="form-group form-label-group">
                            <textarea class="form-control" id="answer" name="answer" rows="3" placeholder="<?= $Question['Answer'] ? $Question['Answer'] : "Answer" ?>"></textarea>
                            <label for="answer"></label>
                        </div>
                    </div>
                    <div class="form-actions d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-light-primary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>