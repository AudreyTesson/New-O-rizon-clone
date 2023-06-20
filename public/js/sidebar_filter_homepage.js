const sidebar_filter_homepage = {

    sidebarOpenBtnMobile: null,
    sidebarOpenBtn: null,
    sidebarCloseBtn: null,
    sidebarMenu: null,

    init: function() {
        sidebar_filter_homepage.sidebarCloseBtn = document.querySelector(".close_filter");
        sidebar_filter_homepage.sidebarOpenBtn = document.getElementById("filter_btn");
        sidebar_filter_homepage.sidebarOpenBtnMobile = document.getElementById("filter_btn_mobile");
        sidebar_filter_homepage.sidebarMenu = document.getElementById("filter_sidebar");
        sidebar_filter_homepage.addEvents();
    },

    /**
     * Method adding click event to open and close the sidebar for filtering research by criteria
     */
    addEvents: function() {
        sidebar_filter_homepage.sidebarCloseBtn.addEventListener('click', sidebar_filter_homepage.handleSidebarClose);
        sidebar_filter_homepage.sidebarOpenBtnMobile.addEventListener('click', sidebar_filter_homepage.handleSidebarOpen);
        sidebar_filter_homepage.sidebarOpenBtn.addEventListener('click', sidebar_filter_homepage.handleSidebarOpen);
    }, 

   /**
    * Handler to manage sidebar opening
    */
    handleSidebarOpen: function() {
        sidebar_filter_homepage.sidebarMenu.classList.remove('hidden'); 
    },

    /**
     * Handler to manager sidebar closing
     */
    handleSidebarClose: function() {
        sidebar_filter_homepage.sidebarMenu.classList.add('hidden');
    }

}

document.addEventListener("DOMContentLoaded", sidebar_filter_homepage.init);


