// Include gulp & plugins
var gulp = require("gulp"),
  sass = require("gulp-sass"),
  clean = require("gulp-clean-css"),
  autoprefix = require("gulp-autoprefixer");
(concat = require("gulp-concat")),
  (uglify = require("gulp-uglify")),
  (rename = require("gulp-rename")),
  (imgmin = require("gulp-imagemin")),
  (cache = require("gulp-cache")),
  (modernizr = require("gulp-modernizr"));

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
      "node_modules/owl.carousel/dist/owl.carousel.js",
      "node_modules/wowjs/dist/wow.js",
      "node_modules/magnific-popup/dist/jquery.magnific-popup.js",
      "node_modules/bootstrap/dist/js/bootstrap.js",
      "node_modules/twitter-fetcher/js/twitterFetcher.js",
      "node_modules/simpleweather/jquery.simpleWeather.js",
      "node_modules/animsition/dist/js/animsition.js",
      "js/lib/modernizr.js",
      "js/javascript.js"
    ])
    .pipe(concat("main.js"))
    .pipe(rename({ suffix: ".min" }))
    .pipe(uglify())
    .pipe(gulp.dest("build/js"));
});

// Preprocess sass file + minify
gulp.task("minify-sass", function() {
  return gulp
    .src("scss/style.scss")
    .pipe(sass({ sourcemaps: true }))
    .pipe(autoprefix())
    .pipe(rename({ basename: "style", suffix: ".min" }))
    .pipe(clean())
    .pipe(gulp.dest("build/css"));
});

// Compress images
gulp.task("images", function() {
  return gulp
    .src("img/**/*")
    .pipe(
      cache(
        imgmin({
          optimizationLevel: 5,
          progressive: true,
          interlaced: true
        })
      )
    )
    .pipe(gulp.dest("build/img"));
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

// Concat vendor js files together
gulp.task("js", ["concat-scripts"]);

// Convert sass to css and then minimize it
gulp.task("sass", ["minify-sass"]);
gulp.task("fonts", ["icons"]);

// Compress images
gulp.task("img", ["images"]);

// Look for changes
gulp.task("watch", ["concat-scripts", "minify-sass", "look"]);
