import React from 'react';
import styles from './HomePageStyles';
import NavBar from './NavBar';
import SearchBar from './SearchBar';

const HomePage = () => {
    return (
        <div style={styles.container}>
             {/* Navigation Bar */}
             <NavBar /> {/* This makes sure that the NavBar is visible */}
            {/* Hero Section */}
            <div style={styles.hero}>
                <div style={styles.heroOverlay}></div>

                <div style={styles.heroContent}> 
                <h1 style={styles.heroTitle}>Raise Money for What Matters</h1>
                <p style={styles.heroSubtitle}>KindledHope.lk is a platform designed to bring together individuals and communities to support causes that matter. By donating or starting your own fundraising campaign, you can make a significant difference in the lives of others.</p>
                <div>
                <a href="/Campaign/index.html" style={styles.ctaButton}>Start a Campaign</a>
                    <button style={styles.ctaButton}>Learn More</button>
                </div>
                <SearchBar />
            </div>
            </div>

            {/* Features Section */}
            <div style={styles.features}>
                <div style={styles.featureCard}>
                    <i style={styles.featureIcon} className="fa fa-bullhorn"></i>
                    <h3>Easy to Use</h3>
                    <p>Create a campaign in minutes and share it with your network.</p>
                </div>
                <div style={styles.featureCard}>
                    <i style={styles.featureIcon} className="fa fa-lock"></i>
                    <h3>Secure Payments</h3>
                    <p>Your transactions are safe and encrypted.</p>
                </div>
                <div style={styles.featureCard}>
                    <i style={styles.featureIcon} className="fa fa-chart-line"></i>
                    <h3>Track Progress</h3>
                    <p>Monitor your fundraising in real-time.</p>
                </div>
            </div>

            

            {/* Footer */}
            <footer style={styles.footer}>
                <p>© 2023 Crowdfunding Platform. All rights reserved.</p>
            </footer>
        </div>
    );
};

export default HomePage;