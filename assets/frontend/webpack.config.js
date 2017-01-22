module.exports = {

    entry : ['./index.js'],

    output : {
        path: __dirname + '/production',
        filename: 'nwe.js',
        library : 'nwe'
    },

    watch : true,

    watchOptions : {
        aggregateTimeout : 100
    }
};