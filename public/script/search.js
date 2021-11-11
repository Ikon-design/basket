let table = document.getElementById('table')
let dialog = document.getElementById('dialog')
let updateReceived = document.getElementById('updateReceived')
let rowId
console.log(rowId)
function search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0] && tr[i].getElementsByTagName("td")[5] && tr[i].getElementsByTagName("td")[2];
        if (td) {
            txtValue = td.textContent || td.innerText;
            console.log(td)
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function valid(id){
    dialog.style.display = 'flex'
    console.log('ez')
    rowId = id
    console.log(rowId)
}

function updateReceiveds(){
    updateReceived.onclick = (window.location='./updateReceived/' + rowId)
}

function updateReceivedWithMail(){
    updateReceived.onclick = (window.location='./updateReceivedWithMail/' + rowId)
}

function closeDialog(){
    dialog.style.display = 'none'
}