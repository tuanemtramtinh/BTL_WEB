<?php
$AllQuestionType = $data['QuestionType'];
?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Question Type
            </h4>
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <a href="admin/question/addType" class="w-100 btn btn-success btn-sm py-2 fs-6">
                    Add Question Type
                </a>
                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="member-table">
                        <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Name</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Action</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($AllQuestionType as $QuestionType) { ?>
                                <tr>
                                    <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter"><?= $QuestionType['ID'] ?></a></td>
                                    <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter"><?= $QuestionType['Name'] ?></a></td>
                                    <td data-sortable="" style="width: 10%">
                                        <a href="admin/question/editType?id=<?= $QuestionType['ID'] ?>" class="btn btn-primary">Edit</a>
                                        <a href="admin/question/deleteQuestionType?id=<?= $QuestionType['ID'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa chủ đề câu hỏi này ?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Answer Question
            </h4>
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4">
                        <input type="checkbox" class="form-check-input" id="checkbox2" name="not-answered">
                        <label for="checkbox2">Not Answered</label>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="checkbox2">Question Type:</label>
                        <fieldset class="form-group">
                            <select class="form-select" id="basicSelect" name="type">
                                <?php foreach ($AllQuestionType as $QuestionType) { ?>
                                    <option><?= $QuestionType['Name'] ?></option>
                                <?php } ?>
                            </select>
                        </fieldset>
                    </div>
                </div>
                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="member-table">
                        <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Name</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Email</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Question</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Question Type</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Answer</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Action</a></th>
                            </tr>
                        </thead>
                        <tbody id="question-table-body">
                            <!-- <tr>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">1</a></td>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Tú</a></td>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">tuduong05042003@gmail.com</a></td>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Có giảm giá cho người khuyết tật không ?</a></td>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Sản phẩm</a></td>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Hehe đoán xem</a></td>
                                <td data-sortable="" style="width: 10%">
                                    <a href="" class="btn btn-success">Answer question</a>
                                    <a href="" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa câu hỏi này ?')">Delete</a>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkbox = document.querySelector('input[name="not-answered"]');
        const select = document.querySelector('select[name="type"]');

        function fetchFilteredQuestions() {
            const notAnswered = checkbox.checked ? 1 : 0;
            const type = select.value;

            fetch(`admin/question/filter`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `notAnswered=${notAnswered}&type=${encodeURIComponent(type)}`
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('question-table-body').innerHTML = data;
                });
        }
        checkbox.addEventListener('change', fetchFilteredQuestions);
        select.addEventListener('change', fetchFilteredQuestions);
        fetchFilteredQuestions();
    })
</script>