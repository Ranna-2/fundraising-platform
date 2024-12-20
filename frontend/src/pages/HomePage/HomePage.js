import React from 'react';
import styles from '../../Components/HomePage/HomePageStyles'; 
import NavBar from '../../Components/HomePage/NavBar'; 
import SearchBar from '../../Components/HomePage/SearchBar'; 
import FeaturedCampaignsSection from '../../Components/HomePage/FeaturedCampaignsSection'; 
import FeaturedSection from '../../Components/HomePage/FeaturesSection'; 
import Footer from '../../Components/HomePage/Footer'; 
import FormPage from '../../Components/HomePage/FormPage'; 
import Testimonial from '../../Components/HomePage/Testimonials';
import CarouselSection from '../../Components/HomePage/CarouselSection';
import { Link } from 'react-router-dom'; // Import Link for routing
import '../../Components/HomePage/HomePage.css'; // Import custom CSS for animations and styles

const HomePage = () => {
    return (
        <div style={styles.container}>
            {/* Navigation Bar */}
            <NavBar />
            {/* Hero Section */}
            <div className="hero-section">
                <div className="hero-overlay"></div>
                <div className="hero-content"> 
                    <h1 className="hero-title">Raise Money for What Matters</h1>
                    <p className="hero-subtitle">KindledHope.lk is a platform designed to bring together individuals and communities to support causes that matter. By donating or starting your own fundraising campaign, you can make a significant difference in the lives of others.</p>
                    <div className="button-container">
                        <Link to="/fundraiserpage" className="cta-btn">Start a Campaign</Link>
                        <Link to="/fundraiserpage" className="cta-btn">Learn More</Link>
                    </div>  
                    <SearchBar />
                </div>
            </div>
            {/* Features Section */}
            
            <FeaturedSection />
            <FeaturedCampaignsSection />
            <CarouselSection />
            <Testimonial/>
            {/* Form Page */}
            <FormPage/>
            {/* Footer */}
            <Footer />
        </div>
    );
};

export default HomePage;