// Enhanced Error Handler for Console Issues and Vite Builds
(function() {
    'use strict';
    
    // Block unload events at the earliest possible moment
    const originalAddEventListener = EventTarget.prototype.addEventListener;
    const originalRemoveEventListener = EventTarget.prototype.removeEventListener;
    
    EventTarget.prototype.addEventListener = function(type, listener, options) {
        if (type === 'beforeunload' || type === 'unload') {
            console.warn('Blocked unload event listener to comply with Permissions Policy');
            return;
        }
        return originalAddEventListener.call(this, type, listener, options);
    };
    
    EventTarget.prototype.removeEventListener = function(type, listener, options) {
        if (type === 'beforeunload' || type === 'unload') {
            return;
        }
        return originalRemoveEventListener.call(this, type, listener, options);
    };
    
    // Block window-specific unload handlers
    Object.defineProperty(window, 'onbeforeunload', {
        set: function(value) {
            console.warn('Blocked onbeforeunload assignment to comply with Permissions Policy');
        },
        get: function() {
            return null;
        }
    });
    
    Object.defineProperty(window, 'onunload', {
        set: function(value) {
            console.warn('Blocked onunload assignment to comply with Permissions Policy');
        },
        get: function() {
            return null;
        }
    });
    
    // Suppress specific console errors that are not critical
    const originalError = console.error;
    const originalWarn = console.warn;
    
    // List of errors to suppress (non-critical)
    const suppressedErrors = [
        'Failed to load resource',
        'net::ERR_INTERNET_DISCONNECTED',
        'google-analytics',
        'Permissions policy violation',
        'unload is not allowed',
        'beforeunload is not allowed',
        'Violation] Permissions policy violation'
    ];
    
    // Override console.error to filter out non-critical errors
    console.error = function(...args) {
        const message = args.join(' ');
        const shouldSuppress = suppressedErrors.some(error => 
            message.toLowerCase().includes(error.toLowerCase())
        );
        
        if (!shouldSuppress) {
            originalError.apply(console, args);
        }
    };
    
    // Override console.warn to filter out non-critical warnings
    console.warn = function(...args) {
        const message = args.join(' ');
        const shouldSuppress = suppressedErrors.some(error => 
            message.toLowerCase().includes(error.toLowerCase())
        );
        
        if (!shouldSuppress) {
            originalWarn.apply(console, args);
        }
    };
    
    // Handle unhandled promise rejections
    window.addEventListener('unhandledrejection', function(event) {
        const message = event.reason?.message || event.reason || '';
        const shouldSuppress = suppressedErrors.some(error => 
            message.toLowerCase().includes(error.toLowerCase())
        );
        
        if (shouldSuppress) {
            event.preventDefault();
        }
    });
    
    // Handle global errors
    window.addEventListener('error', function(event) {
        const message = event.message || '';
        const shouldSuppress = suppressedErrors.some(error => 
            message.toLowerCase().includes(error.toLowerCase())
        );
        
        if (shouldSuppress) {
            event.preventDefault();
            return true;
        }
    });
    
    // Clean up any existing Google Analytics attempts
    if (typeof gtag !== 'undefined') {
        window.gtag = function() {
            // Silently ignore Google Analytics calls
            return;
        };
    }
    
    // Prevent Google Analytics from loading
    window.ga = window.ga || function() {
        // Silently ignore Google Analytics calls
        return;
    };
    
    // Block any attempts to add unload handlers via different methods
    const originalSetAttribute = Element.prototype.setAttribute;
    Element.prototype.setAttribute = function(name, value) {
        if (name === 'onbeforeunload' || name === 'onunload') {
            console.warn('Blocked unload attribute to comply with Permissions Policy');
            return;
        }
        return originalSetAttribute.call(this, name, value);
    };
    
    console.log('Enhanced error handler loaded - unload events blocked');
    
})();