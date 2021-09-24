import React, {useState} from 'react';
import { CountriesData } from '../Data/CountriesData';
import './form.css';

export default function Form() {

    // let select = document.querySelector('#select');

    const [personType, setPersonType] = useState("");

    const [nationality, setNationality] = useState("");

    function personTypeFunction (e) {

        let select = document.querySelector('#select');

        setPersonType(e.target.value);

        select.children[0].selected = true;
    }

    function nationalityFunction (e) {

        let select = document.querySelector('#select');

        setNationality(e.target.value);

        select.children[0].selected = true;
    }


    return (
        <div>
            <div className="header">
                <h1>Formulario</h1>
            </div>
            <form className="form">
                <div className="fieldContainer">
                    <label className="label" htmlFor="countries">País </label>
                    <select className="dropdown" name="countries" id="countries" defaultValue="">
                    <option onClick={nationalityFunction} value="">Selecciona un país</option>
                        {CountriesData.sort().map((country, index) => {
                            return <option onClick={nationalityFunction} key={index} value={country}>{country}</option>
                        })
                        }
                    </select>
                </div>
                <div className="fieldContainer">
                    <input onClick={personTypeFunction} type="radio" name="person" id="person1" value="fisica"/>
                    <label className="label" htmlFor="person1">Persona física</label>
                    <input onClick={personTypeFunction} type="radio" name="person" id="person2" value="jurídica"/>
                    <label className="label" htmlFor="person2">Persona jurídica</label>
                </div>
                <div className="fieldContainer" id="fisica" style={{display: (personType === "fisica") ? 'block' : 'none'}}>
                    <div className="inputDisplay">
                        <label className="label" htmlFor="name">Nombre</label>
                        <input className="input" type="text" id="name"/>
                    </div>
                    <div className="inputDisplay">
                        <label className="label" htmlFor="surname">Apellidos</label>
                        <input className="input input2" type="text" id="surname"/>
                    </div>
                </div>
                <div className="fieldContainer" id="jurídica" style={{display: (personType === "jurídica") ? 'block' : 'none'}}>
                    <label className="label" htmlFor="societyName">Nombre de la sociedad</label>
                    <input className="input" type="text" id="societyName"/>
                </div>
                <div className="fieldContainer">
                    <select className="dropdown" name="document" id="select" defaultValue="">
                        <option value="" id="firstOption">Identifación</option>
                        <option value="nif" style={{display: (personType === "fisica" && nationality === "España") ? 'block' : 'none'}}>NIF</option>
                        <option value="cif" style={{display: (personType === "jurídica") ? 'block' : 'none'}}>CIF</option>
                        <option value="nie" style={{display: (personType === "fisica" && nationality === "España") ? 'block' : 'none'}}>NIE</option>
                        <option value="passport" style={{display: (personType === "fisica" && nationality !== "España" && nationality !== "") ? 'block' : 'none'}}>PASAPORTE</option>
                    </select>
                    <input className="input" type="text" id="identification" name="identification"/>
                </div>
                <div className="fieldContainer">
                    <button className="button">Enviar</button>
                </div>
            </form>
        </div>
    )
}
