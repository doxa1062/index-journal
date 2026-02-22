<?php
$color = $page->color();
snippet('books/header', ['color' => $color]) ?>

<?php $product = $page ?>

<main>
    <section class="title-block product-title" style="background-color: <?= $page->color() ?>">
        <h1 class="text-[6vw]"><span class="title"><?= $page->title() ?></span>
            <?php if ($page->subtitle()->isNotEmpty()) : ?><span class="subtitle"><?= smartypants($page->subtitle()->kti()) ?></span><?php endif ?>
            <?php if ($page->slug() != 'introduction') : ?><span class="author">

                    <ul class="editors text-[6vw]">
                        <?php if ($product->editors()->isNotEmpty()) : ?>
                            <?php foreach ($product->editors()->split() as $editor) : ?>
                                <li class="editor text-[6vw]"><span> <?= $editor ?></span></li>
                            <?php endforeach ?>
                        <?php else : ?>
                            <?php foreach ($product->authors()->split() as $author) : ?>
                                <li class="author text-[6vw]"><span><?= $author ?></span></li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>

                </span><?php endif ?>
        </h1>
    </section>

    <ul class="product-container">


        <li class="text">
            <?= $product->description()->kt() ?>
            <?php if ($product->reviews()->isNotEmpty()) : ?>
                <h2>Reviews</h2>
                <?= $product->reviews()->kt() ?>
            <?php endif ?>
            <div class="layouts">
                <?php foreach ($page->layout()->toLayouts() as $layout) : ?>
                    <section class="grid" id="<?= $layout->id() ?>">
                        <?php foreach ($layout->columns() as $column) : ?>
                            <div class="column" style="--span:<?= $column->span() ?>; --columns:<?= $column->span() ?>">
                                <?php foreach ($column->blocks() as $block) : ?>
                                    <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
                                        <?= $block ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endforeach ?>
                    </section>
                <?php endforeach ?>
            </div>
        </li>
        <li class="image">
            <?php if ($image = $product->cover()->tofile()) : ?>

                <div class="cover-outer-wrapper">
                    <div class="cover-wrapper">
                        <div class="cover">
                            <img alt="<?= $image->alt() ?>" src="<?= $image->resize(300)->url() ?>" srcset="<?= $image->srcset() ?>" width="<?= $image->resize(500)->width() ?>" height="<?= $image->resize(500)->height() ?>" class="m-auto h-[80%] max-w-full">
                        </div>
                    </div>

                    <figcaption class="details">
                        <?= kirbytextinline($product->details()) ?>
                    </figcaption>
                    <figcaption>
                        A$<?php
                            $number = $product->price()->value();
                            echo number_format((float)$number, 2, '.', '');
                            ?>
                    </figcaption>
                    <button type="button" class="add-to-cart is-icon-right snipcart-add-item mt-4 w-full cursor-pointer rounded border border-transparent bg-white p-4 text-black transition duration-200 ease-out hover:bg-black hover:text-white hover:shadow-[0_10px_4px_-8px_rgba(0,0,0,0.5)]" data-item-id="<?= $product->id() ?>" data-item-price="<?= $product->price() ?>" data-item-description="<?= $product->details() ?>" data-item-image="<?= $image->resize(300)->url() ?>" data-item-name="<?= $product->title() ?>" data-item-width="<?= $product->width() ?>" data-item-height="<?= $product->height() ?>" data-item-length="<?= $product->length() ?>" data-item-weight="<?= $product->weight() ?>">
                        <div class="add-to-cart-wrapper flex grow items-center justify-center text-[14px] font-medium">
                            <div class="add-to-cart-wrapper flex grow items-center justify-center text-[14px] font-medium"> ADD TO CART </div>
                        </div>
                    </button>
                </div>


                <!-- product cover -->
                <!-- <figure style="opacity: 1" class="figuregrid ">
                    <span class="img " style="--w:4;--h:3;--background:#333333;background:#333333" data-contain="false">
                        <picture>
                            <source srcset="<?= $image->srcset('avif') ?>" type="image/avif">
                            <source srcset="<?= $image->srcset('webp') ?>" type="image/webp">
                            <img alt="<?= $image->alt() ?>" src="<?= $image->resize(300)->url() ?>" srcset="<?= $image->srcset() ?>" width="<?= $image->resize(500)->width() ?>" height="<?= $image->resize(500)->height() ?>" style="  height: 80%; margin: auto;">
                        </picture>
                    </span>
                </figure> -->






            <?php endif ?>




        </li>


    </ul>


</main>

<?php snippet('books/footer') ?>
