import axios from 'axios';

// Configure axios without unload handlers
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set up CSRF token
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found');
}

// Prevent axios from adding unload handlers
const originalAxiosCreate = axios.create;
axios.create = function(config) {
    const instance = originalAxiosCreate.call(this, config);
    
    // Ensure no unload handlers are added by axios interceptors
    instance.interceptors.request.use(
        (config) => config,
        (error) => Promise.reject(error)
    );
    
    instance.interceptors.response.use(
        (response) => response,
        (error) => Promise.reject(error)
    );
    
    return instance;
};
