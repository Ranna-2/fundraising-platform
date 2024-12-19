import React from 'react';
import styles from '../../Components/HomePage/HomePageStyles'; 
import NavBar from '../../Components/HomePage/NavBar'; 
import SearchBar from '../../Components/HomePage/SearchBar'; 
import FeaturedCampaignsSection from '../../Components/HomePage/FeaturedCampaignsSection'; 
import FeaturedSection from '../../Components/HomePage/FeaturesSection'; 
import Footer from '../../Components/HomePage/Footer'; 
import FormPage from '../../Components/HomePage/FormPage'; 

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
                    
                    
                    <div style={styles.buttonContainer}> {}
                        <a href="Donation.html" className="cta-btn" style={{...styles.ctaButton, textDecoration: 'none'}}>Start a Campaign </a>
                        <a href="Donation.html" className="cta-btn" style={{...styles.ctaButton, textDecoration: 'none'}}> Learn More </a>
                    </div>  
                   
                    <SearchBar style={styles.searchBar} /> {/* Corrected prop name and removed duplicate */}
                
                </div>
            </div>

            {/* Features Section */}
            <FeaturedSection />
            <FeaturedCampaignsSection />

            {/* Form Page */}
            <FormPage/>

            {/* Footer */}
            <Footer />
        </div>
    );
};

export default HomePage;