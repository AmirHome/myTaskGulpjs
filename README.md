# Installing Gulp

You need to have Node.js (Node) installed onto your computer before you can install Gulp.

If you do not have Node installed already, you can get it by downloading the package installer from Node's website.

When you're done with installing Node, you can install Gulp by using the following command in the command line:

	$ npm install gulp -g
	
-----
# Creating a Gulp Project

First, we'll create a folder called project to server as our project root as we move through this tutorial. Run the npm init command from inside that directory:

	... from within our project folder
	$ npm init

Once the package.json file is created, we can install Gulp into the project by using the following command:

	$ npm install gulp --save-dev

My experience is that with windows is you need to do "npm install --no-bin-links" according to Laravel

	$ npm install --no-bin-links

-----
# Writing Your First Gulp Task

The first step to using Gulp is to require it in the gulpfile.

	var gulp = require('gulp');

The require statement tells Node to look into the node_modules folder for a package named gulp. Once the package is found, we assign its contents to the variable gulp.

We can now begin to write a gulp task with this gulp variable. The basic syntax of a gulp task is:

	gulp.task('task-name', function () {
	  return gulp.src('source-files') // Get source files with gulp.src
	    .pipe(aGulpPlugin()) // Sends it through a gulp plugin
	    .pipe(gulp.dest('destination')) // Outputs the file in the destination folder
	})

-----
# Install Package Sample

With npm do:

	$ npm install gulp-cssnano --save-dev