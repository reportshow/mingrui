const webpack = require('webpack');
const path = require('path');
const buildPath = path.resolve(__dirname, 'bin');
const nodeModulesPath = path.resolve(__dirname, 'node_modules');
const TransferWebpackPlugin = require('transfer-webpack-plugin');

const config = {
    entry: './src/analyze/app_external.js',
    // Render source-map file for final build
    devtool: 'source-map',
    // output config
    output: {
	path: './bin',
	filename: 'app_external.js',
    },
    plugins: [
	// Define production build to allow React to strip out unnecessary checks
	new webpack.DefinePlugin({
	    'process.env':{
		'NODE_ENV': JSON.stringify('production')
	    }
	}),
	// Minify the bundle
	new webpack.optimize.UglifyJsPlugin({
	    compress: {
		// suppresses warnings, usually from module minification
		warnings: false,
	    },
	}),
	// Allows error warnings but does not stop compiling.
	new webpack.NoErrorsPlugin(),
	// Transfer Files
	// new TransferWebpackPlugin([
	//   {from: 'www'},
	// ], path.resolve(__dirname, 'src')),
    ],
    module: {
	loaders: [{
	    test: /\.js$/,
	    exclude: /node_modules/,
	    loader: 'babel-loader',
	    presets: ['es2015', 'react']
	}]
    },
};

module.exports = config;
