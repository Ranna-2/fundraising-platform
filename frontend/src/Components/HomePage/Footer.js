import React from 'react';
import styles from './HomePageStyles';

const Footer = () => {
    return (
        <footer style={styles.footer}>
            <p>© 2023 Crowdfunding Platform. All rights reserved.</p>
            <div>
                <a href="/" style={styles.footerLink}>Home</a> | 
                <a href="donation.html" style={styles.footerLink}>Donation Page</a> | 
                <a href="/Campaign/index.html" style={styles.footerLink}>Campaigns</a> | 
                <a href="/HelpCenter/index.html" style={styles.footerLink}>Help Center</a> | 
                <a href="/HelpCenter/index.html" style={styles.footerLink}>FAQ</a> | 
                <a href="/contact" style={styles.footerLink}>Contact Us</a> | 
                <a href="/how-it-works" style={styles.footerLink}>How it Works</a> | 
                <a href="/terms" style={styles.footerLink}>Terms & Conditions</a> | 
                <a href="/privacy" style={styles.footerLink}>Privacy Policy</a>
            </div>
        </footer>
    );
};

export default Footer;