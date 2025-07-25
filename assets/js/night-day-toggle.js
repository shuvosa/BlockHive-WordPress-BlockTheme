document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleBtn');
    let isNightMode = true;

    function toggleTheme() {
        const body = document.body;
        
        if(isNightMode) {
            // Switch to Day Mode
            body.classList.replace('bg-black', 'bg-white');
            body.classList.replace('text-white', 'text-black');
            
            document.querySelectorAll('.text-gray-400').forEach(element => {
                element.classList.replace('text-gray-400', 'text-black');
            });
            
            toggleBtn.innerHTML = `<img src="${myThemeVars.nightIcon}" alt="Toggle theme" width="24" height="24" />`;
        } else {
            // Switch to Night Mode
            body.classList.replace('bg-white', 'bg-black');
            body.classList.replace('text-black', 'text-white');
            
            document.querySelectorAll('.text-black').forEach(element => {
                element.classList.replace('text-black', 'text-gray-400');
            });
            
            toggleBtn.innerHTML = `<img src="${myThemeVars.sunIcon}" alt="Toggle theme" width="24" height="24" />`;
        }
        
        isNightMode = !isNightMode;
    }

    toggleBtn.addEventListener('click', toggleTheme);
});