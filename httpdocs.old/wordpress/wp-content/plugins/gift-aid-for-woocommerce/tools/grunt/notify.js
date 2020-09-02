// Notify Task - https://github.com/dylang/grunt-notify
// ----------------------------------------------------------------------------
module.exports = {
	// Notify once the project is rebuilt.
	// -------------------------------------
	build: {
		options: {
			title: 'Rebuild',
			message: '<%= pluginInfo.plugin_name %> is ready to rock!'
		}
	},
	// Notify once plugin is linted.
	// -------------------------------------
	plugin: {
		options: {
			title: 'PHP',
			message: '<%= pluginInfo.plugin_name %> PHP is error free!'
		}
	},
	// Notify once scripts are concatenated
	// and uglified.
	// -------------------------------------
	scripts: {
		options: {
			title: 'Scripts',
			message: '<%= pluginInfo.plugin_name %> scripts processed!'
		}
	},
	// Notify once styles are processed and
	// minified.
	// -------------------------------------
	styles: {
		options: {
			title: 'Styles',
			message: '<%= pluginInfo.plugin_name %> styles processed!'
		}
	},
	// Notify once images are minified.
	// -------------------------------------
	images: {
		options: {
			title: 'Images',
			message: '<%= pluginInfo.plugin_name %> images processed!'
		}
	},
	// Notify once all documentation has
	// been generated.
	// -------------------------------------
	docs: {
		options: {
			title: 'Docs',
			message: '<%= pluginInfo.plugin_name %> docs generated!'
		}
	},
	// Notify once all code has been linted.
	// -------------------------------------
	linting: {
		options: {
			title: 'Linting',
			message: '<%= pluginInfo.plugin_name %> files linted!'
		}
	},
	// Notify once all images have been
	// minified.
	// -------------------------------------
	images: {
		options: {
			title: 'Images',
			message: '<%= pluginInfo.plugin_name %> images minified!'
		}
	}
};
