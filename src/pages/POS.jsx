import React, { useState, useEffect } from "react";
import Layouts from "../components/Layouts";
import { formatRupiah } from "../components/Format";
import { alert } from "../components/Toast";
import notFound from "/images/notFoundImage.jpg";
import axios from "axios";

const Home = () => {
  const [items, setItems] = useState([]);
  const buttonTitles = ["All", "Makanan", "Minuman"];
  const [activeButton, setActiveButton] = useState(buttonTitles[0]);
  const [cartItems, setCartItems] = useState([]);

  const fetchByCategory = async (title) => {
    setActiveButton(title);

    if (title === "All") {
      const response = await axios.get("http://192.168.18.93:3030/produk");
      setItems(response.data);
    } else {
      const response = await axios.get(
        `http://192.168.18.93:3030/produk/category/${title}`
      );
      setItems(response.data);
    }
  };

  const fetchData = async () => {
    const responseItem = await axios.get("http://192.168.18.93:3030/produk");
    setItems(responseItem.data);
  };

  useEffect(() => {
    fetchData();
  }, []);

  const addToCart = (item) => {
    const totalCartItemQty = cartItems.reduce(
      (totalQty, cartItem) => totalQty + cartItem.qty,
      0
    );

    if (totalCartItemQty + 1 > item.stock) {
      alert("Oops..!", "Stock tidak mencukupi", "warning");
      return;
    }

    const existingCartItem = cartItems.find(
      (cartItem) => cartItem.id === item.id
    );

    if (existingCartItem) {
      const updatedCartItems = cartItems.map((cartItem) =>
        cartItem.id === item.id
          ? { ...cartItem, qty: cartItem.qty + 1 }
          : cartItem
      );
      setCartItems(updatedCartItems);
    } else {
      const newItem = { ...item, qty: 1 };
      setCartItems((prevCartItems) => [...prevCartItems, newItem]);
    }
  };

  const totalPrice = cartItems.reduce(
    (total, cartItem) => total + cartItem.price * cartItem.qty,
    0
  );

  return (
    <Layouts>
      <div className="flex overflow-hidden">
        <div className="w-3/5 h-[90vh] bg-white mb-4 p-4 overflow-x-auto">
          <input
            type="text"
            id="first_name"
            className="bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Search for Item"
          />
          <hr className="my-2" />
          <div className="flex justify-start">
            {buttonTitles.map((title) => (
              <button
                key={title}
                className={`py-1 px-4 rounded border border-gray-300 text-black mx-1 ${activeButton === title ? "bg-gray-300" : "bg-white"
                  }`}
                onClick={() => fetchByCategory(title)}
              >
                {title}
              </button>
            ))}
          </div>
          <hr className="my-2" />
          <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
            {items.map((item) => (
              <div
                key={item.id}
                className="bg-gray-100 p-2 rounded cursor-pointer"
                onClick={() => addToCart(item)}
              >
                <div className="text-center text-black text-sm">
                  <img
                    src={item.image && notFound}
                    alt={item.title}
                    className="w-20 h-auto mx-auto rounded"
                  />
                  <p className="mt-2">{item.title}</p>
                  <hr />
                  <p className="mt-1">{formatRupiah(item.price)}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
        <div className="w-2/5 h-[90vh] bg-white mb-4 p-4 mr-4 flex flex-col justify-between">
          {/* Konten untuk bagian kanan */}
          <select
            className="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            defaultValue="dine-in"
          >
            <option value="dine-in">Dine In</option>
            <option value="take-away">Take Away</option>
          </select>
          <div className="overflow-x-auto">
            <table className="w-full text-sm text-left text-gray-500">
              <thead className="text-xs text-gray-700 uppercase bg-gray-50 text-center sticky top-0 z-10">
                <tr>
                  <th className="px-4 py-2 w-2">#</th>
                  <th className="px-4 py-2">Item</th>
                  <th className="px-4 py-2">Qty</th>
                  <th className="px-4 py-2">Price</th>
                </tr>
              </thead>
              <tbody>
                {cartItems.map((cartItem, index) => (
                  <tr key={cartItem.id}>
                    <td className="px-4 py-2 text-center">{index + 1}</td>
                    <td className="px-4 py-2">{cartItem.title}</td>
                    <td className="px-4 py-2 text-center">{cartItem.qty}</td>
                    <td className="px-4 py-2 text-right">
                      {formatRupiah(cartItem.price * cartItem.qty)}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
          <div className="mt-auto">
            <hr className="my-2" />
            <div className="flex justify-between">
              <span>Total Sebelum PPN:</span>
              <span className="text-right">{formatRupiah(totalPrice)}</span>
            </div>
            <div className="flex justify-between">
              <span>PPN (10%):</span>
              <span className="text-right">
                {formatRupiah(totalPrice * 0.1)}
              </span>
            </div>
            <div className="flex justify-between font-bold">
              <span>Total Sesudah PPN:</span>
              <span className="text-right">
                {formatRupiah(totalPrice * 1.1)}
              </span>
            </div>
          </div>
          <div className="mt-4 flex justify-between">
            <button className="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4">
              Cancel
            </button>
            <button className="bg-green-400 hover:bg-green-500 text-white font-semibold py-1 px-4">
              Pay
            </button>
          </div>
        </div>
      </div>
    </Layouts>
  );
};

export default Home;
