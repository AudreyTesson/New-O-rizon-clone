// Code JavaScript

const menuButton = document.getElementById('menu-button');
const dropdownMenu = document.querySelector('.absolute');
const closeIcon = document.getElementById('close-button');

menuButton.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
});

document.addEventListener('click', (event) => {
    const targetElement = event.target;
    if (!targetElement.closest('.relative')) {
        dropdownMenu.classList.add('hidden');
    }
});

// document.addEventListener('click', (event) => {
//     const targetElement = event.target;
//     if (!targetElement.closest('.relative')) {
//       dropdownMenu.classList.add('hidden');
//     }
  
//     if (targetElement.matches('[data-sort]')) {
//       event.preventDefault();
//       const sortOption = targetElement.getAttribute('data-sort');
//       performSort(sortOption);
//     }
//   });

closeIcon.addEventListener('click', (event) => {
    event.stopPropagation();
    dropdownMenu.classList.add('hidden');
});