/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./templates/**/*.html.twig',
   				 './assets/**/*.js',],
  theme: {
    extend: {

      // Personnaliser les couleurs de bordure
      borderColor: {
        DEFAULT: '#e5e7eb', // Couleur par défaut (gray-200)
        'primary': '#3b82f6', // Exemple : bleu-500
      },
      // Personnaliser l'épaisseur des bordures
      borderWidth: {
        DEFAULT: '1px',
        '2': '2px',
        '3': '3px',
      }, 
    },
  },
  plugins: [],
}

