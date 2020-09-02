// Sass Lint Task - https://github.com/sasstools/grunt-sass-lint
// ----------------------------------------------------------------------------
module.exports = {
	options: {
		configFile: 'config/.sasslint.yml',
		formatter: 'stylish',
		outputFile: '<%= pluginInfo.reports_path %>/sasslint.xml'
	},
	target: ['<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.scss_dir %>/**/*.scss']
};

