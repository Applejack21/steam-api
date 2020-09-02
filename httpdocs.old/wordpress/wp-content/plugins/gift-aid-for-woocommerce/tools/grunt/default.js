// Default Task - The master task used to build/re-build the project. Comment,
// un-comment or re-arrange to suit your specific needs.
// ----------------------------------------------------------------------------
module.exports = function( grunt ) {
	grunt.registerTask( 'default', [
		'sync',
		"lint",
		"spritesmith",
		"sass",
		"postcss",
		"cssmin",
		"modernizr",
		"concat",
		"uglify",
		"newer:svgmin",
		"newer:imagemin",
		"clean",
		// "document",
		"notify:build"
	] );
};
