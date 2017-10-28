let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//自定义配置
mix.webpackConfig({
	resolve: {
		extensions: ['.js', '.vue', '.json'],
		alias: {
		  	'@': path.resolve(__dirname, "resources/assets/js"),
		}
	},
	module: {
		rules: [
		  {
		    test: /\.less$/,
		    use: [{
		        loader: "style-loader" // creates style nodes from JS strings 
		    }, {
		        loader: "css-loader" // translates CSS into CommonJS 
		    }, {
		        loader: "less-loader" // compiles Less to CSS 
		    }]
		  }
		]
	}	
});

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/index.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .browserSync('isconteadmin.local');
