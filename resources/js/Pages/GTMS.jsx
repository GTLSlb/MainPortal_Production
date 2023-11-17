import ReactDataGrid from "@inovua/reactdatagrid-community";
import "@inovua/reactdatagrid-community/index.css";
import { useCallback } from "react";
import { useRef } from "react";
import { useState } from "react";

export default function Gtms(props) {
    const people = [
        { id: 1, name: "John McQueen", age: 35, active: true },
        { id: 2, name: "Mary Stones", age: 25, active: true },
        { id: 3, name: "Robert Fil", age: 27, active: true },
        { id: 4, name: "Roger Robson", age: 81, active: true },
        { id: 5, name: "Billary Konwik", age: 18, active: true },
        { id: 6, name: "Bob Martin", age: 18, active: false },
        { id: 7, name: "Matthew Richardson", age: 54, active: false },
        { id: 8, name: "Ritchie Peterson", age: 54, active: false },
        { id: 9, name: "Bryan Martin", age: 40, active: false },
        { id: 10, name: "Mark Martin", age: 44, active: false },
        { id: 11, name: "Michelle Sebastian", age: 24, active: false },
        { id: 12, name: "Michelle Sullivan", age: 61, active: true },
        { id: 13, name: "Jordan Bike", age: 16, active: false },
        { id: 14, name: "Nelson Ford", age: 34, active: true },
        { id: 15, name: "Tim Cheap", age: 3, active: false },
        { id: 16, name: "Robert Carlson", age: 31, active: true },
        { id: 17, name: "Johny Perterson", age: 40, active: false },
    ];
    const [gridRef, setGridRef] = useState(null);
    const [searchText, setSearchText] = useState("");
    const [dataSource, setDataSource] = useState(people);

    const searchTextRef = useRef(searchText);
    searchTextRef.current = searchText;

    const render = useCallback(({ value }) => {
        const lowerSearchText = searchTextRef.current.toLowerCase();
        if (!lowerSearchText) {
            return value;
        }

        const str = value + ""; // get string value
        const v = str.toLowerCase(); // our search is case insensitive
        const index = v.indexOf(lowerSearchText);

        if (index === -1) {
            return value;
        }

        return [
            <span key="before">{str.slice(0, index)}</span>,
            <span
                key="match"
                style={{
                    background: "gold",
                    fontWeight: "bold",
                    padding: "2px",
                }}
            >
                {str.slice(index, index + lowerSearchText.length)}
            </span>,
            <span key="after">
                {str.slice(index + lowerSearchText.length)}
            </span>,
        ];
    }, []);
    const shouldComponentUpdate = () => true;
    const defaultColumnsXD = [
        {
            name: "id",
            header: "Id",
            width: 100,
            sortable: false,
            type: "number",
            render,
            shouldComponentUpdate,
            defaultVisible: true,
        },
        {
            name: "name",
            header: "Name",
            defaultFlex: 1,
            render,
            shouldComponentUpdate,
        },
        {
            name: "active",
            header: "Status",
            defaultFlex: 1,
            shouldComponentUpdate,
            render: ({ value }) => {
                return value ? (
                    <span className="inline-flex items-center rounded-full bg-green-100 px-3 py-0.5 text-sm font-medium text-green-800">
                        True
                    </span>
                ) : (
                    <span className="inline-flex items-center rounded-full bg-red-100 px-3 py-0.5 text-sm font-medium text-red-800">
                        false
                    </span>
                );
            },
        },
        {
            name: "age",
            header: ({ computedSortInfo }) => {
                let sortState = " - click to sort";

                if (computedSortInfo && computedSortInfo.name == "age") {
                    sortState =
                        " - sorted " +
                        (computedSortInfo.dir == 1
                            ? "ascending"
                            : "descending");
                }

                return "Age" + sortState;
            },
            defaultFlex: 1,
            type: "number",
            render,
            shouldComponentUpdate,
        },
    ];
    const [columns] = useState(defaultColumnsXD);

    const onSearchChange = ({ target: { value } }) => {
        const visibleColumns = gridRef.current.visibleColumns;
        setSearchText(value);

        const newDataSource = people.filter((p) => {
            return visibleColumns.reduce((acc, col) => {
                const v = (p[col.id] + "").toLowerCase(); // get string value
                return acc || v.indexOf(value.toLowerCase()) != -1; // make the search case insensitive
            }, false);
        });

        setDataSource(newDataSource);
    };

    const gridStyle = { minHeight: 550 };

    return (
        <div className="container mx-auto mt-32">
            {/* <Sidebar /> */}
            <div className=" h-screen lg:pl-20 pt-16 ">
                <div style={{ marginBottom: 20 }}>
                    <label>Search text: </label>
                    <input
                        type={"text"}
                        value={searchText}
                        onChange={onSearchChange}
                    />
                </div>
                <ReactDataGrid
                    onReady={setGridRef}
                    idProperty="id"
                    pagination
                    defaultLimit={10}
                    columns={columns}
                    dataSource={dataSource}
                    style={gridStyle}
                />
            </div>
        </div>
    );
}
