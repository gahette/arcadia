import React, { useEffect, useState } from 'react';
import {useNavigate, useParams} from 'react-router-dom';
import { useFetch } from "../hooks/useFetch";
import { Carousel } from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css";

const HabitatDetailPage = () => {
    const { id } = useParams();
    const { items: habitats, load } = useFetch('/api/habitat');
    const [habitat, setHabitat] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        load();
    }, [load]);

    useEffect(() => {
        if (habitats.length > 0) {
            const selectedHabitat = habitats.find(h => h.id === parseInt(id, 10));
            setHabitat(selectedHabitat);
        }
    }, [habitats, id]);

    const handleGoBack = () => {
        navigate('/habitat');
    };

    if (!habitat) {
        return <p>Chargement des détails...</p>;
    }

    return (
        <div className="container mx-auto p-4">
            <button
                onClick={handleGoBack}
                className="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
            >
                Retour à la liste des habitats
            </button>
            <h2 className="text-2xl font-bold mb-4">{habitat.name}</h2>
            <div className="mb-4">
                {habitat.images && habitat.images.length > 0 ? (
                    <Carousel
                        autoPlay
                        interval={6000}
                        infiniteLoop
                        showIndicators={true}
                        showStatus={false}
                        showArrows={true}
                        showThumbs={false}
                    >
                        {habitat.images.map((image, index) => (
                            <div key={index} className="flex justify-center items-center">
                                <img
                                    className="max-w-full  h-full max-h-96 w-auto object-contain"
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
            <p>{habitat.description}</p>
        </div>
    );
};

export default HabitatDetailPage;
