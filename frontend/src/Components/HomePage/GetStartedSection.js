import React from 'react';
import { Link } from 'react-router-dom';

const GetStartedSection = () => {
    return (
        <div>
            <p>Join our community of changemakers today! Register now to create your first campaign or support an existing one.</p>
            <Link to="/register" style={{ padding: '12px 30px', backgroundColor: '#007bff', color: '#fff', textDecoration: 'none', borderRadius: '5px' }}>
                Get Started
            </Link>
        </div>
    );
};

export default GetStartedSection;
