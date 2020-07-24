import { useState, useEffect } from 'react';
import axios from 'axios';

/**
 *
 * @param {string} url
 *
 * @returns {{errorMessage: string, responseData: {}, loading: boolean}}
 */
const useAxiosGet = (url) => {
    const [result, setResult] = useState({ responseData: {}, loading: true, errorMessage: '' });

    useEffect(() => {
        let pending = true;
        axios.get(url, { headers: { 'accept-language': 'en' }})
            .then(res => {
                if (pending) {
                    setResult((state) => ({
                        ...state,
                        loading: false,
                        responseData: res.data,
                    }));
                }
            })
            .catch((error) => {
                if (pending) {
                    setResult((state) => ({
                        ...state,
                        loading: false,
                        errorMessage: error.message,
                    }));
                }
            });

        return () => pending = false;
    }, [url]);

    return result;
}

export default useAxiosGet;