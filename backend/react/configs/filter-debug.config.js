module.exports = {
    entry: './src/filter/filter_div.js',
    output: {
	path: './bin',
	filename: 'filter.js',
    },
    module: {
	loaders: [{
	    test: /\.js$/,
	    exclude: /node_modules/,
	    loader: 'babel-loader',
	    presets: ['es2015', 'react']
	}]
    }
}

