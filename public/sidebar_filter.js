const openSidebar = () => {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("sidebarBtn").style.marginLeft = "250px";
};

const closeSidebar = () => {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("sidebarBtn").style.marginLeft = "0";
};

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