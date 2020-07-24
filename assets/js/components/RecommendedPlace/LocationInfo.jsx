import React from 'react';
import PropTypes from 'prop-types';

const LocationInfo = ({ label = null, description = null }) => {
    if (!description) return null;

    return (
        <div>
            <div>{label}:</div>
            <div>{description}</div>
        </div>
    );
}

LocationInfo.propTypes = {
    label: PropTypes.string,
    description: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
};

export default LocationInfo;