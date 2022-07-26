import svelte from 'rollup-plugin-svelte';
import commonjs from '@rollup/plugin-commonjs';
import resolve from '@rollup/plugin-node-resolve';
import { terser } from 'rollup-plugin-terser';
import copy from 'rollup-plugin-copy';
import json from '@rollup/plugin-json';
import css from 'rollup-plugin-css-only';

const production = !process.env.ROLLUP_WATCH;

function serve() {
	let server;

	function toExit() {
		if (server) server.kill(0);
	}

	return {
		writeBundle() {
			if (server) return;
			server = require('child_process').spawn('npm', ['run', 'start', '--', '--dev'], {
				stdio: ['ignore', 'inherit', 'inherit'],
				shell: true
			});

			process.on('SIGTERM', toExit);
			process.on('exit', toExit);
		}
	};
}

export default [
	{
		input: 'src/entries/app.js',
		output: {
			sourcemap: false,
			format: 'iife',
			name: 'app',
			file: production ? 'public/build/bundle.app.min.js' : 'public/build/bundle.app.js', 
			strict: false,
			globals: {
				jquery: '$'
			},
		},
		external: [
			/*
			'jquery/dist/jquery.min.js',
			'owl.carousel2/dist/owl.carousel.min.js',
			'bootstrap/dist/js/bootstrap.min.js',
			'wowjs/dist/wow.min.js',
			'jquery.easing/jquery.easing.min.js',
			'waypoints/lib/noframework.waypoints.min.js',
			*/
		],
		plugins: [
			svelte({
				compilerOptions: {
					// enable run-time checks when not in production
					dev: !production
				}
			}),
			copy({
				targets: [
					{ 
						src: 'node_modules/font-awesome/fonts/*', 
						dest: 'public/fonts'
					},
					{ 
						src: 'node_modules/bootstrap-icons/font/fonts/*', 
						dest: 'public/build/fonts'
					}
				]
			}),
			// we'll extract any component CSS out into
			// a separate file - better for performance
			css({ output: 'bundle.app.css' }),
			// json for axios
			json(),
			// If you have external dependencies installed from
			// npm, you'll most likely need these plugins. In
			// some cases you'll need additional configuration -
			// consult the documentation for details:
			// https://github.com/rollup/plugins/tree/master/packages/commonjs
			resolve({
				browser: true,
				dedupe: ['svelte']
			}),
			commonjs(),

			// In dev mode, call `npm run start` once
			// the bundle has been generated
			!production && serve(),

			// Watch the `public` directory and refresh the
			// browser on changes when not in production
			//!production && livereload('public'),

			// If we're building for production (npm run build
			// instead of npm run dev), minify
			production && terser()
		],
		watch: {
			clearScreen: true
		}
	},
	{
		input: 'src/entries/login.js',
		output: {
			sourcemap: true,
			format: 'iife',
			name: 'app',
			file:production ? 'public/build/bundle.login.min.js' : 'public/build/bundle.login.js', 
		},
		plugins: [
			svelte({
				compilerOptions: {
					// enable run-time checks when not in production
					dev: !production
				}
			}),
			// we'll extract any component CSS out into
			// a separate file - better for performance
			css({ output: 'bundle.login.css' }),

			// If you have external dependencies installed from
			// npm, you'll most likely need these plugins. In
			// some cases you'll need additional configuration -
			// consult the documentation for details:
			// https://github.com/rollup/plugins/tree/master/packages/commonjs
			resolve({
				browser: true,
				dedupe: ['svelte']
			}),
			commonjs(),

			// In dev mode, call `npm run start` once
			// the bundle has been generated
			!production && serve(),

			// Watch the `public` directory and refresh the
			// browser on changes when not in production
			//!production && livereload('public'),

			// If we're building for production (npm run build
			// instead of npm run dev), minify
			production && terser()
		],
		watch: {
			clearScreen: true
		}
	},
	{
		input: 'src/entries/error.js',
		output: {
			sourcemap: true,
			format: 'iife',
			name: 'error',
			file:production ? 'public/build/bundle.error.min.js' : 'public/build/bundle.error.js', 
		},
		plugins: [
			svelte({
				compilerOptions: {
					// enable run-time checks when not in production
					dev: !production
				}
			}),
			// we'll extract any component CSS out into
			// a separate file - better for performance
			css({ output: 'bundle.error.css' }),

			// If you have external dependencies installed from
			// npm, you'll most likely need these plugins. In
			// some cases you'll need additional configuration -
			// consult the documentation for details:
			// https://github.com/rollup/plugins/tree/master/packages/commonjs
			resolve({
				browser: true,
				dedupe: ['svelte']
			}),
			commonjs(),

			// In dev mode, call `npm run start` once
			// the bundle has been generated
			!production && serve(),

			// Watch the `public` directory and refresh the
			// browser on changes when not in production
			//!production && livereload('public'),

			// If we're building for production (npm run build
			// instead of npm run dev), minify
			production && terser()
		],
		watch: {
			clearScreen: true
		}
	},
	{
		input: 'src/entries/admin.js',
		output: {
			sourcemap: false,
			format: 'iife',
			name: 'admin',
			file: production ? 'public/build/bundle.admin.min.js' : 'public/build/bundle.admin.js', 
			strict: false,
			globals: {
				jquery: '$'
			},
		},
		external: [
			'bootstrap/dist/js/bootstrap.min.js',
		],
		plugins: [
			svelte({
				compilerOptions: {
					// enable run-time checks when not in production
					dev: !production
				}
			}),
			copy({
				targets: [
					{
						src: [
							"node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
							"node_modules/@popperjs/core/dist/cjs/popper.js",
						],
						dest: "public/vendor/bootstrap",
					},
				]
			}),
			// we'll extract any component CSS out into
			// a separate file - better for performance
			css({ output: 'bundle.admin.css' }),
			// json for axios
			json(),
			// If you have external dependencies installed from
			// npm, you'll most likely need these plugins. In
			// some cases you'll need additional configuration -
			// consult the documentation for details:
			// https://github.com/rollup/plugins/tree/master/packages/commonjs
			resolve({
				browser: true,
				dedupe: ['svelte']
			}),
			commonjs(),

			// In dev mode, call `npm run start` once
			// the bundle has been generated
			!production && serve(),

			// Watch the `public` directory and refresh the
			// browser on changes when not in production
			//!production && livereload('public'),

			// If we're building for production (npm run build
			// instead of npm run dev), minify
			production && terser()
		],
		watch: {
			clearScreen: true
		}
	},
];
