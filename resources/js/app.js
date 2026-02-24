import './bootstrap';

// Prevent any unload event handlers from being added
const originalAddEventListener = window.addEventListener;
window.addEventListener = function(type, listener, options) {
    if (type === 'beforeunload' || type === 'unload') {
        // Silently ignore unload event listeners to prevent policy violations
        console.warn('Blocked unload event listener to comply with Permissions Policy');
        return;
    }
    return originalAddEventListener.call(this, type, listener, options);
};

// Override removeEventListener as well for completeness
const originalRemoveEventListener = window.removeEventListener;
window.removeEventListener = function(type, listener, options) {
    if (type === 'beforeunload' || type === 'unload') {
        // Silently ignore unload event listener removal
        return;
    }
    return originalRemoveEventListener.call(this, type, listener, options);
};

// Clean up any existing unload handlers
window.onbeforeunload = null;
window.onunload = null;

// Initialize clean application
document.addEventListener('DOMContentLoaded', function() {
    console.log('Application loaded without unload handlers');
});
