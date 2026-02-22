<?php
$url = (string) ($url ?? '');
$image = $image ?? null;
$imageAlt = trim((string) ($imageAlt ?? ''));
$placeholder = trim((string) ($placeholder ?? ''));
$titlePrefix = (string) ($titlePrefix ?? '');
$title = trim((string) ($title ?? ''));
$type = trim((string) ($type ?? ''));
$meta = trim((string) ($meta ?? ''));
$summary = trim((string) ($summary ?? ''));
$highlightColor = trim((string) ($highlightColor ?? '#f0f412'));

$resolvedImageAlt = $imageAlt !== '' ? $imageAlt : trim($titlePrefix . $title);
?>

<article class="self-start" style="--ij-issue-highlight: <?= esc($highlightColor) ?>;">
  <a href="<?= esc($url) ?>" class="group block">
    <?php if ($image) : ?>
      <figure class="relative aspect-[4/3] w-full overflow-hidden bg-[#d1d1d1]">
        <img
          src="<?= esc($image->url()) ?>"
          alt="<?= esc($resolvedImageAlt) ?>"
          class="block h-full w-full object-cover transition-transform duration-200 ease-in-out group-hover:scale-[1.02]">
      </figure>
    <?php else : ?>
      <div class="flex aspect-[4/3] w-full items-end justify-start bg-[#cdcdcd] p-[0.9rem] text-[0.95rem] font-bold tracking-[0.02em]">
        <span><?= esc($placeholder) ?></span>
      </div>
    <?php endif ?>

    <div class="mb-[0.15rem] mt-[0.72rem] max-w-full text-left  text-[3rem]   tracking-[-0.03em] normal-case max-[1450px]:text-[2.45rem] max-[1180px]:text-[2rem] max-[760px]:text-[1.72rem]">
      <span class="inline box-decoration-clone px-[0.16rem] pb-[0.04rem] transition-colors duration-200 group-hover:bg-[var(--ij-issue-highlight)]">
        <?= esc($titlePrefix . $title) ?>
      </span>
    </div>

    <?php if ($meta !== '') : ?>
      <p class="mb-[0.38rem] max-w-full text-left  text-[2.5rem] font-bold italic  normal-case max-[1450px]:text-[2.05rem] max-[1180px]:text-[1.72rem] max-[760px]:text-[1.4rem]">
        <span class="inline box-decoration-clone px-[0.16rem] pb-[0.04rem] transition-colors duration-200 group-hover:bg-[var(--ij-issue-highlight)]">
          <?= esc($meta) ?>
        </span>
      </p>
    <?php endif ?>

    <?php if ($summary !== '') : ?>
      <p class="m-0 max-w-[95%]  text-[0.99rem] leading-[1.26] normal-case max-[760px]:text-[0.9rem]">
        <?= esc($summary) ?>
      </p>
    <?php endif ?>
  </a>
</article>
