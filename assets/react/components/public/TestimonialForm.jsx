import React, { useState } from 'react';
import { useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup"
import * as yup from "yup"
import { Navigate } from "react-router-dom";
import InputField from "./InputField";
import TextareaField from "./TextareaField";
import { usePost } from "../hooks/useFetch";

const schema = yup
    .object({
        content: yup
            .string()
            .required("Vous devez entrer un témoignage"),
        is_visible: yup
            .boolean()
            .default(false),
        pseudo: yup
            .string()
            .required("Vous devez entrer un nom d'utilisateur")
            .min(3, "Vous devez entrer au moins 3 caractères"),
    })
    .required()

function TestimonialForm() {
    const {
        register,
        formState: { errors, isSubmitSuccessful },
        handleSubmit,
    } = useForm({
        mode: "onTouched",
        resolver: yupResolver(schema),
    });

    const { loading, errors: fetchErrors, load } = usePost('/api/testimonial', 'POST', (response) => {
        if (response) {

        }
    });

    const [redirect, setRedirect] = useState(false);
    const [showSuccessMessage, setShowSuccessMessage] = useState(false)

    const onSubmit = async (data) => {
        const formData = {
            ...data,
            is_visible: data.is_visible === undefined || data.is_visible === null ? 0 : data.is_visible,
        };
        try {
            await load(formData);
            setShowSuccessMessage(true);
            setTimeout(() => {
                setRedirect(true);
            }, 2000);
        } catch (error) {

        }
    };

    if (redirect && isSubmitSuccessful) {

        return <Navigate to="/" />;
    }

    return (
        <section className="bg-bgColor">
            <div className="my-32 md:pt-32 container mx-auto">
                <div className="flex flex-col justify-between text-center text-primaryText my-auto mt-32 gap-16">
                    <p className="lg:text-h2Desktop sm:text-h2Tablet text-h2Mobile mx-30 sm:block">Votre avis nous intéresse !</p>
                </div>

                <div className="flex flex-col items-center justify-center mt-24">
                    <form onSubmit={handleSubmit(onSubmit)}>
                        <div className="flex-column space-y-10">
                            <div>
                                <TextareaField
                                    label="Votre témoignage"
                                    name="content"
                                    register={register}
                                    errors={errors}
                                    placeholder="Laisser votre commentaire ici ..."
                                />
                                <p className='text-footer text-darkGrey'>Les commentaires non conformes à notre code de conduite seront modérés.</p>
                            </div>

                            <InputField
                                label="Nom ou pseudo"
                                name="pseudo"
                                type="text"
                                register={register}
                                errors={errors}
                                placeholder="John Doe"
                            />

                            <input
                                type="hidden"
                                id="is_visible"
                                name="is_visible"
                                {...register("is_visible")}
                                defaultValue={0}
                            />
                        </div>
                        {showSuccessMessage && (
                            <div className="mb-4 text-darkGrey text-center border rounded-lg bg-bgColor p-2.5">
                                Merci pour votre témoignage !
                            </div>
                        )}
                        {fetchErrors && (
                            <div className="mb-4 text-red-600">
                                {fetchErrors.message}
                            </div>
                        )}
                        <button
                            type="submit"
                            disabled={loading}
                            className="px-5 py-3 bg-arcadia rounded-lg border border-arcadia hover:bg-bgColor2 hover:text-arcadia text-bgColor2 lg:text-buttonDesktop sm:text-buttonTablet w-auto text-center text-buttonMobile">
                            <p>Envoyer</p>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    );
}

export default TestimonialForm;
