<?php
$titleSection = $data["titleSection"];
$contentTitle = json_decode($titleSection["Content"], true);
$storySection = $data["storySection"];
$storyContent = json_decode($storySection["Content"], true);
$showcaseSection = $data["showcaseSection"];
$showcaseContent = json_decode($showcaseSection["Background"], true);
$uniqueSection = $data["uniqueSection"];
$uniqueSectionContent = json_decode($uniqueSection["Content"], true);
$inviteSection = $data["inviteSection"];
$inviteContent = $inviteSection["Content"];
?>
<div class="about__section1" style="background-image: url('<?= json_decode($titleSection['Background'])[0] ?>');">
    <div class="container">
        <div class="about__section1-wrapper">
            <div class="about__section1-content">
                <?= $contentTitle['title'] ?>
                <?= $contentTitle['content'] ?>
            </div>
        </div>
    </div>
</div>

<div class="about__section-bonus">
    <div class="container">
        <div class="about__section-bonus-wrapper">
            <h4 class="section-bonus__title">
                The Executive Team
            </h4>
            <div class="section-bonus__team">
                <?php foreach ($data["member"] as $member) {
                    $image = json_decode($member['Image']);
                    $image = $image[0] ?>
                    <div class="team__card">
                        <img src="<?= $image ?>" alt="<?= $member["Name"] ?>'s avatar" class="card__avatar">
                        <div class="card__info-detail">
                            <h4 class="info-detail__name">
                                <?= $member["Name"] ?>
                            </h4>
                            <p class="info-detail__job">
                                <?= $member["Role"] ?>
                            </p>
                            <p class="info-detail__describe">
                                <?= $member["Description"] ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="about__section2">
    <div class="container">
        <div class="about__section2-wrapper">
            <div class="about__section2-content">
                <?= $storyContent["title"] ?>
                <?= $storyContent["content"] ?>
            </div>
        </div>
    </div>
</div>

<div class="about__section3">
    <div class="container">
        <div class="about__section3-wrapper">
            <img src="<?= $showcaseContent[0] ?>" alt="showcase image" class="about__section3-image">
        </div>
    </div>
</div>

<div class="about__section4">
    <div class="container">
        <div class="about__section4-wrapper">
            <div class="about__section4-unique">
                <?= $uniqueSectionContent["title"] ?>
                <div class="about__section4-unique-items">
                    <div class="about__section4-unique-item">
                        <?= $uniqueSectionContent["leftTitle"] ?>
                        <?= $uniqueSectionContent["leftContent"] ?>
                    </div>
                    <div class="about__section4-unique-item">
                        <?= $uniqueSectionContent["middleTitle"] ?>
                        <?= $uniqueSectionContent["middleContent"] ?>
                    </div>
                    <div class="about__section4-unique-item">
                        <?= $uniqueSectionContent["rightTitle"] ?>
                        <?= $uniqueSectionContent["rightContent"] ?>
                    </div>
                </div>
            </div>
            <div class="about__section4-invite">
                <?= $inviteContent ?>
            </div>
        </div>
    </div>
</div>