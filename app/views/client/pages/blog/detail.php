<div class="container" data-aos="fade-down" data-aos-duration="500">
    <div class="detail_page">
        <div class="detail_page-header">
            <div class="detail_page-info">
                <div class="detail_page-info-DEBUG">
                    <p class="detail_info-date"><?= htmlspecialchars($data['blog']['DateCreated']) ?></p>
                    <p class="detail_info-author"><?= htmlspecialchars($data['blog']['Author']) ?></p>
                </div>
                <p class="detail_info-cata"><a href="javascript:void(0)" 
                    class="category-link" 
                    data-category="<?= htmlspecialchars($data['blog']['CategoryName']) ?>">
                    ##<?= htmlspecialchars($data['blog']['CategoryName']) ?>
                </a></p>
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
                <a href="blog/detail?id=<?= htmlspecialchars($data['previousPost']['ID']) ?>" class="detail__control-post">
                    <i class="fa-solid fa-chevron-left"></i>
                    Prev
                </a>
            <?php endif; ?>

            <?php if (!empty($data['nextPost'])): ?>
                <a href="blog/detail?id=<?= htmlspecialchars($data['nextPost']['ID']) ?>" class="detail__control-post">
                    Next
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            <?php endif; ?>
        </div>


        <div class="detail__cmt" id="comment">
            <!-- <div id="flashMessage"></div> -->
            <div id="flashMessage">
            </div>

            <p class="detail__cmt-header">Comments</p>
            
            <div class="detail__cmt-box">
                <form id="commentForm" action="blog/addComment" method="POST" class="detail__cmt-form">
                    <textarea name="Content" placeholder="Write your comment..." class="detail__cmt-input" required></textarea>
                    <input type="hidden" name="ID_Blog" value="<?= htmlspecialchars($data['blog']['BlogID']) ?>">
                    <input type="hidden" name="Status" value="pending"> 
                    <div class="detail__cmt-btn-post">
                        <button type="submit" class="detail__cmt-btn">Post</button>
                    </div>
                </form>
            </div>

            <div class="detail__cmt-list">
                <?php if (!empty($data['comments'])): ?>
                    <?php foreach ($data['comments'] as $comment): ?>
                        <?php if ($comment['Status'] == 'approved'): ?>
                            <?php
                                $statusCMT = null;
                                if (!empty($data['userCommentStatus'])) {
                                    foreach ($data['userCommentStatus'] as $status) {
                                        if ($status['CommentID'] == $comment['ID']) {
                                            $statusCMT = strval($status['StatusCMT']);
                                            break;
                                        }
                                    }
                                }
                            ?>
                            <?php
                                $defaultAvatar = 'https://static.vecteezy.com/system/resources/previews/009/292/244/non_2x/default-avatar-icon-of-social-media-user-vector.jpg';
                                $avatarPath = $defaultAvatar;

                                if (!empty($comment['Avatar'])) {
                                    $avatars = json_decode($comment['Avatar'], true);
                                    if (is_array($avatars) && isset($avatars[0]) && $avatars[0] !== '') {
                                        $avatarPath = $avatars[0];
                                    }
                                }
                            ?>
                            <div class="detail__cmt-item">
                                <img src="<?= htmlspecialchars($avatarPath) ?>"
                                    alt="User Avatar"
                                    class="detail__cmt-user-img">
                                <div class="detail__cmt-content">
                                    <div class="detail__cmt-user-info">
                                        <p class="detail__cmt-user"><?= htmlspecialchars($comment['name_Customer'] ?? 'John Doe') ?></p>
                                        <p class="detail__cmt-time"><?= htmlspecialchars($comment['CreatedAt']) ?></p>
                                    </div>
                                    <p class="detail__cmt-text"><?= htmlspecialchars($comment['Content']) ?></p>
                                    <div class="detail__cmt-react">
                                        <input type="radio" id="react-toggle-like-<?= htmlspecialchars($comment['ID']) ?>"
                                            class="react-toggle"
                                            name="like-dislike-<?= htmlspecialchars($comment['ID']) ?>"
                                            data-action="like"
                                            data-id="<?= htmlspecialchars($comment['ID']) ?>" />
                                        <label for="react-toggle-like-<?= htmlspecialchars($comment['ID']) ?>"
                                            class="detail__cmt-react-item <?= (strval($statusCMT) === '1') ? 'active' : '' ?>"
                                            id="like-label-<?= htmlspecialchars($comment['ID']) ?>">
                                            <i class="fa-regular fa-thumbs-up"></i>
                                            <p class="detail__cmt-react-text" id="like-count-<?= htmlspecialchars($comment['ID']) ?>">
                                                <?= htmlspecialchars($comment['Like']) ?>
                                            </p>
                                        </label>

                                        <input type="radio" id="react-toggle-dislike-<?= htmlspecialchars($comment['ID']) ?>"
                                            class="react-toggle"
                                            name="like-dislike-<?= htmlspecialchars($comment['ID']) ?>"
                                            data-action="dislike"
                                            data-id="<?= htmlspecialchars($comment['ID']) ?>" />
                                        <label for="react-toggle-dislike-<?= htmlspecialchars($comment['ID']) ?>"
                                            class="detail__cmt-react-item <?= (strval($statusCMT) === '0') ? 'active' : '' ?>"
                                            id="dislike-label-<?= htmlspecialchars($comment['ID']) ?>">
                                            <i class="fa-regular fa-thumbs-down"></i>
                                            <p class="detail__cmt-react-text" id="dislike-count-<?= htmlspecialchars($comment['ID']) ?>">
                                                <?= htmlspecialchars($comment['Dislike']) ?>
                                            </p>
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



