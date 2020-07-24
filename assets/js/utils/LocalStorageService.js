class LocalStorageService {
    #key = null;
    #storage = window.localStorage;
    #errorMessageEmptyKey = 'Key could not be empty.'

    /**
     * @param {string} key
     */
    constructor(key) {
        this.#key = key;
    }

    #validateKey = (key) => {
        if (key) this.#key = key;
        if (!this.#key) throw new Error(this.#errorMessageEmptyKey);
    }

    /**
     * @param {string|null} key
     *
     * @returns {string|null}
     */
    getItem = (key = null) => {
        this.#validateKey(key);

        return this.#storage.getItem(this.#key);
    }

    /**
     *
     * @param {string} value
     * @param {string|null} key
     */
    setItem = (value, key = null) => {
        this.#validateKey(key);
        this.#storage.setItem(this.#key, value);
    }

    /**
     * @param {string|null} key
     *
     * @returns {string|null}
     */
    deleteItem = (key = null) => {
        this.#validateKey(key);
        this.#storage.removeItem(key);
    }
}

export default LocalStorageService;