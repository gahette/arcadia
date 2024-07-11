import React from 'react';
import Header from "../components/public/Header";
import Footer from "../components/public/Footer";
import TestimonialForm from "../components/public/TestimonialForm";

const Testimonials = () => {
    return (
        <main className="flex min-h-screen flex-col">
            <Header/>
            <TestimonialForm/>
            <Footer/>
        </main>
    );
}

export default Testimonials;