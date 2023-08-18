/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                pink: "#F7D9CE",
                red: "#9F1D23",
                red_second: "#D34048",
                grey: "#FBFBFB",
                grey_text: "#9C928E",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
