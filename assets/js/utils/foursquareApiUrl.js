import foursquareUrls from '@Config/urls';

const { clientId, clientSecret } = window.foursquareConfig;
const { explore } = foursquareUrls.foursquareApi.venues;

/**
 * Make url with auth params.
 *
 * @param {string} url
 * @returns {string}
 */
const makeUrl = (url) => `${url}?client_id=${clientId}&client_secret=${clientSecret}&v=20200712`;

/**
 * @param {string} name
 *
 * @returns {string}
 */

export const getExploreUrl = (name) => `${makeUrl(explore)}&near=valletta&query=${name}`;