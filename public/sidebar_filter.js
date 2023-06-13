const openSidebar = () => {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("sidebarBtn").style.marginLeft = "250px";
};

const closeSidebar = () => {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("sidebarBtn").style.marginLeft = "0";
};