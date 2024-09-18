const path = require('path');

module.exports = {
    entry: './src/js/script.js',
    output: {
        filename: 'script.js',
        path: path.resolve(__dirname, '../public/assets/js'),
    },
    mode: 'production',
};