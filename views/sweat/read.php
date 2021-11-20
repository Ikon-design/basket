<?php $title = 'NBC - Sweat';
isset($_SESSION['loged']) ? null : header('location: /login');
?>

<?php ob_start(); ?>
<main class="main display-flex align-items-center">
    <div class="display-flex read-content ">
        <div class="display-flex title-search">
            <H2 class="titleSearch">Liste des demandes</H2>
            <input type="search" id="search" class="search input" oninput="search()" placeholder="Votre recherche">
        </div>
        <table id="table">
            <tr class="table-title">
                <th>nom</th>
                <th>prénom</th>
                <th>mail</th>
                <th>tel</th>
                <th>taille</th>
                <th>Flocage</th>
                <th>Couleur</th>
                <th>Payé</th>
                <th>Reçu</th>
                <th>Retiré</th>
                <th>Supprimer</th>
            </tr>

            <?php
            if (isset($data)) {
                foreach ($data as $data) {
                    ?>
                    <tr>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['firstName'] ?></td>
                        <td><?= $data['mail'] ?></td>
                        <td><?= $data['tel'] ?></td>
                        <td><?= $data['size'] ?></td>
                        <td><?= $data['flocking'] ?></td>
                        <td><?= $data['colors'] ?></td>
                        <td><input type='checkbox' <?= $data['payed'] ?>
                                   onclick=(window.location='./updatePayed/<?= $data['id'] ?>')></td>
                        <td>
                            <?php
                            if ($data['received'] != 'checked') {
                                ?>
                                <input type="checkbox" onclick="valid(<?= $data['id'] ?>)">
                            <?php } else { ?>
                                <input type='checkbox' <?= $data['received']?>
                                       onclick=(window.location='./updateReceived/<?= $data['id'] ?>')>
                            <?php }
                            ?>
                        </td>
                        <td><input type='checkbox' <?= $data['took'] ?>
                                   onclick=(window.location='./updateTook/<?= $data['id'] ?>')></td>
                        <td><a href="/sweat/delete/<?= $data['id'] ?>"><img src="/public/img/delete.png"></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        <dialog id="dialog" class="justify-content-center">
            <div class="dialog-item display-flex">
                <a onclick="closeDialog()" class="formButton">Pas reçu</a>
                <a id="updateReceived" class="formButton" onclick="updateReceiveds()">reçu</a>
                <a onclick="updateReceivedWithMail()" class="formButton">reçu (envoyer un mail)</a>
            </div>
        </dialog>
    </div>
    <script src="/public/script/search.js"></script>
</main>
<?php $content = ob_get_clean(); ?>

<?php require(ROOT . 'views/template.php'); ?>
