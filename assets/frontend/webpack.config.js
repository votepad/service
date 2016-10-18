module.exports = {

    entry : ['./index.js'],

    output : {
        path: __dirname + '/production',
        filename: 'main.js',
        library : '[name]'
    },

    watch : true,

    watchOptions : {
        aggregateTimeout : 100
    }
};