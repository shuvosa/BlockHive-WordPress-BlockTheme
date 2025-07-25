document.addEventListener('DOMContentLoaded', function() {
    // Safely target elements (works even if they don't exist)
    const trigger = document.getElementById('trigger');
    const popupOverlay = document.getElementById('popupOverlay');
    const closeBtn = document.getElementById('closeBtn');
    const mainContent = document.querySelector('.main-content');
  
    // Add event listeners only if elements exist
    trigger?.addEventListener('click', () => {
      popupOverlay.style.display = 'flex';
      mainContent?.classList.add('blur');
    });
  
    closeBtn?.addEventListener('click', () => {
      popupOverlay.style.display = 'none';
      console.log('close button clicked');
      mainContent?.classList.remove('blur');
    });
  });



