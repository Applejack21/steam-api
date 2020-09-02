// JSDoc Task - https://github.com/krampstudio/grunt-jsdoc
// ----------------------------------------------------------------------------
module.exports = {
	// Generate documentation for our JS.
	// -------------------------------------
	jsdoc: {
		src: [ '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/**/*.js' ],
		dest: '<%= pluginInfo.docs_path %>/js'
	}
};
