module.exports = {
    entry: './src/app_external.js',
    output: {
	path: './bin',
	filename: 'app_external.js',
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

