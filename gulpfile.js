const { src, dest } = require('gulp');
const package = require('./package.json');
const { pipeline } = require('stream/promises');

const zip = async () => {
    const gulpZip = (await import('gulp-zip')).default;
    
    await pipeline(
        src([
            '**/*',
            
            // Ignored folders & files
            '!**/.*/**',
            '!**/__*/**',
            '!.yarn/**',
            '!**/node_modules/**',
            '!src/**',
            '!webpack/**',
            '!test-config/**',
            '!storybook-assets/**',
            '!dist/**',
            '!**/*.zip',
            '!**/*.map',
            '!.gitignore',
            '!.yarnrc.yml',
            '!gulpfile.js',
            '!package.json',
            '!package-lock.json',
            '!tsconfig.json',
            '!webpack.config.js',
            '!yarn.lock',
            '!composer.json',
            '!composer.lock',
            '!README.md',
        ], { base: '.' }),
        gulpZip(package.name + '.zip'),
        dest('./')
    );
};

exports.zip = zip;