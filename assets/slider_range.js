import { create } from 'nouislider';

// temperature slider
const sliderTemperature = document.getElementById('temperature-slider');

if (sliderTemperature) {
    const temperatureMin = document.getElementById('filter_data_temperatureMin')
    const temperatureMax = document.getElementById('filter_data_temperatureMax')
    const range = create(sliderTemperature, {
        start: [temperatureMin.value || -10, temperatureMax.value || 30],
        handleAttributes: [
            { 'aria-label': 'lower' },
            { 'aria-label': 'upper' },
        ],
        connect: true,
        range: {
            'min': -50,
            'max': 50
        }
    })
    // display number in the field 
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            temperatureMin.value = Math.round(values[0])
        }
        if (handle === 1) {
            temperatureMax.value = Math.round(values[1])
        }
    })
}

// Demography slider
const sliderDemography = document.getElementById('demography-slider');

if (sliderDemography) {
    const demographyMin = document.getElementById('filter_data_demographyMin')
    const demographyMax = document.getElementById('filter_data_demographyMax')
    const range = create(sliderDemography, {
        start: [demographyMin.value || 1000000, demographyMax.value || 10000000],
        handleAttributes: [
            { 'aria-label': 'lower' },
            { 'aria-label': 'upper' },
        ],
        connect: true,
        step: 1000,
        range: {
            'min': 0,
            'max': 40000000
        }
    })

    // display number rounded in the field 
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            demographyMin.value = Math.round(values[0])
        }
        if (handle === 1) {
            demographyMax.value = Math.round(values[1])
        }
    })
}

// Cost slider
const sliderCost = document.getElementById('cost-slider');

if (sliderDemography) {
    const costMin = document.getElementById('filter_data_costMin')
    const costMax = document.getElementById('filter_data_costMax')
    const range = create(sliderCost, {
        start: [costMin.value || 10000, costMax.value || 500000],
        handleAttributes: [
            { 'aria-label': 'lower' },
            { 'aria-label': 'upper' },
        ],
        step: 50,
        connect: true,
        range: {
            'min': 1000,
            'max': 1000000
        }
    })

    // display number rounded in the field 
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            costMin.value = Math.round(values[0])
        }
        if (handle === 1) {
            costMax.value = Math.round(values[1])
        }
    })
}

// Area slider
const sliderArea = document.getElementById('area-slider');

if (sliderArea) {
    const areaMin = document.getElementById('filter_data_areaMin')
    const areaMax = document.getElementById('filter_data_areaMax')
    const range = create(sliderArea, {
        start: [areaMin.value || 10000, areaMax.value || 100000],
        handleAttributes: [
            { 'aria-label': 'lower' },
            { 'aria-label': 'upper' },
        ],
        connect: true,
        step: 1000,
        range: {
            'min': 500,
            'max': 400000
        }
    })

    // display number rounded in the field 
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            areaMin.value = Math.round(values[0])
        }
        if (handle === 1) {
            areaMax.value = Math.round(values[1])
        }
    })
}

// Timezone slider
const sliderTimezone = document.getElementById('timezone-slider');

if (sliderTimezone) {
    const timezone = document.getElementById('filter_data_timezone')
    const range = create(sliderTimezone, {
        start: [0],
        connect: true,
        step: 1,
        range: {
            'min': -12,
            'max': 12
        }
    })

    // display number rounded in the field 
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            timezone.value = Math.round(values[0])
        }
        if (handle === 1) {
            areaMax.value = Math.round(values[1])
        }
    })
}