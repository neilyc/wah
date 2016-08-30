var gulp = require('gulp'),
concat = require('gulp-concat'),
less = require('gulp-less'),
minifyCSS = require('gulp-minify-css'),
uglify = require('gulp-uglify');


gulp.task('css.front', function() {
  gulp.src([
    './public/src/less/styles.less',
  ])
  .pipe(concat('styles.min.css'))
  .pipe(less())
  .pipe(minifyCSS())
  .pipe(gulp.dest('./public/assets/css'));
});

gulp.task('css.admin', function() {
  gulp.src([
    './public/src/less/admin/styles.less',
  ])
  .pipe(concat('styles.min.css'))
  .pipe(less())
  .pipe(minifyCSS())
  .pipe(gulp.dest('./public/assets/css/admin'));
});

gulp.task('js.front', function() {
  gulp.src([
    // lib

    // app
    './public/src/js/app.js',
  ])
  .pipe(concat('app.min.js'))
  //.pipe(uglify())
  .pipe(gulp.dest('./public/assets/js'));
});
gulp.task('js.admin', function() {
  gulp.src([
    // lib

    // app
    './public/src/js/admin/app.js',
    './public/src/js/admin/validPopin.js'
  ])
  .pipe(concat('app.min.js'))
  //.pipe(uglify())
  .pipe(gulp.dest('./public/assets/js/admin'));
});

gulp.task('watch', function () {
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