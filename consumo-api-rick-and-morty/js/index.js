const handleGetCharacters = (done) => {

    const response = fetch("https://rickandmortyapi.com/api/character");
    response.then(response => response.json())
        .then(data => done(data))

}

handleGetCharacters(data => {

    data.results.forEach(character => {

        const estado = "";

        switch (character.status) {
            case "Alive":
                
        }

        const article = document.createRange().createContextualFragment(`
            <article>
                <div class="image-container">
                    <img src="${character.image}" alt="Rick and Morty character">
                </div>

                <span class="${character.status.toLowerCase()}"></span>
                <span>Nombre: ${character.name}</span>
                <span>Especie: ${character.species}</span>
                <span>Género: ${character.gender}</span>
                <span>Origen: ${character.origin.name}</span>
                <span>Localización: ${character.location.name}</span>

            </article>
        `)

        const main = document.querySelector("main");

        main.append(article);

    })

})
