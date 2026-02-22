<?php snippet('header') ?>

<?php
$issues = page('issues')
  ->children()
  ->listed()
  ->sortBy('issue_date', 'desc');

$feedItems = [];

foreach ($issues as $issue) {
  $issueArticles = $issue
    ->index()
    ->listed()
    ->filter(function ($article) {
      return str_ends_with($article->intendedTemplate()->name(), 'essay');
    })
    ->sortBy('num', 'asc');

  foreach ($issueArticles as $article) {
    $type = strtolower($article->intendedTemplate()->name());
    $type = str_ends_with($type, '-essay') ? substr($type, 0, -6) : $type;
    $type = trim(str_replace('-', ' ', $type));
    $type = $type ?: 'essay';

    $image = $article->images()->sortBy('sort', 'asc')->first();
    if (!$image && $issue->issue_image()->isNotEmpty()) {
      $image = $issue->issue_image()->toFile();
    }

    $summary = '';
    if ($article->subtitle()->isNotEmpty()) {
      $summary = Kirby\Toolkit\Str::excerpt($article->subtitle()->value(), 180);
    } elseif ($article->abstract()->isNotEmpty()) {
      $summary = Kirby\Toolkit\Str::excerpt($article->abstract()->value(), 180);
    } elseif ($article->text()->isNotEmpty()) {
      $summary = Kirby\Toolkit\Str::excerpt(strip_tags($article->text()->kirbytext()), 180);
    }

    $feedItems[] = [
      'article' => $article,
      'issue' => $issue,
      'image' => $image,
      'summary' => $summary,
      'type' => $type
    ];
  }
}

?>

<main class="eq-home" aria-label="All articles feed">
  <section class="eq-grid" aria-label="Article cards">
    <?php $currentIssueId = null; ?>
    <?php foreach ($feedItems as $item) : ?>
      <?php
      $article = $item['article'];
      $issue = $item['issue'];
      $image = $item['image'];
      $summary = $item['summary'];
      $highlightColor = issueColorCss($issue->issue_color());
      ?>

      <?php if ($currentIssueId !== $issue->id()) : ?>
        <h2 class="eq-grid-issue">
          <span>Issue <?= $issue->num() ?>: <?= $issue->title()->html() ?></span>
          <span class="eq-grid-date"><?= $issue->issue_date()->toDate('d.m.Y') ?></span>
        </h2>
        <?php $currentIssueId = $issue->id(); ?>
      <?php endif ?>

      <article class="eq-card" style="--eq-issue-highlight: <?= esc($highlightColor) ?>;">
        <a href="<?= $article->url() ?>" class="eq-card-link">
          <?php if ($image) : ?>
            <figure class="eq-card-image">
              <img
                src="<?= $image->url() ?>"
                alt="<?= $image->alt()->or($article->title())->esc() ?>">
            </figure>
          <?php else : ?>
            <div class="eq-card-image eq-card-image--placeholder">
              <span>Issue <?= $issue->num() ?></span>
            </div>
          <?php endif ?>

          <h3 class="eq-card-title">
            <?= $article->title()->html() ?>
            <span class="eq-inline-type"><?= esc($item['type']) ?></span>
          </h3>

          <?php if ($article->author()->isNotEmpty()) : ?>
            <p class="eq-card-author"><?= $article->author()->html() ?></p>
          <?php endif ?>

          <?php if (!empty($summary)) : ?>
            <p class="eq-card-summary"><?= esc($summary) ?></p>
          <?php endif ?>
        </a>
      </article>
    <?php endforeach ?>
  </section>
</main>

<?php snippet('footer') ?>
