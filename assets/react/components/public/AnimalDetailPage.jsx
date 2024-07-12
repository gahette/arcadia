import React, { useEffect, useState } from 'react';
import {useNavigate, useParams} from 'react-router-dom';
import { useFetch } from "../hooks/useFetch";
import { Carousel } from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css";

const AnimalDetailPage = () => {
    const { id } = useParams();
    const { items: animals, load } = useFetch('/api/animal');
    const [animal, setAnimal] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        load();
    }, [load]);

    useEffect(() => {
        if (animals.length > 0) {
            const selectedAnimal = animals.find(h => h.id === parseInt(id, 10));
            setAnimal(selectedAnimal);
        }
    }, [animals, id]);

    const handleGoBack = () => {
        navigate('/animal');
    };

    if (!animal) {
        return <p>Chargement des détails...</p>;
    }

    return (
        <div className="container mx-auto p-4">
            <button
                onClick={handleGoBack}
                className="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
            >
                Retour à la liste des animaux
            </button>
            <h2 className="text-2xl font-bold mb-4">{animal.name}</h2>
            <div className="mb-4">
                {animal.images && animal.images.length > 0 ? (
                    <Carousel
                        autoPlay
                        interval={6000}
                        infiniteLoop
                        showIndicators={true}
                        showStatus={false}
                        showArrows={true}
                        showThumbs={false}
                    >
                        {animal.images.map((image, index) => (
                            <div key={index} className="flex justify-center items-center">
                                <img
                                    className="max-w-full  h-full max-h-96 w-auto object-contain"
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
            <p>{animal.description}</p>
        </div>
    );
};

export default AnimalDetailPage;