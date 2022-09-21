const gulp = require('gulp');
var fs = require('fs');
const fsPromises = fs.promises;
const util = require('util');

var header = require('gulp-header');
var clean = require('gulp-clean');

// for css adn scss
const concat = require('gulp-concat');
const csso = require('gulp-csso');
const autoprefixer = require('gulp-autoprefixer');

// js
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const include = require('gulp-include');

var path = require('path');
var dirpath = path.dirname(__filename);

// for tailwind
var postcss = require('gulp-postcss');

const livereload = require('gulp-livereload');

const PCVersion = '1.0';

let dirs = {
    dist: {
        root: 'dist/',
        css: '',
    },

    src: {
        css: [
            'src/css/settings.css',

            // tailwind utilities
            'src/Tailwind/init.scss',
            'src/Tailwind/scss/*.scss',

            //src scss
            'src/css/code/**/*.scss',

            // views scss
            'views/**/*.scss',
            'views/**/*.css',

            // libs css
            'src/css/libs/**/*.css',
        ],

        js: {
            libs: [
                'src/js/libs/import.js',
            ],

            global: [
                'src/js/global/**/*.js',
            ],

            block: [
                '!views/**/compiled.js',
                '!views/**/block-js.js',
                'views/**/*.js',
            ]
        }
    },

    watch: {
        excludes: [
            '!vendor/**/*',
            '!dist/**/*',
        ],

        tailwind: [
            'src/**/*.css',
            'src/**/*.scss',
            'views/**/*.scss',
            // '**/*.twig',
            // '**/*.php',
            // '**/*.html',
        ],

        js: {
            libs: [
                'src/js/libs/**/*.js',
            ],
        },

        htmlcode: [
            // '**/*.php',
            'views/**/*.twig',
            // '**/*.html',
            // '*.php',
        ],
    },
}


var working = false;

function runWatchersWithCashe() {
    const watcher = gulp.watch([
        ...dirs.watch.excludes,
        ...dirs.watch.tailwind,
        ...dirs.watch.js.libs,
        ...dirs.src.js.global,
        ...dirs.src.js.block,
        ...dirs.watch.htmlcode,
    ], {
        delay: 20
    });

    watcher.on('change', function () {
        if (!working) {
            working = true;
            compileAll();
        }
    });
}

const compileAll = async () => {
    let time = Date.now();
    console.log('Start compilling...');

    convJs(dirs.src.js.libs, 'global-libs-js.js');
    convJs(dirs.src.js.block, 'global-js.js');
    convJs(dirs.src.js.global, 'global-functions-js.js');
    let endtime = Date.now();
    console.log('End compiling js in: ' + ((endtime - time) / 1000) + ' s')

    await Async(tailwindCSS());

    pageReload();
    working = false;
    endtime = Date.now();
    console.log('End compiling in: ' + ((endtime - time) / 1000) + ' s')
}

function Async(p) {
    return new Promise((res, rej) => p.on('error', err => rej(err)).on('end', () => res()));
}

const tailwindCSS = () => {
    return gulp.src([...dirs.src.css])
        .pipe(postcss())
        .on('error', function (err) {
            console.log(err.toString());

            this.emit('end');
        })
        .pipe(concat('global-style.css'))
        .pipe(csso({
            sourceMap: false,
            debug: false
        }))
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest(dirs.dist.root))
}

function convJs(src, file) {
    return gulp.src(src)
        .pipe(babel({
            presets: ['@babel/preset-env']
        }).on('error', (e) => {
            console.log(e);
            this.end();
        }))
        .pipe(concat(file))
        .pipe(include())
        .pipe(uglify())
        .pipe(gulp.dest(dirs.dist.root))
}

function pageReload() {
    return gulp.src('index.php')
        .pipe(livereload());
}

gulp.task('default', function () {
    console.log('Project Caster WebPack v' + PCVersion);
    console.log('Starting...');

    livereload.listen();
    runWatchersWithCashe();

    console.log('Compilling scss...');
    compileAll();
});