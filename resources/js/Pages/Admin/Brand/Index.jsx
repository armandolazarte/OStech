import React from "react";
import { Head, Link } from "@inertiajs/react";

import AdminLayout from "@/Layouts/AdminLayout";
import Button from "@/Components/Button";

import { IoMdSearch } from "react-icons/io";

const Index = () => {
    return (
        <AdminLayout>
            <Head title="Brand" />

            <h1 className="text-4xl font-bold mb-3">Brand</h1>

            <div className="flex sm:flex-row flex-col sm:items-center sm:justify-between mb-4">
                <div className="bg-white dark:bg-gray-900 sm:mb-0 mb-2 w-auto">
                    <div className="relative mt-1">
                        <div className="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none text-gray-500 dark:text-gray-400">
                            <IoMdSearch />
                        </div>
                        <input
                            type="text"
                            id="table-search"
                            className="block pt-2 ps-10 text-sm text-gray-900 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search here ..."
                        />
                    </div>
                </div>
                <Link href={route("admin.brands.create")}>
                    <Button>Créer un brand</Button>
                </Link>
            </div>
        </AdminLayout>
    );
};

export default Index;
