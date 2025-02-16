import Alpine from "alpinejs";
import { DataTable } from "simple-datatables";
import "./bootstrap";
import "flowbite";

// Dark Mode
const enableDarkMode = () => {
    document.addEventListener("alpine:init", () => {
        Alpine.data("darkMode", () => ({
            isOn: localStorage.getItem("darkMode") === "true",

            toggle() {
                this.isOn = !this.isOn;
                localStorage.setItem("darkMode", this.isOn);
                document.documentElement.classList.toggle("dark");
            },
        }));
    });

    const checkDarkMode = () => {
        if (localStorage.getItem("darkMode") === "true") {
            document.documentElement.classList.add("dark");
        }
    };

    checkDarkMode();

    window.Alpine = Alpine;
    Alpine.start();
};

// Data Table
const dataTable = () => {
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
};

enableDarkMode();
dataTable();
