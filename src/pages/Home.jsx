import React, { useEffect, useState } from "react";
import Highcharts from 'highcharts';
import HighchartsReact from 'highcharts-react-official';
import Layouts from "../components/Layouts";
import axios from "axios";
import Card from "../components/Card";

const Home = () => {
  const [allOrder, setAllOrder] = useState(0)

  const [date, setDate] = useState('')

  const handleMonthChange = async (month) => {
    const response = await axios.get(`http://192.168.18.93:3030/dashboard/day/${month}`)
    console.log(response.data)
  }

  const fetchData = async () => {
    try {
      const responseAllOrder = await axios.get(`http://192.168.18.93:3030/dashboard/order`)
      setAllOrder(responseAllOrder.data)
    } catch (error) {
      console.log(error)
    }
  }

  useEffect(() => {
    fetchData()
  }, [])

  const options = {
    chart: {
      type: 'line'
    },
    title: {
      text: 'Grafik Penjualan Perhari'
    },
    series: [{
      name: 'Penjualan Perhari',
      data: [1, 2, 3, 4, 5]
    }]
  };

  return (
    <>
      <Layouts>
        <input type="month" className="bg-gray-50 border border-gray-300 mb-10 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Pilih Chart Hari Berdasarkan Perbulan" value={date} onChange={(e) => handleMonthChange(e.target.value)} />
          <Card col="3" data={allOrder}  header="All Success Order" max-screen="max-w-screen-2xl" />
        <HighchartsReact highcharts={Highcharts} options={options} />
      </Layouts>
    </>
  );
};

export default Home;
