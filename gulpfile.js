var gulp = require("gulp"),
    //sass = require("gulp-sass"),
    autoprefixer = require("gulp-autoprefixer"),
    // hash = require("gulp-hash"),
    // concat = require('gulp-concat'),
    // plumber = require('gulp-plumber'),
    // notify = require('gulp-notify'),
    del = require("del"),
    //sourcemaps = require('gulp-sourcemaps'),
    less = require('gulp-less'),
    path = require('path'),
    cssmin = require('gulp-cssmin'),
    rename = require('gulp-rename');



gulp.task('less', function () {
    del(["./assets/css/*"])
    return gulp.src('./assets/less/*.less')
        .pipe(less({
            paths: [path.join(__dirname, 'less', 'includes')]
        }))
        .pipe(cssmin())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest('./assets/css'));
});


// Hash images
// gulp.task("images", function () {
//    del(["static/images/**/*"])
//    gulp.src("src/images/**/*")
//        .pipe(hash())
//        .pipe(gulp.dest("static/images"))
//        .pipe(hash.manifest("hash.json"))
//        .pipe(gulp.dest("data/images"))
//});

// Hash javascript
//gulp.task("js", function () {
//    del(["static/js/**/*"])
//    gulp.src(["src/js/**/*.js", "themes/mi-cologne-styleguide/layouts/partials/atoms/**/*.js"])
//        .pipe(concat('main.js'))
//        .pipe(hash())
//        .pipe(gulp.dest("static/js"))
//        .pipe(hash.manifest("hash.json"))
//        .pipe(gulp.dest("data/js"))
//})

// Watch asset folder for changes
// gulp.task("watch", ["scss", "images", "js"], function() {
//     gulp.watch(["src/scss/**/*", "themes/mi-cologne-styleguide/layouts/partials/atoms/**/*", "themes/mi-cologne-styleguide/layouts/partials/molecules/**/*", "themes/mi-cologne-styleguide/layouts/partials/organisms/**/*"], ["scss"])
//     gulp.watch("src/images/**/*", ["images"])
//    gulp.watch(["src/js/**/*", "themes/mi-cologne-styleguide/layouts/partials/atoms/**/*", "themes/mi-cologne-styleguide/layouts/partials/molecules/**/*", "themes/mi-cologne-styleguide/layouts/partials/organisms/**/*"], ["js"])
// });*/

var connect = require('gulp-connect-php'),
    browserSync = require('browser-sync');

gulp.task('serve', function () {
    connect.server({}, function () {
        browserSync({
            proxy: '127.0.0.1:8000'
        });
    });

    gulp.start("less");
    gulp.watch('./assets/less/*.less', ['less']).on('change', function () {
        browserSync.reload();
    });
    gulp.watch('**/*.php').on('change', function () {
        browserSync.reload();
    });
});

// Set watch as default task
gulp.task("default", ["serve"])