import React from 'react';
import styles from './HomePageStyles';

const Footer = () => {
    return (
        <footer style={styles.footer}>
            <p>© 2023 Crowdfunding Platform. All rights reserved.</p>
            <a href="/terms" style={styles.footerLink}>Terms & Conditions</a> | 
            <a href="/privacy" style={styles.footerLink}>Privacy Policy</a>
        </footer>
    );
};

export default Footer;
