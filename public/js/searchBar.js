// search bar
const searchInput = document.getElementById("searchInput");
console.log(searchInput);
searchInput.addEventListener("keyup", function () {
    const input = this.value.toLowerCase();
    const rows = document.querySelectorAll("#myTable tbody tr");

    rows.forEach(function (row) {
        const cells = row.querySelectorAll("td");
        let rowText = "";
        cells.forEach(function (cell) {
            rowText += cell.textContent.toLowerCase() + " ";
        });

        if (rowText.includes(input)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
