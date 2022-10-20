const promises = () => {
    fetch('https://rickandmortyapi.com/api/character')
        .then(response => response.json())
        .then(data => {
            data.results.forEach(character => {
                console.log(character.name)
            });
        })
        .catch(error => alert("Se produjo un error"))
}

const saludar = (message) => {
    alert(message);
}

const callbacksAsyncAwait = async (fnSaludar) => {
    try {
        const data = await fetch('https://rickandmortyapi.com/api/character');
        const response = await data.json();
        response.results.forEach(character => {
            console.log(character.name)
        });
        fnSaludar("Proceso finalizado");
    } catch (error) {
        console.log("Se presentó un error")
    }
}

const init = () => {
    callbacksAsyncAwait(saludar);
}