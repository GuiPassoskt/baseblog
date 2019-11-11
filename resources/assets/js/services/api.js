import axios from "axios";


const api = axios.create({
    baseURL: "/api/"
})



api.interceptors.request.use((config) => {

    const token = window.localStorage.getItem('api_token');

    if (token) {
        config.headers.common.Authorization = `Bearer ${token}`;
    }

    return config;
})


export default api;