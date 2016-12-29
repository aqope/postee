/**
	Main gulp file for executing tasks
	usage: gulp <task1> <task2>
*/

var gulp = require('gulp');
var path = require('path');
var less = require('gulp-less');
var watch = require('./semantic/tasks/watch');
var build = require('./semantic/tasks/build');

/**
 * Compiles all less files from ./less into css ./css
 */
gulp.task('comp-css', function() {
	console.log(path.join(__dirname, 'less'));
	return gulp.src('./less/*.less')
	.pipe(less({
		paths: [path.join(__dirname, 'less')]
	}))
	.pipe(gulp.dest('./css'));
});

gulp.task('build-styles', build);
gulp.task('watch-styles', watch);