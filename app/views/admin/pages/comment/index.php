<div class="card border-0 shadow-sm">
    <div class="card-header border-bottom">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="http://localhost/BTL_WEB/admin/comment">All Comments</a>
            </li>
        </ul>
    </div>
    
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex gap-2">
                <select class="dataTable-selector form-select">
                    <option>All Statuses</option>
                    <option>Approved</option>
                    <option>Pending</option>
                </select>
                <button class="btn btn-outline-secondary">Filter
                </button>
            </div>
        </div>

        <div class="table-responsive rounded-3">
            <table class="table table-hover mb-0">
                <thead class="table-striped">
                    <tr>
                        <th style="width: 40px;"><input type="checkbox" class="form-check-input"></th>
                        <th style="width: 120px;">Date</th>
                        <th>Comment</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td class="text-muted">2023-10-11</td>
                        <td>
                            <div class="d-flex flex-column">
                                <strong class="mb-1">John Doe</strong>
                                <p class="text-muted mb-0">Great article! Really enjoyed reading this piece.</p>
                            </div>
                        </td>
                        
                        <td>
                            <span class="badge bg-success">Approved</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#commentDetailModal">
                                    View
                                </button>
                                <button class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button class="btn btn-outline-danger">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Pending Comment Example -->
                    <tr class="align-middle">
                        <td><input type="checkbox" class="form-check-input"></td>
                        <td class="text-muted">2023-10-10</td>
                        <td>
                            <div class="d-flex flex-column">
                                <strong class="mb-1">Jane Smith</strong>
                                <p class="text-muted mb-0">Interesting perspective, but need to verify sources.</p>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-danger">Pending</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#commentDetailModal">
                                    View
                                </button>
                                <button class="btn btn-outline-primary">
                                    Edit
                                </button>
                                <button class="btn btn-outline-danger">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">Showing 1-10 of 25 comments</div>
            <nav>
                <ul class="dataTable-pagination-list pagination pagination-primary">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Prev</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="commentDetailModal" tabindex="-1" aria-labelledby="commentDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentDetailModalLabel">Detail Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> 1</li>
                    <li class="list-group-item"><strong>Content:</strong> Great article! Really enjoyed reading this piece.</li>
                    <li class="list-group-item"><strong>ID Customer:</strong> 10</li>
                    <li class="list-group-item"><strong>ID Blog:</strong> <a href="http://localhost/BTL_WEB/admin/blog/detail?id=27"> 27 </a></li>
                    <li class="list-group-item"><strong>Like:</strong> 5</li>
                    <li class="list-group-item"><strong>Dislike:</strong> 0</li>
                    <li class="list-group-item"><strong>Status:</strong> Approved</li>
                    <li class="list-group-item"><strong>Created At:</strong> 2023-10-11 12:00:00</li>
                </ul>
            </div>
        </div>
    </div>
</div>