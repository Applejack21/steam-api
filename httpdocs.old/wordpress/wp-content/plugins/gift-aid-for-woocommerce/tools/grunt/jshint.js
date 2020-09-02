// JSHint Task - https://github.com/gruntjs/grunt-contrib-jshint
// ----------------------------------------------------------------------------
module.exports = {
	options: {
		// Import our JSHint config options.
		// -------------------------------------
		jshintrc: 'tools/grunt/config/jshintrc.json',
		// Output the results to file.
		// -------------------------------------
		reporterOutput: '<%= pluginInfo.reports_path %>/jshint.txt',
		reporter: require( 'jshint-stylish' ),
	},
	// Lint our Javascript.
	// -------------------------------------
	scripts: {
		options: {
			// Continue the build regardless of
			// JSHint errors.
			// -------------------------------------
			force: true
		},
		src: [
			'<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/**/*.js',
			'!<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/lib/modernizr-custom.js'
		]
	}
};
