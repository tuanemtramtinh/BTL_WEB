<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">About us</h4>
        </div>
        <div class="card-body">
            <form action="admin/about/">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="about-us-title" placeholder="Enter title" required>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description:</label>
                    <textarea class="form-control" id="content" name="about-us-content"></textarea>
                </div>
                <div class="mb-3">
                    <label for="images" class="form-label">Background Image</label>
                    <div class="filepond--root image-preview-filepond filepond--hopper" id="images" data-style-button-remove-item-position="left" data-style-button-process-item-position="right" data-style-load-indicator-position="right" data-style-progress-indicator-position="right" data-style-button-remove-item-align="false" style="height: 76px;"><input class="filepond--browser" type="file" id="filepond--browser-sq4200i1g" name="images[]" aria-controls="filepond--assistant-sq4200i1g" aria-labelledby="filepond--drop-label-sq4200i1g" accept="image/png,image/jpg,image/jpeg,image/webp" multiple="">
                        <div class="filepond--drop-label" style="transform: translate3d(0px, 0px, 0px); opacity: 1;"><label for="filepond--browser-sq4200i1g" id="filepond--drop-label-sq4200i1g" aria-hidden="true">Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span></label></div>
                        <div class="filepond--list-scroller" style="transform: translate3d(0px, 60px, 0px);">
                            <ul class="filepond--list" role="list"></ul>
                        </div>
                        <div class="filepond--panel filepond--panel-root" data-scalable="true">
                            <div class="filepond--panel-top filepond--panel-root"></div>
                            <div class="filepond--panel-center filepond--panel-root" style="transform: translate3d(0px, 8px, 0px) scale3d(1, 0.6, 1);"></div>
                            <div class="filepond--panel-bottom filepond--panel-root" style="transform: translate3d(0px, 68px, 0px);"></div>
                        </div><span class="filepond--assistant" id="filepond--assistant-sq4200i1g" role="status" aria-live="polite" aria-relevant="additions"></span>
                        <fieldset class="filepond--data"></fieldset>
                        <div class="filepond--drip"></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Change Section</button>
            </form>
        </div>
    </div>
</section>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                The Executive Team
            </h4>
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown"><select class="dataTable-selector form-select">
                            <option value="5">5</option>
                            <option value="10" selected="">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select><label> entries per page</label></div>
                    <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
                </div>
                <a href="admin/about/addMem" class="w-100 btn btn-success btn-sm py-2 fs-6">
                    Add Member
                </a>
                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="member-table">
                        <thead>
                            <tr>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Image</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Name</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Role</a></th>
                                <th data-sortable="" style="width: 50%"><a href="#" class="dataTable-sorter">Description</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Action</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Render using api / database is  -->
                            <tr>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">1</a></td>
                                <td data-sortable="" style="width: 10%">
                                    <img src="public/images/tt-avatar-3.png" alt="" class="card__avatar">
                                </td>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Duong Thanh Tu</a></td>
                                <td data-sortable="" style="width: 10%"><a href="#" class="dataTable-sorter">Boss</a></td>
                                <td data-sortable="" style="width: 50%"><a href="#" class="dataTable-sorter">Artist is a term applied to a person who engages in an activity deemed to be an art.</a></td>
                                <td data-sortable="" style="width: 10%">
                                    <a href="" class="btn btn-success">View</a>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="dataTable-bottom">
                    <!-- Need to be dynamic with the data in database -->
                    <div class="dataTable-info">Showing 1 to 10 of 26 entries</div>
                    <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list pagination pagination-primary">
                            <li class="active page-item"><a href="#" data-page="1" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" data-page="2" class="page-link">2</a></li>
                            <li class="page-item"><a href="#" data-page="3" class="page-link">3</a></li>
                            <li class="pager page-item"><a href="#" data-page="2" class="page-link">›</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>