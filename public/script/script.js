let dialog = document.getElementById('dialog')
let dialogName = document.getElementById('name')
let dialogFirstName = document.getElementById('firstName')
let dialogMail = document.getElementById('mail')
let dialogTel = document.getElementById('tel')
let dialogSize = document.getElementById('size')
let dialogFlocking = document.getElementById('flocking')
let name = document.getElementsByName("name")
let firstName = document.getElementsByName("firstName")
let mail = document.getElementsByName("mail")
let tel = document.getElementsByName("tel")
let size = document.getElementsByName('size')
let flocking = document.getElementsByName('flocking')
let formButton = document.getElementById('formButton')
let mailField = document.getElementById('mailField')
let phoneField = document.getElementById('phoneField')
let errorText = document.getElementsByClassName('errerText')
let errorMail = document.createElement('p')
let errorPhone = document.createElement('p')
const textError = document.createTextNode("L'adresse mail saisie ne recepect pas le format demandé.")
const textErrorPhone = document.createTextNode("Le numéro saisie ne recepect pas le format demandé.")
const regex = new RegExp('(?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\\])')
const phoneRegex = new RegExp('^((\\+)33|0)[1-9](\\d{2}){4}$')
localStorage.getItem("nom") ? dialogName.innerHTML = "Nom : " + localStorage.getItem("nom") : ""
localStorage.getItem("prénom") ? dialogFirstName.innerHTML = "Prénom : " + localStorage.getItem("prénom") : ""
localStorage.getItem("mail") ? dialogMail.innerHTML = "Mail : " + localStorage.getItem("mail") : ""
localStorage.getItem("téléphone") ? dialogTel.innerHTML = "Téléphone : " + localStorage.getItem("téléphone") : ""
localStorage.getItem("taille") ? dialogSize.innerHTML = "Taille : " + localStorage.getItem("taille") : ""
localStorage.getItem("flocking") ? dialogFlocking.innerHTML = "Flockage : " + localStorage.getItem("flocking") : ""

function onChangeValue(params) {
    let key = params.toString() + " : "
    switch (params) {
        case 'nom':
            dialogName.innerHTML = key + name[0].value
            localStorage.setItem('nom', name[0].value)
            if (name[0].value === "") dialogName.innerHTML = ""
            break;
        case 'prénom':
            dialogFirstName.innerHTML = key + firstName[0].value
            localStorage.setItem('prénom', firstName[0].value)
            if (firstName[0].value === "") dialogFirstName.innerHTML = ""
            break;
        case 'mail':
            dialogMail.innerHTML = key + mail[0].value
            localStorage.setItem('mail', mail[0].value)
            if (mail[0].value === "") dialogMail.innerHTML = ""
            break;
        case 'téléphone':
            dialogTel.innerHTML = key + tel[0].value
            localStorage.setItem('téléphone', tel[0].value)
            if (tel[0].value === "") dialogTel.innerHTML = ""
            break;
        case 'taille':
            dialogSize.innerHTML = key + size[0].value
            localStorage.setItem('taille', size[0].value)
            if (size[0].value === "") dialogSize.innerHTML = ""
            break;
        case 'flocking':
            dialogFlocking.innerHTML = "Flockage : " + flocking[0].value
            localStorage.setItem('flocking', flocking[0].value)
            if (flocking[0].value === "") dialogFlocking.innerHTML = ""
            break;
        default:
            break;
    }
    if (name[0].value && firstName[0].value && mail[0].value && tel[0].value && size[0].value && flocking[0].value !== "") {
        if (regex.test(mail[0].value) === true && phoneRegex.test(tel[0].value) === true) {
            formButton.removeAttribute('disabled')
            console.log('ici')
        } else {
            if (regex.test(mail[0].value) === false) {
                errorMail.appendChild(textError)
                errorMail.setAttribute('class', 'errerText')
                mailField.appendChild(errorMail)
            } else {
                mailField.lastChild.tagName === "P" ? mailField.lastChild.style.display = 'none' : null
            }
            if (phoneRegex.test(tel[0].value) === false) {
                errorPhone.appendChild(textErrorPhone)
                errorPhone.setAttribute('class', 'errerText')
                phoneField.appendChild(errorPhone)
            } else {
                phoneField.lastChild.tagName === "P" ? phoneField.lastChild.style.display = 'none' : null
            }
            console.log('faux')
            console.log(phoneRegex.test(tel[0].value), tel[0].value)
            formButton.setAttribute('disabled', true)
        }
    } else {
        formButton.setAttribute('disabled', true)
    }
}

function openDialog() {
    if (name[0].value && firstName[0].value && mail[0].value && tel[0].value && size[0].value && flocking[0].value != null) {
        dialog.style.display = 'flex'
    } else {
        formButton.setAttribute('disabled', true)
    }
}

function closeDialog() {
    dialog.style.display = 'none'
}
