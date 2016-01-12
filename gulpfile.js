/*
npm install gulp gulp-useref gulp-if gulp-uglify gulp-cssnano del gulp-livereload gulp-clean --save-dev
*/
var gulp = require('gulp'),
    useref = require('gulp-useref'),
    gulpIf = require('gulp-if'),
    uglify = require('gulp-uglify'),
    cssnano = require('gulp-cssnano'),
    del = require('del'),
    livereload = require('gulp-livereload'),
    clean = require('gulp-clean')
    ;

// Paths variables
var paths = {  
    'dev': {
        'css': 'gulpBuild/resources/assets/css',
        'js': 'gulpBuild/resources/assets/js',
        'font': 'gulpBuild/resources/assets/fonts',
        'html':'gulpBuild/resources/views',
        'vendor': 'laravel/public/dev/vendor',
    },
    'assets': {
        'css': 'resources/assets/css',
        'js': 'resources/assets/js',
        'font': 'resources/assets/fonts/**/*',
        'html':'resources/views/**/*.php',
        'vendor': 'ssets/bower_vendor'
    }

};

gulp.task('hello', function() {
  console.log(paths.dev.js+'/*.js');
});

gulp.task('useref', function(){
  return gulp.src(paths.assets.html)
    .pipe(useref())
    // Minifies only if it's a JavaScript file
    .pipe(gulpIf('*.js', uglify()))
    // Minifies only if it's a CSS file
    .pipe(gulpIf('*.css', cssnano()))
    .pipe(gulp.dest(paths.dev.html))
});

gulp.task('copy', function() {
   // Copy fonts
 return gulp.src(paths.assets.font)
 .pipe(gulp.dest(paths.dev.font));
});

// gulp.task('clean:dist', function() {
//   return del.sync('dist');
// })

gulp.task('clean', function() {
  return del.sync(['gulpBuild/resources/**',
                    '!gulpBuild/resources/assets/',
                    '!gulpBuild/resources/views/',
                    ]);
  // del([ 'gulpBuild/resources/assets/css',
  //               'gulpBuild/resources/assets/js',
  //               'gulpBuild/resources/assets/views',
  //               'gulpBuild/resources/assets/fonts',
  //            ]);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('useref', 'copy');
});

// Watch
gulp.task('watch', function() {

  var livereloadPage = function () {
    // Reload the whole page
    livereload.reload();
  };

  // Watch .blade lang files
  gulp.watch(paths.assets.html, livereloadPage);
  gulp.watch('app/helpers.php', livereloadPage);
  gulp.watch('resources/lang/**/*.php', livereloadPage);

  // gulp.watch( paths.assets.css+'/*.css', 'useref');
  gulp.watch( 'resources/assets/css/*.css'  , [useref]);
  gulp.watch( 'resources/assets/js/*.js'  , [useref]);

  // Create LiveReload server
  livereload.listen();

  // Watch any files in dist/, reload on change
  gulp.watch(['resources/assets/**']).on('change', livereload.changed);
  // Watch .css , .js files

});