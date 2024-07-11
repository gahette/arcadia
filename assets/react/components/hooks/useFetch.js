import { useCallback, useState } from "react";

async function jsonLdFetch(url, method = "GET", data = null) {
    const params = {
        method: method,
        headers: {
            'Accept': 'application/ld+json',
            'Content-Type': 'application/json'
        }
    }

    if (data) {
        params.body = JSON.stringify(data)
    }
    const response = await fetch(url, params)
    if (response.status === 204) {
        return null
    }
    const responseData = await response.json()
    if (response.ok) {
        return responseData
    } else {
        throw responseData
    }
}

export function useFetch(url) {
    const [loading, setLoading] = useState(false)
    const [items, setItems] = useState([])
    const [count, setCount] = useState(0)
    const [next, setNext] = useState(null)
    const [previous, setPrevious] = useState(null)

    const load = useCallback(async () => {
        setLoading(true)
        try {
            const response = await jsonLdFetch(next || url)

            setItems(response || []);
            setCount(response.length || 0);

            if (response['hydra:view'] && response['hydra:view']['hydra:next']) {
                setNext(response['hydra:view']['hydra:next'])
            } else {
                setNext(null)
            }

            if (response['hydra:view'] && response['hydra:view']['hydra:previous']) {
                setPrevious(response['hydra:view']['hydra:previous'])
            } else {
                setPrevious(null)
            }

        } catch (error) {
        } finally {
            setLoading(false);
        }
    }, [next, url]);

    return {
        items, load, count, loading, hasMore: next !== null, hasLess: previous !== null
    }
}

export function usePost(url, method = "POST", callback = null) {
    const [errors, setErrors] = useState({});
    const [loading, setLoading] = useState(false);

    const load = useCallback(async (data = null) => {
        setLoading(true)
        try {
            const response = await jsonLdFetch(url, method, data)
            if (callback) {
                callback(response)
            }
        } catch (error) {
            if (error.violations) {
                setErrors(error.violations.reduce((acc, violation) => {
                    acc[violation.propertyPath] = violation.message
                    return acc
                }, {}));
            } else {

            }
        }
        setLoading(false)
    }, [url, method, callback]);
    return {
        loading, errors, load
    }
}