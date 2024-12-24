// src/pages/FundraiserPage/FundraiserPage.js
import React, { useState, useEffect } from "react";
import Navbar from "../../Components/FundraiserPage/Navbar";
import Footer from "../../Components/HomePage/Footer";
import Card from "../../Components/FundraiserPage/Card";
import Loading from "../../Components/FundraiserPage/Loading";
import "../../Components/FundraiserPage/Donation.css";

const FundraiserPage = () => {
  const [fundraisers, setFundraisers] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // Simulate API fetch
    setTimeout(() => {
      setFundraisers([
        {
          id: 1,
          title: "Feed Starved Kids in Gaza",
          description: "Provide hot meals to children in need.",
          image: "/images/gaza-campaign.jpg",
          link: "/campaign/1",
        },
        {
          id: 2,
          title: "Help Earthquake Victims",
          description: "Support families affected by earthquakes.",
          image: "/images/earthquake-campaign.jpg",
          link: "/campaign/2",
        },
      ]);
      setLoading(false);
    }, 2000); // Simulated delay
  }, []);

  return (
    <div className="fundraiser-page">
      <Navbar />
      <div className="hero-section">
        <h1>Support Our Fundraisers</h1>
        <p>Your contributions can make a difference!</p>
      </div>
      <div className="content">
        <h1>Current Fundraisers</h1>
        {loading ? (
          <Loading />
        ) : (
          <div className="card-container">
            {fundraisers.map((fundraiser) => (
              <Card
                key={fundraiser.id}
                title={fundraiser.title}
                description={fundraiser.description}
                image={fundraiser.image}
                link={fundraiser.link}
              />
            ))}
          </div>
        )}
      </div>
      <Footer />
    </div>
  );
};

export default FundraiserPage;