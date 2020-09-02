// Imagemin Task - https://github.com/gruntjs/grunt-contrib-imagemin
// ----------------------------------------------------------------------------
module.exports = {
	// Place minified versions of the image
	// assets in the theme.
	// -------------------------------------
	images: {
		options: {
			progressive: true
		},
		files: [ {
			expand: true,
			cwd: '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.img_dir %>',
			src: [ '**/*.{png,jpg,gif}' ],
			dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.img_dir %>'
		} ]
	}
};
