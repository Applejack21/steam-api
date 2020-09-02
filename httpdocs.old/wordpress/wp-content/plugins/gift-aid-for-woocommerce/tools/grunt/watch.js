// Watch Task - https://github.com/gruntjs/grunt-contrib-watch
// ----------------------------------------------------------------------------
module.exports = {
	options: {
		// Livereload support - requires a browser plugin
		livereload: true,
		spawn: false
	},

	// Process plugin code.
	// -------------------------------------
	plugin: {
	  files: [ 'plugin.php', '/php/**/*.php', '/views/**/*.php' ],
	  tasks: [
		'phplint',
		'phpdoc:theme',
		'notify:plugin'
	  ]
	},

	// Minify JPG & PNG images.
	// -------------------------------------
	images_jpg: {
		files: [ '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.img_dir %>/**/*.{jpg,png,gif}' ],
		tasks: [
			'newer:imagemin',
			'notify:images'
		]
	},

	// Minify SVG images.
	// -------------------------------------
	images_svg: {
		files: [ '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.img_dir %>/**/*.svg' ],
		tasks: [
			'newer:svgmin',
			'notify:images'
		]
	},

	// Process scripts.
	// -------------------------------------
	scripts: {
		files: [
			'<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/**/*.js',
			'!<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/lib/modernizr-custom.js'
		],
		tasks: [
			'jshint',
			'modernizr',
			'concat',
			'uglify',
			'clean',
			'jsdoc',
			'notify:scripts'
		]
	},

	// Process styles.
	// -------------------------------------
	styles: {
		files: [ '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.scss_dir %>/**/*.scss' ],
		tasks: [
			'scsslint',
			'spritesmith',
			'sass',
			'postcss',
			'cssmin',
			'sassdoc',
			'notify:styles'
		]
	}
};
