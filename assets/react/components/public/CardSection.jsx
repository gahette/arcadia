import React from 'react';
import {Link} from "react-router-dom";

const legendary =
    [
        {title: 'Habitats', text: 'Se connecter au monde naturel', path: 'elephants.jpg', id: '/habitat'},
        {title: 'Nos animaux', text: 'En savoir plus sur nos animaux', path: 'lions.jpg', id: '/animal'},
        {title: 'Nos services', text: 'En savoir plus sur nos services', path: 'train.jpg', id: '/service'},
    ];

const CardSection = () => {
    return (
        <div className='bg-bgColor'>
            <div className="mx-auto separate"></div>
            <h2 className='m-6 text-center lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile text-primaryText'>Explorer
                ARCADIA</h2>
            <div className='xl:mx-28 sm:mx-14 mx-5 mb-20 pt-12 bg-bgColor2 rounded-lg'>
                <ul className='flex flex-wrap rounded-lg justify-center gap-10'>
                    {legendary.map((item, i) => (
                        <li key={i} className='lg:pb-6 sm:pb-12'>
                            <Link to={item.id}>
                                <img
                                    className='rounded-lg object-fit-cover w-[354px] h-[232px]'
                                    src={`./images/homePictures/${item.path}`}
                                    alt={item.path}/>
                                <h3 className='pt-4 lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile text-arcadia'>{item.title}</h3>
                                <p className='text-cardTablet text-black'>{item.text}</p>
                            </Link>
                        </li>
                    ))}
                </ul>

            </div>
        </div>
    );
};

export default CardSection;