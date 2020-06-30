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
    rules: {
        'no-console': ['error', { allow: ['warn', 'error'] }],
        'no-unused-vars': 0,
        'react-hooks/rules-of-hooks': 'error',
        'react-hooks/exhaustive-deps': 'warn',
    }
};