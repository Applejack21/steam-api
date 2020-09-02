// Uglify Task - https://github.com/gruntjs/grunt-contrib-uglify
// ----------------------------------------------------------------------------
module.exports = {
	// Uglify all of our JS assets.
	// -------------------------------------
	options: {
		banner: '/*! <%= package.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n',
		// Turning off mangling keeps the original
		// code intact, reducing errors.
		// -------------------------------------
		mangle: false,
		// Generate a sourcemap for each
		// Javascript file.
		// -------------------------------------
		sourceMap: false
	},
	// Public JS.
	// -------------------------------------
	public: {
		files: {
			'<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-public.min.js': [ '<%= concat.public.dest %>' ]
		}
	},
	// Admin JS.
	// -------------------------------------
	admin: {
		files: {
			'<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-admin.min.js': [ '<%= concat.admin.dest %>' ]
		}
	},
	// Customizer JS.
 	// -------------------------------------
	customizer: {
		files: {
			'<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-customizer.min.js': [ '<%= concat.customizer.dest %>' ]
		}
	},

};
