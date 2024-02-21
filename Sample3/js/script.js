// poke_container: This variable likely targets a div element with the ID 'poke-container' within
const poke_container = document.getElementById('poke-container')
//pokemon_count: Sets the limit of Pokemon to be fetched, in this case 151.
const pokemon_count = 151
//colors: A dictionary (object) storing color codes associated with different Pokemon types.
const colors = {
    fire: '#fddfdf',
    grass: '#defde0',
    electric: '#fcf7de',
    water: '#def3fe',
    ground: '#f4e7da',
    rock: '#e0dfde',
    ghost: '#fceaff',
    poison: '#e47ff5',
    bug: '#f8d5a3',
    dragon: '#97b3e6',
    psychic: '#eaeda1',
    flying: '#f5f5f5',
    fighting: '#e6e0d4',
    normal: '#ffbd66'
}

//main_types: An array containing the keys (type names) from the colors object.
const main_types = Object.keys(colors)

/**
This is an asynchronous function using the async keyword.
- It has a for loop that iterates from 1 to the pokemon_count.
- Inside the loop, it calls getPokemon(i) for each ID, awaiting its completion before moving to the next iteration (await).
*/
const fetchPokemons = async () => {
    for(let i = 1; i <= pokemon_count; i++) {
        await getPokemon(i)
    }
}

/** 
Also an asynchronous function.
- url: Constructs the URL to fetch data from the PokeAPI, using the provided Pokemon ID.
- res: Uses fetch(url) to send a request to the API and store the response.
- data: Transforms the response into JSON format using res.json().
- Calls createPokemonCard(data) to generate a card using the Pokemon data.
*/
const getPokemon = async (id) => {
    const url = `https://pokeapi.co/api/v2/pokemon/${id}`
    const res = await fetch(url)
    const data = await res.json()
    createPokemonCard(data)
}

/**
- Creates a div element and gives it the class 'pokemon'.
- name: Formats the Pokemon name for display.
- id: Formats the Pokemon ID for display (padding it with zeros).
- poke_types: Extracts an array of the Pokemon's types.
- type: Finds the primary type by matching types in the main_types array.
- color: Retrieves the associated color from the colors object.
- pokemonInnerHTML: This is a template string defining the structure of a Pokemon card – image, number, name, and type.
- Sets the background color and content of the created 'pokemon' div.
- Lastly, appends the created Pokemon card to the poke_container.
 */
const createPokemonCard = (pokemon) => {
    const pokemonElement = document.createElement('div')
    pokemonElement.classList.add('pokemon')

    const name = pokemon.name[0].toUpperCase() + pokemon.name.slice(1)
    const id = pokemon.id.toString().padStart(3, '0')
    const poke_types = pokemon.types.map(type => type.type.name)
    const type = main_types.find(type => poke_types.indexOf(type) > -1)
    const color = colors[type]

    pokemonElement.style.backgroundColor = color

    const pokemonInnerHTML = `
    <div class="img-container">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${pokemon.id}.png" alt="${pokemon.name}"/>
    </div>
    <div class="info">
        <span class="number">#${id}</span>
        <h3 class="name">${name}</h3>
        <small class="type">Type: <span>${type}</span></small>
    </div>
    `

    pokemonElement.innerHTML = pokemonInnerHTML

    poke_container.appendChild(pokemonElement)
}   

//The code execution starts by calling this function, which begins the process of fetching and displaying the first 151 Pokemon.
fetchPokemons()


