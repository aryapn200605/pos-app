import React from "react";
import { IconContext } from "react-icons";
import {
  MdFastfood,
  MdCategory,
  MdLogout,
  MdShoppingCart,
  MdHome,
} from "react-icons/md";
import { FaUser } from "react-icons/fa";
import { Link, useLocation } from "react-router-dom";
import sidebarData from "../assets/json/sidebar.json";

const iconMap = {
  MdHome: MdHome,
  MdShoppingCart: MdShoppingCart,
  FaUser: FaUser,
  MdFastfood: MdFastfood,
  MdCategory: MdCategory,
  MdLogout: MdLogout,
};

const Layouts = ({ children }) => {
  const location = useLocation();

  return (
    <>
      <aside
        id="logo-sidebar"
        className="fixed top-0 left-0 z-40 w-24 h-screen bg-gray-50"
        aria-label="Sidebar"
      >
        <div className="h-full px-3 py-4 overflow-hidden flex flex-col items-center">
          <img
            src="https://flowbite.com/docs/images/logo.svg"
            className="h-6 mb-2"
            alt="Flowbite Logo"
          />
          <span className="text-xl font-semibold whitespace-nowrap dark:text-white">
            POS App
          </span>
          <ul className="space-y-2 font-medium mt-5">
            {sidebarData.map((item, index) => {
              const IconComponent = iconMap[item.icon];
              const isActive = location.pathname === item.path;
              return (
                <li key={index}>
                  <Link
                    to={item.path}
                    className={`flex flex-col items-center p-2 rounded-lg dark:text-white hover:bg-gray-100 group transition-colors ${
                      isActive
                        ? "bg-gray-100 dark:bg-gray-700 text-blue-500"
                        : ""
                    }`}
                  >
                    <IconContext.Provider
                      value={{ className: "w-6 h-6" }}
                      className="w-6 h-6"
                    >
                      <IconComponent />
                    </IconContext.Provider>
                    <span className="mt-1 text-sm">{item.name}</span>
                  </Link>
                </li>
              );
            })}
          </ul>
        </div>
      </aside>

      <div className="ml-24 overflow-y-auto">
        <div className="p-4 dark:border-gray-700">
          <div className="mb-2 flex justify-between items-center">
            <p className="text-black font-semibold py-1 text-2xl">
              Toko Kafe Kita Bersama
            </p>
            <div className="flex items-center">
              <p className="flex bg-gray-400 text-white font-semibold py-3 px-4 mr-2">
                <FaUser className="m-auto mr-2" />
                Administrator
              </p>
              <button className="bg-red-400 hover:bg-red-500 text-white font-semibold py-4 px-4">
                <MdLogout />
              </button>
            </div>
          </div>
          {children}
        </div>
      </div>
    </>
  );
};

export default Layouts;
