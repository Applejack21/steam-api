// PostCSS Task - https://github.com/nDmitry/grunt-postcss
// ----------------------------------------------------------------------------
module.exports = {
	// Run our CSS through pixrem and
	// autoprefixer.
	// -------------------------------------
	options: {
		processors: [
			require( 'autoprefixer' )( {
				browsers: [ '> 5%', 'last 2 versions' ]
			} ),
			require( 'pixrem' )()
		]
	},
	plugin_public: {
		src: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.css_dir %>/<%= pluginInfo.plugin_slug %>-<%= pluginInfo.public_scss_file %>.css',
	},
	plugin_admin: {
		src: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.css_dir %>/<%= pluginInfo.plugin_slug %>-<%= pluginInfo.admin_scss_file %>.css',
	},
}
