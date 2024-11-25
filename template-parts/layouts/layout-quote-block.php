<?php

$name = get_sub_field('name');
$content = get_sub_field('content');
?>
<div class="b-quote" data-aos="fade-up">
    <div class="o-wrapper">
        <div class="b-quote__wrapper">

            <p data-aos="fade-up"><?php echo $content; ?></p>
            <?php if ($name) : ?>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="b-quote__name">
                        <?=$name?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

