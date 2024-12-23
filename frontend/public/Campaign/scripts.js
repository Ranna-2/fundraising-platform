// Example JavaScript to filter programs or handle other interactions
const filterButtons = document.querySelectorAll('.filter-btn');
const charityPrograms = document.querySelectorAll('.program-card');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Example: filter programs based on category
        const category = button.innerText.toLowerCase().trim();  // Trim to avoid accidental spaces
        
        charityPrograms.forEach(program => {
            const programCategory = program.querySelector('p').innerText.toLowerCase().trim();
            
            // Show the program if it matches the category or show all if category is "all"
            if (programCategory.includes(category) || category === "all") {
                program.style.display = 'block';
            } else {
                program.style.display = 'none';
            }
        });
    });
});


