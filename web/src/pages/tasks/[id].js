"use client";

import AppLayout from "@/components/Layouts/AppLayout";
import Head from "next/head";
import { useContext, useEffect, useState } from "react";
import { TokenContext } from "@/contexts/TokenContext";
import axios from "@/libs/axios";

const Task = ({ id }) => {
    const [task, setTask] = useState([]);
    const { token } = useContext(TokenContext);

    useEffect(() => {
        axios
            .get(`/api/v1/tasks/${id}`, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            })
            .then((response) => {
                setTask(response.data.tasks);
            })
            .catch((error) => console.log(error));
    }, []);

    if (task.id === undefined) {
        return null;
    }

    return (
        <AppLayout
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
            <Head>
                <title>Laravel - Dashboard</title>
            </Head>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="pt-4">
                        <h1>{task.attributes.title}</h1>
                        <p className="text-sm">{task.attributes.body}</p>
                        <div className="text-xs">
                            Created at: {task.attributes.created_at}
                        </div>
                        <div className="text-xs">
                            Estimated time: {task.attributes.time_estimated}
                        </div>
                        <div className="text-xs">
                            Time spent: {task.attributes.time_spent}
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
};

export default Task;

export async function getServerSidePaths() {
    const response = await axios.get("/api/v1/tasks");

    return {
        fallback: false,
        paths: response.data.data.map((task) => ({
            params: {
                id: task.id,
            },
        })),
    };
}

export async function getServerSideProps({ params }) {
    return {
        props: {
            id: params.id,
        },
    };
}
