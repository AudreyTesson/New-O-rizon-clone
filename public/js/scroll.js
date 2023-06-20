
        window.onscroll = function() {scrollUpTo200()};    

        /**
         * Method to show the toTopButton after scrolling down 200px from the top of the document
         */
        function scrollUpTo200 () {
            const toTopButton = document.getElementById("to-top-button");
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                toTopButton.classList.remove("hidden");
            } else {
                toTopButton.classList.add("hidden");
            }
        }

        /**
         * Method to smoothly scroll to the top of the document with click event on toTopButton
         */
        function goToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
