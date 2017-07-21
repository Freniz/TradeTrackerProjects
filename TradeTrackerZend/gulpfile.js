var gulp = require('gulp');
var concat = require('gulp-concat');
var less = require('gulp-less');

gulp.task('less', function(){
   gulp.src(['public/less/base.less','public/less/layout.less'])
   .pipe(concat('main.css'))
   .pipe(less())
   .pipe(gulp.dest('public/css/'));
});

gulp.task('default',['less'],function(){
});