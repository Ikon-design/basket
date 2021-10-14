<?php $title = 'NBC - Sweat';
?>

<?php ob_start(); ?>
<main class="main display-flex align-items-center justify-content-center">
    <h1 style="color: green">Bien joué BG</h1>
</main>
<?php $content = ob_get_clean(); ?>

<?php require(ROOT . 'views/template.php'); ?>
