import React from "react";
import ContactForm from "./ContactForm";

function ContactSection() {
    return (
        <section className="bg-bgColor">
            <div className="my-40 mx-auto max-w-7xl">
                <div
                    className="flex flex-col justify-between text-center">
                    <h2 className="text-darkGrey lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile">Contactez-nous !</h2>
                    <h3 className="text-darkGrey lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile mx-30 hidden sm:block">
                        <div>
                            <p>Par téléphone : 00 00 00 00 00</p>
                            <p>Par email : arcadia@broceliande.fr</p>
                            <p>Adresse postale : Forêt de Brocéliande</p>
                            <p>35380 Ville de Bretagne</p>
                        </div>
                    </h3>
                    <div className="mt-24">
                        <h2 className="text-darkGrey lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile">Ou bien
                            remplissez le
                            formulaire</h2>
                        <h3 className="text-darkGrey lg:text-h3Desktop sm:text-h3Tablet text-h3Mobile mx-30 hidden sm:block">
                            Vos demandes seront traitées dans les plus bref délai</h3>
                    </div>
                </div>
            </div>
            <ContactForm/>
        </section>
    )

}

export default ContactSection;