// Connect to the database
const db = connect("127.0.0.1:27017/fundraising_platform");

// Clear existing data if needed
db.users.drop();
db.support_tickets.drop();
db.notifications.drop();
db.messages.drop();
db.donations.drop();
db.payments.drop();
db.receipts.drop();
db.campaigns.drop();
db.analytics.drop();
db.updates.drop();

// Insert data for users
db.users.insertMany([
    {
        email: "user1@example.com",
        password: "hashedpassword1",
        first_name: "John",
        last_name: "Doe",
        role: "donor",
        profile_picture: "url1",
        created_at: new Date(),
        updated_at: new Date()
    },
    {
        email: "user2@example.com",
        password: "hashedpassword2",
        first_name: "Jane",
        last_name: "Smith",
        role: "campaigner",
        profile_picture: "url2",
        created_at: new Date(),
        updated_at: new Date()
    }
]);

// Insert data for support tickets
db.support_tickets.insertMany([
    {
        description: "Issue with donation",
        status: "open",
        subject: "Donation issue",
        user_id: db.users.findOne({ email: "user1@example.com" })._id,
        created_at: new Date(),
        updated_at: new Date()
    },
    {
        description: "Unable to login",
        status: "closed",
        subject: "Login issue",
        user_id: db.users.findOne({ email: "user2@example.com" })._id,
        created_at: new Date(),
        updated_at: new Date()
    }
]);

// Insert data for notifications
db.notifications.insertMany([
    {
        user_id: db.users.findOne({ email: "user1@example.com" })._id,
        content: "Donation received!",
        type: "donation",
        created_at: new Date()
    },
    {
        user_id: db.users.findOne({ email: "user2@example.com" })._id,
        content: "Campaign approved",
        type: "campaign_update",
        created_at: new Date()
    }
]);

// Insert data for campaigns
db.campaigns.insertMany([
    {
        title: "Save the Environment",
        goal_amount: 10000,
        description: "Raising funds for planting trees",
        current_amount: 5000,
        deadline: new Date("2024-12-31"),
        status: "active",
        user_id: db.users.findOne({ email: "user2@example.com" })._id,
        created_at: new Date(),
        updated_at: new Date()
    }
]);

// Insert data for donations
db.donations.insertMany([
    {
        user_id: db.users.findOne({ email: "user1@example.com" })._id,
        campaign_id: db.campaigns.findOne({ title: "Save the Environment" })._id,
        receipt_id: null,
        amount: 500,
        status: "completed",
        payment_method: "credit_card",
        donation_date: new Date()
    }
]);

// Insert data for payments
db.payments.insertMany([
    {
        donation_id: db.donations.findOne({ amount: 500 })._id,
        payment_method: "credit_card",
        amount: 500,
        currency: "USD",
        transaction_status: "successful",
        receipt_details: "Payment successful for donation"
    }
]);

// Insert data for receipts
db.receipts.insertMany([
    {
        donation_id: db.donations.findOne({ amount: 500 })._id,
        receipt_details: "Receipt for donation of $500",
        created_at: new Date()
    }
]);

// Insert data for analytics
db.analytics.insertMany([
    {
        campaign_id: db.campaigns.findOne({ title: "Save the Environment" })._id,
        created_at: new Date(),
        donation_trends: [500],
        donor_count: 1,
        average_donation: 500,
        total_donations: 500
    }
]);

// Insert data for updates
db.updates.insertMany([
    {
        campaign_id: db.campaigns.findOne({ title: "Save the Environment" })._id,
        created_at: new Date(),
        content: "Thank you for your donations! We've reached half our goal!"
    }
]);

print("Database setup completed!");
