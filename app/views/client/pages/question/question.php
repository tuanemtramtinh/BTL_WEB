<?php
$Types = $data['allType'];
?>
<div class="question__section1">
    <div class="container">
        <div class="question__section1-wrapper">
            <div class="question__header">
                <h3 class="question__header-title">
                    FAQ Question Form about Perfume
                </h3>
                <p class="question__header-notice">Hỏi những câu hỏi ngắn và xúc tích để chúng tôi có thể giải đáp thắc mắc của bạn</p>
            </div>
            <div class="question__body">
                <form action="question/sendQuestion" method="POST" class="question__form">
                    <div class="question__body-name">
                        <label for="name">Họ và tên</label>
                        <input type="text" id="name" name="name">
                    </div>
                    <div class="question__body-email">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="question__body-type">
                        <label for="type">Loại câu hỏi</label>
                        <select name="type" id="type" value="Sản phẩm">
                            <!-- <option value="Sản phẩm">Sản phẩm</option>
                            <option value="Cửa hàng">Cửa hàng</option>
                            <option value="Tuyển dụng">Tuyển dụng</option>
                            <option value="Ưu đãi">Ưu đãi</option> -->
                            <?php foreach ($Types as $Type) { ?>
                                <option value="<?= $Type['Name'] ?>"><?= $Type['Name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="question__body-question">
                        <label for="question">Câu hỏi: </label>
                        <input type="text" id="question" name="question">
                    </div>
                    <div class="question__body-submit">
                        <button type="submit">Gửi câu hỏi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>