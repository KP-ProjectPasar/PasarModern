<?php /* Minimal error view for CLI */ ?>

An uncaught Exception was encountered:

Type: <?= esc($type) ?>
Message: <?= esc($message) ?>
Filename: <?= esc($file) ?>
Line Number: <?= esc($line) ?>

Backtrace:
<?php foreach ($trace as $index => $row): ?>
#<?= $index ?> <?= esc($row['file'] ?? '') ?> (<?= esc($row['line'] ?? '') ?>): <?= esc($row['function'] ?? '') ?>()
<?php endforeach; ?> 