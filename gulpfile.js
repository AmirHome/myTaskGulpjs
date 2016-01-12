var uglify = require('gulp-uglify');
var gulpIf = require('gulp-if');
var cssnano = require('gulp-cssnano');
var del = require('del');


var gulp = require('gulp'),
    useref = require('gulp-useref'),
    gulpIf = require('gulp-if'),
    uglify = require('gulp-uglify'),
    cssnano = require('gulp-cssnano'),
    del = require('del'),
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
        'css': 'gulpBuild/assets/css',
        'js': 'gulpBuild/assets/js',
        'font': 'gulpBuild/resources/fonts',
        'html':'gulpBuild/resources/views',
        'vendor': 'laravel/public/dev/vendor',
        'html':'dev/html/'
    },
    'assets': {
        'css': 'assets/css',
        'js': 'assets/js',
        'font': 'resources/fonts/**/*',
        'html':'resources/views',
        'vendor': 'ssets/bower_vendor'
    }

};

gulp.task('hello', function() {
  console.log(paths.assets.html);
});

gulp.task('useref', function(){
  return gulp.src('./resources/views/*.blade.php')
    .pipe(useref())
    // Minifies only if it's a JavaScript file
    .pipe(gulpIf('*.js', uglify()))
    // Minifies only if it's a CSS file
    .pipe(gulpIf('*.css', cssnano()))
    .pipe(gulp.dest('./gulpBuild/resources/views'))
});

gulp.task('copy', function() {
   // Copy fonts
 return gulp.src('resources/assets/fonts/**/*')
 .pipe(gulp.dest('gulpBuild/resources/assets/fonts'));
});

// gulp.task('clean:dist', function() {
//   return del.sync('dist');
// })

gulp.task('clean', function() {
  return del([ 'gulpBuild/resources/assets/css',
                'gulpBuild/resources/assets/js',
                'gulpBuild/resources/assets/views',
                'gulpBuild/resources/assets/fonts',
             ]);
});

// Default task
gulp.task('default', ['clean'], function() {
// gulp.task('default', function() {
  // gulp.start('styles', 'scripts', 'images');
  gulp.start('useref', 'copy');
});
