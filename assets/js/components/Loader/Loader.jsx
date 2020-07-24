import React, { useMemo } from 'react';

import './Loader.scss'

const Loader = () => {
    const loaderItems = useMemo(() =>
            Array(12).fill(0).map((value, index) => <div key={`loader-item-${index}`}/>),
        []
    );
    return (
        <div className="loader">
            {loaderItems}
        </div>
    );
}

export default Loader;