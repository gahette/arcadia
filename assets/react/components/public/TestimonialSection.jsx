import React from "react";
import Testimonial from "./Testimonial";
import {Link} from "react-router-dom";

function TestimonialSection() {
    return (
        <section className="bg-bgColor relative">
            <div className="mx-auto separate"></div>
            <h2 className='mt-6 text-center lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile text-primaryText'>Ce qu'ils
                ont dit !!</h2>
            <Testimonial/>
            <div className="absolute bottom-5 left-1/2 transform -translate-x-1/2">
                <button
                    className="px-5 py-3 bg-arcadia rounded-lg border border-arcadia hover:bg-bgColor2 hover:text-arcadia text-bgColor2 lg:text-buttonDesktop sm:text-buttonTablet w-auto text-center text-buttonMobile">
                    <Link to={'/testimonial'}>Écrire un commentaire</Link>
                </button>
            </div>
        </section>)
}

export default TestimonialSection;