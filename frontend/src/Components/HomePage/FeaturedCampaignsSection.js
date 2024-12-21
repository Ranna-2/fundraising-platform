import React from 'react';
import styles from './HomePageStyles';

const FeaturedCampaignsSection = () => {
    return (
        <div style={styles.featuredCampaigns}>
            <h2>Featured Campaigns</h2>
            <div className="card-container">
                <div className="card">
                    <img src="/images/featuredCampaigns/disaster2.jpg" alt="Food & Water Relief" />
                    <div className="card-content">
                        <h3 className="card-title">Food & Water Relief</h3>
                        <p className="card-description">Delivering essential food supplies and clean drinking water to affected regions after a disaster.</p>
                        <a href="Donation.html" className="donate-btn">Donate Now</a>
                    </div>
                </div>
                <div className="card">
                    <img src="/images/featuredCampaigns/program1.jpg" alt="Free Health Checkups" />
                    <div className="card-content">
                        <h3 className="card-title">Free Health Checkups</h3>
                        <p className="card-description">Providing free health checkup camps for underprivileged communities to detect and treat diseases early.</p>
                        <a href="Donation.html" className="donate-btn">Donate Now</a>
                    </div>
                </div>
                <div className="card">
                    <img src="/images/featuredCampaigns/hunger5.jpg" alt="School Meal Programs" />
                    <div className="card-content">
                        <h3 className="card-title">School Meal Programs</h3>
                        <p className="card-description">Ensuring that children in need receive daily meals to keep them healthy and focused in school.</p>
                        <a href="Donation.html" className="donate-btn">Donate Now</a>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default FeaturedCampaignsSection;