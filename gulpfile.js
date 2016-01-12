var uglify = require('gulp-uglify');
var gulpIf = require('gulp-if');

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

gulp.task('html', function () {
    return gulp.src(paths.dev.html+'*.html')
        .pipe(useref())
        // .pipe(gulpif('*.js', uglify()))
        // .pipe(gulpif(paths.dev.css+'*.css', minifycss()))
        .pipe(gulp.dest(paths.assets.html));
});

gulp.task('useref', function(){
  return gulp.src('app/*.html')
    .pipe(useref())
    // Minifies only if it's a JavaScript file
    .pipe(gulpIf('*.js', uglify()))
    .pipe(gulp.dest('dist'))
});