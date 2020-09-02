// Modernizr Task - https://github.com/Modernizr/grunt-modernizr
// ----------------------------------------------------------------------------
module.exports = {
    // Generate a custom Modernizr build
    // based on the checks found in our
    // Sass & Javascript.
    // -------------------------------------
    custom: {
        "cache": true,
        "uglify": false,
        "options": [
            "domPrefixes",
            "prefixes",
            "mq",
            "prefixed",
            "testAllProps",
            "testProp",
            "setClasses"
        ],
        "tests": [
            "flexbox",
            "cssanimations",
            "cssgradients",
            "csstransforms",
            "csstransitions",
            "csscolumns",
            "cssvhunit",
            "cssvwunit",
            "placeholder",
            "localstorage",
            "inlinesvg",
            "canvas",
            "shapes"
        ],
        "excludeTests": [
            "hidden"
        ],
        "devFile": "tools/bower_components/modernizr/src/Modernizr.js",
        "dest": "<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/lib/_modernizr-custom.js",
        "crawl": true,
        "files": {
            "src": [
                '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.scss_dir %>/**/*.scss',
                '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/**/*.js',
                '!<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.js_dir %>/lib/modernizr-custom.js'
            ]
        }
    }
};
