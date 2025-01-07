/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            center: true,
        },
        screens: {
            sm: "430px",
            md: "798px",
            lg: "834px",
            xl: "1280px",
            "2xl": "1440px",
            "3xl": "1800px",
        },
        extend: {
            fontFamily: {
                magilo: ["Magilo"],
                aesthetnova: ["AesthetNova"],
            },

            colors: {
                "highlight-content": "#F8C055",
                "accent-color": "#FAF7F5",
                "accent-color-admin": "#727272",
                "primary-color": "#090E1A",
                "secondary-accent-color": "#141925",
                "secondary-color": "#F24949",
                "secondary-accent-color-admin": "#F5F7FA",
                "secondary-color-admin": "#F1F5F9",
                "primary-color-admin": "#FFFFFF",
            },

            animation: {
                "spin-slow": "spin 20s linear infinite",
            },
        },
    },
    plugins: [],
};
