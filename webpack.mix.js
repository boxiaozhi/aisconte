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
		alias: {
		  	'@': path.resolve(__dirname, "resources/assets/js"),
		}
	},
	module: {
		rules: [
		  {
		  	test: /\.json$/,
		  	use: [{
		  		loader: "json-loader"
		  	}]
		  }
		]
	}
});

mix.js('resources/assets/js/index.js', 'public/js')
   .browserSync('isconteadmin.local');
