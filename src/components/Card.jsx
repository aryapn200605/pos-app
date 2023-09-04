import React from 'react'

const Card = (props) => {
    return (
        <>
            <div style={style} className={`col-span-${props.col} block ${props.max-screen} p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700`}>
                <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{props.header}</h5>
                <p className="font-normal text-gray-700 dark:text-gray-400">{props.data}</p>
            </div>
        </>
    )
}

const style = {
    marginBottom: '20px',
}

export default Card