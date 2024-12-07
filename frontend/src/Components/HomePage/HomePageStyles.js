const styles = {
    container: {
      fontFamily: 'Arial, sans-serif',
      margin: 0,
      padding: 0,
    },
  
    hero: {
    
      position: 'relative',
      backgroundImage: 'url(/images/background.png)', // Add your background image here
      backgroundSize: 'cover',
      backgroundPosition: 'center',
      height: '100vh', // Adjust the height as needed
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      color: '#fff', // Text color
      
},
heroOverlay: {
  position: 'absolute',
  top: 0,
  left: 0,
  width: '100%',
  height: '100%',
  background: 'rgba(0, 0, 0, 0.5)', // Overlay color
  zIndex: 1, // Overlay should be below the text and buttons
},

  
    heroContent: {
      position: 'relative',
      zIndex: 2, // Ensures content is on top of the overlay
    },
  
    heroTitle: {
      fontSize: '3rem',
      fontWeight: 'bold',
      marginBottom: '1rem',
    },
  
    heroSubtitle: {
      fontSize: '1.5rem',
      marginBottom: '2rem',
    },

    // HomePageStyles.js (add this to your existing styles)
searchBar: {
  marginTop: '2rem',
  padding: '1rem',
  backgroundColor: '#f9f9f9',
  borderRadius: '8px',
},
  
    // Updated button styles to replace glassmorphism and apply the new button styles
    ctaButton: {
      margin: '0 10px',
      padding: '20px 30px',
      fontSize: '1rem',
      fontWeight: 'bold',
      color: '#fff',
      backgroundColor: '#28a745',  // Solid background color for button
      borderColor: '#28a745',      // Ensure border matches background
      borderRadius: '12px',
      cursor: 'pointer',
      transition: 'background-color 0.3s, transform 0.2s',
    },
  
    ctaButtonHover: {
      backgroundColor: '#1e8b5f',  // Slightly darker color on hover
      transform: 'scale(1.05)',     // Hover effect for scaling
    },
  
    // Optional: Add outline button styles
    ctaButtonOutline: {
      margin: '0 10px',
      padding: '20px 30px',
      fontSize: '1rem',
      fontWeight: 'bold',
      color: '#28a745', // Green text color
      backgroundColor: 'transparent', // Transparent background
      borderColor: '#28a745', // Green border
      borderRadius: '12px',
      cursor: 'pointer',
      transition: 'background-color 0.3s, transform 0.2s',
    },
  
    ctaButtonOutlineHover: {
      backgroundColor: '#28a745',  // Background becomes green on hover
      color: '#fff',               // White text color on hover
    },
  
    features: {
      display: 'flex',
      justifyContent: 'space-around',
      padding: '2rem',
      background: '#f9f9f9',
    },
  
    featureCard: {
      textAlign: 'center',
      width: '30%',
    },
  
    featureIcon: {
      fontSize: '2rem',
      marginBottom: '1rem',
    },
  
    campaigns: {
      padding: '2rem',
    },
  
    campaignCard: {
      display: 'flex',
      marginBottom: '1rem',
    },
  
    campaignImage: {
      width: '40%',
      marginRight: '1rem',
      borderRadius: '8px',
    },
  
    campaignContent: {
      textAlign: 'left',
    },
  
    footer: {
      padding: '1rem',
      textAlign: 'center',
      background: '#333',
      color: '#fff',
    },
  };
  
  export default styles;
  