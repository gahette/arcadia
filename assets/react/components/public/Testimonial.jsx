import React, {useEffect, useState} from 'react';
import {useFetch} from '../hooks/useFetch';
import {Carousel} from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css';

const Testimonial = () => {
    const {items: testimonials, load, loading} = useFetch('/api/testimonial');
    const [visibleTestimonials, setVisibleTestimonials] = useState([]);

    useEffect(() => {
        load();
    }, [load]);

    useEffect(() => {
        if (testimonials.length > 0) {
            const filteredTestimonials = testimonials.filter(testimonial => testimonial.is_visible);
            setVisibleTestimonials(filteredTestimonials);
        }
    }, [testimonials]);

    return (
        <section>
            {loading ? (
                'Chargement...'
            ) : (
                <div className="lg:my-5 my-12 mx-auto lg:w-7/12 sm:w-3/5 w-10/12 bg-bgColor2 rounded-lg ">
                    {visibleTestimonials.length > 0 ? (
                        <Carousel
                            interval={6000}
                            autoPlay
                            infiniteLoop
                            showIndicators={false}
                            showStatus={false}
                            showArrows
                            showThumbs={false}
                        >
                            {visibleTestimonials.map((slide, index) => (
                                <div key={index} className="p-4">
                                    <div className="flex-col justify-start m-9 space-y-4">
                                        <div
                                            className="text-start text-primaryText lg:text-textDesktop sm:text-textTablet text-textMobile">{slide.content}</div>
                                        <div
                                            className="text-start text-primaryText lg:text-textDesktop sm:text-textTablet text-textMobile">- {slide.pseudo}</div>
                                    </div>
                                </div>
                            ))}
                        </Carousel>
                    ) : (
                        <p className="text-center p-4">Aucun témoignage visible pour le moment.</p>
                    )}
                </div>
            )}
        </section>
    );
};

export default Testimonial;
