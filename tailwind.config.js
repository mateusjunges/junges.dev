const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './app/*.php',
    ],
    plugins: [
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
                blue: {
                    lightest: '#cae1e8',
                    light: '#cae1e8',
                },
                gray: {
                    lighter: '#cbd2ce',
                    lightest: '#f3efea',
                    light: '#b8bfbb',
                },
                opaque: 'rgba(255, 255, 255, 0.5)',
            },
            screens: {
                sm: '720px',
                md: '960px',
                lg: '1230px',
                xl: '1615px',
                print: { raw: 'print' },
            },
            margin: {
                '3_5': '3.5rem',
            },
            maxWidth: {
                sm: '25rem', // xl/2 - half gap
                md: '40rem',
                lg: '50rem',
                xl: '60rem',
                '2xl': '70rem',
                '3xl': '80rem',
                '4xl': '90rem',
                '5xl': '100rem',
                '1/2': '50vw',
                columns: '80rem', // xl + (2 * large gap)
                logoclient: '8rem',
            },

            zIndex: {
                auto: 'auto',
                back: -1,
                postcard: 700,
            },

            lineHeight: {
                none: 1,
                tight: 1.1,
                normal: 1.6,
                loose: 2,
            },

            letterSpacing: {
                tight: '-0.05em',
                normal: '0',
                wide: '0.05em',
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
