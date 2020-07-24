import React from 'react';
import useAxiosGet from '@Hooks/useAxiosGet';
import Loader from '@Components/Loader';
import Category from './Category';

import './Categories.scss';

const Categories = () => {
    const { loading, responseData, errorMessage } = useAxiosGet('/first-level-categories');
    if (loading || !responseData) return <Loader/>
    if (errorMessage) return <h1>Error {errorMessage}</h1> // todo: moved to component with custom message, error should be sent as stack trace to server

    return (
        <div className="categories-container">
            {
                responseData.map((category) =>
                    <Category
                        key={category.category_id}
                        id={category.category_id}
                        name={category.name}
                        iconPrefix={category.icon_prefix}
                        iconSuffix={category.icon_suffix}
                        subCategoriesIds={category.sub_categories_ids ? category.sub_categories_ids.split(',') : []}
                    />)
            }
        </div>
    );
}

export default Categories;