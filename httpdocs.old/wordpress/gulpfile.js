var gulp = require('gulp'),
	sass = require('gulp-sass'),
	livereload = require('gulp-livereload'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	dest = require('gulp-dest'),
	order = require('gulp-order'),
	sourcemaps = require('gulp-sourcemaps'),
	autoprefixer = require('gulp-autoprefixer')
	rename = require('gulp-rename'),
	flatmap = require('gulp-flatmap'),
	path = require('path');

var theme = 'wp-content/themes/firecask-starter/';


/* ===== Regular theme tasks ===== */

gulp.task('sass', function(){
	return gulp.src(theme  + 'src/scss/**/*.scss')
		.pipe(sourcemaps.init())
		.pipe( sass({
			outputStyle: 'compressed'
		}).on( 'error', sass.logError ) )
		.pipe( sourcemaps.write('.') )
		.pipe( gulp.dest(theme + 'assets/css') )
		.pipe( livereload() )
});

gulp.task('php', function(){
	return gulp.src(theme  + '**/*.php')
		.pipe(livereload())
});

gulp.task('js', function(){
	return gulp.src(theme + 'src/js/**/*.js')
		.pipe( order([
			'libs/*.js',
			'*.js'
		]) )
		.pipe( concat(theme + 'assets/js/scripts.js') )
		.pipe( gulp.dest('.') )
		.pipe( uglify({ mangle: true }) )
		.pipe( dest('', { ext: '.min.js' }) )
		.pipe( gulp.dest('.') )
		.pipe( livereload() )
});

gulp.task('autoprefixer', ['sass'], function(){
	return gulp.src(theme  + 'assets/css/style.css')
		.pipe(autoprefixer())
		.pipe(gulp.dest(theme + 'assets/css'))
});


/* ===== Guntenberg specific tasks ===== */

gulp.task('sass-blocks', function(){
	return gulp.src(theme  + 'template-parts/blocks/*/css/src/*.scss', { base: '.' })
		.pipe( sass({
			outputStyle: 'compressed'
		}).on( 'error', sass.logError ) )
		.pipe(rename(function(file) {
		   file.dirname = file.dirname.replace(/src$/, "output");
		}))
		.pipe( gulp.dest('.') )
		.pipe( livereload() )
});

gulp.task('js-blocks', function(){
	return gulp.src(theme + 'template-parts/blocks/*/', { base: '.' })
		.pipe(flatmap(function(stream, dir) {
		   return gulp.src(dir.path + '/js/src/**/*.js')
				.pipe( order([
					'libs/*.js',
					'*.js'
				]) )
				.pipe( concat( 'scripts.js') )
				.pipe( gulp.dest(path.relative(dir.base, dir.path) + '/js/output/') )
				.pipe( uglify({ mangle: true }) )
				.pipe( dest('', { ext: '.min.js' }) )
				.pipe(gulp.dest(path.relative(dir.base, dir.path) + '/js/output/'))
		 }))
});


gulp.task('watch', function(){
	livereload.listen();
	gulp.watch(theme  + 'src/scss/**/*.scss', ['sass']);
	
	gulp.watch(theme  + 'template-parts/blocks/*/css/src/*.scss', ['sass-blocks']);

	gulp.watch(theme  + '**/*.php', ['php']);
	
	gulp.watch(theme  + 'src/js/**/*.js', ['js']);
	
	gulp.watch(theme  + 'src/js/**/*.js', ['js-blocks']);
});

gulp.task('build', ['sass', 'sass-blocks', 'autoprefixer', 'js', 'js-blocks']);

gulp.task('default', ['watch']);
