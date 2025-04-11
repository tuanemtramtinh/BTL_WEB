<div class="container" data-aos="fade-down" data-aos-duration="500">
    <div class="detail_page">
        <div class="detail_page-header">
            <div class="detail_page-info">
                <div class="detail_page-info-DEBUG">
                    <p class="detail_info-date"><?= htmlspecialchars($data['blog']['DateCreated']) ?></p>
                    <p class="detail_info-author"><?= htmlspecialchars($data['blog']['Author']) ?></p>
                </div>
                <p class="detail_info-cata"><a href="">##<?= htmlspecialchars($data['blog']['CategoryName']) ?></a></p>
                <div class="detail__share">
                    <button class="detail__share-btn" onclick="copyPostLink()">
                        <i class="fa-solid fa-link"></i> Copy Link
                    </button>
                    <span class="detail__share-notify" style="display: none; color: green; font-size: 14px;">Copied!</span>
                </div>
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
                    Prev
                </a>
            <?php endif; ?>

            <?php if (!empty($data['nextPost'])): ?>
                <a href="http://localhost/BTL_WEB/blog/detail?id=<?= htmlspecialchars($data['nextPost']['ID']) ?>" class="detail__control-post">
                    Next
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>


        <div class="detail__cmt" id="comment">
                <p class="detail__cmt-header">Comments</p>
                <div class="detail__cmt-box">
                    <form action="http://localhost/BTL_WEB/blog/addComment" method="POST" class="detail__cmt-form">
                        <textarea name="Content" placeholder="Write your comment..." class="detail__cmt-input" required></textarea>
                        <input type="hidden" name="ID_Blog" value="<?= $data['blog']['BlogID'] ?>">
                        <input type="hidden" name="ID_Customer" value="<?= $_SESSION['userId'] ?? '' ?>">
                        <input type="hidden" name="Status" value="pending"> 

                        <div class="detail__cmt-btn-post">
                            <button type="submit" class="detail__cmt-btn">Post</button>
                        </div>
                    </form>
                </div>

                <div class="detail__cmt-list">
                    <?php if(!empty($data['comments'])): ?>
                        <?php foreach($data['comments'] as $comment): ?>
                            <?php if($comment['Status'] == 'approved'): ?>
                                <div class="detail__cmt-item">
                                    <img src="public/images/mau avt.png" alt="User Avatar" class="detail__cmt-user-img">
                                    <div class="detail__cmt-content">
                                    <div class="detail__cmt-user-info">
                                        <p class="detail__cmt-user"><?= htmlspecialchars($comment['name_Customer'] ?? 'John Doe') ?></p>
                                        <p class="detail__cmt-time"><?= $comment['CreatedAt'] ?></p>
                                    </div>
                                    <p class="detail__cmt-text"><?= htmlspecialchars($comment['Content']) ?></p>
                                    <div class="detail__cmt-react">
                                        <input type="radio" id="react-toggle-like-<?= $comment['ID'] ?>" class="react-toggle" name="like-dislike-<?= $comment['ID'] ?>" />
                                        <label for="react-toggle-like-<?= $comment['ID'] ?>" class="detail__cmt-react-item">
                                        <i class="fa-regular fa-thumbs-up"></i>
                                        <p class="detail__cmt-react-text"><?= htmlspecialchars($comment['Like']) ?></p>
                                        </label>
                                        <input type="radio" id="react-toggle-dislike-<?= $comment['ID'] ?>" class="react-toggle" name="like-dislike-<?= $comment['ID'] ?>" />
                                        <label for="react-toggle-dislike-<?= $comment['ID'] ?>" class="detail__cmt-react-item">
                                        <i class="fa-regular fa-thumbs-down"></i>
                                        <p class="detail__cmt-react-text"><?= htmlspecialchars($comment['Dislike']) ?></p>
                                        </label>
                                    </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="blog-kococmt">No comments yet.</p>
                    <?php endif; ?>
                </div>

        </div>
    </div>
</div>

