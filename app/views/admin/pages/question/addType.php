<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Add Question Type
            </h4>
        </div>
        <div class="card-body">
            <form action="admin/question/createQuestionType" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                </div>
                <button type="submit" class="btn btn-success w-100">Add</button>
            </form>
        </div>
    </div>
</section>