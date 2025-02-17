import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", function () {
    // default table
    if (
        document.getElementById("default-table") &&
        typeof DataTable !== "undefined"
    ) {
        new DataTable("#default-table", {
            paging: true,
            perPage: 10,
            sortable: true,
        });
    }
});
