function searchWithFilter() {
    var input, filter, table, tr, td, i, txtValue, select;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("SQLTable");
    tr = table.getElementsByTagName("tr");
    select = document.getElementById("mySelect");
    selectedOption = select.options[select.selectedIndex].value;

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[selectedOption - 1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}