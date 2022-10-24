import React, { useState, useEffect, Fragment } from "react";
import { Character } from "./components/character-card/character-card";
import "./buttons.css";

export const Home = () => {
    const [ characters, setCharacters ] = useState([]);
    const [ currentPage, setCurrentPage ] = useState(1);

    useEffect(() => {
        const handleGetData = async () => {
            const response = await fetch(`https://rickandmortyapi.com/api/character/?page=${currentPage}`);
            const data = await response.json();
            setCharacters(data.results);
        }

        document.getElementById("prev-button").disabled = currentPage === 1 ? true : false;
        document.getElementById("next-button").disabled = currentPage === 42 ? true : false;

        handleGetData();
    }, [currentPage]);
    
    const handlePrevPage = () => {
        if (currentPage > 1) setCurrentPage(currentPage - 1);
    }
    
    const handleNextPage = () => {
        if (currentPage < 42) setCurrentPage(currentPage + 1);
    }

    return (
        <Fragment>
            <section className="buttons-container">
                <div className="center-buttons">
                    <button type="button" id="prev-button" className="button" onClick={ handlePrevPage }>&larr; Prev</button>
                    <button type="button" id="next-button" className="button" onClick={ handleNextPage }>Next &rarr;</button>
                </div>
            </section>
            <section className="container">
                {
                    characters.map((character) => {
                        return <Character key={character.id} character={character} />
                    })
                }
            </section>
        </Fragment>
    );
}