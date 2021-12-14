import delta from '../utils/delta';
import dispatcher from '../utils/dispatcher';
import getCurrentDeviceMode from './device-mode';

const w = window;
const d = document;
const de = d.documentElement;
const c = process.env.DEBUG ? console.log : () => { };

const ga = 'getAttribute';
const sa = 'setAttribute';

const getClass = (el) => {
    return el[ga]('class') || "";
}

const setClass = (el, value) => {
    return el[sa]('class', value);
}

export default () => {
    window.addEventListener("load", function () {
        const mode = getCurrentDeviceMode();
        const vw = Math.max(de.clientWidth || 0, w.innerWidth || 0);
        const vh = Math.max(de.clientHeight || 0, w.innerHeight || 0);

        const keys = ['_animation_' + mode, 'animation_' + mode, '_animation', '_animation', 'animation'];
        Array.from(d.querySelectorAll('.elementor-invisible')).forEach(el => {

            // we  only want to optimize elements in the top of the page
            const viewportOffset = el.getBoundingClientRect();
            if (viewportOffset.top + w.scrollY <= vh && viewportOffset.left + w.scrollX < vw) {
                try {
                    const settings = JSON.parse(el[ga]('data-settings'));
                    if (settings.trigger_source) {
                        return;
                    }
                    const animationDelay = settings._animation_delay || settings.animation_delay || 0;
                    let animation, key;

                    for (var i = 0; i < keys.length; i++) {
                        if (settings[keys[i]]) {
                            key = keys[i];
                            animation = settings[keys[i]];
                            break;
                        }
                    };

                    if (animation) {
                        process.env.DEBUG && c(delta(), 'animating with' + animation, el);
                        const oldClass = getClass(el);
                        const newClass = animation === 'none'
                            ? oldClass
                            : oldClass + ' animated ' + animation;

                        const animate = () => {
                            setClass(el, newClass.replace(/\belementor\-invisible\b/, ''))
                            keys.forEach(key => delete settings[key]);
                            el[sa]('data-settings', JSON.stringify(settings));
                        };

                        let timeout = setTimeout(animate, animationDelay);

                        dispatcher.on('fi', () => {
                            clearTimeout(timeout);
                            setClass(el, getClass(el).replace(new RegExp('\\b' + animation + '\\b'), ''));
                        });

                    }
                } catch (e) {
                    console.error(e);
                }
            }
        })
    })
}