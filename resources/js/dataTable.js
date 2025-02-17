import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", function () {
    // default table
    if (
        document.getElementById("default-table") &&
        typeof DataTable !== "undefined"
    ) {
        new DataTable("#default-table", {
            searchable: true,
            sortable: true,
        });
    }
});
