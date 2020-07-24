const path = require('path');
const root = __dirname;

module.exports = {
    resolve: {
        alias: {
            '@Components': path.resolve(root, 'assets/js/components'),
            '@Config': path.resolve(root, 'assets/js/config'),
            '@Hooks': path.resolve(root, 'assets/js/hooks'),
            '@Utils': path.resolve(root, 'assets/js/utils'),
        },
    },
};