import axios from "axios";
import React, { useEffect, useState } from "react";
import { alert } from "../../components/Toast";

const Form = () => {
    const [title, setTitle] = useState('')
    const [description, setDescription] = useState('')
    const [price, setPrice] = useState('')
    const [image, setImage] = useState(null)
    const [stock, setStock] = useState(0)
    const [categoryId, setCategoryId] = useState('')

    const [category, setCategory] = useState([])

    const handleSubmit = async (e) => {
        e.preventDefault()
        try {
            await axios.post(`http://192.168.18.93:3030/produk/`, {
                title: title,
                description: description,
                price: price,
                image: image,
                stock: stock,
                categoryId: categoryId,
            })
            alert("Berhasil!", "Category Berhasil Di Tambahkan!", "success");
            setTitle('')
        } catch (error) {
            console.log(error)
        }
    }

    const fetchData = async () => {
        try {
            const response = await axios.get(`http://192.168.18.93:3030/category/`)
            setCategory(response.data)
        } catch (error) {
            console.log(error)
        }
    }

    useEffect(() => {
        fetchData()
    },[])

    return (
        <form className="grid gap-6 mb-6" onSubmit={handleSubmit}>
            <div>
                <label
                    htmlFor="title"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >
                    Create New Product
                </label>
                <input
                    type="text"
                    id="title"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Title"
                    value={title}
                    onChange={(e) => setTitle(e.target.value)}
                    required
                />
            </div>
            <div>
                <label
                    htmlFor="description"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >

                </label>
                <input
                    type="text"
                    id="description"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Description"
                    value={description}
                    onChange={(e) => setDescription(e.target.value)}
                    required
                />
            </div>
            <div>
                <label
                    htmlFor="price"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >

                </label>
                <input
                    type="text"
                    id="price"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Price"
                    value={price}
                    onChange={(e) => setPrice(e.target.value)}
                    required
                />
            </div>
            <div>
                <label
                    htmlFor="image"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >

                </label>
                <input
                    type="file"
                    id="image"
                    className="bg-gray-50 border border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Image"
                    value={image}
                    onChange={(e) => setImage(e.target.files[0])}
                    required
                />
            </div>
            <div>
                <label
                    htmlFor="stock"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >

                </label>
                <input
                    type="text"
                    id="stock"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Stock"
                    value={stock}
                    onChange={(e) => setStock(e.target.value)}
                    required
                />
            </div>
            <div>
                <label
                    htmlFor="categoryId"
                    className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                >

                </label>
                <select value={categoryId} onChange={(e) => setCategoryId(e.target.value)}>
                    {category.map((item,index) => (
                        <option value={item.id} key={index}>{item.name}</option>
                    ))}
                </select>
            </div>
            <div className="flex justify-between items-center">
                <button
                    type="button"
                    className="text-red-700 hover:bg-red-500 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium text-sm px-5 py-2.5 text-center"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center"
                >
                    Submit
                </button>
            </div>
        </form>
    );
};

export default Form;
