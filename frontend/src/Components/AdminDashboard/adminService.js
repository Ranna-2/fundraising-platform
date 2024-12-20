import axios from "axios";

const API_URL = "http://localhost:5000"; // Replace with your API endpoint

// Fetch all users
export const getUsers = async () => {
    try {
        const response = await axios.get(`${API_URL}/users`);
        return response.data;
    } catch (error) {
        console.error("Error fetching users:", error);
        throw error;
    }
};

// Fetch all campaigns
export const getCampaigns = async () => {
    try {
        const response = await axios.get(`${API_URL}/campaigns`);
        return response.data;
    } catch (error) {
        console.error("Error fetching campaigns:", error);
        throw error;
    }
};
