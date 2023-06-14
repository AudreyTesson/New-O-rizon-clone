/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

// tailwind elements
import 'tw-elements';

import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';

const slider = document.getElementById('temperature-slider');

if (slider) {
    const temperatureMin = document.getElementById('filter_data_temperatureMin')
    const temperatureMax = document.getElementById('filter_data_temperatureMax')
    const range = noUiSlider.create(slider, {
        start: [temperatureMin.value || 0, temperatureMax.value || 50],
        connect: true,
        range: {
            'min': -50,
            'max': 50
        }
    })


    range.on('slide', function (values, handle) {
        if (handle === 0) {
            temperatureMin.value = Math.round(values[0])
        }
        if (handle === 1) {
            temperatureMax.value = Math.round(values[1])
        }
    })
}

