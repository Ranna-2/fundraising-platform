import React, { useState } from 'react';
import styles from './HomePageStyles';
import NavBar from './NavBar';

const HomePage = () => {
    const [hover, setHover] = useState(null);

    const handleMouseEnter = (button) => setHover(button);
    const handleMouseLeave = () => setHover(null);

    return (
        <div style={styles.container}>
            {/* Navigation Bar */}
            <NavBar />

            {/* Hero Section */}
            <div style={styles.hero}>
                <div style={styles.heroOverlay}></div> {/* Add overlay for readability */}
                <div style={styles.heroContainer}>
                    <h1 style={styles.heroTitle}>Raise Money for What Matters</h1>
                    <p style={styles.heroSubtitle}>
                        Discover powerful tools to bring your ideas to life.
                    </p>

                    {/* Buttons Section */}
                    <div className="d-flex justify-content-center gap-3">
                        {/* Start Campaign Button */}
                        <a
                            href="#"
                            className="btn btn-light btn-lg"
                            onMouseEnter={() => handleMouseEnter('start')}
                            onMouseLeave={handleMouseLeave}
                            style={{
                                ...styles.ctaButton,
                                ...(hover === 'start' ? styles.ctaButtonHover : {}),
                            }}
                        >
                            Start a Campaign
                        </a>

                        {/* Learn More Button */}
                        <a
                            href="#"
                            className="btn btn-outline-light btn-lg"
                            onMouseEnter={() => handleMouseEnter('learn')}
                            onMouseLeave={handleMouseLeave}
                            style={{
                                ...styles.ctaButton,
                                ...(hover === 'learn' ? styles.ctaButtonHover : {}),
                            }}
                        >
                            Learn More
                        </a>
                    </div>
                </div>
            </div>

            {/* Additional Sections */}
            {/* Add other sections below as needed */}
        </div>
    );
};

export default HomePage;
