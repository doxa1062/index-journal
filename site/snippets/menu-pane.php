<section class="menu-pane fixed top-0 z-1000 hidden w-screen overflow-scroll bg-white p-4 shadow-header" <?php if ($page->template() == 'essay') : ?> style="background-color: <?= issueColorCss($page->parent()->issue_color()) ?>; box-shadow: 0px 15px 16px 0px <?= issueColorCss($page->parent()->issue_color(), 0.55) ?>;" <?php endif ?><?php if ($page->template() == 'product') : ?> style="background-color: <?= $page->color() ?>; box-shadow: 0px 15px 16px 0px <?= $page->color() ?>;" <?php endif ?>>
    <h1 class="close absolute right-4 top-4 cursor-pointer">(close)</h1>

    <h1 class="flex flex-row">
        <a href="/">INDEX JOURNAL</a>
        <?php foreach (page('issues')->children()->listed()->flip()->slice(0, 1) as $issue) : ?>
            <a href="<?= $issue->url() ?>" class="current-issue"><span>, Issue </span><span>No. </span><?= $issue->num() ?><span class="uppercase"> <?= $issue->title() ?></span></a>
        <?php endforeach ?>
    </h1>
    <h1>Issues</h1>
    <ul class="mt-0">
        <?php foreach ($site->find('issues')->children()->listed() as $subPage) : ?>
            <h1><a href="<?= $subPage->url() ?>">Issue No. <?= $subPage->num() ?> <span class="uppercase"><?= $subPage->title() ?></span></a></h1>

        <?php endforeach ?>
    </ul>
    <h1>Special Issues</h1>
    <ul class="mt-0">
        <?php foreach ($site->find('special-issues')->children()->listed() as $subPage) : ?>
            <h1><a href="<?= $subPage->url() ?>"> <span class="uppercase"><?= $subPage->title() ?></span></a></h1>

        <?php endforeach ?>
    </ul>

    <h1><a href="https://index-press.com/" target="_blank">Index Press</a></h1>
    <h1><a href="/about">About</a></h1>
    <h1><a href="<?= $site->url() ?>/emaj">EMAJ</a></h1>
</section>
