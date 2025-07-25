document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('simple-data-form');
    if (form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Get form data.
            const name = document.getElementById('name').value;
            //const age = document.getElementById('age').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            // Prepare data for AJAX request.
            const formData = new FormData();
            formData.append('action', 'sdp_submit_form');
            formData.append('name', name);
            formData.append('email', email);
            formData.append('message', message);

            // Send AJAX request.
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('sdp-message');
                if (data.success) {
                    messageDiv.style.color = 'white';
                    messageDiv.textContent = data.data.message;
                    messageDiv.style.display = 'block'; // Show the message div
                    messageDiv.style.backgroundColor= 'black'; // Set background color to green
                  console.log(data.data.message); // Log the success message to the console
                    form.reset(); // Clear the form.
                } else {
                    messageDiv.style.color = 'red';
                    messageDiv.textContent = data.data.message;
                    console.log(data); // Log the error message to the console
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});





 // Wait for the DOM to load (optional, if not already loaded)

 document.addEventListener("DOMContentLoaded", function() {
    // Select the navigation container
    const navContainer = document.querySelector('.footer-categories-menu');

    // Check if the container exists
    if (navContainer) {
        // Select all the navigation links within the container
        const navLinks = navContainer.querySelectorAll('.wp-block-pages-list__item');

        // If there are more than 2 links, remove the excess ones
        if (navLinks.length > 2) {
            for (let i = 4; i < navLinks.length; i++) {
                navLinks[i].remove();
            }
        }
    }
});






    // Check if body contains all three classes
    if (document.body.classList.contains('wp-admin') &&
        document.body.classList.contains('wp-core-ui') &&
        document.body.classList.contains('js')) {
        
        // Add the new classes
        document.body.classList.add('min-h-screen', 'bg-black', 'text-white');
    }


     // Function to adjust which div is visible based on window width
     function adjustDivs() {
        const div1 = document.querySelector('.main-nav');
        const div2 = document.querySelector('.side-nav');
        // Define the breakpoint (768px in this case)
        if (window.innerWidth >= 768) {
          // Desktop: show div1 and hide div2
          // Remove the "hidden" class from the main navigation
          div1.classList.remove('hidden');
          // Add the "hidden" class to the side navigation
          div2.classList.add('hidden');
        } else {
          // Mobile: show div2 and hide div1
          div1.classList.add('hidden');
          div2.classList.remove('hidden');
        }
      }
  
      // Run on page load
      adjustDivs();
  
      // Run whenever the window is resized
      window.addEventListener('resize', adjustDivs);