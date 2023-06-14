// Code JavaScript

const menuButton = document.getElementById('menu-button');
const dropdownMenu = document.querySelector('.absolute');
const closeIcon = document.getElementById('close-button');

menuButton.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
});

// document.addEventListener('click', (event) => {
//     const targetElement = event.target;
//     if (!targetElement.closest('.relative')) {
//         dropdownMenu.classList.add('hidden');
//     }
// });

document.addEventListener('click', (event) => {
    const targetElement = event.target;
    if (!targetElement.closest('.relative')) {
      dropdownMenu.classList.add('hidden');
    }
  
    if (targetElement.matches('[data-sort]')) {
      event.preventDefault();
      const sortOption = targetElement.getAttribute('data-sort');
      performSort(sortOption);
    }
  });
  
//   function performSort(sortOption) {
//     const citiesContainer = document.getElementById('cities-container');
//     citiesContainer.innerHTML = '<p>Loading...</p>';
  
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET', `/cities/${sortOption}`, true);
//     xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
//     xhr.onreadystatechange = function() {
//       if (xhr.readyState === 4 && xhr.status === 200) {
//         citiesContainer.innerHTML = xhr.responseText;
//       }
//     };
//     xhr.send();
//   }
function performSort(sortOption, contentType) {
    const containerId = contentType === 'cities' ? 'cities-container' : 'images-container';
    const container = document.getElementById(containerId);
  
    container.innerHTML = '<p>Loading...</p>';
  
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/${contentType}/${sortOption}`, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        container.innerHTML = xhr.responseText;
      }
    };
  
    xhr.send();
  }

closeIcon.addEventListener('click', (event) => {
    event.stopPropagation();
    dropdownMenu.classList.add('hidden');
});