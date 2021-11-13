<?php $title = 'NBC - Sweat';
?>

<?php ob_start(); ?>
<main class="main display-flex align-items-center justify-content-center">
    <img width="250px" src="/public/img/logo.svg">
    <h1 class="success-title">Merci pour votre commande !</h1>
    <h1 class="success-title">Vous allez recevoir un mail de confirmation d'ici quelques minutes.</h1>
    <h1 class="request-title" style="margin-top: 25px">À bientot !</h1>
</main>
<?php $content = ob_get_clean(); ?>

<?php require(ROOT . 'views/template.php'); ?>
