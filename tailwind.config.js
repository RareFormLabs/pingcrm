/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");

module.exports = {
  content: [
    "./src/js/**/*.{js,vue}",
    "./modules/frontend/templates/**/*.twig",
    "./templates/**/*.{twig,svg}",
  ],
  theme: {
    extend: {
      colors: {
        indigo: {
          100: "#e6e8ff",
          300: "#b2b7ff",
          400: "#7886d7",
          500: "#6574cd",
          600: "#5661b3",
          800: "#2f365f",
          900: "#191e38",
        },
      },
    },
  },
  plugins: [require("@tailwindcss/typography")],
};
