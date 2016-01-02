/**
 * Created by Luke.Lazurite on 12/31/2015.
 */


var gulp = require('gulp');
var header = require('gulp-header');
var footer = require('gulp-footer');
var concat = require('gulp-concat');
var jshint = require('gulp-jshint');
var cached = require('gulp-cached');
var remember = require('gulp-remember');

var scripts = [
    "bower_components/qrcode-js/qrcode.js",
    "src/script/**/*.js"
];

gulp.task("scripts", function() {
    return gulp.src(scripts)
        .pipe(cached('scripts'))
        .pipe(jshint())
        .pipe(remember("scripts"))
        .pipe(concat('main.js'))
        .pipe(gulp.dest('static/script/'));
});

gulp.task("watch", function() {
    var watcher = gulp.watch(scripts, ["scripts"]);
    watcher.on("change", function(event) {
        if (event.type === "deleted") {
            delete cached.caches["scripts"][event.path];
            remember.forget("scripts", event.path);
        }
    });
});