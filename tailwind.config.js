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
                primary: "#8D2323",
                'primary-light': '#F3E9E9',
                light: "#FFFFFF",
                dark: "#000000",
                grey: "#54555B",
            },
            fontFamily: {
                primary: ["Adobe Caslon Pro", "serif"],
                secondary: ["Montserrat", "sans-serif"],
            },
            backgroundImage: {
                "hero-section":
                    "url('../../public/assets/images/danya_header.webp')",
                "change-making-projects-section":
                    "url('../../public/assets/images/change_making_projects.webp')",
                "honors-accomplishments-section":
                    "url('../../public/assets/images/honors_and_accomplishments.webp')",
                "speaking-opportunities":
                    "url('../../public/assets/images/speaking_opportunities.webp')",
                "awards-achievements-section":
                    "url('../../public/assets/images/awards_achievements.webp')",
                footer: "url('../../public/assets/images/danya_footer.png')",
            },
        },
    },
    plugins: [],
};
