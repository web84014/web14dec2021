import delta from '../utils/delta';
import dispatcher from '../utils/dispatcher';

const d = document;
const c = process.env.DEBUG ? console.log : () => { };

const ga = 'getAttribute';
const sa = 'setAttribute';
const qsa = 'querySelectorAll';
const inmega = 'data-in-mega_smartmenus';

export default () => {

    const div = d.createElement('div');
    div.innerHTML = '<span class="sub-arrow --wp-meteor"><i class="fa" aria-hidden="true"></i></span>';
    const placeholder = div.firstChild;

    const prevAll = el => {
        const result = [];
        while (el = el.previousElementSibling)
            result.push(el);
        return result;
    }

    d.addEventListener("DOMContentLoaded", function () {
        Array.from(d[qsa]('.pp-advanced-menu ul')).forEach(ul => {
            /* skipping mega menues */
            if (ul[ga](inmega)) {
                return;
            } else if ((ul[ga]('class') || "").match(/\bmega\-menu\b/)) {
                ul[qsa]('ul').forEach(ul => {
                    ul[sa](inmega, true);
                });
            }
            let prev = prevAll(ul);
            let a = prev.filter(el => el).filter(el => el.tagName === 'A').pop();
            if (!a) {
                a = prev.map(el => Array.from(el[qsa]('a'))).filter(el => el).flat().pop();
            }
            if (a) {
                const span = placeholder.cloneNode(true);
                a.appendChild(span);
                
                const observer = new MutationObserver(mutations => {
                    mutations.forEach(({ addedNodes }) => {
                        addedNodes.forEach(node => {
                            // For each added script tag
                            if (node.nodeType === 1 && 'SPAN' === node.tagName) {
                                try { 
                                    a.removeChild(span) 
                                } catch { }
                            }
                        })
                    })
                })
                observer.observe(a, { childList: true });
            }
        })
    });
}