import React, {useState} from 'react';
import {useForm} from 'react-hook-form';
import {yupResolver} from '@hookform/resolvers/yup';
import * as yup from 'yup';
import InputField from './InputField';
import TextareaField from "./TextareaField";
import {Navigate} from "react-router-dom";

const schema = yup.object().shape({
    name: yup.string().required('Name is required'),
    email: yup.string().email('Invalid email format').required('Email is required'),
    message: yup.string().required('Message is required'),
});

const ContactForm = () => {
    const {
        register,
        handleSubmit,
        formState: {errors, isSubmitSuccessful}
    } = useForm({
        resolver: yupResolver(schema),
    });

    const [status, setStatus] = useState('');
    const [loading, setLoading] = useState(false);
    const [redirect, setRedirect] = useState(false);
    const [showSuccessMessage, setShowSuccessMessage] = useState(false)

    const onSubmit = async (data) => {
        setLoading(true)
        try {
            const response = await fetch('/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(data),
            });

            if (response.ok) {
                setShowSuccessMessage(true);
                setTimeout(() => {
                    setRedirect(true);
                }, 2000);
            } else {
                setStatus('Error sending message');
            }
        } catch (error) {
            setStatus('Error sending message');
        }
    };


    if (redirect && isSubmitSuccessful) {

        return <Navigate to="/"/>;
    }

    return (
        <div className="flex flex-col items-center justify-center mt-24">
            <form onSubmit={handleSubmit(onSubmit)}>
                <div className="flex-column space-y-10">
                    <InputField
                        label="Votre nom ou pseudo"
                        name="name"
                        type="text"
                        register={register}
                        errors={errors}
                        placeholder="John Doe"
                    />
                    <InputField
                        label="Votre Email"
                        name="email"
                        type="email"
                        register={register}
                        errors={errors}
                        placeholder="Email"
                    />

                    <TextareaField
                        label="Votre message"
                        name="message"
                        register={register}
                        errors={errors}
                        placeholder="Laisser votre commentaire ici ..."
                    />
                </div>

                {showSuccessMessage && (
                    <div className="mb-4 text-darkGrey text-center border rounded-lg bg-bgColor p-2.5">
                        Merci pour votre message !
                    </div>
                )}
                {status && (
                    <div className="mb-4 text-red-600">
                        {status}
                    </div>
                )}
                <button
                    type="submit"
                    disabled={loading}
                    className="px-5 py-3 bg-arcadia rounded-lg border border-arcadia hover:bg-bgColor2 hover:text-arcadia text-bgColor2 lg:text-buttonDesktop sm:text-buttonTablet w-auto text-center text-buttonMobile mb-24">
                    <p>{loading ? 'Envoi...' : 'Envoyer'}</p>
                </button>
            </form>
        </div>
    );
};

export default ContactForm;





