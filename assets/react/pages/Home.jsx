import React from 'react';
import HeroSection from "../components/public/HeroSection";
import HeadingSection from "../components/public/HeadingSection";

export default function Home() {
    return (
        <main className="flex min-h-screen flex-col">
            <HeroSection/>
            <HeadingSection/>
        </main>
    );
}