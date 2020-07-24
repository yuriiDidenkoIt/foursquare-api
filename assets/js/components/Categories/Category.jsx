import React, { useCallback, useEffect }  from 'react';
import { useHistory } from 'react-router-dom';
import routes from '@Config/routes';
import PropTypes from 'prop-types';
import LocalStorageService from '@Utils/LocalStorageService';

import './Category.scss'

const Category = ({ id, name, iconPrefix, iconSuffix, subCategoriesIds }) => {
    const history = useHistory();
    const navigateToExplore = useCallback(() => {
        history.push(`${routes.explore.path}/${id}`)
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [id] );

    const navigateToSubCategories = useCallback(() => {
        history.push(`${routes.subCategories.path}/${id}`)
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [id] );

    useEffect(() => {
        return () => (new LocalStorageService(id)).setItem(name);
    }, [id, name]);

    return (
        <div className="category-container" key={id}>
            <img onClick={navigateToExplore} src={`${iconPrefix}bg_88${iconSuffix}`} alt={name}/>
            <h1 className="category-name">{name}</h1>
            {
                subCategoriesIds.length ?
                <button type="button" onClick={navigateToSubCategories} className="sub-category-link">
                    Sub Categories({subCategoriesIds.length})
                </button>
                    : null
            }
        </div>
    )
};

Category.propTypes = {
    id: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    iconPrefix: PropTypes.string.isRequired,
    iconSuffix: PropTypes.string.isRequired,
    subCategoriesIds: PropTypes.arrayOf(PropTypes.string.isRequired),
};

export default Category;