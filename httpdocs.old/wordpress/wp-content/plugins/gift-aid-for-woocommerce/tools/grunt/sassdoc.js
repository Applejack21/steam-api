// SassDoc Task - https://github.com/SassDoc/grunt-sassdoc
// ----------------------------------------------------------------------------
module.exports = {
	// Generate documentation for our Sass.
	// -------------------------------------
	options: {
		dest: '<%= pluginInfo.docs_path %>/scss'
	},
	sass: {
		src: '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.scss_dir %>',
	}
};
