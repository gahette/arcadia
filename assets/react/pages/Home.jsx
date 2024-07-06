import React from 'react';
import Header from "../components/public/Header";

export default function Home() {
    return (
        <>
            <Header/>
            <div className="text-center font-bold lg:text-Logodesktop sm:text-H1tablet text-H1mobile text-primary sm:text-bgColor lg:text-red-700">
                Bienvenue à Arcadia
            </div>
        </>

    );
}


