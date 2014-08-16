var gulp = require('gulp');
var imagemin = require('gulp-imagemin');
var pngcrush = require('imagemin-pngcrush');
var minifycss = require('gulp-minify-css');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');



gulp.task('sass', function(){
    return gulp.src('app/sass/*.scss')
        .pipe(sass({
            style: 'compressed',
            sourceComments: 'map',
            errLogToConsole: false,
            onError: function(err) {
                return notify().write(err);
            }
        }))
     //   .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(gulp.dest('public/assets/css'))
        .pipe(notify({ message: 'Styles task complete' }));
});

//gulp.task('image_min', function(){
//    gulp.src('public/assets/images/listings/*')
//        .pipe(imagemin({
//            progressive: true,
//            svgoPlugins: [{removeViewBox: false}],
//            use: [pngcrush()]
//        }))
//        .pipe(gulp.dest('public/dist/img'));
//});

gulp.task('default', function () {
    gulp.run('sass');
    gulp.watch('app/sass/**/*.scss', function(){
        gulp.run('sass');
    });
});