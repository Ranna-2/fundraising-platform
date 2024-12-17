
import React from 'react';
import styles from './HomePageStyles';

const FeaturedCampaignsSection = () => {
    return (
        <div style={styles.featuredCampaigns}>
            <h2>Featured Campaigns</h2>
            <div style={styles.campaignsContainer}>
                <div className="program-card">
                    <img src="/images/disaster2.jpg" alt="Food & Water Relief" />
                    <div className="card-content">
                        <h3>Food & Water Relief</h3>
                        <p>Delivering essential food supplies and clean drinking water to affected regions after a disaster.</p>
                        <a href="Donation.html" className="donate-btn" style={styles.donateButton}>Donate Now</a>
                    </div>
                </div>
                <div className="program-card">
                    <img src="/images/program1.jpg" alt="Free Health Checkups" />
                    <div className="card-content">
                        <h3>Free Health Checkups</h3>
                        <p>Providing free health checkup camps for underprivileged communities to detect and treat diseases early.</p>
                        <a href="Donation.html" className="donate-btn" style={styles.donateButton}>Donate Now</a>
                    </div>
                </div>
                <div className="program-card">
                    <img src="/images/hunger5.jpg" alt="School Meal Programs" />
                    <div className="card-content">
                        <h3>School Meal Programs</h3>
                        <p>Ensuring that children in need receive daily meals to keep them healthy and focused in school.</p>
                        <button className="donate-btn" style={styles.donateButton}>Donate Now</button>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default FeaturedCampaignsSection;