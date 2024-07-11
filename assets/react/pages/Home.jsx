import React from 'react';
import HeroSection from "../components/public/HeroSection";
import HeadingSection from "../components/public/HeadingSection";
import CardSection from "../components/public/CardSection";
import TestimonialSection from "../components/public/TestimonialSection";

export default function Home() {
    return (
        <main className="flex min-h-screen flex-col">
            <HeroSection/>
            <HeadingSection/>
            <CardSection/>
            <TestimonialSection/>
        </main>
    );
}