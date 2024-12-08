const express = require("express");
const cors = require("cors");
const app = express();

app.use(cors());
app.use(express.json());

const campaigns = [
    {
        id: 1,
        title: "Emergency Relief for Flood Victims",
        description: "The recent devastating floods have displaced numerous families in our community, leaving them without basic necessities.",
        image: "flood.jpg",
        donationOptions: [10, 20, 50, 100],
        bankDetails: {
            bankName: "Example Bank",
            accountNumber: "123456789",
            accountName: "Crowdfunding Platform",
            swiftCode: "EXAMP123",
        },
        paymentMethods: ["credit-card", "paypal", "stripe", "bank-slip", "ezcash"],
    },
];

// Get campaign details by ID
app.get("/api/campaigns/:id", (req, res) => {
    const campaign = campaigns.find((c) => c.id === parseInt(req.params.id));
    if (!campaign) return res.status(404).send("Campaign not found.");
    res.send(campaign);
});

// Start the server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
