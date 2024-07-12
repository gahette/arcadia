import React from "react";


const InputField = ({ label, name, type, register, errors, placeholder }) => (
    <div className="sm:col-span-2">
        <label htmlFor={name} className="text-footer text-darkGrey">
            {label}
        </label>
        <input
            type={type}
            name={name}
            {...register(name)}
            aria-invalid={errors[name] ? "true" : "false"}
            className="p-2.5 w-full text-darkGrey bg-bgColor2 rounded-lg border border-darkGrey focus:ring-arcadia focus:border-arcadia"
            placeholder={placeholder}
        />
        {errors[name] && (
            <p className="font-medium text-red-600" role="alert">
                {errors[name].message}
            </p>
        )}
    </div>
);

export default InputField;