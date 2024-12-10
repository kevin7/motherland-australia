import gulp from 'gulp';
import gutil from 'gulp-util';
import sass from 'gulp-sass';
import sassGlob from 'gulp-sass-glob';
import autoprefixer from 'gulp-autoprefixer';
import sourcemaps from 'gulp-sourcemaps';
import webpack from 'webpack';
import browserSync from 'browser-sync';
import path from 'path';
import clean from 'gulp-clean';
import imagemin from 'gulp-imagemin';
import runSequence from 'run-sequence';
import dotenv from 'dotenv';
import fontello from 'gulp-fontello';
import filter from 'gulp-filter';
import rename from 'gulp-rename';
import concat from 'gulp-concat';

// --------------------------------------------------
// Setup
// --------------------------------------------------

dotenv.config();

const dirs = {
    src: 'src',
    dest: '../dist'
};

// --------------------------------------------------
// Styles
// --------------------------------------------------

gulp.task('styles:dev', function () {
    gulp.src([dirs.src + '/scss/main.scss', dirs.src + '/scss/login.scss', dirs.src + '/scss/editor.scss'])
    .pipe(sourcemaps.init())
    .pipe(sassGlob())
    .pipe(
        sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError)
    )
    .pipe(autoprefixer({ browsers: ['last 4 versions'] }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(dirs.dest + '/css/'));
 });

 gulp.task('styles:build', function () {
    gulp.src([dirs.src + '/scss/main.scss', dirs.src + '/scss/login.scss', dirs.src + '/scss/editor.scss'])
    .pipe(sassGlob())
    .pipe(
        sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError)
    )
    .pipe(autoprefixer({ browsers: ['last 4 versions'] }))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(dirs.dest + '/css/'));
 });

// --------------------------------------------------
// Images
// --------------------------------------------------

gulp.task('images', () => {
    return gulp
        .src(dirs.src + '/images/**/*')
        .pipe(imagemin())
        .pipe(gulp.dest(dirs.dest + '/images'));
});

// --------------------------------------------------
// Fonts
// --------------------------------------------------

gulp.task('fonts', () => {
    return gulp.src(dirs.src + '/fonts/**/*').pipe(gulp.dest(dirs.dest + '/fonts'));
});

gulp.task('fontello', function() {
    const fontelloFilter = filter(['**/*.{woff,woff2}', '**/fontello.css']);

    let options = {
        host: 'https://fontello.com',
        font: 'fonts',
        css: 'css',
        assetsOnly: true
    };

    return gulp
        .src('fontello-config.json')
        .pipe(fontello(options))
        .pipe(fontelloFilter)
        .pipe(gulp.dest(dirs.dest));
});

// --------------------------------------------------
// Concat
// --------------------------------------------------

gulp.task('concat', () => {
    gulp.src([dirs.dest + '/css/main.css', dirs.dest + '/css/fontello.css'])
        .pipe(concat('main.css'))
        .pipe(gulp.dest(dirs.dest + '/css'));

    gulp.src([dirs.dest + '/css/editor.css', dirs.dest + '/css/fontello.css'])
        .pipe(concat('editor.css'))
        .pipe(gulp.dest(dirs.dest + '/css'));        
});

// --------------------------------------------------
// Scripts
// --------------------------------------------------

function runWebpack(env, callback) {
    const plugins = [];

    webpack(
        {
            mode: env === 'dev' ? 'development' : 'production',
            optimization: {
                minimize: env == 'dev' ? false : true
            },
            devtool: env === 'dev' ? 'inline-source-map' : false,
            entry: {
                'main': './' + dirs.src + '/js/index.js',
                'editor': './' + dirs.src + '/js/editor.js'
            },
            output: {
                filename: '[name].js',
                path: path.resolve(__dirname, dirs.dest + '/js')
            },
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        exclude: /(node_modules|bower_components)/,
                        loader: 'babel-loader'
                    }
                ]
            },
            plugins: plugins,
            externals: {
                jquery: 'jQuery',
                $: 'jQuery'
            }
        },
        (err, stats) => {
            if (err) throw new gutil.PluginError('webpack', err);
            if (env === 'dev') browserSync.reload();
            gutil.log('[webpack]', stats.toString());
            callback();
        }
    );
}

gulp.task('scripts:dev', callback => {
    return runWebpack('dev', callback);
});
gulp.task('scripts:build', callback => {
    return runWebpack('prod', callback);
});

// --------------------------------------------------
// Watch & BrowserSync
// --------------------------------------------------

gulp.task('browser-sync', () => {

    browserSync.init({
        proxy: process.env.PROXY || 'localhost/DEV',
        open: 'local',
        notify: true,
        ghostMode: false,
        files: [
            dirs.dest + '/css/*',
            dirs.dest + '/js/main.js',
            dirs.dest + '/images/**/*',
            '**/*.php'
        ],
        reloadDebounce: 300,
        reloadDelay: 300
    });

    gulp.watch(dirs.src + '/scss/**/*.scss', ['styles:dev']);
    gulp.watch(dirs.src + '/fonts/**/*', ['fonts', 'fontello']);
    gulp.watch(dirs.src + '/images/**/*', ['images']);
    gulp.watch(dirs.src + '/js/**/*', ['scripts:dev']);
    gulp.watch(dirs.dest + '/css/main.css', ['concat']);
});

gulp.task('watch', callback => {
    runSequence(
        ['clean:css', 'clean:js', 'clean:fonts'],
        ['styles:dev', 'scripts:dev', 'fonts', 'fontello'],
        'images',
        'concat',
        'browser-sync',
        callback
    );
});

// --------------------------------------------------
// Clean
// --------------------------------------------------

gulp.task('clean:css', () => {
    return gulp.src(dirs.dest + 'css').pipe(clean({force: true}));
});

gulp.task('clean:js', () => {
    return gulp.src(dirs.dest + 'js').pipe(clean({force: true}));
});

gulp.task('clean:fonts', () => {
    return gulp.src(dirs.dest + 'fonts').pipe(clean({force: true}));
});

gulp.task('clean:images', () => {
    return gulp.src(dirs.dest + 'images').pipe(clean({force: true}));
});


// --------------------------------------------------
// Build
// --------------------------------------------------

function build(callback) {
    return runSequence(
        ['clean:css', 'clean:js', 'clean:fonts'],
        ['styles:build', 'scripts:build', 'fonts', 'fontello', 'images'],
        'concat',
        callback
    );
}

gulp.task('build', build);

// --------------------------------------------------
// Default
// --------------------------------------------------

gulp.task('default', ['watch']);