<?php $title = 'NBC - Sweat';
?>

<?php ob_start(); ?>
<main class="main display-flex align-items-center justify-content-center" onloadstart="onLoad()">
    <img src="/public/img/logo.png" width="150px" >
    <h2 class="request-title logo">Commande de sweat</h2>
    <form method="post" class="form-container">
        <label class="form-name-left display-flex label">
            Votre nom :
            <input class="lastName input" type="text" onload="onLoad()" oninput="onChangeValue('nom')" name="name" required/>
        </label>
        <label class="form-name-right display-flex label">
            Votre prénom :
            <input class="firstName input" type="text" oninput="onChangeValue('prénom')" name="firstName" required/>
        </label>
        <label class="form-child display-flex label" id="mailField">
            Votre addresse mail :
            <input class="otherInput input" type="email" oninput="onChangeValue('mail')" name="mail" required/>
        </label>
        <label class="form-child display-flex label">
            Votre numéro :
            <input type="tel" pattern="^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" class=" input" oninput="onChangeValue('téléphone')" name="tel" required/>
        </label>

        <label class="form-name-left display-flex label">
            Sélectionnez une taille :
            <select name="size" class="input" onchange="onChangeValue('taille')">
                <option>6 ans</option>
                <option>8 ans</option>
                <option>10 ans</option>
                <option>12 ans</option>
                <option>xs</option>
                <option>s</option>
                <option>m</option>
                <option>l</option>
                <option>xl</option>
                <option>xxl</option>
            </select>
        </label>
        <label class="form-name-right display-flex label">
            Sélectionnez la couleur :
            <select name="colors" class="input">
                <option>Orange</option>
                <option>Bleu</option>
                <option>Blanc</option>
                <option>Noir</option>
            </select>
        </label>
        <label class="form-child display-flex label">
            Flockage :
            <input class="input" type="text" oninput="onChangeValue('flocking')" name="flocking" required/>
        </label>
        <input id="formButton" disabled type="button" value="Valider" onclick="openDialog()" />
        <dialog id="dialog" class="justify-content-center">
            <div class="dialog-item display-flex">
                <div class="display-flex dialog-item-title-container">
                    <h5>Valider vos informations</h5>
                    <a onclick="closeDialog()"><img width="20px" src="/public/img/close-circle.png"></a>
                </div>
                <p id="name"></p>
                <p id="firstName"></p>
                <p id="mail"></p>
                <p id="tel"></p>
                <p id="size"></p>
                <p id="flocking"></p>
                <input class="formButton" type="submit" value="Valider" formaction="sweat/create"/>
            </div>
        </dialog>
    </form>
    <script src="/public/script/script.js"></script>
</main>
<?php $content = ob_get_clean(); ?>

<?php require(ROOT . 'views/template.php'); ?>
