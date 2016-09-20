var gulp = require('gulp'),
concat = require('gulp-concat'),
less = require('gulp-less'),
minifyCSS = require('gulp-minify-css'),
babel = require('gulp-babel'),
uglify = require('gulp-uglify');


gulp.task('css.front', () => {
  gulp.src([
    './public/src/less/styles.less',
  ])
  .pipe(concat('styles.min.css'))
  .pipe(less())
  .pipe(minifyCSS())
  .pipe(gulp.dest('./public/assets/css'));
});

gulp.task('css.admin', () => {
  gulp.src([
    './public/src/less/admin/styles.less',
  ])
  .pipe(concat('styles.min.css'))
  .pipe(less())
  .pipe(minifyCSS())
  .pipe(gulp.dest('./public/assets/css/admin'));
});

gulp.task('js.front', () => {
  gulp.src([
    // lib

    // app
    './public/src/js/modal.js',
    './public/src/js/app.js',
  ])
  .pipe(babel())
  .pipe(concat('app.min.js'))
  //.pipe(uglify())
  .pipe(gulp.dest('./public/assets/js'));
});
gulp.task('js.admin', () => {
  gulp.src([
    // lib
    './public/src/js/lib/tinymce/lang/*',
    // app
    './public/src/js/admin/app.js',
    './public/src/js/admin/validPopin.js'
  ])
  .pipe(concat('app.min.js'))
  .pipe(babel())
  //.pipe(uglify())
  .pipe(gulp.dest('./public/assets/js/admin'));
});

gulp.task('watch', () => {
  gulp.watch([
    './public/src/less/**/*.less',
  ], ['css']);
  gulp.watch([
    './public/src/js/**/*.js'
  ], ['js']);
});

gulp.task('css', [
  'css.front',
  'css.admin'
]);

gulp.task('js', [
  'js.front',
  'js.admin'  
]);

gulp.task('prod', [
  'js',
  'css'
]);

gulp.task('default', [
  'prod',
  'watch'
]);