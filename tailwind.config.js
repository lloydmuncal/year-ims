/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",

    ],
    theme: {
      extend: {
        height: {
            '120': '32rem',  // Adjust the value accordingly
          },
        },
    },
    plugins: [],
  }
