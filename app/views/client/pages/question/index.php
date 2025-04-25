<?php
$Questions = $data['answeredQuestion'];
?>

<div class="contact__section1">
    <div class="container">
        <div class="contact__section1-wrapper">
            <h2 class="contact__section1-title">Hello, how can Perfumé help you?</h2>
            <div class="contact__section1-content">
                <div class="contact__section1-accordion">
                    <?php foreach ($Questions as $question) { ?>
                        <div class="contact__section1-item">
                            <div class="contact__section1-item-header">
                                <p class="contact__section1-header-question"><?= $question['Question'] ?> - <?= $question['QuestionType'] ?></p>
                                <button class="contact__section1-header-button">+</button>
                            </div>
                            <div class="contact__section1-item-answer">
                                <p><?= $question['Answer'] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="contact__section1-email">
                    <img src="public/images/tt-icon-1.png" alt="chat box" class="contact__section1-email-icon contact__activate">
                    <p class="contact__section1-email-header">Do you have more questions?</p>
                    <p class="contact__section1-email-detail">End-to-end payments and financial management in a single solution. Meet the right platform to help realize.</p>
                    <button class="contact__section1-email-button" onclick='location.href="question/question"'>
                        contact now !
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var items = document.querySelectorAll(".contact__section1-item");

        function getIcons() {
            return window.innerWidth > 768 ? {
                active: "<i class=\"fa-solid fa-x\"></i>",
                deactive: "<i class=\"fa-solid fa-plus\"></i>"
            } : {
                active: "<i class=\"fa-solid fa-angle-up\"></i>",
                deactive: "<i class=\"fa-solid fa-angle-down\"></i>"
            };
        }

        function updateIcons() {
            var icons = getIcons();
            items.forEach(function(item) {
                var button = item.querySelector(".contact__section1-header-button");
                if (item.classList.contains("active")) {
                    button.innerHTML = icons.active;
                } else {
                    button.innerHTML = icons.deactive;
                }
            });
        }

        items.forEach(function(item) {
            var header = item.querySelector(".contact__section1-item-header");
            var answer = item.querySelector(".contact__section1-item-answer");
            var button = item.querySelector(".contact__section1-header-button");

            header.addEventListener("click", function() {
                var isActive = item.classList.contains("active");

                items.forEach(function(el) {
                    el.classList.remove("active");
                    el.querySelector(".contact__section1-item-answer").style.maxHeight = "0";
                    el.querySelector(".contact__section1-item-answer").style.padding = "0 18px";
                });

                if (!isActive) {
                    item.classList.add("active");

                    answer.style.maxHeight = "none";
                    let fullHeight = 80 + "px";

                    answer.style.maxHeight = fullHeight;
                    answer.style.padding = "18px";
                }
                updateIcons();
            });
        });
        window.addEventListener("resize", updateIcons);
        updateIcons();
    });
</script>