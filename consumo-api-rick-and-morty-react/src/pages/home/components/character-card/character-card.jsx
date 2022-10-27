import "./character-card.css"
import React from "react";

export const Character = ({ character }) => {
    return (
        <article className="card">
            <div className="card-image">
                <img src={character.image} alt={character.name} />
            </div>
            <div className="card-content">
                <div className="section-one">
                    <a href={character.url} rel="nofollow noopener noreferrer" target="_blank">
                        <h2>{character.name}</h2>
                    </a>
                    <span><span className={`${character.status.toLowerCase()}
                            status`}></span>{character.status.toLowerCase().charAt(0).toUpperCase() +
                        character.status.toLowerCase().slice(1)} - {character.species}</span>
                </div>
                <div className="section-two">
                    <div className="subsection">
                        <div>
                            <span className="text-bold">Género:</span>
                            <p>{character.gender}</p>
                        </div>
                        <div>
                            <span className="text-bold">Origen:</span>
                            <a href={character.origin.url} rel="nofollow noopener noreferrer"
                                target="_blank">{character.origin.name}</a>
                        </div>
                        <div>
                            <span className="text-bold">Localización:</span>
                            <a href={character.location.url} rel="nofollow noopener noreferrer"
                                target="_blank">{character.location.name}</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    );
}