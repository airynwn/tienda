/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.{html,php}",
    "./src/**/_*.{html,php", // faltaba esto para el icono redondo etc
    "./node_modules/flowbite/**/*.js"    
],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
