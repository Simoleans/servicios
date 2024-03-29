const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            borderColor: ['active'],
        },
        spinner: (theme) => ({
            default: {
              color: '#000000', // color you want to make the spinner
              size: '1em', // size of the spinner (used for both width and height)
              border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
              speed: '500ms', // the speed at which the spinner should rotate
            },
          }),
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        animation: ['responsive', 'motion-safe', 'motion-reduce'],
        boxShadow: ['responsive', 'hover', 'focus'],
        transitionProperty: ['responsive', 'hover', 'focus','motion-safe', 'motion-reduce'],
        gridTemplateColumns: ['responsive', 'hover', 'focus'],
    },

    plugins: [require('tailwindcss-spinner')],
            
};
