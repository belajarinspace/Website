// Fungsi pencarian resep
function searchRecipe() {
    let input = document.getElementById('search').value.toLowerCase();
    let recipeCards = document.querySelectorAll('.recipe-card');

    recipeCards.forEach((card) => {
        let title = card.querySelector('h3').innerText.toLowerCase();
        if (title.includes(input)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
