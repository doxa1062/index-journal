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

<main class="ij-home" aria-label="All issues">
  <section class="ij-grid" aria-label="Issue cards">
    <h2 class="ij-grid-issue">
      <span>All issues</span>
      <span class="ij-grid-date"><?= $issues->count() ?> total</span>
    </h2>

    <?php foreach ($issues as $issue) : ?>
      <?php
      $image = $issue->issue_image()->toFile();
      $number = $issueNumber($issue);
      $summary = $buildSummary($issue);
      $issueType = strtolower((string) $issue->issue_type()->value());
      $highlightColor = issueColorCss($issue->issue_color());
      ?>

      <?php snippet('ij-card', [
        'url' => $issue->url(),
        'image' => $image,
        'imageAlt' => $image ? $image->alt()->or('Issue ' . $number . ': ' . $issue->title())->value() : '',
        'placeholder' => 'Issue ' . $number,
        'titlePrefix' => 'Issue ' . $number . ': ',
        'title' => $issue->title()->value(),
        'type' => $issueType,
        'meta' => $issue->issue_date()->isNotEmpty() ? $issue->issue_date()->toDate('d.m.Y') : '',
        'summary' => $summary,
        'highlightColor' => $highlightColor
      ]) ?>
    <?php endforeach ?>

    <?php if ($issues->isEmpty()) : ?>
      <p class="m-0 max-w-[95%] font-['Helvetica_Neue',Helvetica,Arial,sans-serif] text-[0.99rem] leading-[1.26] normal-case max-[760px]:text-[0.9rem]">No published issues yet.</p>
    <?php endif ?>
  </section>
</main>

<?php snippet('footer') ?>
