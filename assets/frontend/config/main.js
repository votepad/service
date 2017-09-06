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
const webpack             = require('webpack');
const ExtractTextPlugin   = require("extract-text-webpack-plugin");
const OptimizeCssPlugin   = require('optimize-css-assets-webpack-plugin');

/** Environment requirements */
const NODE_ENV = process.env.NODE_ENV || 'development';

const path   = require('path');
const libJS  = "[name].min.js";
const libCSS = "[name].min.css";


const modulePath = path.resolve(__dirname, "../modules/");
const bundlePath = path.resolve(__dirname, "../bundles/");

module.exports = {

    entry: {
        "vp" : path.resolve(__dirname, "../votepad.js")
    },

    output: {

        path : bundlePath,
        filename: libJS,
        library: "[name]"
    },

    watch: true,

    watchOptions: {
        aggregateTimeOut: 50
    },

    devtool: NODE_ENV === 'development' ? "source-map" : null,

    module : {

        // rules for modules
        rules : [
            {
                test: /\.js?$/,
                loader: 'eslint-loader',
                include: modulePath,
                exclude: /node_modules/,
                options : {
                    fix: true
                }
            },
            {
                test: /\.css?$/,
                include: modulePath,
                exclude: /node_modules/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [
                        {
                            loader: "css-loader"
                        },
                        {
                            loader: "postcss-loader",
                            options: {
                                plugins: [
                                    require('postcss-smart-import')(),
                                    require('postcss-cssnext')(),
                                    require('postcss-svg')()
                                ]
                            }
                        }
                    ]
                })
            },
        ]

    },

    resolve : {

        modules : ["node_modules", "*-loader", "*"],
        extensions : [".js", ".css"]

    },

    plugins : [

        /** Минифицируем JS */
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false,
                //drop_console: true
            }
        }),

        /** Вырезает CSS из JS сборки в отдельный файл */
        new ExtractTextPlugin(libCSS),

        /** Минифицируем CSS */
        new OptimizeCssPlugin({
            cssProcessorOptions: {
                discardComments: {
                    removeAll: true
                }
            }
        })
    ]

};
