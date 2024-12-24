import React from "react";

const Card = ({ title, description, image, link }) => {
  return (
    <div className="card">
      <img src={image} alt={title} className="card-image" />
      <h3>{title}</h3>
      <p>{description}</p>
      <a href={link} className="card-link">Learn More</a>
    </div>
  );
};

export default Card;
