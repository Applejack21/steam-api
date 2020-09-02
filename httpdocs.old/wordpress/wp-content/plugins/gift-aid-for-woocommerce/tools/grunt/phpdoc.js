// PHPdoc Task - https://github.com/chrisklaussner/grunt-phpdoc
// ----------------------------------------------------------------------------
module.exports = {
	// Generate plugin documentation.
	// -------------------------------------
	plugin: {
		src: [
			'php/**/*.php',
			'views/**/*.php',
			'plugin.php'
		],
		dest: '<%= pluginInfo.docs_path %>/php'
	}
}
