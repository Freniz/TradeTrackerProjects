var gulp = require('gulp');
var concat = require('gulp-concat');
var sass = require('gulp-sass');

gulp.task('sass', function(){
   gulp.src(['web/sass/base.sass'])
   .pipe(concat('main.css'))
   .pipe(sass())
   .pipe(gulp.dest('web/css/'));
});

gulp.task('default',['sass'],function(){
});