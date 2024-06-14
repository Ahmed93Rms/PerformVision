function simple_fetch(url, options) {
    const responseType = options?.responseType ?? 'json';
    if (options?.responseType) { delete options.responseType; }

    if (options?.get) {
        for (const [key, value] of Object.entries(options.get)) {
            if (typeof value !== 'number' && typeof value !== 'string') {
                return Promise.reject('Error: simple_fetch: value for "' + key + '" is not of allowed type.');
            }
        }
        options.method = 'GET';
        url += url.includes('?') ? '&' : '?';
        url += (new URLSearchParams(options.get)).toString();
        delete options.get;
    }

    if (options?.post) {
        options.method = 'POST';
        const data = new FormData();
        for (const [key, value] of Object.entries(options.post)) {
            if (typeof value !== 'number' && typeof value !== 'string') {
                return Promise.reject('Error: simple_fetch: value for "' + key + '" is not of allowed type.');
            }
            data.append(key, value);
        }
        delete options.post;
        options.body = data;
    }

    if (options?.postJson) {
        options.method = 'POST';
        if (!options.headers) { options.headers = {}; }
        options.headers['Accept'] = 'application/json';
        options.headers['Content-Type'] = 'application/json';
        options.body = JSON.stringify(options.postJson);
        delete options.postJson;
    }

    return fetch(url, options).then(response => {
        if (!response.ok) {
            return response[responseType]().then((r) => {
                return Promise.reject(r);
            });
        }
        return response[responseType]();
    });
}
