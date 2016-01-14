/*
npm install gulp gulp-useref gulp-if gulp-uglify gulp-cssnano del gulp-livereload gulp-clean gulp-replace gulp-htmlmin --save-dev
*/
var gulp = require('gulp'),
    useref = require('gulp-useref'),
    gulpIf = require('gulp-if'),
    uglify = require('gulp-uglify'),
    cssnano = require('gulp-cssnano'),
    del = require('del'),
    livereload = require('gulp-livereload'),
    clean = require('gulp-clean'),
    replace = require('gulp-replace'),
    htmlmin = require('gulp-htmlmin')
    ;

// Paths variables
var paths = {  
    'dev': {
        'css': 'gulpBuild/resources/assets/css',
        'js': 'gulpBuild/resources/assets/js',
        'font': 'gulpBuild/resources/assets/fonts',
        'view':'gulpBuild/resources/views',
        'localgulp': 'D:/xampp/htdocs/signalgulp/resources',
    },
    'assets': {
        'css': 'resources/assets/css',
        'js': 'resources/assets/js',
        'font': 'resources/assets/fonts/**/*',
        'view':'resources/views/**/*.php',
        'local': 'D:/xampp/htdocs/signal/gulpBuild/resources'
    }

};

gulp.task('hello', function() {
  console.log(paths.assets.local);
});

gulp.task('useref', function(){
  return gulp.src(paths.assets.view)
    .pipe(replace("{{ asset('resources/assets') }}", 'resources/assets'))
    // .pipe(replace(/foo(.{3})/g, '$1foo'))
    .pipe(useref())
    // Minifies only if it's a JavaScript file
    .pipe(gulpIf('*.js', uglify()))
    // Minifies only if it's a CSS file
    .pipe(gulpIf('*.css', cssnano()))
    
    .pipe(gulp.dest(paths.dev.view))

    .pipe(replace('../assets', "{{ asset('resources/assets') }}"))
    .pipe(gulp.dest(paths.dev.view))
});

gulp.task('htmlmin',['useref'], function() {
  return gulp.src(paths.assets.view)
    .pipe(htmlmin({collapseWhitespace: true,
                    removeAttributeQuotes: true,
                    removeComments:        true,
                    minifyJS:              true}))
    .pipe(gulp.dest(paths.dev.view))
});


gulp.task('copy', function() {
   // Copy fonts
 return gulp.src(paths.assets.font)
 .pipe(gulp.dest(paths.dev.font));

  // Copy go test gulp build
 // return gulp.src(paths.assets.local)
 // .pipe(gulp.dest(paths.assets.localgulp));
});

gulp.task('clean', function() {
  return del.sync(['gulpBuild/resources/**',
                    '!gulpBuild/resources/assets/',
                    '!gulpBuild/resources/views/',
                    ]);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('useref','htmlmin');
});

// Watch
gulp.task('watch', function() {

  var livereloadPage = function () {
    // Reload the whole page
    livereload.reload();
  };

  // Watch .blade lang files
  gulp.watch(paths.assets.view, livereloadPage);
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
