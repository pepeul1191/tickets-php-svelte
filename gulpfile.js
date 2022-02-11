const { src, dest, series } = require('gulp');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const concat = require('gulp-concat');

function defaultTask(cb) {
  // place code for your default task here
  console.log(process.env)
  cb();
}

function javascript() {
  return src([
      'node_modules/jquery/dist/jquery.min.js',
      'node_modules/owl.carousel2/dist/owl.carousel.min.js',
    ])
    .pipe(concat('vendor.js'))
    .pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('public/build/'));
}

function css() {
  return src([
      'node_modules/animate.css/animate.css',
      'node_modules/owl.carousel2/dist/assets/owl.carousel.css',
    ])
    .pipe(concat('vendor.css'))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(dest('public/build/'));
}

exports.build = series(javascript, css);
exports.default = defaultTask