import React from 'react';
import styles from './HomePageStyles';
import NavBar from './NavBar';
import SearchBar from './SearchBar';
import FeaturedCampaignsSection from './FeaturedCampaignsSection';
import FeaturedSection from './FeaturesSection';
import Footer from './Footer';

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
            
            <FeaturedSection />
            <FeaturedCampaignsSection />
           

            {/* Footer */}
            <Footer />
        </div>
    );
};

export default HomePage;