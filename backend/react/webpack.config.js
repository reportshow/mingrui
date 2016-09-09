module.exports = {
    entry: './src/app.js',
    output: {
	path: './bin',
	filename: 'app.js',
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

