import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, useForm } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton";
import InputError from "@/Components/InputError";
import Chirp from "@/Components/Chirp";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

export default function Index({ auth, chirps }) {
    const { data, setData, post, processing, reset, errors } = useForm({
        message: "",
    });

    const notify = () => toast.success("Chirp Posted!");

    console.log(chirps);

    const submit = (e) => {
        e.preventDefault();
        post(route("chirps.store"));
        notify();
    };
    return (
        <AuthenticatedLayout auth={auth}>
            <Head title="Chirps" />

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form action="" onSubmit={submit}>
                    <textarea
                        placeholder="What's on your mind"
                        className="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        name=""
                        id=""
                        rows="5"
                        onChange={(e) => setData("message", e.target.value)}

                        // onSubmit={}
                    ></textarea>
                    <InputError message={errors.message} className="mt-2" />
                    <PrimaryButton className="mt-4">Chirp</PrimaryButton>
                </form>

                <div className="mt-6 shadow-sm rounded-lg divide-y bg-white">
                    {chirps.map((chirp) => (
                        <Chirp key={chirp.id} chirp={chirp} />
                    ))}
                </div>
            </div>
            <ToastContainer />
        </AuthenticatedLayout>
    );
}
