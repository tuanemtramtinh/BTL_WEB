<!-- <section class="section">

</section> -->
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">
                Blog List
            </h5>
            <button type="button" class="btn btn-primary">Thêm bài viết</button>
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top" style="display: flex;justify-content: space-between;">
                    <div class="dataTable-dropdown">
                        <select class="dataTable-selector form-select">
                            <option value="5">5</option>
                            <option value="10" selected="">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                        <label> entries per page</label>
                    </div>
                    <div class="dataTable-search">
                        <input class="dataTable-input" placeholder="Search..." type="text">
                    </div>
                </div>
                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                            <tr>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">ARTICLE ID</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">TITLE</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">TAG</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">PUBLISH DATE</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">ACTION</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 10;
                            for( $i = 0; $i < $count; $i++){
                                echo '<tr>
                                <td class="text-bold-500">#1234355</td>
                                <td>Finding Your Signature Scent: A Guide to Perfume Personalities</td>
                                <td class="text-bold-500">Animation</td>
                                <td>27/05/2004</td>
                                <td><a href="#">View Full Detail <i class="bi bi-chevron-double-right"></i></a></td>
                            </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="dataTable-bottom">
                    <div class="dataTable-info">Showing 1 to 10 of 10 entries</div>
                    <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list pagination pagination-primary">
                            <li class="active page-item"><a href="#" data-page="1" class="page-link">1</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
