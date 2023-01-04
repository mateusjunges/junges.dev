const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './app/*.php',
        './vendor/filament/**/*.blade.php',
        './vendor/filament/**/*.css',

    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
    theme: {
        fontFamily: {
            sans: [
                'Whitney SSm A',
                'Whitney SSm B',
                '-apple-system',
                'BlinkMacSystemFont',
                'Segoe UI',
                'Roboto',
                'Helvetica Neue',
                'Arial',
                'Noto Sans',
                'sans-serif',
                'Apple Color Emoji',
                'Segoe UI Emoji',
                'Segoe UI Symbol',
                'Noto Color Emoji',
            ],
            mono: [
                'Operator Mono SSm A',
                'Operator Mono SSm B',
                'Monaco',
                'Consolas',
                'Liberation Mono',
                'Courier New',
                'monospace',
            ],
            serif: [
                'Chronicle Display A',
                'Chronicle Display B',
                'Constantia',
                'Lucida Bright',
                'Lucidabright',
                'Lucida Serif',
                'Lucida',
                'DejaVu Serif',
                'Bitstream Vera Serif',
                'Liberation Serif',
                'Georgia',
                'serif',
            ],
        },
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
                gray: {
                    lighter: '#cbd2ce',
                    lightest: '#f3efea',
                    light: '#b8bfbb',
                },
                blue: {
                    lightest: '#cae1e8',
                    light: '#cae1e8',
                },
                'bunker': {
                    '50': '#f3f6fa',
                    '100': '#d6e3f1',
                    '200': '#acc6e3',
                    '300': '#7b9ecd',
                    '400': '#4f76b2',
                    '500': '#355a97',
                    '600': '#294578',
                    '700': '#243961',
                    '800': '#21304e',
                    '900': '#080b11',
                },
            },
            borderWidth: {
                3: '3px',
                5: '5px',
            },
            fontSize: {
                xxs: '0.65rem',
            },
            lineHeight: {
                relaxed: 1.75,
            },
            maxWidth: {
                columns: '80rem',
                '8xl': '90rem',
            },
            spacing: {
                7: '1.75rem',
            },
            borderRadius: {
                xl: '12px',
                '2xl': '16px',
                '3xl': '24px',
            },
            rotate: {
                '-5': '-5deg',
            },
        },
    },
    variants: {
        borderColor: ['focus-within', 'hover', 'focus'],
        extend: {
            fontWeight: ['hover', 'focus']
        }
    },
};
