// Test via a getter in the options object to see if the passive property is accessed
const listenerOptions = {};

((w, p) => {
    try {
        const opts = Object.defineProperty({}, p, {
            get: function () {
                listenerOptions[p] = true;
            }
        });
        w.addEventListener(p, null, opts);
        w.removeEventListener(p, null, opts);
    } catch (e) { }
})(window, "passive");

export default listenerOptions;
