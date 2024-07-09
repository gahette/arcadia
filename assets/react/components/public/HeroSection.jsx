import React, {useEffect} from 'react';
import {useFetch} from "../hooks/useFetch";
import {Carousel} from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css"; // Assurez-vous d'importer les styles du carousel

const HeroSection = () => {
    const {items: animals, load, loading} = useFetch('/api/animal');

    useEffect(() => {
        load();
    }, [load]);

    useEffect(() => {
        console.log("Animals data: ", animals);
    }, [animals]);

    return (
        <div className="">
            {loading && 'Chargement...'}
            {!loading && animals.length > 0 ? (
                <Carousel
                    autoPlay
                    interval={6000}
                    infiniteLoop
                    showIndicators={true}
                    showStatus={false}
                    showArrows={false}
                    showThumbs={false}
                >
                    {animals.map((animal, index) => {
                        const filteredImages = animal.images
                            ? animal.images
                                .filter(image => image.priority === 1)
                            : [];

                        return (
                            <div key={index}>
                                {filteredImages.length > 0 ? (
                                    filteredImages.map((image, idx) => (
                                        <img
                                            className="max-w-full max-h-[597px] object-cover"
                                            key={idx}
                                            src={`/images/${image.path}`}
                                            alt={image.description || 'Animal image'}
                                        />
                                    ))
                                ) : (
                                    <p>Aucune image disponible</p>
                                )}
                            </div>
                        );
                    })}
                </Carousel>
            ) : (
                !loading && 'Aucun animal trouvé.'
            )}

            <div className="absolute inset-x-0 top-auto bottom-2/3 sm:top-72 flex flex-col items-center text-bgColor2 lg:items-start lg:text-left">
                <div className="lg:text-h1Desktop sm:text-h1Tablet lg:w-auto lg:ml-32 sm:text-center sm:w-full text-h1Mobile">
                    Venez visiter le zoo ARCADIA
                </div>
                <p className="mt-5 text-pDesktop lg:text-pDesktop sm:text-pTablet sm:text-center sm:w-full lg:w-auto lg:ml-32 hidden md:block">
                    Découvrez le monde de la faune et de la flore au coeur de la forêt de Brocéliande
                </p>
                <button className="lg:ml-32 mt-4 px-5 py-3 bg-arcadia rounded-lg border border-arcadia hover:bg-bgColor2 hover:text-arcadia text-bgColor2 lg:text-buttonDesktop sm:text-buttonTablet w-full w-auto text-center text-buttonMobile">
                    Ouvert tous les jours dès 10h00
                </button>
            </div>
        </div>
    );
};

export default HeroSection;




