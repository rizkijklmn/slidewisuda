const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            textShadow: {
                sm: '0 1px 2px var(--tw-shadow-color)',
                DEFAULT: '0 2px 4px var(--tw-shadow-color)',
                lg: '0 8px 16px var(--tw-shadow-color)',
              },
            backgroundImage: {
                "wisuda-26": "url(../images/bg-wisuda-26.jpg)",
                "wisuda-27": "url(../images/bg-wisuda-27.jpg)",
                "wisuda-28": "url(../images/background-28.jpg)",
                "wisuda-29": "url(../images/bg-wisuda-29.jpg)",
                "wisuda-30": "url(../images/bg-wisuda-30.jpg)",
                "wisuda-31": "url(../images/bg-wisuda-31.jpeg)",
            },
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require("@tailwindcss/forms"), plugin(function ({ matchUtilities, theme }) {
        matchUtilities(
          {
            'text-shadow': (value) => ({
              textShadow: value,
            }),
          },
          { values: theme('textShadow') }
        )
      }),],
};
