import React from 'react';
import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import Service from "./pages/Service";
import Habitat from "./pages/Habitat";
import Animal from "./pages/Animal";
import About from "./pages/About";
import Contact from "./pages/Contact";
import Error from "./pages/_utils/Error";
import ErrorBoundary from "./components/ErrorBoundary";

const App = () => {
    return (
        <BrowserRouter>
            <ErrorBoundary>
                <div className="App">
                    <Routes>
                        <Route index element={<Home/>}/>

                        <Route path="/" element={<Home/>}/>
                        <Route path="/service" element={<Service/>}/>
                        <Route path="/habitat" element={<Habitat/>}/>
                        <Route path="/animal" element={<Animal/>}/>
                        <Route path="/about" element={<About/>}/>
                        <Route path="/contact" element={<Contact/>}/>
                        <Route path="/admin" action="/login"/>

                        <Route path="*" element={<Error/>}/>

                    </Routes>
                </div>
            </ErrorBoundary>
        </BrowserRouter>
    )
        ;
};
export default App;