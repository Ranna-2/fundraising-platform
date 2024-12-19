const styles = {
  // General container styles
  container: {
      fontFamily: 'Arial, sans-serif',
      margin: 0,
      padding: 0,
  },

  // Hero section styles
  hero: {
      position: 'relative',
      backgroundImage: 'url(/images/background.png)', 
      backgroundSize: 'cover',
      backgroundPosition: 'center',
      height: '100vh', 
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      color: '#fff', 
  },
  heroOverlay: {
      position: 'absolute',
      top: 0,
      left: 0,
      width: '100%',
      height: '100%',
      background: 'rgba(0, 0, 0, 0.5)', 
      zIndex: 1, 
  },
  heroTitle: {
      fontSize: '3rem',
      fontWeight: 'bold',
      marginBottom: '1rem',
  },
  heroContent: {
      position: 'relative',
      zIndex: 2, 
  },
  heroSubtitle: {
      fontSize: '1.5rem',
      marginBottom: '2rem',
  },

  // Search bar styles
  searchBar: {
      marginTop: '2rem',
      padding: '1rem',
      backgroundColor: '#f9f9f9',
      borderRadius: '8px',
  },

  // Call to action button styles
  ctaButton: {
      margin: '0 10px',
      padding: '20px 30px',
      fontSize: '1rem',
      fontWeight: 'bold',
      color: '#fff',
      backgroundColor: '#28a745',  
      borderColor: '#28a745',     
      borderRadius: '12px',
      cursor: 'pointer',
      transition: 'background-color 0.3s, transform 0.2s',
  },
  ctaButtonHover: {
      backgroundColor: '#1e8b5f',  
      transform: 'scale(1.05)',     
  },

  
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

  // Features section styles
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
  featureIconContainer: {
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      height: '100px', // Fixed height for icon container
      marginBottom: '15px',
  },
  featureImage: {
      maxWidth: '80px',      // Limit maximum width
      maxHeight: '80px',     // Limit maximum height
      width: 'auto',         // Maintain aspect ratio
      height: 'auto',        // Maintain aspect ratio
      objectFit: 'contain',  // Ensure the entire image is visible
  },

  // Campaigns section styles
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

  // Footer styles
  footer: {
      padding: '1rem',
      textAlign: 'center',
      background: '#333',
      color: '#fff',
  },

  // Featured campaigns section styles
  featuredCampaigns: {
      padding: '2rem',
      backgroundColor: '#f9f9f9',
      textAlign: 'center',
  },
  campaignsContainer: {
      display: 'flex',
      justifyContent: 'space-between',
      gap: '20px',
  },

  // Donate button styles
  donateButton: {
      backgroundColor: '#28a745',
      color: 'white',
      border: 'none',
      padding: '10px 20px',
      borderRadius: '5px',
      cursor: 'pointer',
      transition: 'background-color 0.3s',
      
  },
};

export default styles;