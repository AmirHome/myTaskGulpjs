/*
$ npm install rimraf -g $ rimraf node_modules
$ npm install gulp -g
$ npm init
$ npm install gulp gulp-useref gulp-if gulp-uglify gulp-cssnano del gulp-livereload gulp-replace gulp-htmlmin gulp-git vinyl-ftp yargs fs run-sequence --save-dev
*/
var gulp = require('gulp'),
    useref = require('gulp-useref'),
    gulpIf = require('gulp-if'),
    uglify = require('gulp-uglify'),
    cssnano = require('gulp-cssnano'),
    del = require('del'),
    livereload = require('gulp-livereload'),
    replace = require('gulp-replace'),
    htmlmin = require('gulp-htmlmin'),
    git = require('gulp-git'), // git
    ftp = require('vinyl-ftp'), // ftp
    aArgv = require('yargs'), // pass arguments
    fs = require('fs'), // load file
    runSequence = require('run-sequence').use(gulp) // tasks in order
;
// Paths variables
var ftpignore = ['.bowerrc', '.env', '.env.example','.htaccess', '.gitattributes', '.gitignore', '.jshintrc', 'artisan', 'composer.json', 'composer.lock', 'gulpfile.js', 'package.json', 'phpunit.xml', 'README.md', 'node_modules/**', 'node_modules', '.git/**', '.git', 'storage/framework/views/**/*', 'storage/framework/cache/**/*', 'storage/framework/sessions/**/*', 'storage/debugbar/**/*', 'storage/logs/**/*', 'gulpBuild/**', 'gulpBuild'];
var lastTag, logTag;
var logsFile = 'gulpfile.log';
var paths = {
    'dev': {
        'css': 'gulpBuild/resources/assets/css',
        'js': 'gulpBuild/resources/assets/js',
        'font': 'gulpBuild/resources/assets/fonts',
        'view': 'gulpBuild/resources/views',
        // 'localgulp': 'D:/xampp/htdocs/signalgulp/resources',
    },
    'assets': {
        'css': 'resources/assets/css',
        'js': 'resources/assets/js',
        'font': 'resources/assets/fonts/**/*',
        'view': 'resources/views/**/*.php',
    }
};
/** Configuration **/
var aDomain = '';
var aUserName = '';
var aPassword = '';
// get authorizations parameters from console user
gulp.task('authorizations', function() {
    aDomain = (aArgv.argv.d === undefined || aArgv.argv.d === true) ? '' : aArgv.argv.d;
    aUserName = (aArgv.argv.u === undefined || aArgv.argv.u === true) ? '' : aArgv.argv.u;
    aPassword = (aArgv.argv.p === undefined || aArgv.argv.p === true) ? '' : aArgv.argv.p;
    aPort = (aArgv.argv.o === undefined || aArgv.argv.o === true) ? '21' : aArgv.argv.o;
    if ('' === aDomain || '' === aPassword || '' === aUserName) {
        console.log('\n\r !! ERROR Authorizations: this command needs to -d Domain -u username -p password !! \n\r');
        gulp.start('help');
        process.exit(1);
    }
});
// helper function to build an FTP connection based on our configuration
function getFtpConnection() {
    return ftp.create({
        host: aDomain, // ftp host name
        user: aUserName, // ftp username
        password: aPassword, // ftp password
        parallel: 7,
        port: aPort,
        //log: gutil.log,
        reload: true,
        // maxConnections:1,
    });
}
// help commands
gulp.task('help', function() {
    console.log('Help Commands\n\r');
    console.log('   ftp-deploy\t\t Upload modified git with ftp');
    console.log('             \t\t Parameters:');
    console.log('             \t\t -d Domain -u username -p password [-f Full Transfer] \n\r');
    console.log('             \t\t                                   [-t Tag use] \n\r');

    console.log('   mini-deploy\t\t Minify html, css, js and upload modified git with ftp');
    console.log('              \t\t Parameters:');
    console.log('              \t\t -d Domain -u username -p password [-f Full Transfer] \n\r');

    console.log('   create-version\t Create tag for this version git \n\r');
    console.log('   build\t Minify and Copy in gulpBuild folder \n\r');
});
// Create Tag Version
gulp.task('create-version', function() {
    runSequence('createTag', 'pushTag');
});
//calculate and create tag
gulp.task('createTag', function() {
    return git.exec({
        args: 'rev-list --count HEAD'
    }, function(err, tagc) {
        if (err) throw err;
        segmentFirst = parseInt(tagc / 1000);
        segmentSecond = parseInt((tagc % 1000) / 200);
        segmentThird = parseInt(((tagc % 1000) % 200) / 20);
        segmentFourth = parseInt(((tagc % 1000) % 200) % 20);
        if (10 > segmentFourth) {
            segmentFourth = '0' + segmentFourth;
        }
        git.tag(segmentFirst + '.' + segmentSecond + '.' + segmentThird + '.' + segmentFourth, 'Version gulpfiles', function(err) {
            // if (err) throw err;
            console.log('   Created version ' + segmentFirst + '.' + segmentSecond + '.' + segmentThird + '.' + segmentFourth);
        });
    });
});
// add commite gulpfile.log
gulp.task('addCommitGulpLog', function() {
    gulp.src('gulpfile.log')
        .pipe(git.add())
        .pipe(git.commit('commit gulpfile.log'));
});
// push with git tag to orgin
gulp.task('pushTag', ['addCommitGulpLog'],function(){
    git.push('origin', 'master', {args:"--follow-tags"}, function (err) {
        if (err) throw err;
        console.log('Pushed git version');
    });
})
/*
 * upload modified git with ftp
 */
