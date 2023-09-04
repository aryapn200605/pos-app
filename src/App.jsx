import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Home from "./pages/Home";
import POS from "./pages/POS";
import Users from "./pages/Users";
import Items from "./pages/Items";
import PageNotFound from "./pages/PageNotFound";
import Categories from "./pages/categories/Page";
import Products from "./pages/products/Page";

function App() {
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/pos" element={<POS />} />
          <Route path="/users" element={<Users />} />
          <Route path="/categories" element={<Categories />} />
          <Route path="/items" element={<Items />} />
          <Route path="/products" element={<Products />} />
          <Route path="*" element={<PageNotFound />} />
        </Routes>
      </BrowserRouter>
    </>
  );
}

export default App;
