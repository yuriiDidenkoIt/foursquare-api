import React, { useMemo } from 'react';
import { useParams } from 'react-router-dom';
import useAxiosGet from '@Hooks/useAxiosGet';
import Category from '@Components/Categories/Category';
import Loader from '@Components/Loader';
import LocalStorageService from '@Utils/LocalStorageService';
import '../Categories/Categories'

import './SubCategories.scss';

const SubCategories = () => {
    const { id } = useParams();
    const serviceStorage = useMemo(() => {
        return  new LocalStorageService(id);
    }, [id]);
    const { loading, responseData, errorMessage } = useAxiosGet(`/categories/sub/${id}`);

    if (loading || !responseData) return <Loader/>
    if (errorMessage) return <h1>Error {errorMessage}</h1>
    return (
        <>
            <h1 className="sub-category-title">{serviceStorage.getItem()}</h1>
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
        </>
    )
};

export default SubCategories;