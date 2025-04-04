<!-- <section class="section">

</section> -->
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">
                Blog List
            </h5>
            <a href="admin/blog/add" class="btn btn-primary">Add blog</a>
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top" style="display: flex;justify-content: space-between;">
                <div class="dataTable-dropdown">
                    <select class="dataTable-selector form-select" id="entriesPerPage" onchange="changeEntriesPerPage(this.value)">
                        <option value="5" <?php echo ($data['limit'] == 5) ? 'selected' : '' ;?>>5</option>
                        <option value="10" <?php echo ($data['limit'] == 10) ? 'selected' : '' ;?>>10</option>
                        <option value="15" <?php echo ($data['limit'] == 15) ? 'selected' : '' ;?>>15</option>
                        <option value="20" <?php echo ($data['limit'] == 20) ? 'selected' : '' ;?>>20</option>
                        <option value="25" <?php echo ($data['limit'] == 25) ? 'selected' : '' ;?>>25</option>
                    </select>
                    <label> entries per page</label>
                </div>
                <script>
                function changeEntriesPerPage(limit) {
                    const urlParams = new URLSearchParams(window.location.search);
                    urlParams.set('limit', limit);
                    urlParams.set('page', 1);
                    window.location.search = urlParams.toString();
                }
                </script>
                    <div class="dataTable-search">
                        <form method="get" action="">
                            <input class="dataTable-input" name="search" placeholder="Search..." type="text" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';?>">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
                <div class="dataTable-container">
                    <table class="table table-striped dataTable-table" id="table1">
                        <thead>
                            <tr>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">ID</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">Title</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">Author</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">DateCreated</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">BlogCategory</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">Image</a></th>
                                <th data-sortable=""><a href="#" class="dataTable-sorter">Detail</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['blogs'])): ;?>
                                <?php foreach ($data['blogs'] as $blog): ;?>
                                
                                    <tr>
                                        <td><?php echo $blog['BlogID'] ;?></td>
                                        <td><?php echo $blog['Title'] ;?></td>
                                        <td><?php echo $blog['Author'] ;?></td>
                                        <td>
                                            <?php echo date('d/m/Y', strtotime($blog['DateCreated'])) ;?>
                                        </td>
                                        
                                        <td><?php echo $blog['CategoryName'] ;?></td>
                                        <td>
                                            <?php 
                                            if (!empty($blog['Image'])): 
                                                $blogImages = json_decode($blog['Image'], true);
                                                $firstImage = !empty($blogImages) ? $blogImages[0] : 'public/images/bg-1.png';
                                            ?>
                                                <img src="<?php echo htmlspecialchars($firstImage); ?>" 
                                                    alt="Blog Image"
                                                    style="aspect-ratio: 1/1; object-fit: contain; width: 150px;"
                                                    onerror="this.src='public/images/bg-1.png'">
                                            <?php else: ?>
                                                <img src="public/images/bg-1.png" 
                                                    alt="No Image"
                                                    style="aspect-ratio: 1/1; object-fit: contain; width: 150px;">
                                            <?php endif; ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <a href="admin/blog/detail?id=<?php echo $blog['BlogID'] ;?>">
                                                View <i class="bi bi-chevron-double-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ;?>
                            <?php else: ;?>
                                <tr>
                                    <td colspan="8">No blogs found.</td>
                                </tr>
                            <?php endif; ;?>
                        </tbody>

                    </table>
                </div>
                <?php
                    $totalBlogs  = $data['totalBlogs'];
                    $currentPage = $data['currentPage'];
                    $totalPages  = $data['totalPages'];
                    $limit       = $data['limit']; 
                    $start = ($currentPage - 1) * $limit + 1;
                    $end   = min($start + $limit - 1, $totalBlogs);
                ;?>
                <div class="dataTable-bottom" style="display: flex;justify-content: space-between;">
                    <div class="dataTable-info">
                        Showing <?php echo $start ;?> to <?php echo $end ;?> of <?php echo $totalBlogs ;?> entries
                    </div>

                    <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list pagination pagination-primary">
                           
                            <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : '' ;?>">
                            <a class="page-link" href="admin/blog?limit=<?php echo $data['limit'];?>&page=<?php echo max($currentPage - 1, 1);?>">Prev</a>
                            </li>

                            <?php for ($page = 1; $page <= $totalPages; $page++):;?>
                                <li class="page-item <?php echo ($page == $currentPage) ? 'active' : '';?>">
                                    <a class="page-link" href="admin/blog?limit=<?php echo $data['limit'];?>&page=<?php echo $page;?>">
                                        <?php echo $page;?>
                                    </a>
                                </li>
                            <?php endfor;?>


                            <li class="page-item <?php echo ($currentPage >= $totalPages) ? 'disabled' : '' ;?>">
                            <a class="page-link" href="admin/blog?limit=<?php echo $data['limit'];?>&page=<?php echo min($currentPage + 1, $totalPages);?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const existingImage = undefined;

</script>
