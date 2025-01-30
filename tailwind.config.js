/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: "jit",
    content: [
        "./resources/views/**/*.blade.php", // Laravel Blade templates
        "./resources/js/**/*.js", // JavaScript files
        "./public/**/*.{html,js}", // Public files, if applicable
    ],
    theme: {
        weight: {
            text2: "500px",
        },
        extend: {
            screens: {
                xs: "480px",
                xe: "460px",
                xd: "414px",
                xc: "375px",
                xb: "360px",
                xa: "344px",
            },
            fontFamily: {
                poppins: ["Poppins"],
            },
            colors: {
                jgc: "#4D915D",
                cari: "#05864D",
            },
        },
    },
    plugins: [],
};
