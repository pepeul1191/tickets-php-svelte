const { src, dest, series } = require('gulp');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const concat = require('gulp-concat');
const cssMinify = require('gulp-css-minify');

function defaultTask(cb) {
  // place code for your default task here
  console.log(process.env.ENV)
  cb();
}

function javascript() {
  if(process.env.ENV == 'dev'){
    return src([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/owl.carousel2/dist/owl.carousel.min.js',
        'node_modules/wowjs/dist/wow.min.js',
        'node_modules/jquery.easing/jquery.easing.min.js',
        'node_modules/waypoints/lib/noframework.waypoints.min.js',
      ])
      .pipe(concat('vendor.js'))
      .pipe(uglify())
      .pipe(rename({ extname: '.js' }))
      .pipe(dest('public/build/'));
  }else{
    return src([
      'public/build/bundle.app.min.js',
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/owl.carousel2/dist/owl.carousel.min.js',
      'node_modules/wowjs/dist/wow.min.js',
      'node_modules/jquery.easing/jquery.easing.min.js',
      'node_modules/waypoints/lib/noframework.waypoints.min.js',
      'public/assets/js/site.js',
    ])
    .pipe(concat('site.js'))
    .pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('public/build/'));
  }
}

function css() {
  if(process.env.ENV == 'dev'){
    return src([
        'node_modules/animate.css/animate.css',
        'node_modules/owl.carousel2/dist/assets/owl.carousel.css',
      ])
      .pipe(concat('vendor.css'))
      .pipe(rename({ extname: '.css' }))
      .pipe(dest('public/build/'));
  }else{
    return src([
      'public/build/bundle.app.css',
      'node_modules/animate.css/animate.css',
      'node_modules/owl.carousel2/dist/assets/owl.carousel.css',
      'public/assets/css/styles.css'
    ])
    .pipe(concat('site.css'))
    .pipe(cssMinify())
    .pipe(rename({ extname: '.min.css' }))
    .pipe(dest('public/build/'));
  }
}

exports.build = series(javascript, css);
exports.default = defaultTask