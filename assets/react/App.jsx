import React from 'react';
import {BrowserRouter, Route, Routes} from "react-router-dom";
import {About, Animal, Contact, Habitat, Home, Layout, Service, Testimonials} from "./pages";
import Error from "./pages/_utils/Error";
import ErrorBoundary from "./components/ErrorBoundary";
import HabitatDetailPage from "./components/public/HabitatDetailPage";
import AnimalDetailPage from "./components/public/AnimalDetailPage";

const App = () => {
    return (
        <BrowserRouter>
            <ErrorBoundary>
                <div className="App">
                    <Routes>

                        <Route element={<Layout/>}>

                            <Route index element={<Home/>}/>

                            <Route path="/" element={<Home/>}/>
                            <Route path="/service" element={<Service/>}/>
                            <Route path="/habitat" element={<Habitat/>}/>

                            <Route path="/animal" element={<Animal/>}/>
                            <Route path="/about" element={<About/>}/>
                            <Route path="/contact" element={<Contact/>}/>


                        </Route>
                        <Route>
                            <Route path="/habitat/:id" element={<HabitatDetailPage />} />
                            <Route path="/animal/:id" element={<AnimalDetailPage />} />
                            <Route path="/testimonial" element={<Testimonials/>}/>
                            <Route path="/admin" action="/login"/>
                            <Route path="*" element={<Error/>}/>
                        </Route>

                    </Routes>
                </div>
            </ErrorBoundary>
        </BrowserRouter>
    );
};
export default App;