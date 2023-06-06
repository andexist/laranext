import axios from "@/libs/axios";
import { useEffect, useState } from "react";
import Link from "next/link";

const Tasks = () => {
    const [tasks, setTasks] = useState([]);

    useEffect(() => {
        axios
            .get("/api/v1/tasks")
            .then((response) => {
                setTasks(response.data.data);
            })
            .catch((error) => {
                console.log(error);
            });
    }, []);

    return (
        <div className="container m-auto grid grid-cols-3 gap-4">
            {tasks.map((task) => (
                <div className="bg-gray-200 p-4 rounded-lg" key={task.id}>
                    <h1 className="text-2sm font-bold p-2">
                        <Link href={`/tasks/${task.id}`}>
                            {task.attributes.title}
                        </Link>
                    </h1>
                    <span className="text-xs p-2">
                        Last modified: {task.attributes.updated_at}
                    </span>
                    <p className="bg-gray-100 p-4 text-sm m-2">
                        {task.attributes.body.slice(0, 100)}...
                    </p>
                </div>
            ))}
        </div>
    );
};

export default Tasks;
