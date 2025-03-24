import React, { useState } from "react";
import Modal from "./Modal";
import Button from "./Button";
import Input from "./Input";
import plusSvg from "../../assets/plus.svg";
import Card from "./Card";

const base_url = "http://localhost:5173";

function getAllCardsData() {
  const AllCardData = [
    {
      id: 1,
      title: "Loop Through a String",
      code: "const text = 'Hello';\nfor (let i = 0; i < text.length; i++) {\n  console.log(text[i]);\n}",
      language: "JavaScript",
      is_favorite: false,
      is_public: true,
      tags: ["Array", "String"],
      keywords: ["loop", "string", "character"],
    },
    {
      id: 2,
      title: "Loop Through a String",
      code: "const text = 'Hello';\nfor (let i = 0; i < text.length; i++) {\n  console.log(text[i]);\n}",
      language: "JavaScript",
      is_favorite: false,
      is_public: true,
      tags: ["Array", "String"],
      keywords: ["loop", "string", "character"],
    },
    {
      id: 3,
      title: "Loop Through a String",
      code: "const text = 'Hello';\nfor (let i = 0; i < text.length; i++) {\n  console.log(text[i]);\n}",
      language: "JavaScript",
      is_favorite: false,
      is_public: true,
      tags: ["Array", "String"],
      keywords: ["loop", "string", "character"],
    },
    {
      id: 4,
      title: "Loop Through a String",
      code: "const text = 'Hello';\nfor (let i = 0; i < text.length; i++) {\n  console.log(text[i]);\n}",
      language: "JavaScript",
      is_favorite: false,
      is_public: true,
      tags: ["Array", "String"],
      keywords: ["loop", "string", "character"],
    },
  ];
  return AllCardData;
}

const CardsGrid = () => {
  const [filteredCardsData, setFilteredCardsData] = useState(getAllCardsData);
  // const [isEditing, setIsEditing] = useState(false);
  const [searchedText, setSearchedText] = useState("");
  const [selectedTag, setSelectedTag] = useState("");

  return (
    <>
      <div className="div-search-filter-create flex justify-between w-full">
        <div className="flex gap-8">
          <Input
            classes="body1 rounded-lg search-input"
            type="search"
            name="search"
            placeholder="search"
            value={searchedText}
            // onChange={(e) => {
            //   setSearchedText(e.target.value);
            // }}
          />
          <select
            name="tag"
            onChange={(e) => {
              setSelectedTag(e.target.value);
            }}
            value={selectedTag}
            className="body1 rounded-lg filter-input"
          >
            <option value="">select a tag</option>
            <option value="nature">tag 1</option>
            <option value="beach">tag 2</option>
            <option value="urban">tag 3</option>
          </select>
        </div>
        <button className="bg-primary btn" onClick={() => {}}>
          <img src={plusSvg} alt="plus icon" />
        </button>
      </div>
      <div className="cards-container">
        {filteredCardsData.map((item, index) => (
          <div className="card-item w-full" key={index}>
            <Card
              title={item.title}
              tags={item.tags}
              keywords={item.keywords}
              code={item.code}
            />
          </div>
        ))}
      </div>
    </>
  );
};

export default CardsGrid;
