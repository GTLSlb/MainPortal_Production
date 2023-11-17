import { PencilIcon } from "@heroicons/react/24/solid";
import { useEffect } from "react";
import { useState } from "react";
const people = [
    {
        name: "Lindsay Walton",
        title: "Front-end Developer",
        department: "Optimization",
        email: "lindsay.walton@example.com",
        role: "Member",
        image: "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    {
        name: "Lindsay Walton",
        title: "Front-end Developer",
        department: "Optimization",
        email: "lindsay.walton@example.com",
        role: "Member",
        image: "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    {
        name: "Lindsay Walton",
        title: "Front-end Developer",
        department: "Optimization",
        email: "lindsay.walton@example.com",
        role: "Member",
        image: "https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
    },
    // More people...
];

export default function EmployeesTable ({employees}){

    const [employeesElements, setEmployeesElements] = useState(employees);

    useEffect(()=>{
        setEmployeesElements(employees)
    },[employees])

    return(
        <div className=" flow-root">
                <div className="mt-2 my-2 -mx-6 overflow-x-auto lg:-mx-8 p-5">
                    <div className="inline-block min-w-full py-2 align-middle sm:px-3 lg:px-5 border rounded-xl shadow bg-white">
                        <table className=" min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th
                                        scope="col"
                                        className="py-2.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-500 sm:pl-0"
                                    >
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-3 py-2.5 text-left text-sm font-semibold text-gray-500"
                                    >
                                        Job Title
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-3 py-2.5 text-left text-sm font-semibold text-gray-500"
                                    >
                                        Status
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-3 py-2.5 text-left text-sm font-semibold text-gray-500"
                                    >
                                        Role
                                    </th>
                                    <th
                                        scope="col"
                                        className="relative py-2.5 pl-3 pr-6 sm:pr-0"
                                    >
                                        <span className="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-gray-200 bg-white">
                                {employeesElements?.map((employee) => (
                                    <tr key={employee.UserId}>
                                        <td className="whitespace-nowrap py-4 pl-6 pr-3 text-sm sm:pl-0">
                                            <div className="flex items-center">
                                                <div className="h-10 w-10 flex-shrink-0">
                                                    <img
                                                        className="h-10 w-10 rounded-full"
                                                        src={employee.Picture}
                                                        alt="pic"
                                                    />
                                                </div>
                                                <div className="ml-4">
                                                    <div className="font-medium text-gray-900">
                                                        {employee.FirstName} {employee.LastName}
                                                    </div>
                                                    <div className="text-gray-500">
                                                        {employee.Email}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div className="text-gray-900">
                                                {employee.RoleName}
                                            </div>
                                            <div className="text-gray-500">
                                                {employee.GroupName}
                                            </div>
                                        </td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span className="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {employee.RoleName}
                                        </td>
                                        <td className="relative whitespace-nowrap py-4 pl-3 pr-6 text-left text-sm font-medium sm:pr-0">
                                            <a
                                                href="#"
                                                className=" text-blue-500 hover:text-blue-900 flex flex-col ji"
                                            >
                                                <PencilIcon className="w-5 h-5 ml-1"/>
                                                Edit
                                                <span className="sr-only">
                                                    , {employee.RoleName}
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    )
}