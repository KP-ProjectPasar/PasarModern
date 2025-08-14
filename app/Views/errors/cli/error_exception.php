<?php
?>
<pre>
<?= esc($exception->getMessage()) ?>

<?= esc($exception->getFile()) ?>:<?= esc($exception->getLine()) ?>

<?= esc($exception->getTraceAsString()) ?>
</pre> 