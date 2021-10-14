<?php $title = 'NBC - Login';
?>

<?php ob_start(); ?>
<main class="main display-flex align-items-center justify-content-center">
<form method="post" class="display-flex">
    <input placeholder="mot de passe" name="password" class="input">
    <input type="submit" class="formButton">
</form>
</main>

<?php $content = ob_get_clean(); ?>

<?php require(ROOT . 'views/template.php'); ?>