gulp.task('ftp-deploy', ['readLastTag'], function() {
    //Full Upload param
    var init = aArgv.argv.f === undefined ? false : true;
    // var tag = (aArgv.argv.t === undefined || aArgv.argv.t === true) ? '' : aArgv.argv.t;
    var separator;
    if (init) {
        var conn_upload = getFtpConnection();
        var remotePath = '/'; // the remote path on the server you want to upload to
        var list = ['./**', '.git/refs/tags/*'];
        ftpignore.forEach(function(item) {
            list.push('!' + item);
        });
        // console.log(list); process.exit();
        // using base = '.' will transfer everything to /public_html correctly
        // turn off buffering in gulp.src for best performance
        return gulp.src(list, {
            base: '.',
            buffer: false
        }).pipe(conn_upload.newer(remotePath)) // only upload newer files
            .pipe(conn_upload.dest(remotePath));
    } else {
        separator = '\t';
        return git.exec({
            args: 'describe --tags'
        }, function(err, tagc) {
            if (err) throw err;
            lastTag = tagc.trim().slice(0, 8);
            if (logTag == '') logTag = lastTag;
            // console.log('logTag'+logTag);
            // console.log(lastTag);
            // process.exit(0);
            return git.exec({
                args: 'diff --name-status ' + logTag + ' ' + 'HEAD',
                maxBuffer: 1024 * 1024
            }, function(err, stdout) {
                if (err) throw err;
                var list = stdout;
                console.log('\n\rQueued files ...\n\r');
                console.log('Status\t\t\tPath');
                console.log(list);
                list = list.trim().split('\n').map(function(line) {
                    var a = line.split(separator);
                    return {
                        type: a[0],
                        path: a[1]
                    };
                });
                list = list.filter(function(x) {
                    return ftpignore.indexOf(x.path) < 0
                });
                // save last list to cache
                // append last tag git to list
                list.push({
                    type: 'M',
                    path: '.git/refs/tags/' + lastTag
                });
                // console.log(list); process.exit();
                var conn_upload = getFtpConnection();
                var remotePath = '/'; // the remote path on the server you want to upload to
                // added and modified files
                var changes = list.reduce(function(a, cur) {
                    if (cur.type !== 'D' && cur.type.length) a.push(cur.path);
                    return a || [];
                }, []);
                // deleted files
                var deletes = list.reduce(function(a, cur) {
                    if (cur.type === 'D' && cur.type.length) a.push(cur.path);
                    return a || [];
                }, []);
                // delete removes files
                deletes.map(function(d) {
                    conn_upload.delete(remotePath + d, function(err) {
                        //if (err) throw err;
                    });
                });
                // upload added and modified files
                gulp.src(changes, {
                    base: '.',
                    buffer: false
                }).pipe(conn_upload.dest(remotePath, function(err) {
                        if (err) throw err;
                    })
                );
                // write log for last
                // return writeLastTag();
                // return gulp.start('writeLastTag');
                return runSequence('writeLastTag', 'pushTag');
            });
        });
    }
});
/* clean up css and js and html */
gulp.task('useref', ['clean'], function() {
    return gulp.src(paths.assets.view).pipe(replace("{{url('resources/assets')}}", 'resources/assets')).pipe(useref())
    /* Minifies only if it's a JavaScript file
    <!--build:js(./)  ../assets/js/general-javascript.js -->
        <script src="{{ asset('resources/assets') }}/js/jquery.min.js"></script>
        <script src="{{ asset('resources/assets') }}/js/menu.js"></script>
    <!-- endbuild -->
    */
        .pipe(gulpIf('*.js', uglify()))
        /* Minifies only if it's a CSS file
        <!-- build:css(./)  ../assets/css/general-head.css -->
            <link rel="stylesheet" href="{{ asset('resources/assets') }}/css/style1.css">
            <link rel="stylesheet" href="{{ asset('resources/assets') }}/css/style2.css">
        <!-- endbuild -->
        */
        .pipe(gulpIf('*.css', cssnano())).pipe(gulp.dest(paths.dev.view)).pipe(replace('resources/assets', "{{url('resources/assets')}}")).pipe(replace('../assets', "{{url('resources/assets')}}")).pipe(gulpIf('*.php', htmlmin({
            collapseWhitespace: true,
            removeAttributeQuotes: true,
            removeComments: true,
            minifyJS: true,
        }))).pipe(gulpIf('*.php', gulp.dest(paths.dev.view)))
});
// Remove gulpBuild Directory
gulp.task('clean', function() {
    return del.sync(['gulpBuild/resources/**', '!gulpBuild/resources/assets/', '!gulpBuild/resources/views/', ]);
});
// git test master
gulp.task('min', ['clean_min'], function() {
    return gulp.src([__dirname + '/**', '!' + __dirname + '/node_modules/**', '!' + __dirname + '/node_modules', '!' + __dirname + '/.git/**', '!' + __dirname + '/.git', '!' + __dirname + '/storage/framework/views/**/*', '!' + __dirname + '/storage/framework/cache/**/*', '!' + __dirname + '/storage/framework/sessions/**/*', '!' + __dirname + '/gulpBuild/**', '!' + __dirname + '/gulpBuild'], {
        dot: true
    }).pipe(gulp.dest(__dirname + '_min'));
});
gulp.task('clean_min', ['useref'], function() {
    return del([
        __dirname + '_min/**', '!' + __dirname + '_min'
        // ,'!'+paths.local.root+paths.local.project+'_min/amir/**'
        , '!' + __dirname + '_min/.git/**'
    ], {
        force: true,
        dot: true
    });
});
// Minify and Copy in gulpBuild folder
gulp.task('build', ['min'], function() {
    return gulp.src([__dirname + '/gulpBuild/**'], {
        dot: true
    }).pipe(gulp.dest(__dirname + '_min'));
});
// Upload gulpBuild folder
gulp.task('upload_gulpBuild', ['authorizations', 'useref'], function() {
    var conn_upload_gulpBuild = getFtpConnection();
    return gulp.src(__dirname + '/gulpBuild/**/*', {
        base: './gulpBuild/',
        buffer: false
    }) //.pipe(conn_upload_gulpBuild.newer('/')) // only upload newer files
        .pipe(conn_upload_gulpBuild.dest('/'));
});
// mini-deploy command
gulp.task('mini-deploy', function() {
    runSequence('ftp-deploy', 'upload_gulpBuild');
});
// Watch
gulp.task('watch', function() {
    var livereloadPage = function() {
        // Reload the whole page
        livereload.reload();
    };
    // Watch .blade lang files
    gulp.watch(paths.assets.view, livereloadPage);
    gulp.watch('app/helpers.php', livereloadPage);
    gulp.watch('resources/lang/**/*.php', livereloadPage);
    // gulp.watch( paths.assets.css+'/*.css', [useref]);
    gulp.watch('resources/assets/css/*.css');
    gulp.watch('resources/assets/js/*.js');
    // Create LiveReload server
    livereload.listen();
    // Watch any files in dist/, reload on change
    gulp.watch(['resources/assets/**', 'resources/vendors/**']).on('change', livereload.changed);
    // Watch .css , .js files
});
// htmlmin
gulp.task('htmlmin', ['clean'], function() {
    return gulp.src(paths.assets.view).pipe(htmlmin({
        collapseWhitespace: true,
        // removeAttributeQuotes: true,
        removeComments: true,
        minifyJS: true,
    })).pipe(gulp.dest(paths.dev.view))
});
// Default task
gulp.task('default', function() {
    gulp.start(['help']);
});
// read last tag
gulp.task('readLastTag', ['authorizations'], function() {
    if (aArgv.argv.t === undefined || aArgv.argv.t === true) {
        if (fs.existsSync(logsFile)) {
            // Get content from file
            var contents = fs.readFileSync(logsFile, 'utf-8');
            // Define to JSON type
            var jsonContent = JSON.parse(contents);
            // Get Value from JSON
            if (jsonContent[aDomain] === undefined) {logTag = '';}
            else {logTag = jsonContent[aDomain];}
        } else {
            logTag = '';
            // console.log("Error: LOG FILE DOES NOT EXIST");
            // process.exit();
        }
    } else {
        logTag = aArgv.argv.t;
    }
    console.log("Current Tag in log file is :", logTag + "\n\r");
});
//write last tag in log file
gulp.task('writeLastTag', function() {
    console.log("lastTag" + lastTag);
    if (fs.existsSync(logsFile)) {
        // Get content from file
        var string = fs.readFileSync(logsFile, 'utf-8');
        // Define to JSON type
        var jsonObj = JSON.parse(string);
        // Change Value from JSON
        jsonObj[aDomain] = lastTag;

        /*for (var exKey in jsonObj) {
            if (exKey == jsonObj[aDomain]) {
                jsonObj[exKey] = lastTag;
            }
            // console.log("key:"+exKey+", value:"+jsonObj[exKey]);
        }*/

    }else{
        jsonObj = JSON.parse('{"'+aDomain+'":"'+lastTag+'"}');
    }
    // Write to log file
    fs.writeFileSync(logsFile, JSON.stringify(jsonObj));
    console.log("Write to log file Last Tag :", lastTag + "\n\r");
});
// test task

