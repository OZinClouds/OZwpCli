const path = require('path');
const webpack = require('webpack'); //to access built-in plugins
const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin'); //sort of Liveload...
const ExtractTextPlugin = require('extract-text-webpack-plugin');

///declare proxy here
const ProxY="http://localhost/ozwpdev";

module.exports = env => {


return {

	entry: {
		theme: ["./src/theme.js"],
		system: ["./src/system.js"],
		update: ["./src/update.js"],
		newwp:["./src/newwp.js"],
		editwp:["./src/editwp.js"],
		defaults:["./src/defaults.js"],
		tmp:["./src/tmp.js"]
	},

	output: {
		filename: "[name].bundle.js",
		path: path.resolve(__dirname,'dist'),
		publicPath: "./dist/",

		hotUpdateChunkFilename: './tmp/hot-update.js', //keep chunks away for .gitignore
   		hotUpdateMainFilename: './tmp/hot-update.json'
		
	},

	module: {

		rules: [

			{
				test:/\.jsx$/, 
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: 'babel-loader',
					options : {
						presets : ['es2015', 'es2016', 'stage-2']
					}
				}
			},

			{
			            test:/\.(s*)css$/, 
			            use: ExtractTextPlugin.extract({ 
			            		fallback:'style-loader',
			             	use:['css-loader','sass-loader'],
			             	})
		            },



			{
				test: /\.(png|jpg|jpeg|gif|ico|svg)$/,
				use: {
					loader:'file-loader',
					options: {
			                         name: '[name].[ext]',
					outputPath: 'img/',
			                         publicPath: '../dist/img/'
			                  	}

				       }
			},

			{
				test: /\.(woff|woff2|eot|ttf|otf)$/,
				use: {
					loader:'file-loader',
					options: {
			                        name: '[name].[ext]',
			                        outputPath: 'fonts/',
			                        publicPath: '../dist/fonts/'
			                  	}

				       }
			},

			{
				//solves query problems...
				//check with jquery version: $.fn.jquery;
			          test: require.resolve('jquery'),
			          use: [{
			              loader: 'expose-loader',
			              options: '$'
			          }]
			}




		]


    	},

    	devtool: 'source-map',

    	plugins: [ 
    		
		new webpack.ProvidePlugin({
			  $: "jquery",
			  jQuery: 'jquery'			  
		}),

    		new ExtractTextPlugin({filename:'[name].bundle.css'}),

    		 new CleanWebpackPlugin( ['dist/*.*'], {verbose:  true, dry: false}),

    		new webpack.NamedModulesPlugin(),

    		new webpack.HotModuleReplacementPlugin(),

    		new webpack.optimize.CommonsChunkPlugin('vendors'),

    		new BrowserSyncPlugin({
    			host: 'devoz',
    			port: 3000,
    			proxy: ProxY,
    			open: 'local',
    			browser: env.browser,

    			files: [
    				{
    					match: ['**/*.php', '**/*.html', '**/*.json'  ,'./src/**'],
    					fn: function (event, file){
    						if (event==='change'){
    							const bs = require('browser-sync').get('bs-webpack-plugin');
    							bs.reload();
    						}
    					}
    				}
    			]

    		},{reload:false})

    	],

    	watch: false,

    	devServer :{
    		
    		//contentBase: path.resolve(__dirname,''),
    		hot: true,
    		inline: true,
    		progress: true
    	}
}

	 

}