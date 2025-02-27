import { DataTable } from "simple-datatables";

document.addEventListener("DOMContentLoaded", function () {
    const tables = document.querySelectorAll("[id^='default-table']");

    tables.forEach((table) => {
        if (typeof DataTable !== "undefined") {
            new DataTable(table, {
                paging: true,
                perPage: 10,
                sortable: true,
            });
        }
    });
});
