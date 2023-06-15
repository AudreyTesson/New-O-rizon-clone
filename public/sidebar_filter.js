const sidebar_filter = {

    sidebarOpenBtn: null,
    sidebarCloseBtn: null,

    init: function() {
        sidebar_filter.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter.sidebarOpenBtn = document.getElementById("filter_menu");
        sidebar_filter.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter.sidebarCloseBtn.addEventListener('click', sidebar_filter.handleSidebarClose);
        sidebar_filter.sidebarOpenBtn.addEventListener('click', sidebar_filter.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        
        sidebar_filter.sidebarOpenBtn.classList.remove('hidden');
        // animated class with tailwind
        sidebar_filter.sidebarOpenBtn.classList.add('animate-jump-in animate-once animate-duration-[2500ms] animate-ease-in');
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter.sidebarCloseBtn.classList.add('animate-jump-out animate-once animate-duration-[2500ms] animate-ease-in');
    }

}

document.addEventListener("DOMContentLoaded", sidebar_filter.init);


