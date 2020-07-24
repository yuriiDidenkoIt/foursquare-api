import React, { useMemo } from 'react';
import { useParams } from 'react-router-dom';
import useAxiosGet from '@Hooks/useAxiosGet';
import { getExploreUrl } from '@Utils/foursquareApiUrl';
import Loader from '@Components/Loader';
import RecommendedPlace from '@Components/RecommendedPlace';
import LocalStorageService from '@Utils/LocalStorageService';

import './ExploreCategory.scss';

const ExploreCategory = () => {
    const { id } = useParams();
    const serviceStorage = useMemo(() => {
        return new LocalStorageService(id);
    }, [id]);

    const categoriesName = useMemo(() => {
        return serviceStorage.getItem()
    }, [serviceStorage]);

    const { loading, responseData, errorMessage } = useAxiosGet(getExploreUrl(categoriesName));

    if (loading || !responseData) return <Loader />

    if (errorMessage) return <h1 className="explore-warning">OOPS! Something went wrong :( ! Try later ;)</h1>

    if (responseData.response.warning) return <h1 className="explore-warning">{responseData.response.warning.text}</h1>
    const groups = responseData.response.groups || [];

    return (
        <div className="explore-container">
            <h1>{categoriesName}</h1>
            {groups.map((group) => {
                const { name: groupName, type: groupType, items: groupItems } = group;
                return (
                    <div key={groupName}>
                        <h1>{groupType}</h1>
                        <div className="recommended-places-container">
                            {
                                groupItems.map((recommendedItems) =>
                                    <RecommendedPlace
                                        key={recommendedItems.referralId}
                                        referralId={recommendedItems.referralId}
                                        venue={recommendedItems.venue}
                                    />
                                )
                            }
                        </div>
                    </div>
                );
            })}
        </div>
    );
}


export default ExploreCategory;