// Sass Task - https://github.com/sindresorhus/grunt-sass
// ----------------------------------------------------------------------------
module.exports = {
	// Generate CSS from our Sass files.
	// -------------------------------------
	sass: {
		options: {
			sourceMap: false,
			style: 'compressed'
		},
		files: [ {
			expand: true,
			cwd: '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.scss_dir %>',
			src: [ '*.scss' ],
			dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.css_dir %>',
			ext: '.css'
		} ]
	}
};
