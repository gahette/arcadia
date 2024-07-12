import React from 'react';

const HeadingSection = () => {
    return (
        <section className='inset-0 bg-bgColor'>
            <h2 className='m-6 text-center lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile text-primaryText'>Une journée exceptionnelle vous attend</h2>
            <p className='m-6 lg:mx-36 sm:mx-20 text-center lg:text-pDesktop sm:text-pTablet text-pMobile text-dark'>Découvrez une faune étonnante, apprenez comment nous protégeons son avenir et partagez des souvenirs incroyables de notre monde naturel bondissant, rugissant et criard.</p>
        </section>
    );
};

export default HeadingSection;