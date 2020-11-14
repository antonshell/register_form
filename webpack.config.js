var path = require('path');
var webpack = require('webpack');

module.exports = {
    mode: 'development',
    entry: './vue_app/main.js',
    output: {
        path: path.resolve(__dirname, './public/vue_build/'),
        publicPath: '/vue_build/',
        filename: 'bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            }
        ],
    },
    plugins: [
        new webpack.SourceMapDevToolPlugin({})
    ]
};