<div class="container">
    <div class="blog_page">
        <h2 class="blog__header">Our Blog Collection</h2>
        <div class="blog__best">
            <div class="blog__best-left">
                <p class="blog__best-left-header">Discover the Art of Perfumery</p>
                <p class="blog__best-left-text">Welcome to Local Face's Perfumery Blog Collection! Here, we invite you to immerse yourself in the captivating world of fragrances, where each blog post is a sensory journey that unveils the magic and allure of perfumes. Our team of fragrance enthusiasts, industry experts, and perfumers have curated an array of captivating articles to enrich your understanding and appreciation for these olfactory delights.</p>
                <p class="blog__best-left-text">At Local Face, we believe that perfumery is an extraordinary fusion of art, science, and emotion. Our passion for exquisite fragrances has inspired us to curate a treasure trove of blog posts, each designed to ignite your senses.</p>
            </div>
            <div class="blog__slider">
                <?php
                    $lengthBlogPostList = 3;
                    $tileBlogPostPhone = $lengthBlogPostList * 2;
                    $withBlogPost = $lengthBlogPostList * 2 * 100;
                    echo "<div class=\"blog__slider-track\" style=\"width: {$withBlogPost}%;\">";
                    for($i=0; $i < $lengthBlogPostList; $i++){
                        echo "<div class=\"blog__slide\">
                            <img src=\"public/images/Frame 481.png\" alt=\"\" class=\"blog__best-right\">
                        </div>
                        <div class=\"blog__slide\">
                            <img src=\"public/images/mau 2.png\" alt=\"\" class=\"blog__best-right\">
                        </div>";
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
        <div class="blog__search-chua">
            <div class="blog__search">
                <input type="text" placeholder="Search here" class="blog__search-input" id="search-input">
                <label for="search-input" class="blog__search-label">
                    <i class="fa-solid fa-magnifying-glass blog__search-icon" id="blog__search-icon-js"></i>
                </label>
            </div>
            <div class="blog__search-keyword">
                <ul class="blog__search-list">
                    <!-- <li class="blog__search-item">All</li>
                    <li class="blog__search-item">Perfume</li>
                    <li class="blog__search-item">Event</li>
                    <li class="blog__search-item">Sale</li>
                    <li class="blog__search-item">All</li>
                    <li class="blog__search-item">Perfume</li>
                    <li class="blog__search-item">Event</li>
                    <li class="blog__search-item">Sale</li> -->
                    <?php
                        $lengthSearchList = 8;
                        for($i=0; $i < $lengthSearchList; $i++){
                            echo "<li class=\"blog__search-item\">Perfume</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>
        
        <div class="blog__posts">
            <?php
                for($i=0;$i<10;$i++){
                    echo "<div class=\"blog__post-item\">
                            <img src=\"public/images/dartistana_create_a_professional_product_shoot_of_3_perfume_bot_3e6bf181-e7e3-410a-96fa-977eb5e88c24 1.png\" alt=\"\" class=\"blog__post-img\">
                            <p class=\"blog__post-content\">Finding Your Signature Scent: A Guide to Perfume Personalities</p>
                            <p class=\"blog__post-note\">Embark on a journey of self-discovery as we delve into the concept of perfume personalities. From bold and adventurous to elegant and timeless, there's a fragrance that perfectly complements your essence. Let us help you find your signature scent, a fragrant expression of your unique style.</p>
                            <a href=\"http://localhost/BTL_WEB/blog/detail\" class=\"blog__post-readmore-link\"><button class=\"blog__post-readmore\">Read More</button></a>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
</div>