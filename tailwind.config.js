/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#BB5A5A",
                "primary-light": "#F3E9E9",
                light: "#FFFFFF",
                dark: "#242626",
                grey: "#54555B",
            },
            fontFamily: {
                primary: ["Adobe Caslon Pro", "serif"],
                secondary: ["Montserrat", "sans-serif"],
            },
            backgroundImage: {
                "hero-section": "url('../../public/assets/images/header.png')",
                "projects-section":
                    "url('../../public/assets/images/projects.png')",
                "as-seen-as-section":
                    "url('../../public/assets/images/as-seen-as.png')",
                "achievements-section":
                    "url('../../public/assets/images/achievement.png')",
                footer: "url('../../public/assets/images/footer.png')",
            },
        },
    },
    plugins: [],
};
