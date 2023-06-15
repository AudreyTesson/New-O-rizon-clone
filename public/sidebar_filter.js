const sidebar_filter = {

    sidebarOpenBtnMobile: null,
    sidebarOpenBtnDesktop: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter.sidebarOpenBtnDesktop = document.getElementById("filter_btn_desktop");
        sidebar_filter.sidebarOpenBtnMobile = document.getElementById("filter_btn_mobile");
        sidebar_filter.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter.sidebarCloseBtn.addEventListener('click', sidebar_filter.handleSidebarClose);
        sidebar_filter.sidebarOpenBtnMobile.addEventListener('click', sidebar_filter.handleSidebarOpen);
        sidebar_filter.sidebarOpenBtnDesktop.addEventListener('click', sidebar_filter.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        // animated class with tailwind
        // sidebar_filter.sidebarMenu.classList.add('animate-jump-in animate-once animate-duration animate-ease-in');
        sidebar_filter.sidebarMenu.classList.remove('hidden');
        
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter.sidebarMenu.classList.add('hidden');
        // sidebar_filter.sidebarMenu.classList.add('animate-jump-out animate-once animate-duration animate-ease-in');
    }

}

document.addEventListener("DOMContentLoaded", sidebar_filter.init);


