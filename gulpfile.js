
var purify = require('gulp-purifycss');

var uglify = require('gulp-uglify');

var gulp = require('gulp'),
    useref = require('gulp-useref'),
    gulpif = require('gulp-if'),
    uglify = require('gulp-uglify'),
    minifycss = require('gulp-minify-css'),
    // 
    autoprefixer = require('gulp-autoprefixer'),
    rename = require('gulp-rename'),
    gutil = require('gulp-util'),
    jshint = require('gulp-jshint'),
    browserify = require('gulp-browserify'),
    concat = require('gulp-concat'),
    clean = require('gulp-clean'),
    notify = require('gulp-notify');
 


// Paths variables
var paths = {  
    'dev': {
        'css': './dev/css/',
        'scss': './laravel/public/dev/scss/',
        'js': './laravel/public/dev/js/',
        'vendor': './laravel/public/dev/vendor/',
        'html':'./dev/html/'
    },
    'assets': {
        'css': './assets/css/',
        'js': './assets/js/',
        'vendor': '/assets/bower_vendor/',
        'html':'./test/'
    }

};

gulp.task('hello', function() {
  console.log(paths.assets.html);
});

gulp.task('css', function() {
  return gulp.src(paths.dev.css+'*.css')

    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest(paths.assets.css))

    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest(paths.assets.css))

    .pipe(notify({ message: 'Styles task complete' }));
});


gulp.task('html', function () {
    return gulp.src(paths.dev.html+'*.html')
        .pipe(useref())
        // .pipe(gulpif('*.js', uglify()))
        // .pipe(gulpif(paths.dev.css+'*.css', minifycss()))
        .pipe(gulp.dest(paths.assets.html));
});

