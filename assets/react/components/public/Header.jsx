import React, {useEffect, useRef, useState} from 'react';
import {Link, NavLink} from "react-router-dom";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faBars, faXmark} from "@fortawesome/free-solid-svg-icons";

const navlink = [
    {title: 'Accueil', id: '/'},
    {title: 'Services', id: '/service'},
    {title: 'Habitats', id: '/habitat'},
    {title: 'Animaux', id: '/animal'},
    {title: 'À propos', id: '/about'},
    {title: 'Contact', id: '/contact'},
];

const Header = () => {
    const [toggle, setToggle] = useState(false);
    const menuRef = useRef(null);
    const buttonRef = useRef(null);

    useEffect(() => {
        const handleClickOutside = (e) => {
            if (menuRef.current && !menuRef.current.contains(e.target) && buttonRef.current && !buttonRef.current.contains(e.target)) {
                setToggle(false);
            }
        };
        document.addEventListener("mousedown", handleClickOutside);
        return () => {
            document.removeEventListener("mousedown", handleClickOutside);
        };
    }, []);

    const handleToggle = (e) => {
        e.stopPropagation();
        setToggle(prevToggle => !prevToggle);
    };

    const closeMenu = () => {
        setToggle(false);
    };

    return (
        <header>
            <nav className="mt-12 m-auto bg-bgColor2 w-10/12 border-2 rounded-lg z-10 opacity-75 relative drop-shadow-[0_4px_6px_rgba(0,0,0,0.25)]">
                <div className="flex flex-wrap items-center justify-between lg:mx-6  sm:mx-16 p-2 cursor-pointer">
                    <div
                        className="flex flex-wrap items-center 2xl:text-logoDesktop xl:text-logoTablet sm:text-logoMobile text-primaryText">
                        <Link to='/'>ARCADIA</Link>
                    </div>

                    <div className="mobile-menu block relative lg:hidden" onClick={handleToggle} ref={buttonRef}>
                        <button
                            className="flex items-center px-3 py-2 text-black hover:text-grey">
                            <FontAwesomeIcon icon={toggle ? faXmark : faBars} className="h-5 w-5"/>
                        </button>

                        {toggle && (
                            <div
                                className="absolute top-full -left-16 mt-6 w-36 bg-black-gradient rounded-xl z-20">
                                <ul ref={menuRef}
                                    className="list-none flex justify-center items-center flex-1 flex-col bg-white p-3 rounded-xl">
                                    {navlink.map((link, i) => (
                                        <li key={i} className="block text-nav text-grey hover:text-red-600">
                                            <NavLink to={link.id}
                                                     className={'[&.active]:text-black [&.active]:border-b-2 border-black py-1'}
                                                     onClick={closeMenu}>
                                                {link.title}
                                            </NavLink>
                                        </li>
                                    ))}
                                    <li className="block sm:hidden">
                                        <a href={"/admin"}
                                           className="block text-nav text-grey hover:text-red-600">
                                            Connexion
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        )}
                    </div>

                    <div className="menu hidden lg:block md:w-auto" id="navbar">
                        <ul className="items-center flex p-8 md:p-0 md:flex-row xl:space-x-12 md:space-x-10">
                            {navlink.map((link, i) => (
                                <li key={i}
                                    className="block pl-3 pr-4 font-bold text-slate-400 xl:text-base lg:text-sm md:text-xs rounded md:p-0 hover:text-red-600">
                                    <NavLink to={link.id}
                                             className={'[&.active]:text-black [&.active]:border-b-2 border-black py-1'}>
                                        {link.title}
                                    </NavLink>
                                </li>
                            ))}
                        </ul>
                    </div>

                    <div className="hidden sm:block lg:space-y-1 md:space-y-2">
                        <a href={"/admin"}
                           className="2xl:text-buttonDesktop xl:text-buttonTablet text-black px-5 inline-block py-3 w-full sm:w-fit rounded-lg border border-arcadia hover:bg-arcadia hover:text-white">
                            Connexion
                        </a>
                    </div>
                </div>
            </nav>
        </header>
    );
};

export default Header;
