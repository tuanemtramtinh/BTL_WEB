<div class="container" data-aos="fade-down" data-aos-duration="500">
    <div class="detail_page">
        <div class="detail_page-header">
            <div class="detail_page-info">
                <p class="detail_info-date"><?= htmlspecialchars($data['blog']['DateCreated']) ?></p>
                <p class="detail_info-author"><?= htmlspecialchars($data['blog']['Author']) ?></p>
            </div>
    
            <h2 class="detail__header"><?= htmlspecialchars($data['blog']['Title']) ?></h2>
        </div>
        <!-- <img src="public/images/mau 2.png" alt="" class="detail__bg-img"> -->
        <div class="detail__content">
            <?= $data['blog']['Content'] ?>

        </div>
        <div class="detail__control">
            <?php if (!empty($data['previousPost'])): ?>
                <a href="http://localhost/BTL_WEB/blog/detail?id=<?= htmlspecialchars($data['previousPost']['ID']) ?>" class="detail__control-post">
                    <i class="fa-solid fa-chevron-left"></i>
                    <?= htmlspecialchars($data['previousPost']['Title']) ?>
                </a>
            <?php endif; ?>

            <?php if (!empty($data['nextPost'])): ?>
                <a href="http://localhost/BTL_WEB/blog/detail?id=<?= htmlspecialchars($data['nextPost']['ID']) ?>" class="detail__control-post">
                    <?= htmlspecialchars($data['nextPost']['Title']) ?>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>


        <div class="detail__cmt">
                <p class="detail__cmt-header">Comments</p>
                <div class="detail__cmt-box">
                    <textarea  placeholder="Write your comment..." class="detail__cmt-input"></textarea>
                    <div class="detail__cmt-btn-post">
                        <button class="detail__cmt-btn">Post</button>
                    </div>
                </div>
                <div class="detail__cmt-list">
                    <?php
                        $nameClassLike= "react-toggle-like";
                        $nameClassDislike= "react-toggle-dislike";
                        $nameClass= "like-dislike";
                        for($i=0; $i < 4; $i++){
                            echo "<div class=\"detail__cmt-item\">
                        <img src=\"public/images/mau avt.png\" alt=\"\" class=\"detail__cmt-user-img\">
                        <div class=\"detail__cmt-content\">
                            <div class=\"detail__cmt-user-info\">
                                <p class=\"detail__cmt-user\">John Doe</p>
                                <p class=\"detail__cmt-time\">2023-01-05 12:00:00</p>
                            </div>
                            <p class=\"detail__cmt-text\">This is a great post! Thank you for sharing your knowledge.</p>

                            <div class=\"detail__cmt-react\">
                                
                                <input type=\"radio\" id=\"{$nameClassLike}-{$i}\" class=\"react-toggle\" name=\"{$nameClass}-{$i}\" />
                                <label for=\"{$nameClassLike}-{$i}\" class=\"detail__cmt-react-item\">
                                    <i class=\"fa-regular fa-thumbs-up\"></i>
                                    <p class=\"detail__cmt-react-text\">12</p>
                                </label>
                                
                                <input type=\"radio\" id=\"{$nameClassDislike}-{$i}\" class=\"react-toggle\" name=\"{$nameClass}-{$i}\" />
                                <label for=\"{$nameClassDislike}-{$i}\" class=\"detail__cmt-react-item\">
                                    <i class=\"fa-regular fa-thumbs-down\"></i> <!-- Thường là thumbs-down -->
                                    <p class=\"detail__cmt-react-text\">12</p>
                                </label>
                            </div>

                        </div>
    
                    </div>";
                        }

                    ?>
                </div>
        </div>
    </div>
</div>