// test task
gulp.task('test', ['authorizations'],  function() {
    aArgv.usage('Usage: $0 <command> [options]')
        .command('count', 'Count the lines in a file')
        .example('$0 count -f foo.js', 'count the lines in the given file')
        .alias('f', 'file')
        .nargs('f', 1)
        .describe('f', 'Load a file')
        .demandOption(['f'])
        .help('h')
        .alias('h', 'help')
        .epilog('copyright 2015')
        .argv;

    var fs = require('fs');
    var s = fs.createReadStream(argv.file);

    var lines = 0;
    s.on('data', function (buf) {
        lines += buf.toString().match(/\n/g).length;
    });

    s.on('end', function () {
        console.log(lines);
    });
});

/*function writeLastTag() {
    if (fs.existsSync(logsFile)) {
        // Get content from file
        var string = fs.readFileSync(logsFile, 'utf-8');
        // Define to JSON type
        var jsonObj = JSON.parse(string);
        // Change Value from JSON
        jsonObj[aDomain] = lastTag;
    }else{
        jsonObj = "{'"+aDomain+"':'"+lastTag+"'}";
    }
    // Write to log file
    fs.writeFileSync(logsFile, JSON.stringify(jsonObj));
    console.log("Write to log file Last Tag :", lastTag + "\n\r");
}*/