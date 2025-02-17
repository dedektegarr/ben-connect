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
