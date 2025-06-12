
document.addEventListener('DOMContentLoaded', () => {
    tinymce.init({
        selector: 'textarea',
        language: 'fr_FR',
        language_url: '/js/tinymce/langs/fr_FR.js',
        branding: false,   // Désactive "Build with TinyMCE" en bas à droite
        promotion: false,  // Désactive "💝 Get all features" en haut à droite
        statusbar: false,  // (Optionnel) Masque toute la barre du bas
        // plugins: 'advlist autolink lists charmap preview anchor table ao',
        plugins: 'advlist autolink lists charmap preview anchor table',
        // toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table image',
        toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table',
        style_formats: [
            { title: 'Texte', items: [
                { title: 'Titre 1', format: 'h1' },
                { title: 'Titre 2', format: 'h2' },
                { title: 'Titre 3', format: 'h3' },
                { title: 'Paragraphe', format: 'p' }
            ]},
            { title: 'Alignement', items: [
                { title: 'Gauche', format: 'alignleft' },
                { title: 'Centre', format: 'aligncenter' },
                { title: 'Droite', format: 'alignright' },
                { title: 'Justifié', format: 'alignjustify' }
            ]}
        ],
        skin: 'oxide',
        width: 750,
        height: 400,
        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });

    document.querySelector('form').addEventListener('submit', function() {
        tinymce.triggerSave();
    });
});



// assets/js/tinymce-init.js

// function initTinyMCE() {
//     tinymce.init({
//         selector: 'textarea',
//         language: 'fr_FR',
//         language_url: '/js/tinymce/langs/fr_FR.js',
//         branding: false,   // Désactive "Build with TinyMCE" en bas à droite
//         promotion: false,  // Désactive "💝 Get all features" en haut à droite
//         statusbar: false,  // (Optionnel) Masque toute la barre du bas
//         plugins: 'advlist autolink lists charmap preview anchor table image',
//         toolbar: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table image',
//         style_formats: [
//             { title: 'Texte', items: [
//                 { title: 'Titre 1', format: 'h1' },
//                 { title: 'Titre 2', format: 'h2' },
//                 { title: 'Titre 3', format: 'h3' },
//                 { title: 'Paragraphe', format: 'p' }
//             ]},
//             { title: 'Alignement', items: [
//                 { title: 'Gauche', format: 'alignleft' },
//                 { title: 'Centre', format: 'aligncenter' },
//                 { title: 'Droite', format: 'alignright' },
//                 { title: 'Justifié', format: 'alignjustify' }
//             ]}
//         ],
//         skin: 'oxide',
//         width: 750,
//         height: 400,
//         setup: function(editor) {
//             editor.on('change', function() {
//                 editor.save();
//             });
//         }
//     });
// }

// // Initialisation normale
// document.addEventListener('DOMContentLoaded', initTinyMCE);

// // Gestion des événements Turbo
// document.addEventListener('turbo:load', function() {
//     tinymce.remove(); // Nettoie les anciennes instances
//     initTinyMCE(); // Réinitialise pour les nouveaux contenus
// });

// document.addEventListener('turbo:before-render', function() {
//     tinymce.remove(); // Nettoie avant le rendu Turbo
// });