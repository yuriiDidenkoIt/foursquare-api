import React from 'react';
import PropTypes from 'prop-types';
import LocationInfo from '@Components/RecommendedPlace/LocationInfo';

import './RecommendedPlace.scss';

const RecommendedPlace = ({ referralId, venue }) => {
    const { location: { address, city, country, lat, lng }, name } = venue;

    return (
        <div className="recommended-place">
            <h1 className="place-name">{name}</h1>
            <div className="place-location">
                <LocationInfo label="Address" description={address}/>
                <LocationInfo label="City" description={city}/>
                <LocationInfo label="Country" description={country}/>
                <LocationInfo label="LAT" description={lat}/>
                <LocationInfo label="LNG" description={lng}/>
            </div>
            <h5 className="referralId">Referral ID: {referralId}</h5>
        </div>
    );
}

RecommendedPlace.propTypes = {
    referralId: PropTypes.string.isRequired,
    venue: PropTypes.shape({
        id: PropTypes.string.isRequired,
        name: PropTypes.string.isRequired,
        location: PropTypes.shape({
            address: PropTypes.string,
            city: PropTypes.string,
            country: PropTypes.string.isRequired,
            lat: PropTypes.number,
            lng: PropTypes.number,
        })
    }),
}

export default RecommendedPlace;
