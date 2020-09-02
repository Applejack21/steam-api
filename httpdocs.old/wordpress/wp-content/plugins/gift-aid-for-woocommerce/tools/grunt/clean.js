// Clean Task - https://github.com/gruntjs/grunt-contrib-clean
// ----------------------------------------------------------------------------
module.exports = {
	// Remove the temporary JS files created
	// by the grunt-contrib-concat task.
	// -------------------------------------
	clean_js: {
		src: [
			'<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/*.tmp.js'
		]
	}
};
