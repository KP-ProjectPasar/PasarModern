<?php
// app/Views/errors/cli/error_exception.php
?>
<pre>
<?= esc($exception->getMessage()) ?>

<?= esc($exception->getFile()) ?>:<?= esc($exception->getLine()) ?>

<?= esc($exception->getTraceAsString()) ?>
</pre> 