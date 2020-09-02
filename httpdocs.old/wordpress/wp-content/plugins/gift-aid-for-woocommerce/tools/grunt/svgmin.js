// SVG Min Task - https://github.com/sindresorhus/grunt-svgmin
// ----------------------------------------------------------------------------
module.exports = {
    options: {
        plugins: [
        {
            removeTitle: true
        },
        {
            removeDimensions: true
        },
        {
            removeStyleElement: true
        },
        {
            sortAttrs: true
        }]
    },
    svg: {
        files: [{
            expand: true,
            cwd: '<%= pluginInfo.assets_path_dev %>/<%= pluginInfo.img_dir %>',
            src: ['**/*.svg'],
            dest: '<%= pluginInfo.assets_path_prod %>/<%= pluginInfo.img_dir %>'
        }]
    }
};
