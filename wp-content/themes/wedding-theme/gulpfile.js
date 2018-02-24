// Include gulp & plugins
var gulp        = require("gulp"),
    sass        = require("gulp-sass"),
    clean       = require("gulp-clean-css"),
    autoprefix  = require("gulp-autoprefixer"),
    concat      = require("gulp-concat"),
    uglify      = require("gulp-uglify"),
    rename      = require("gulp-rename"),
    imgmin      = require("gulp-imagemin"),
    cache       = require("gulp-cache"),
    modernizr   = require("gulp-modernizr");

gulp.task("modernizr", function() {
  var settings = {
    options: [
      "setClasses",
      "addTest",
      "html5printshiv",
      "testProp",
      "fnBind",
      "mq"
    ],
    tests: ["objectfit"]
  };
  return gulp
    .src("./js/*.js")
    .pipe(modernizr("modernizr.js", settings))
    .pipe(gulp.dest("js/lib"));
});

// Concatenate JS Files
gulp.task("concat-scripts", function() {
  return gulp
    .src([
      "node_modules/jquery/dist/jquery.js",
      "node_modules/jquery-migrate/dist/jquery-migrate.js",
      "node_modules/wowjs/dist/wow.js",
      "node_modules/bootstrap/dist/js/bootstrap.js",
      "node_modules/animsition/dist/js/animsition.js",
      "js/lib/modernizr.js",
      "js/javascript.js"
    ])
    .pipe(concat("main.js"))
    .pipe(rename({ suffix: ".min" }))
    .pipe(uglify())
    .pipe(gulp.dest("dist/js"));
});

// Preprocess sass file + minify
gulp.task("minify-sass", function() {
  return gulp
    .src("scss/style.scss")
    .pipe(sass({ sourcemaps: true }))
    .pipe(autoprefix())
    .pipe(rename({ basename: "style", suffix: ".min" }))
    .pipe(clean())
    .pipe(gulp.dest("dist/css"));
});

// Compress images
gulp.task("images", function() {
  return gulp
    .src("img/**/*")
    .pipe(
      cache(
        imgmin({
          optimizationLevel: 8,
          progressive: true,
          interlaced: true
        })
      )
    )
    .pipe(gulp.dest("dist/img"));
});

// Move font-awesome fonts folder to css compiled folder
gulp.task("icons", function() {
  return gulp
    .src(["node_modules/font-awesome/fonts/*"])
    .pipe(gulp.dest("build/fonts/"));
});

gulp.task("look", function() {
  // Watch .js files
  gulp.watch("js/javascript.js", ["concat-scripts"]);
  // Watch .scss files
  gulp.watch(
    [
      "scss/style.scss",
      // This will look through ALL folders and subfolders
      "scss/**/*.scss"
    ],
    ["minify-sass"]
  );
});

// Gulp task runners
gulp.task("js", ["concat-scripts"]);
gulp.task("sass", ["minify-sass"]);
gulp.task("fonts", ["icons"]);
gulp.task("img", ["images"]);
gulp.task("watch", ["concat-scripts", "minify-sass", "look"]);