<!-- https://plugins.andkindness.com/seo/docs/get-started/installation-setup -->
<?php if ($page->template() === 'essay') snippet('scholarly-schema'); ?>
<?php snippet('seo/schemas'); ?>
<footer class="relative clear-both z-[1000] mt-24 border-t border-black px-4 pb-24 pt-10 text-sm font-medium text-black sm:px-8 lg:px-12">
    <div class="mx-auto grid w-full max-w-5xl grid-cols-1 gap-10 sm:grid-cols-3">
        <div class="space-y-2">
            <div class="uppercase tracking-wide">Index Journal</div>
            <div>ISSN 2652-4740</div>
            <div>Published in Narrm, Australia</div>
        </div>

        <div class="space-y-2">
            <div class="uppercase tracking-wide">Information</div>
            <?php foreach ($site->footer()->pages()->toPages() as $page): ?>
                <div>
                    <a class="hover:underline" href="<?= $page->url() ?>">
                        <?= html($page->title()) ?>
                    </a>
                </div>
            <?php endforeach ?>
        </div>

        <div class="space-y-2">
            <div class="uppercase tracking-wide">Contact</div>
            <div>
                <a class="hover:underline" href="mailto:editor@index-journal.org">editor@index-journal.org</a>
            </div>
            <div>
                <a class="hover:underline" href="https://newsletter.index-press.com/subscription/form">Email newsletter</a>
            </div>
            <div class="pt-2 text-gray-700">
                © <?= date('Y') ?> Index Press Inc.<br>
                <a class="underline" href="https://creativecommons.org/licenses/by-nc-nd/4.0/">CC BY-NC-ND 4.0</a>
            </div>
        </div>
    </div>
</footer>

</body>

</html>
