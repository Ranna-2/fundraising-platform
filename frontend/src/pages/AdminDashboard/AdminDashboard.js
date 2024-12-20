import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import { getUsers, getCampaigns } from "../../Components/AdminDashboard/adminService";
import Navbar from "../../Components/AdminDashboard/Navbar"; 
import Footer from "../../Components/AdminDashboard/Footer"; 
import "../../Components/AdminDashboard/AdminDashboard.css";

const AdminDashboard = () => {
    const [users, setUsers] = useState(null);
    const [campaigns, setCampaigns] = useState(null);
    const [error, setError] = useState(false);

    useEffect(() => {
        const fetchUsers = async () => {
            try {
                const userData = await getUsers();
                setUsers(userData || []);
            } catch (error) {
                console.error("Error fetching users:", error);
                setError(true);
            }
        };

        const fetchCampaigns = async () => {
            try {
                const campaignData = await getCampaigns();
                setCampaigns(campaignData || []);
            } catch (error) {
                console.error("Error fetching campaigns:", error);
                setError(true);
            }
        };

        fetchUsers();
        fetchCampaigns();
    }, []);

    if (error) {
        return <p className="error-message">Error loading data. Please check the server or API connection.</p>;
    }

    return (
        <div className="admin-dashboard">
            <Navbar />
            <div className="dashboard-container">
                <h1>Admin Dashboard</h1>

                {/* Users Section */}
                <section className="users-section">
                    <h2>Manage Users</h2>
                    {users ? (
                        users.length > 0 ? (
                            <table>
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {users.map((user) => (
                                        <tr key={user._id}>
                                            <td>{user.username}</td>
                                            <td>{user.email}</td>
                                            <td>{user.role}</td>
                                            <td>
                                                <button>Edit</button>
                                                <button>Deactivate</button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        ) : (
                            <p>No users found.</p>
                        )
                    ) : (
                        <p>Loading users...</p>
                    )}
                </section>

                {/* Campaigns Section */}
                <section className="campaigns-section">
                    <h2>Manage Campaigns</h2>
                    {campaigns ? (
                        campaigns.length > 0 ? (
                            <table>
                                <thead>
                                    <tr>
                                        <th>Campaign Title</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {campaigns.map((campaign) => (
                                        <tr key={campaign._id}>
                                            <td>{campaign.title}</td>
                                            <td>{campaign.status}</td>
                                            <td>{campaign.creator}</td>
                                            <td>
                                                <Link to={`/campaign/${campaign._id}`}>
                                                    View Details
                                                </Link>
                                                <button>Edit</button>
                                                <button>Deactivate</button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        ) : (
                            <p>No campaigns found.</p>
                        )
                    ) : (
                        <p>Loading campaigns...</p>
                    )}
                </section>

                <section className="settings-section">
                    <h2>Settings</h2>
                    <button>Platform Settings</button>
                    <button>Payment Integration</button>
                </section>
            </div>
            <Footer />
        </div>
    );
};

export default AdminDashboard;
