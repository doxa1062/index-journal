<?php snippet('books/header', ['color' => 'white']) ?>
<main class="shop px-0 pb-[5.6em] pr-16 pt-[5.6em] menu:pr-4">
    <div>
        <ul class="shop-about">
            <?= $site->about()->kt() ?>
        </ul>
        <ul class="shop-container">

            <?php foreach ($page->children()->listed() as $product) : ?>
                <li>
                    <a href="<?= $product->url() ?>" class="link-container">
                        <?php if ($image = $product->cover()->tofile()) : ?>
                            <figure class="figuregrid product">
                                <span class="img" style="--w:4;--h:3;--background:black;background:black" data-contain="false">
                                    <picture>
                                        <source srcset="<?= $image->srcset('webp') ?>" type="image/webp">
                                        <img alt="<?= $image->alt() ?>" src="<?= $image->url() ?>" srcset="<?= $image->srcset('default') ?>" class="m-auto h-[80%]">
                                    </picture>
                                </span>
                            </figure>
                            <div class="info">
                                <figcaption class="text">
                                    <p><?= $product->title() ?></p>
                                    <?php if ($product->editors()) : ?>

                                        <ul class="editors mt-[0.6rem]">
                                            <?php if ($product->editors()->isNotEmpty()) : ?>
                                                <?php foreach ($product->editors()->split() as $editor) : ?>
                                                    <li class="editor sub-title-books"><span> <?= $editor ?></span></li>
                                                <?php endforeach ?>
                                            <?php else : ?>
                                                <?php foreach ($product->authors()->split() as $author) : ?>
                                                    <li class="author sub-title-books"><span><?= $author ?></span></li>
                                                <?php endforeach ?>
                                            <?php endif ?>

                                        </ul>
                                    <?php endif ?>
                                </figcaption>
                            </div>
                        <?php endif ?>

                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</main>

<?php snippet('books/footer') ?>
