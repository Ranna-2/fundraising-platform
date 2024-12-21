const { MongoClient } = require("mongodb");


const uri = "mongodb://localhost:27017";

const client = new MongoClient(uri);

const connectDB = async () => {
  try {
    await client.connect();
    console.log("Connected to MongoDB");
  } catch (err) {
    console.error("Failed to connect to MongoDB:", err);
  }
};

module.exports = { client, connectDB };

const { connectDB } = require("./db");


connectDB();
