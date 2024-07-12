import React, { useEffect } from 'react';
import { useFetch } from "../hooks/useFetch";
import { Carousel } from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import {useNavigate} from "react-router-dom";

const AnimalSection = () => {
    const { items: animals, load, loading } = useFetch('/api/animal');
    const navigate = useNavigate();

    useEffect(() => {
        load();
    }, [load]);

    useEffect(() => {
        console.log(animals);
    }, [animals]);

    const incrementConsultationCount = async (id) => {
        try {
            const response = await fetch(`/api/animal/${id}/increment-consultation`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('Failed to increment consultation count');
            }

            console.log('Consultation count incremented successfully');
        } catch (error) {
            console.error('Error incrementing consultation count:', error);
        }
    };

    const handleCardClick = async (id) => {
        try {
            await incrementConsultationCount(id);
            navigate(`/animal/${id}`);
        } catch (error) {
            console.error('Error during handleCardClick:', error);
            alert('An error occurred while navigating to the animal page.');
        }
    };


    return (
        <section className="bg-bgColor">
            <div className="my-40 mx-auto max-w-7xl">
                <div className="flex flex-col justify-center items-center text-center my-auto gap-16">
                    <h2 className="text-darkGrey lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile">
                        Découvrez tous nos animaux
                    </h2>
                    <p className="text-darkGrey lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile mx-30 hidden sm:block">
                        Située à l'entrée du Zoo Arcadia et ouverte toute l'année, la boutique vous propose de
                        nombreuses références de produits : peluches, rayon libraire, jeux, textiles et papeterie.
                    </p>
                </div>
                <div className="mt-24 flex justify-center">
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 grid-cols-1 gap-6">
                        {loading && <p>Chargement...</p>}
                        {!loading && animals.length > 0 ? (
                            animals.map((animal, index) => {
                                const filteredImages = animal.images
                                    ? animal.images.filter(image => image.priority !== 2 && image.priority !== 1)
                                    : [];

                                return (
                                    <div key={index}
                                         className="bg-bgColor2 rounded-lg shadow p-4 transform transition-transform hover:-translate-y-1 max-w-xs mx-auto"
                                         onClick={() => handleCardClick(animal.id)}
                                    >
                                        <h3 className="text-start text-arcadia lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile">{animal.name}</h3>
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
                                                            alt={image.description || 'Image de l\'animal'}
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
                            !loading && <p>Aucun animal trouvé.</p>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default AnimalSection;