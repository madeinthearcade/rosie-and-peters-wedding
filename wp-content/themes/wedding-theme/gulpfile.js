// Include gulp
var gulp    = require('gulp'),
    bourbon = require('bourbon').includePaths,
    neat    = require('bourbon-neat').includePaths,
    sass    = require('gulp-sass'),
    clean   = require('gulp-clean-css');

// Include plugins
var concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

// Concatenate JS Files
gulp.task('concat-scripts', function () {
    return gulp.src([
        'bower_components/jquery/dist/jquery.js',
        'bower_components/jquery-migrate/jquery-migrate.js',
        'bower_components/owl.carousel/dist/owl.carousel.js',
        'bower_components/wow/dist/wow.js',
        'bower_components/magnific-popup/dist/jquery.magnific-popup.js',
        'bower_components/bootstrap/dist/js/bootstrap.js',
        'bower_components/twitter-fetcher/js/twitterFetcher.js',
        'js/javascript.js'
    ])
    .pipe(concat('main.js'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('build/js'));
});

// Preprocess sass file + minify
gulp.task('minify-sass', function () {
    return gulp.src('scss/style.scss')
    .pipe(sass({
        sourcemaps: true,
        includePaths: [bourbon, neat]
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(clean())
    .pipe(gulp.dest('build/css'))
});

// Move font-awesome fonts folder to css compiled folder
gulp.task('icons', function () {
    return gulp.src('bower_components/font-awesome/fonts/**.*')
        .pipe(gulp.dest('build/fonts/'));
});

gulp.task('watch', function () {
    // Watch .js files
    gulp.watch('js/javascript.js', ['concat-scripts']);
    // Watch .scss files
    gulp.watch('scss/partials/**/*.scss', ['minify-sass']);
});

// Concat vendor js files together
gulp.task('concat', ['concat-scripts']);

// Convert sass to css and then minimize it
gulp.task('sass', ['minify-sass']);
gulp.task('fonts', ['icons']);
gulp.task('look', ['watch']);