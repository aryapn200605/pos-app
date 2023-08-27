import axios from "axios";
import React, { useState } from "react";
import { alert } from "../../components/Toast";

const Form = () => {
  const [categoryName, setCategoryName] = useState('')

  const handleSubmit = async (e) => {
    e.preventDefault()
    try {
      await axios.post(`http://localhost:3030/category/`, {
        name: categoryName
      })
      alert("Berhasil!", "Category Berhasil Di Tambahkan!", "success");
      setCategoryName('')
    } catch (error) {
      console.log(error)
    }
  }

  return (
    <form className="grid gap-6 mb-6" onSubmit={handleSubmit}>
      <div>
        <label
          htmlFor="category_name"
          className="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        >
          Create New Category
        </label>
        <input
          type="text"
          id="category_name"
          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          placeholder="Category Name"
          value={categoryName}
          onChange={(e) => setCategoryName(e.target.value)}
          required
        />
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
