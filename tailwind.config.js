/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./assets/**/*.jsx",
        "./templates/**/*.html.twig",
    ],
    theme: {
        extend: {
            screens: {
                'sm': '640px',
                'md': '768px',
                'lg': '1024px',
                'xl': '1280px',
                '2xl': '1536px',
            },
            colors: {
                transparent: "transparent",
                arcadia: "#22C55E",
                bgColor2: "#F7F7F7",
                primaryText: "#15803D",
                bgColor: '#3EBE83',
                black: '#000000',
                dark: '#000000BF',
                darkGrey: '#454545',
                grey: '#828282',
            },
            fontFamily: {
                'sans': 'Inter, sans-serif'
            },
            fontSize: {
                'h1Mobile': ['1.5rem', {
                    lineHeight: '1.813rem',
                    letterSpacing: '-0.02em',
                    fontWeight: '700',
                }],
                'h1Tablet': ['3rem', {
                    lineHeight: '3.5rem',
                    letterSpacing: '-0.02em',
                    fontWeight: '700',
                }],
                'h1Desktop': ['4rem', {
                    lineHeight: '4.813rem',
                    letterSpacing: '-0.02em',
                    fontWeight: '700',
                }],
                'logoDesktop': ['2.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '700',
                }],
                'logoTablet': ['1.5rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '700',
                }],
                'logoMobile': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '700',
                }],
                'h2Desktop': ['2.5rem', {
                    lineHeight: '110%',
                    letterSpacing: '0',
                    fontWeight: '600',
                }],
                'h2Tablet': ['2.25rem', {
                    lineHeight: '110%',
                    letterSpacing: '0',
                    fontWeight: '600',
                }],
                'h2Mobile': ['1.5rem', {
                    lineHeight: '110%',
                    letterSpacing: '0',
                    fontWeight: '600',
                }],
                'h3Desktop': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '700',
                }],
                'h3Tablet': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '700',
                }],
                'h3Mobile': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '700',
                }],
                'nav': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '500',
                }],
                'navLg': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '500',
                }],
                'pDesktop': ['1.5rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
                'pTablet': ['1.5rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
                'pMobile': ['1.5rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
                'cardTablet': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
                'cardMobile': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
                'buttonDesktop': ['1.5rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '600',
                }],
                'buttonTablet': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '600',
                }],
                'buttonMobile': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '600',
                }],
                'footerDesktop': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '500',
                }],
                'footerTablet': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '500',
                }],
                'footerMobile': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '500',
                }],
                'textDesktop': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
                'textTablet': ['1.25rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
                'textMobile': ['1rem', {
                    lineHeight: '150%',
                    letterSpacing: '0',
                    fontWeight: '400',
                }],
            },
        },
    },
    plugins:
        [],
}

