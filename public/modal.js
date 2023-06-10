const modal = {

    init: async function() {
                
        // form selector
        const form = document.querySelector('form');
        // event listener on form submit
        form.addEventListener('submit', modal.handleModal);
    },

    /**
     * Method to handle modal 
     */
    handleModal: function()
    {
        // close button selector
        const close = document.querySelector(".close_modal");
        // event listener on close button click
        close.addEventListener('click', modal.closeModal);
    },

    /**
     * Method to close the modal on click event
     */
    closeModal: function(){
        debugger;
        const modalSuccess = document.querySelector(".modal");
        modalSuccess.classList.add("hidden");
    },
        
}

document.addEventListener('DOMContentLoaded', modal.init);