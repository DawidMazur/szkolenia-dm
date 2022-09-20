var path = require('path');
var dirpath = path.dirname(__filename);


function ColorOpacity(name) {
  return ({
    opacityValue
  }) => {
    if (opacityValue != undefined) {
      return `rgba(var(--pc-c-${name}), ${opacityValue})`
    }
    return `rgb(var(--pc-c-${name}))`
  }
}

// sizes
function getPx(min = 0, max = 50, move = 1) {
  let r = {}

  for (let i = min; i <= max; i = i + move) {
    r[i] = (i / 10) + 'px'
  }

  return r;
}

function pxToRem(max = 200) {
  let r = {}

  for (let i = 0; i < 20; i++) {
    r[i] = (i / 10) + 'rem'
  }

  for (let i = 20; i < 50; i = i + 2) {
    r[i] = (i / 10) + 'rem'
  }

  for (let i = 0; i < 150; i = i + 5) {
    r[i] = (i / 10) + 'rem'
  }

  for (let i = 150; i <= max; i = i + 10) {
    r[i] = (i / 10) + 'rem'
  }

  return r
}

function getUnitList(unit, prefix = "", ratio = 1, min = 10, max = 100, move = 10) {
  let r = {}

  for (let i = min; i <= max; i = i + move) {
    r[i + prefix] = (i / ratio) + unit
  }

  return r;
}

// font sizes
function genFontSize(radio) {
  let r = {}
  let ratioSizeLineHeight = 1.6
  let ratios = radio ? radio : {
    0: ratioSizeLineHeight,
    40: 1.3,
  }
  for (let i = 1; i <= 100; i++) {
    if (ratios[i]) {
      ratioSizeLineHeight = ratios[i];
    }
    r[i] = [
      (i / 10) + 'rem',
      {
        lineHeight: Math.round((i / 10) * ratioSizeLineHeight * 10) / 10 + 'rem',
      }
    ]
  }
  return r;
}

const colors = require('tailwindcss/colors')

module.exports = {
  mode: 'jit',
  content: [
    '!./node_modules/**/*',
    './views/**/*.twig',
    // './*.php',
    './**/*.php',
    './**/*.html',
    './src/js/global/**/*.js',
    './views/**/*.js'
    // './src/**/*.scss',
    // './**/*.css',
  ],
  corePlugins: {
    fontFamily: false,
    container: false,
  },
  theme: {
    colors: {
      white: '#fff',
      black: '#000',
      transparent: 'transparent',
      current: 'currentColor',
      // add colors here,
      primary: 'blue',
      gray: colors.gray,
      emerald: colors.emerald,
      indigo: colors.indigo,
      yellow: colors.yellow,
      red: colors.red,
      blue: colors.blue,
      sky: colors.sky,
    },

    screens: {
      'sm': '360px',
      'md': '600px',
      'lg': '991px',
      'slap': '1280px',
      'mlap': '1356px',
      'llap': '1536px',
      'full': '1920px',
    },

    blur: {
      ...getPx(),
      DEFAULT: '8px',
    },

    borderRadius: {
      none: '0px',
      DEFAULT: '0.25rem',
      ...pxToRem(),
      '50p': '50%',
      full: '9999px',
    },

    borderWidth: {
      DEFAULT: '1px',
      0: '0px',
      2: '2px',
      4: '4px',
      8: '8px',
    },

    spacing: pxToRem(500),

    fontFamily: {
      'TitilliumWeb': ['Titillium Web', 'ui-sans-serif'],
      'Montserrat': ['Montserrat', 'ui-sans-serif'],
    },

    fontSize: genFontSize(),

    fontWeight: {
      100: '100',
      200: '200',
      300: '300',
      400: '400',
      500: '500',
      600: '600',
      700: '700',
      800: '800',
      900: '900',
    },

    lineHeight: {
      none: '1',
      tight: '1.25',
      snug: '1.375',
      normal: '1.5',
      relaxed: '1.625',
      loose: '2',
      ...pxToRem()
    },

    maxWidth: (theme, {
      breakpoints
    }) => ({
      none: 'none',
      ...pxToRem(2000),
      ...getUnitList('vw', 'vw'),
      full: '100%',
      min: 'min-content',
      max: 'max-content',
      screen: '100vw',
      prose: '65ch',
      ...breakpoints(theme('screens')),
    }),

    maxHeight: (theme, {
      breakpoints
    }) => ({
      none: 'none',
      ...pxToRem(2000),
      ...getUnitList('vh', 'vh'),
      full: '100%',
      min: 'min-content',
      max: 'max-content',
      prose: '65ch',
      ...breakpoints(theme('screens')),
    }),

    minWidth: theme => theme('maxWidth'),

    minHeight: theme => theme('maxHeight'),

    // poprawka dla vscode
    borderColor: theme => ({
      DEFAULT: '#000',
      ...theme('colors'),
    }),

    ringColor: theme => ({
      DEFAULT: 'blue',
      ...theme('colors'),
    }),

    extend: {
      zIndex: {
        '-2': '-2',
        '-1': '-1',
        0: '0',
        5: '5',
        1000: '1000',
        1010: '1010',
        1020: '1020',
        1030: '1030',
        1040: '1040',
        1050: '1050',
        1060: '1060',
        1070: '1070',
        1080: '1080',
        1090: '1090',
      },

      flex: {
        '2': '2 2 0%',
        '3': '3 3 0%',
        '4': '4 4 0%',
        '5': '5 5 0%',
        '6': '6 6 0%',
        '7': '7 7 0%',
        '8': '8 8 0%',
        '9': '9 9 0%',
        '10': '10 10 0%',
        '11': '11 11 0%',
        '12': '12 12 0%',
      },

      width: {
        ...getUnitList('vw', 'vw')
      },

      height: {
        ...getUnitList('vh', 'vh')
      },

      padding: {
        ...getUnitList('vw', 'vw'),
        ...getUnitList('vh', 'vh')
      },

      typography: theme => ({
        DEFAULT: {
          css: {
            color: null,
            fontSize: null,
            lineHeight: null,
            maxWidth: null,
            a: {
              color: theme('colors.primary'),
            },
            strong: {
              color: null,
            }
          }
        }
      }),
      boxShadow: {
        std: '0 0 5rem rgba(0,0,0,1)',
        gold: '0 0.3rem 9.9rem #947541',
        goldb: '0 2rem 9.9rem #947541',
        goldbig: '0 0 9.9rem #9475418a',
      },
      animation:{
        pulsing: 'pulsing 5s ease-in-out infinite',
      },
      keyframes: {
        'pulsing': {
            '0%': { transform: 'scale(.9)' },
            '70%': {transform:'scale(1)'},
            '100%': { transform:'scale(.9)'},
        },
      }
    },
  },
  variants: {
    extend: {
      lineClamp: {
        7: '7',
        8: '8',
        9: '9',
        10: '10',
      }
    },
    container: [],
  },
  plugins: [
    require('@tailwindcss/typography')({
      modifiers: [],
    }),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/line-clamp'),
    // require("@tailwindcss/forms")({
    //   strategy: 'class',
    // }),
  ],
}