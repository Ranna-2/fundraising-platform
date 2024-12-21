import React, { useState, useEffect } from "react";
import "../../Components/CampaignDetailsPage/CampaignDetailsPage.css"; // Import the CSS for styling
import NavBar from "../../Components/HomePage/NavBar";
import Footer from '../../Components/HomePage/Footer'; 

const CampaignDetailsPage = () => {
  const [campaign, setCampaign] = useState(null);
  const [bankDetails, setBankDetails] = useState(null);
  const [donationAmount, setDonationAmount] = useState("");
  const [isAnonymous, setIsAnonymous] = useState(false);
  const [loading, setLoading] = useState(true);

  // Dummy data
  const dummyCampaign = {
    id: 1,
    name: "Suwaseriya Appeal",
    location: "Islandwide",
    category: "Healthcare",
    description:
      "The Suwaseriya Appeal is a life-saving initiative aimed at providing emergency healthcare services across the nation. Your support will help us save lives and expand our reach.",
    imageUrl:
      "https://resources.karuna.lk/program/shareurlbanner/874936e2-b5c0-4e63-a9e4-9caa2e601bb5.jpeg",
    raisedAmount: 1407573.93,
    goalAmount: 10000000,
    donors: 2507,
  };

  const dummyBankDetails = {
    accountName: "Suwaseriya Appeal",
    accountNumber: "1234567890",
    bank: "Commercial Bank",
    branch: "Colombo Main",
    swiftCode: "CCEYKLX",
  };

  // Simulate API call with dummy data
  useEffect(() => {
    const fetchDummyData = async () => {
      setLoading(true);
      try {
        // Simulate network delay
        await new Promise((resolve) => setTimeout(resolve, 1000));
        setCampaign(dummyCampaign);
        setBankDetails(dummyBankDetails);
      } catch (error) {
        console.error("Error fetching dummy data:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchDummyData();
  }, []);

  const handleDonate = () => {
    console.log(`Donating ${donationAmount}, Anonymous: ${isAnonymous}`);
    alert("Thank you for your donation!");
  };

  if (loading) {
    return <div>Loading...</div>;
  }

  if (!campaign || !bankDetails) {
    return <div>Error loading campaign details. Please try again later.</div>;
  }

  return (
    <div className="campaign-container">
      {/* Navigation Bar */}
      <NavBar />

      {/* Hero Section */}
      <header className="campaign-header">
        <h1>{campaign.name}</h1>
        <p>
          {campaign.location} | {campaign.category}
        </p>
      </header>

      <div className="campaign-main">
        <div className="campaign-image">
          <img src={campaign.imageUrl} alt={campaign.name} />
          <div className="campaign-progress">
            <p>Raised: LKR {campaign.raisedAmount.toLocaleString()}</p>
            <p>Goal: LKR {campaign.goalAmount.toLocaleString()}</p>
          </div>

          {/* Campaign Description */}
          <div className="campaign-description">
            <h2>Campaign Description</h2>
            <p>{campaign.description}</p>
          </div>

          {/* Bank Account Details */}
          <div className="bank-details">
            <h2>Bank Account Details</h2>
            <p>
              <strong>Account Name:</strong> {bankDetails.accountName}
              <br />
              <strong>Account Number:</strong> {bankDetails.accountNumber}
              <br />
              <strong>Bank:</strong> {bankDetails.bank}
              <br />
              <strong>Branch:</strong> {bankDetails.branch}
              <br />
              <strong>SWIFT Code:</strong> {bankDetails.swiftCode}
            </p>
          </div>
        </div>

        <div className="campaign-details">
          <h2>Select Donation Amount</h2>
          <div className="donation-amount-options">
            {[500, 1000, 5000, 10000, 50000].map((amount) => (
              <button
                key={amount}
                className="amount-btn"
                onClick={() => setDonationAmount(amount)}
              >
                LKR {amount}
              </button>
            ))}
          </div>
          <input
            type="number"
            placeholder="Enter custom amount"
            value={donationAmount}
            onChange={(e) => setDonationAmount(e.target.value)}
          />

          <h2>Select Payment Method</h2>
          <div className="payment-methods">
            {["Card", "Add To Bill", "Star Points", "eZCash", "Bank Slip"].map(
              (method) => (
                <button key={method} className="payment-btn">
                  {method}
                </button>
              )
            )}
          </div>

          <div className="word-support">
            <label htmlFor="support-message">Word of Support</label>
            <input
              type="text"
              id="support-message"
              placeholder="Type your word of support here"
            />
          </div>

          <div className="anonymous-option">
            <label>
              <input
                type="checkbox"
                checked={isAnonymous}
                onChange={() => setIsAnonymous(!isAnonymous)}
              />
              Donate Anonymously
            </label>
          </div>

          <button className="donate-now-btn" onClick={handleDonate}>
            Donate Now
          </button>
        </div>
      </div>

      <footer className="campaign-footer">
        <p>{campaign.donors} Donors</p>
        <p>LKR {campaign.goalAmount.toLocaleString()} Needed</p>
      </footer>
      {/* Footer */}
      <Footer />
    </div>
  );
};

export default CampaignDetailsPage;

