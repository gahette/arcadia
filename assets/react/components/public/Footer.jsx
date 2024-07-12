import React from 'react';
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faFacebook, faInstagram, faLinkedin, faYoutube} from "@fortawesome/free-brands-svg-icons";
import {Link} from "react-router-dom";

const Footer = () => {
    return (
            <footer className="footer bg-arcadia pb-20">
                <div className="container mx-auto pt-2">
                    <div className="mx-auto separate"></div>
                    <div className="flex lg:flex-row flex-col text-center">
                        <div className="pt-10 lg:space-y-24 lg:flex-initial lg:w-72 flex lg:flex-col lg:items-start sm:items-center justify-center lg:justify-start sm:space-x-24 lg:space-x-0">
                            <p className="lg:text-pDesktop sm:text-pTablet"><Link to='/'>ARCADIA</Link></p>
                            <ul className="sm:flex space-x-5 hidden  sm:block">
                                <li className="list-inline-item"><FontAwesomeIcon icon={faFacebook}
                                                                                  className='w-5 h-5 text-grey'/></li>
                                <li className="list-inline-item"><FontAwesomeIcon icon={faLinkedin}
                                                                                  className='w-5 h-5 text-grey'/></li>
                                <li className="list-inline-item"><FontAwesomeIcon icon={faYoutube}
                                                                                  className='w-5 h-5 text-grey'/></li>
                                <li className="list-inline-item"><FontAwesomeIcon icon={faInstagram}
                                                                                  className='w-5 h-5 text-grey'/></li>
                            </ul>
                        </div>
                        <div className="pt-10 sm:flex sm:flex-wrap sm:justify-between sm:flex-auto">
                            <div className="align-items-start">
                                <p className='text-footer text-black'><Link to='/contact'>Contact</Link></p>
                                <ul className="mt-6">
                                    <li className="text-footer text-darkGrey">Zoo Arcadia</li>
                                    <li className='text-footer text-darkGrey'>Forêt de Brocéliande</li>
                                    <li className='text-footer text-darkGrey'>35380 Ville de Bretagne</li>
                                </ul>
                                <ul className="sm:mt-6">
                                    <li className="text-footer text-darkGrey">+33 (0)2 00 00 00 00</li>
                                    <li className="text-footer text-darkGrey"><a
                                        href='mailto:arcadia@brocéliande.fr'>arcadia@brocéliande.fr</a></li>
                                </ul>
                            </div>
                            <div className="sm:mt-0 mt-6">
                                <p className='text-footer text-black'>Le zoo</p>
                                <ul className="sm:mt-6 sm:space-y-6">
                                    <li className="text-footer text-darkGrey"><Link to='/habitat'>Habitats</Link>
                                    </li>
                                    <li className='text-footer text-darkGrey'><Link to='/animal'>Animaux</Link>
                                    </li>
                                    <li className='text-footer text-darkGrey'><Link to='/service'>Service</Link>
                                    </li>
                                </ul>
                            </div>
                            <div className="sm:mt-0 mt-6">
                                <p className='text-footer text-black'>Brochures</p>
                                <ul className="sm:mt-6 sm:space-y-6">
                                    <li className="text-footer text-darkGrey">Grand public</li>
                                    <li className='text-footer text-darkGrey'>Groupe</li>
                                    <li className='text-footer text-darkGrey'>Scolaire</li>
                                </ul>
                            </div>
                            <div className="sm:mt-0 mt-6 sm:space-y-6">
                                <p className='text-footer text-black'>Recrutement</p>
                                <p className="text-footer text-darkGrey">Rejoignez notre équipe</p>
                            </div>
                        </div>

                    </div>
                </div>

            </footer>
    );
};

export default Footer;