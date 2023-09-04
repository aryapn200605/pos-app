import React, { useState } from "react";
import Layouts from "../../components/Layouts";
import Tables from "./Table";
import Form from "./Form";

const Page = () => {
  return (
    <>
      <Layouts>
        <div className="overflow-auto">
          <div className="bg-white mb-4 p-4">
            <h2 className="text-4xl font-bold">Product</h2>
            <hr className="my-4" />
            <Form />
          </div>
          <div className="bg-white p-4">
            <Tables  />
          </div>
        </div>
      </Layouts>
    </>
  );
};

export default Page;
