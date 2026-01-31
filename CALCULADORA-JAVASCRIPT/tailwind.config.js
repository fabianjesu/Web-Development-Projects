/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}",
            "./components/**/*.{html,js}",],
  theme: {
    extend: {
      colors: {
        //definir variable de colores
        //'black': '#000'
      },
      width: {
        '42': '170px',
      }
    },
  },
  plugins: [],
}

