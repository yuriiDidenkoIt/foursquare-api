export default {
    home: {
        path: '/',
        label: 'Home',
    },
    categories: {
        path: '/categories',
        label: 'Categories',
    },
    explore: {
        path: '/explore',
        parameter: 'id',
        label: 'Categories',
    },
    category: {
        path: '/categories/:name',
        label: 'Category',
    },
    categoryId: {
        path: '/categories/:id',
        label: 'Category',
    },
    subCategories: {
        path: '/sub-categories',
        parameter: 'id',
        label: 'Sub Categories',
    }
};