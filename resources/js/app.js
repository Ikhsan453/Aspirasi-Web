import './bootstrap';
import 'bootstrap';

const originalAddEventListener = window.addEventListener;
window.addEventListener = function(type, listener, options) {
    if (type === 'beforeunload' || type === 'unload') {
        return;
    }
    return originalAddEventListener.call(this, type, listener, options);
};

const originalRemoveEventListener = window.removeEventListener;
window.removeEventListener = function(type, listener, options) {
    if (type === 'beforeunload' || type === 'unload') {
        return;
    }
    return originalRemoveEventListener.call(this, type, listener, options);
};

window.onbeforeunload = null;
window.onunload = null;
