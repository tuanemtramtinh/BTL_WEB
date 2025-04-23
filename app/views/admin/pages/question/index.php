<?php
$AllQuestionType = $data['QuestionType'];
$AllQuestions = $data['Questions'];
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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
                                <th data-sortable="" style="width: 10%">ID</th>
                                <th data-sortable="" style="width: 10%">Name</th>
                                <th data-sortable="" style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($AllQuestionType as $QuestionType) { ?>
                                <tr>
                                    <td data-sortable="" style="width: 10%"><a href="admin/question/editType?id=<?= $QuestionType['ID'] ?>" class="dataTable-sorter"><?= $QuestionType['ID'] ?></a></td>
                                    <td data-sortable="" style="width: 10%"><a href="admin/question/editType?id=<?= $QuestionType['ID'] ?>" class="dataTable-sorter"><?= $QuestionType['Name'] ?></a></td>
                                    <td data-sortable="" style="width: 10%">
                                        <a href="admin/question/editType?id=<?= $QuestionType['ID'] ?>" class="btn btn-success">Edit</a>
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
                Question Client
            </h4>
        </div>
        <div class="card-body">
            <div class="dataTable-container">
                <a href="admin/question/addQuestionFront" class="w-100 btn btn-success btn-sm py-2 fs-6">
                    Add Question Client
                </a>
                <table class="table table-striped dataTable-table" id="question-front-table">
                    <thead>
                        <tr>
                            <th data-sortable="" style="width: 10%">ID</th>
                            <th data-sortable="" style="width: 10%">Question</th>
                            <th data-sortable="" style="width: 10%">Question Type</th>
                            <th data-sortable="" style="width: 10%">Answer</th>
                            <th data-sortable="" style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="question-front-table-body">
                        <?php foreach ($AllQuestions as $Question) { ?>
                            <tr>
                                <td data-sortable="" style="width: 10%"><a href="admin/question/editAnswer?id=<?= $Question['ID'] ?>" class="dataTable-sorter"><?= $Question['ID'] ?></a></td>
                                <td data-sortable="" style="width: 10%"><a href="admin/question/editAnswer?id=<?= $Question['ID'] ?>" class="dataTable-sorter"><?= $Question['Question'] ?></a></td>
                                <td data-sortable="" style="width: 10%"><a href="admin/question/editAnswer?id=<?= $Question['ID'] ?>" class="dataTable-sorter"><?= $Question['Type'] ?></a></td>
                                <td data-sortable="" style="width: 10%"><a href="admin/question/editAnswer?id=<?= $Question['ID'] ?>" class="dataTable-sorter"><?= $Question['Answer'] ?></a></td>
                                <td data-sortable="" style="width: 10%">
                                    <a href="admin/question/editAnswer?id=<?= $Question['ID'] ?>" class="btn btn-success">Edit answer</a>
                                    <a href="admin/question/deleteAnswerFront?id=<?= $Question['ID'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa câu hỏi này ?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                    <table class="table table-striped dataTable-table" id="question-table">
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
                        </tbody>
                    </table>
                </div>
                <nav>
                    <ul class="pagination" id="pagination"></ul>
                </nav>

            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        const table = $('#question-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'admin/question/datatable',
                type: 'POST',
                data: function(d) {
                    d.notAnswered = $('input[name="not-answered"]').is(':checked') ? 1 : 0;
                    d.type = $('select[name="type"]').val();
                },
                error: function(xhr, error, thrown) {
                    // Hiển thị thông báo lỗi nếu có vấn đề trong việc gọi AJAX
                    alert("Đã xảy ra lỗi khi lấy dữ liệu. Vui lòng thử lại.");
                    console.log("Error: " + thrown);
                    console.log("Response: " + xhr.responseText);
                }
            },
            columns: [{
                    data: 0
                }, // ID
                {
                    data: 1
                }, // Name
                {
                    data: 2
                }, // Email
                {
                    data: 3
                }, // Question
                {
                    data: 4
                }, // QuestionType
                {
                    data: 5
                }, // Answer
                {
                    data: 6, // Action buttons
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                "processing": "Đang xử lý...",
                "lengthMenu": "Hiển thị _MENU_ bản ghi",
                "zeroRecords": "Không tìm thấy kết quả phù hợp",
                "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ bản ghi",
                "infoEmpty": "Không có dữ liệu",
                "search": "Tìm kiếm:",
                "paginate": {
                    "first": "Đầu",
                    "last": "Cuối",
                    "next": "Sau",
                    "previous": "Trước"
                },
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

        $('input[name="search"]').on('input', function() {
            // Lấy giá trị tìm kiếm, loại bỏ thẻ HTML (nếu có)
            const sanitizedSearchValue = sanitizeSearchInput($(this).val());

            // Sử dụng giá trị đã làm sạch để tìm kiếm trong DataTable
            table.search(sanitizedSearchValue).draw();
        });

        // Đảm bảo reload dữ liệu khi checkbox hoặc select thay đổi
        $('input[name="not-answered"], select[name="type"]').on('change', function() {
            table.ajax.reload();
        });
    });
</script>