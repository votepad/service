/**
 * Webpack configuration
 *
 * @author Khaydarov Murod <murod.haydarov@gmail.com>
 * @copyright Votepad Team 2017
 */
'use strict';

/**
 * Plugins for bundle
 * @type {webpack}
 */
var webpack                     = require('webpack');

/** Environment requirements */
const NODE_ENV = process.env.NODE_ENV || 'development';

var path = require('path');

var modulePath = path.resolve(__dirname, "../modules/");
var bundlePath = path.resolve(__dirname, "../bundles/");
var entryFile  = path.resolve(__dirname, "../votepad.js");
var nodeModules = path.resolve("/var/www/votepad.local/node_modules");

var config = {

    entry: {
        "votepad" : entryFile
    },

    output: {

        /** Public output path */
        path : bundlePath,

        /** bundle name */
        filename: "[name].bundle.js",

        /** Lib name */
        library: "vp"
    },

    watch: true,

    watchOptions: {
        aggregateTimeOut: 50
    },

    devtool: NODE_ENV == 'development' ? "source-map" : null,

    module : {

        // rules for modules
        rules : [

            {
                test : /\.js$/,
                include: [
                    modulePath
                ],
                loader: "babel",
                options: {
                    presets: ['node_modules', __dirname + 'node_modules/babel-preset-es2015', nodeModules + "/babel-preset-es2015", 'babili']
                }

            }
        ]

    },

    resolve : {

        modules : [nodeModules, "node_modules", "*-loader", "*"],
        extensions : [".js"]

    },

    resolveLoader : {

        modules: [nodeModules, "web_loaders", "web_modules", "node_loaders", "node_modules"],
        moduleExtensions: ['*-loader']

    },

    plugins : [
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false,
                drop_console: false
            }
        })
    ]

};

module.exports = config;
