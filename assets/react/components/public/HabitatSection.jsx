import React, { useEffect } from 'react';
import { useFetch } from "../hooks/useFetch";
import { Carousel } from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import {useNavigate} from "react-router-dom";

const HabitatSection = () => {
    const { items: habitats, load, loading } = useFetch('/api/habitat');
    const navigate = useNavigate();

    useEffect(() => {
        load();
    }, [load]);

    useEffect(() => {
        console.log(habitats);
    }, [habitats]);

    const handleCardClick = (id) => {
        navigate(`/habitat/${id}`);
    };


    return (
        <section className="bg-bgColor">
            <div className="my-40 mx-auto max-w-7xl">
                <div className="flex flex-col justify-center items-center text-center my-auto gap-16">
                    <h2 className="text-darkGrey lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile">
                        Découvrez tous nos habitats
                    </h2>
                    <p className="text-darkGrey lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile mx-30 hidden sm:block">
                        Située à l'entrée du Zoo Arcadia et ouverte toute l'année, la boutique vous propose de
                        nombreuses références de produits : peluches, rayon libraire, jeux, textiles et papeterie.
                    </p>
                </div>
                <div className="mt-24 flex justify-center">
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 grid-cols-1 gap-6">
                        {loading && <p>Chargement...</p>}
                        {!loading && habitats.length > 0 ? (
                            habitats.map((habitat, index) => {
                                const filteredImages = habitat.images
                                    ? habitat.images.filter(image => image.priority === 2)
                                    : [];

                                return (
                                    <div key={index}
                                         className="bg-bgColor2 rounded-lg shadow p-4 transform transition-transform hover:-translate-y-1 max-w-xs mx-auto"
                                         onClick={() => handleCardClick(habitat.id)}
                                    >
                                        <h3 className="text-start text-arcadia lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile">{habitat.name}</h3>
                                        {filteredImages.length > 0 ? (
                                            <Carousel
                                                autoPlay
                                                interval={6000}
                                                infiniteLoop
                                                showIndicators={true}
                                                showStatus={false}
                                                showArrows={true}
                                                showThumbs={false}
                                                className="w-full"
                                            >
                                                {filteredImages.map((image, idx) => (
                                                    <div key={idx} className="flex justify-center items-center">
                                                        <img
                                                            className="max-w-full h-auto sm:object-cover object-cover"
                                                            src={`/images/${image.path}`}
                                                            alt={image.description || 'Image de l\'habitat'}
                                                        />
                                                    </div>
                                                ))}
                                            </Carousel>
                                        ) : (
                                            <p>Aucune image disponible</p>
                                        )}
                                    </div>
                                );
                            })
                        ) : (
                            !loading && <p>Aucun habitat trouvé.</p>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default HabitatSection;


