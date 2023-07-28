import Popper from "popper.js";
import * as bootstrap from 'bootstrap';

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = Popper;
} catch (e) {
    console.log(e);
}
