import React from 'react';
import styles from './HomePageStyles';

const FeaturesSection = () => {
    return (
        <div style={styles.features}>
            <div style={styles.featureCard}>
                <div style={styles.featureIconContainer}>
                    <img 
                        src="/images/feature1.png" 
                        alt="Easy to Use" 
                        style={styles.featureImage} 
                    />
                </div>
                <h3>Easy to Use</h3>
                <p>Create a campaign in minutes and share it with your network.</p>
            </div>
            <div style={styles.featureCard}>
                <div style={styles.featureIconContainer}>
                    <img 
                        src="/images/feature2.png" 
                        alt="Secure Payments" 
                        style={styles.featureImage} 
                    />
                </div>
                <h3>Secure Payments</h3>
                <p>Your transactions are safe and encrypted.</p>
            </div>
            <div style={styles.featureCard}>
                <div style={styles.featureIconContainer}>
                    <img 
                        src="/images/feature3.png" 
                        alt="Track Progress" 
                        style={styles.featureImage} 
                    />
                </div>
                <h3>Track Progress</h3>
                <p>Monitor your fundraising in real-time.</p>
            </div>
        </div>
    );
};

export default FeaturesSection;