<?php snippet('header') ?>

<?php
$issues = $page
  ->children()
  ->listed()
  ->sortBy('issue_date', 'desc');

$issueNumber = function ($issue) {
  if ($issue->issue_num()->isNotEmpty()) {
    return (string) $issue->issue_num()->value();
  }

  return (string) $issue->num();
};

$formatEditors = function ($issue) {
  $names = [];

  foreach ($issue->editors()->toStructure() as $editor) {
    $firstName = trim((string) $editor->first_name()->value());
    $lastName = trim((string) $editor->last_name()->value());
    $name = trim($firstName . ' ' . $lastName);

    if ($name !== '') {
      $names[] = $name;
    }
  }

  if (count($names) === 0) {
    return '';
  }

  if (count($names) === 1) {
    return $names[0];
  }

  if (count($names) === 2) {
    return $names[0] . ' and ' . $names[1];
  }

  $lastName = array_pop($names);

  return implode(', ', $names) . ', and ' . $lastName;
};

$buildSummary = function ($issue) use ($formatEditors) {
  $summaryParts = [];
  $editors = $formatEditors($issue);

  if ($editors !== '') {
    $summaryParts[] = 'Edited by ' . $editors;
  }

  if ($issue->issue_doi()->isNotEmpty()) {
    $summaryParts[] = 'DOI ' . $issue->issue_doi()->value();
  }

  return implode(' · ', $summaryParts);
};

?>

<main class="eq-home" aria-label="All issues">
  <section class="eq-grid" aria-label="Issue cards">
    <h2 class="eq-grid-issue">
      <span>All issues</span>
      <span class="eq-grid-date"><?= $issues->count() ?> total</span>
    </h2>

    <?php foreach ($issues as $issue) : ?>
      <?php
      $image = $issue->issue_image()->toFile();
      $number = $issueNumber($issue);
      $summary = $buildSummary($issue);
      $issueType = strtolower((string) $issue->issue_type()->value());
      $highlightColor = issueColorCss($issue->issue_color());
      ?>

      <article class="eq-card" style="--eq-issue-highlight: <?= esc($highlightColor) ?>;">
        <a href="<?= $issue->url() ?>" class="eq-card-link">
          <?php if ($image) : ?>
            <figure class="eq-card-image">
              <img
                src="<?= $image->url() ?>"
                alt="<?= $image->alt()->or('Issue ' . $number . ': ' . $issue->title())->esc() ?>">
            </figure>
          <?php else : ?>
            <div class="eq-card-image eq-card-image--placeholder">
              <span>Issue <?= esc($number) ?></span>
            </div>
          <?php endif ?>

          <h3 class="eq-card-title">
            Issue <?= esc($number) ?>: <?= $issue->title()->html() ?>
            <?php if ($issueType !== '') : ?>
              <span class="eq-inline-type"><?= esc($issueType) ?></span>
            <?php endif ?>
          </h3>

          <?php if ($issue->issue_date()->isNotEmpty()) : ?>
            <p class="eq-card-author"><?= $issue->issue_date()->toDate('d.m.Y') ?></p>
          <?php endif ?>

          <?php if ($summary !== '') : ?>
            <p class="eq-card-summary"><?= esc($summary) ?></p>
          <?php endif ?>
        </a>
      </article>
    <?php endforeach ?>

    <?php if ($issues->isEmpty()) : ?>
      <p class="eq-card-summary">No published issues yet.</p>
    <?php endif ?>
  </section>
</main>

<?php snippet('footer') ?>
