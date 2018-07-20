const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');

/* -------------------- */
// Browser
/* -------------------- */
// browser sync init
gulp.task('browser-sync', function() {
  browserSync.init({
    server: {
      baseDir: './',
      index: 'index.html'
    }
  });
});

// browser reload
gulp.task('bs-reload', function () {
  browserSync.reload();
});

/* -------------------- */
// Sass
/* -------------------- */
gulp.task('sass', function() {
  gulp.src('./assets/sass/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./assets/css'))
});

/* -------------------- */
// JS
/* -------------------- */
gulp.task('js-min', function() {
  gulp.src('./assets/js/script.js')
    .pipe(uglify())
    .pipe(concat('script.min.js'))
    .pipe(gulp.dest('./assets/js'))
});

/* -------------------- */
// watch | $ gulp
/* -------------------- */
gulp.task('default', ['browser-sync'], function () {
  gulp.watch('./*.html', ['bs-reload']);
  gulp.watch('./assets/css/*.css', ['bs-reload']);
  gulp.watch('./assets/js/*.js', ['bs-reload']);
  gulp.watch('./assets/sass/*.scss',['sass']);
  gulp.watch(['./assets/js/script.js','./assets/js/script.min.js'],['js-min']);
});
