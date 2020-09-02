// Concat Task - https://github.com/gruntjs/grunt-contrib-concat
// ----------------------------------------------------------------------------
module.exports = {
	options: {
		separator: '\r\n\r\n',
	},
	// Public JS.
	// -------------------------------------
	public: {
		src: ['<%= concatPublic %>'],
		dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-public.js',
		nonull: true
	},
	public_min: {
		src: ['<%= concatPublic %>'],
		dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-public.tmp.js',
		nonull: true
	},
	// Admin JS.
	// -------------------------------------
	admin: {
		src: ['<%= concatAdmin %>'],
		dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-admin.js',
		nonull: true
	},
	admin_min: {
		src: ['<%= concatAdmin %>'],
		dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-admin.tmp.js',
		nonull: true
	},
	// Customizer JS.
	// -------------------------------------
	customizer: {
		src: ['<%= concatCustomizer %>'],
		dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-customizer.js',
		nonull: true
	},
	customizer_min: {
		src: ['<%= concatCustomizer %>'],
		dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.js_dir %>/<%= pluginInfo.plugin_slug %>-customizer.tmp.js',
		nonull: true
	}
};
