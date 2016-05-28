var gulp = require('gulp'),
sass = require('gulp-ruby-sass'),
autoprefixer = require('gulp-autoprefixer'),
clean = require('gulp-clean-css'),
rename = require('gulp-rename'),
concat = require('gulp-concat'),
uglify = require('gulp-uglify'),
watch = require ('gulp-watch'),
sourcemaps = require('gulp-sourcemaps'),
webserver = require ('gulp-webserver');


gulp.task ('process-sass', function() {
  return sass('sass/style.scss', {
    sourcemap: true,
    style: 'compact'
    })
  .pipe(autoprefixer({ browsers: ['last 2 versions', 'ie 8', 'ie 9'] }))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./'))
  .pipe(clean())
  .on('error', sass.logError)
  .pipe(rename({suffix: '.min'}))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./'));
  });

gulp.task ('process-scripts', function() {
  return gulp.src('js/process/**/*.js')
  .pipe(concat('main.js'))
  .pipe(gulp.dest('js'))
  .pipe(uglify())
  .pipe(rename({suffix: '.min'}))
  .pipe(gulp.dest('js'))
  });

gulp.task('webserver', function() {
  gulp.src('./')
  .pipe(webserver({
    livereload: true,
    open: 'http://localhost/test_site_2016-05-14/',
    path: 'http://localhost/test_site_2016-05-14/'
    }));
  });

gulp.task('watch', function() {
  gulp.watch( 'js/**/*.js', ['process-scripts']);
  gulp.watch( 'sass/**/*.scss', ['process-sass']);
  });

gulp.task('default', ['process-sass', 'watch', 'webserver']);

