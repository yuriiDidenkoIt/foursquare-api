module.exports = {
    extends: [
        'eslint:recommended',
        'plugin:react/recommended',
    ],
    plugins: [
        'react-hooks',
    ],
    parserOptions: {
        ecmaVersion: 6,
        sourceType: 'module',
        ecmaFeatures: {
            jsx: true
        }
    },
    env: {
        browser: true,
        es6: true,
        node: true
    },
    settings: {
        'import/resolver' : {
            webpack: {
                config: './webpack.config.alias.js'
            }
        },
    },
    parser: 'babel-eslint',
    rules: {
        quotes: ['error', 'single'],
        'no-console': ['error', { allow: ['warn', 'error'] }],
        'no-unused-vars': ['warn'],
        'react-hooks/rules-of-hooks': 'error',
        'react-hooks/exhaustive-deps': 'warn',
    }
};