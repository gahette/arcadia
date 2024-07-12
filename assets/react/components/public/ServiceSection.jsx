import React, { useEffect } from 'react';
import { useFetch } from "../hooks/useFetch";

const ServiceSection = () => {
    const { items: services, load, loading } = useFetch('/api/service');

    useEffect(() => {
        const fetchData = async () => {
            await load();
        };
        fetchData();
    }, [load]);

    return (
        <section className="bg-bgColor">
            <div className="my-40 mx-auto max-w-7xl">
                <div className="flex flex-col justify-center items-center text-center my-auto gap-16">
                    <h2 className="text-darkGrey lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile">
                        Découvrez tous nos services
                    </h2>
                    <p className="text-darkGrey lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile mx-30 hidden sm:block">
                        Située à l'entrée du Zoo Arcadia et ouverte toute l'année, la boutique vous propose de
                        nombreuses références de produits : peluches, rayon libraire, jeux, textiles et papeterie.
                    </p>
                </div>
                <div className="mt-24 flex justify-center">
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 grid-cols-1 gap-6">
                        {loading && 'Chargement...'}
                        {!loading && services.length > 0 ? (
                            services.map((service, index) => (
                                <div key={index} className="bg-bgColor2 rounded-lg shadow p-4 transform transition-transform hover:-translate-y-1 max-w-xs mx-auto">
                                    <div className="flex-col justify-start space-y-4">
                                        <div className="text-start text-arcadia lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile">
                                            {service.name}
                                        </div>
                                        <div
                                            className="text-start text-black lg:text-cardTablet sm:text-cardTablet text-cardMobile"
                                            dangerouslySetInnerHTML={{ __html: service.description }}
                                        />
                                    </div>
                                </div>
                            ))
                        ) : (
                            <p className="text-center p-4">Aucun service visible pour le moment.</p>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
};

export default ServiceSection;


