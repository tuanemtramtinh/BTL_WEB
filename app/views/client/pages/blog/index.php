<!-- views/blog/index.php -->
<div class="container">
  <div class="blog_page">
    <h2 class="blog__header" data-aos="fade-down" data-aos-duration="300">Our Blog Collection</h2>
    <?php
      $introImages = json_decode($data['blogIntro']['Images'] ?? '[]', true);
      $introImages = is_array($introImages) ? $introImages : [];
      $introContent = $data['blogIntro']['Content'] ?? '';
    ?>
    <div class="blog__best">
      <div class="blog__best-left" data-aos="fade-right" data-aos-duration="300">
        <!-- <p class="blog__best-left-text"> -->
        <!-- </p> -->
        <?= $introContent ?>
      </div>
      

      <div class="blog__slider" data-aos="fade-left" data-aos-duration="300">
      <?php
        $lengthBlogPostList = count($introImages);
        $tileBlogPostPhone = $lengthBlogPostList * 2;
        $withBlogPost = $lengthBlogPostList * 2 * 100;
        echo "<div class=\"blog__slider-track\" style=\"width: {$withBlogPost}%;\">";
        for ($i = 0; $i < 2; $i++) {
          foreach($introImages as $img){
              echo "<div class=\"blog__slide\">
                  <img src=\"" . htmlspecialchars($img) . "\" alt=\"\" class=\"blog__best-right\">
              </div>";
          }
        }
        echo "</div>";
        echo "<style>
                @media (max-width: 767px) {
                    .blog__slider-track {
                        aspect-ratio: {$tileBlogPostPhone} / 1;
                    }
                }
            </style>";
        ?>
            <div class="slide-overlay">
                <p class="slide-text">This is a display product image</p>
        </div>
      </div>
    </div>
    
    <div class="blog__search-chua" data-aos="fade-down" data-aos-duration="300">
      <div class="blog__search">
        <form method="get" action="" id="search-form" 
        onsubmit="return false;" style="width: 100%;justify-content: space-between;display: flex;">
            <input type="text" name="search" placeholder="Search here" class="blog__search-input" id="search-input"
                  value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            <label for="search-input" class="blog__search-label">
              <i class="fa-solid fa-magnifying-glass blog__search-icon" id="blog__search-icon-js"></i>
            </label>
          </form>
      </div>
      <div class="blog__search-keyword">
        <ul class="blog__search-list">
          <?php if (!empty($data['categories'])): ?>
            <?php foreach ($data['categories'] as $cat): ?>
              <li class="blog__search-item <?= (isset($_GET['category']) && $_GET['category'] == $cat['ID']) ? 'active' : '' ?>" 
                  data-category-id="<?= $cat['ID'] ?>"
                  data-category-name="<?= htmlspecialchars($cat['Name']) ?>">
                <?= htmlspecialchars($cat['Name']) ?>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="blog__search-item">No category</li>
          <?php endif; ?>
          <button class="btn btn-sm btn-danger mb-2 clear-filter">Clear Filter Tag</button>
        </ul>
          
                
          
        
      </div>
    </div>
    
    <div class="blog__posts">
      <?php if (!empty($data['blogs'])): ?>
        <?php foreach ($data['blogs'] as $blog): ?>
          <?php
          $imageData = json_decode($blog['Image'], true);
          $imageUrl = !empty($imageData) ? $imageData[0] : ''; 
          ?>
          <a href="http://localhost/BTL_WEB/blog/detail?id=<?= htmlspecialchars($blog['BlogID']) ?>" class="blog__post-item" data-aos="fade-down" data-aos-duration="300" style="display: flex;flex-direction: column;justify-content: space-around;">
            <img src="<?= htmlspecialchars($imageUrl) ?>" alt="" class="blog__post-img">
            <p class="blog__post-content"><?= htmlspecialchars($blog['Title']) ?></p>
            <p class="blog__post-note"><?= htmlspecialchars($blog['Desc']) ?></p>
            <button class="blog__post-readmore">Read More</button>
          </a>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No blog posts found.</p>
      <?php endif; ?>
    </div>

    <?php if ($data['totalPages'] > 1): ?>
    <div class="pagination-custom" data-aos="fade-up" data-aos-duration="300">
        <?php
        $currentPage = $data['currentPage'];
        $totalPages = $data['totalPages'];
        $prevPage = max($currentPage - 1, 1);
        $nextPage = min($currentPage + 1, $totalPages);
        
        $queryParams = $_GET;
        unset($queryParams['page']);
        $queryString = !empty($queryParams) ? '&' . http_build_query($queryParams) : '';
        ?>

        <a class="pagination-button prev <?= ($currentPage <= 1) ? 'disabled' : '' ?>" 
            href="?page=<?= $prevPage ?><?= $queryString ?>">
            <i class="fa-solid fa-angle-left"></i>
        </a>

        <span class="pagination-text">Page <?= $currentPage ?> of <?= $totalPages ?></span>

        <a class="pagination-button next <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>" 
            href="?page=<?= $nextPage ?><?= $queryString ?>">
            <i class="fa-solid fa-angle-right"></i>
        </a>
    </div>
    <?php endif; ?>
  </div>
</div>